<?php 

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class RoleHelper{
    public static function hasRole($role){
        if(Auth::guard('patient')->check()){
            return false;
        }

        $hasRole = false;
        foreach(Auth::guard('web')->user()->user_role as $userRole){
            if($userRole->dm_role->name == $role){
                $hasRole = true;
            }
        }

        return $hasRole;
    }
}
?>