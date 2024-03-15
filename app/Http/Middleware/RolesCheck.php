<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RolesCheck
{
    public function handle(Request $request, Closure $next)
    {
        
        $hasAccess = false;
        if(Auth::guard('web')->check()){
            $roles = array_slice(func_get_args(), 2);
            foreach ($roles as $role) {
                $userId = Auth::guard('web')->user()->id;
                $userCount = UserRole::where('user_id', $userId)->wherehas('dm_role', function($q) use($role){
                    $q->where('name', $role);
                })->count();
    
                if($userCount){
                    $hasAccess = true;
                    break;
                }
            }
        }else if(Auth::guard('patient')->check() || in_array("Patient", func_get_args())){
            $hasAccess = true;
        }

        return $hasAccess ? $next($request) : to_route('auth.login');
    }
}
