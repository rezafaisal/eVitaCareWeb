<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\DmRole;
use App\Models\DmUserStatus;
use App\Models\HomeCarePatient;
use App\Models\User;
use App\Models\UserRole;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(){
        $users = User::with('user_role', 'dm_user_status')->get();
        return view('user.index', compact('users'));
    }

    public function create(){
        $user_statuses = DmUserStatus::all();
        $user_roles = DmRole::all();
        return view('user.create', compact('user_statuses', 'user_roles'));
    }

    public function store(UserRequest $request){
        try{
            DB::beginTransaction();

            $user = User::create([
                'name' => $request->name,
                'phone_number' => $request->phone,
                'email' => $request->email,
                'nip' => $request->nip,
                'password' => bcrypt($request->email),
                'dm_user_status_id' => $request->status,
            ]);
    
            for($i = 0; $i < DmRole::count(); $i++){
                if($request->get("role-$i") == "on"){
                    UserRole::create([
                        'user_id' => $user->id,
                        'dm_role_id' => $i
                    ]);
                }
            }

            DB::commit();
            return redirect(route('user.index'))->with('success', 'Berhasil Menambahkan User Baru');
        }catch(Exception $e){
            DB::rollBack();
        }
    }

    public function edit($id){
        $user = User::find($id);
        $user_statuses = DmUserStatus::all();
        $user_roles = DmRole::all();
        return view('user.create', compact('user_statuses', 'user_roles', 'user'));
    }

    public function update(UserRequest $request, $id){
        try{
            DB::beginTransaction();
            User::find($id)->update([
                'name' => $request->name,
                'phone_number' => $request->phone,
                'email' => $request->email,
                'nip' => $request->nip,
                'dm_user_status_id' => $request->status,
            ]);
    
            UserRole::where('user_id', $id)->delete();
            for($i = 0; $i < DmRole::count(); $i++){
                if($request->get("role-". ($i + 1)) == "on"){
                    UserRole::create([
                        'user_id' => $id,
                        'dm_role_id' => $i + 1
                    ]);
                }
            }

            DB::commit();
            return redirect(route('user.index'))->with('success', 'Berhasil Mengubah Data User');
        }catch(Exception $e){
            DB::rollBack();
        }
    }

    public function delete($id){
        if(HomeCarePatient::where('doctor_dpjp_id', $id)->count()){
            return redirect(route('user.index'))->with('error', 'Akses Ditolak, Dokter Sedang Menjadi DPJP!');
        }
        
        try{
            DB::beginTransaction();
            UserRole::where('user_id', $id)->delete();
            User::find($id)->delete();
            DB::commit();
            return redirect(route('user.index'))->with('success', 'Berhasil Menghapus Akun!');
        }catch(Exception $e){
            DB::rollBack();
            return redirect(route('user.index'))->with('error', 'Terjadi Kesalahan, Silahkan Coba Lagi!');
        }
    }

    public function datatable(Request $request){

    }
}
