<?php

namespace App\Http\Controllers;

use App\Helpers\RoleHelper;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\DmGender;
use App\Models\Patient;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function verify(LoginRequest $request){
        if(Auth::guard('patient')->attempt($request->only('email', 'password'))){
            return to_route('dashboard');
        }
        
        if(Auth::guard('web')->attempt($request->only('email', 'password'))){
            if(RoleHelper::hasRole('Administrator')){
                if(RoleHelper::hasRole('Doctor')){
                    return to_route('dashboard');
                }

                return to_route('roles.index');
            }

            return to_route('dashboard');
        }

        return to_route('auth.login')->with('error', 'Email atau Password Salah!');
    }

    public function register(){
        $genders = DmGender::all();
        return view('auth.register', compact('genders'));
    }

    public function registration(RegisterRequest $request){
        try{
            Patient::create([
                'name' => $request->name,
                'nik' => $request->nik,
                'birth_date' => $request->birth_date,
                'dm_gender_id' => $request->gender_id,
                'bpjs_number' => $request->bpjs_number,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
            return to_route('auth.login')->with('success', 'Pendaftaran sukses, silahkan login menggunakan email');
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Terjadi kesalahan, silahkan coba lagi!');
        }
    }

    public function logout(Request $request){
        Auth::guard('web')->logout();
        Auth::guard('patient')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return to_route('auth.login');
    }

    public function profile(){
        return view('auth.profile');
    }

    public function editProfile(){
        return view('auth.edit-profile', [
            'user' => Auth::user()
        ]);
    }

    public function updateProfile(Request $request){
        User::find(Auth::user()->id)->update([
            'name' => $request->name,
            'nip' => $request->nip,
            'phone' => $request->phone,
            'email' => $request->email
        ]);

        return redirect(route('profile'))->with('success', 'Berhasil Mengubah Profile');
    }

    public function updatePassword(Request $request){
        if(password_verify($request->old_password, Auth::user()->password)){
            if($request->new_password == $request->c_password){
                $user = User::find(Auth::user()->id);
                $user->password = bcrypt($request->new_password);
                $user->save();
                return redirect(route('profile'))->with('is_change_password', true)->with('success', 'Berhasil Mengubah Password');
            }else{
                return back()->with('is_change_password', true)->with('error', 'Konfirmasi Password Harus Sama Dengan Password Baru!');
            }
        }else{
            return back()->with('is_change_password', true)->with('error', 'Password Lama Anda Salah!');
        }
    }
}
