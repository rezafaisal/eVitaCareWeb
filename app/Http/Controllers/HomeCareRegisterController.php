<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\HomeCarePatient;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\HomeCareRegisterRequest;

class HomeCareRegisterController extends Controller
{
    public function index(){
        $user = Auth::guard('patient')->user();
        $doctors = User::wherehas('user_role', function($q){
            $q->where('dm_role_id', 2);
        })->get();

        return view('home_care_register.index', compact('user', 'doctors'));
    }

    public function registration(HomeCareRegisterRequest $request){
        try{
            HomeCarePatient::create([
                'patient_id' => Auth::guard('patient')->user()->id,
                'doctor_dpjp_id' => $request->doctor_id,
                'dm_monitoring_status_id' => 1,
                'registration_date' => date('Y-m-d')
            ]);

            return to_route('dashboard')->with('success', 'Berhasil Mendaftar Silahkan Tunggu Sampai Dikonfirmasi!');
        }catch(Exception $e){
            return to_route('home_care_register.index')->with('error', 'Terjadi Kesalahan, Mohon Coba Lagi!');
        }
    }
}
