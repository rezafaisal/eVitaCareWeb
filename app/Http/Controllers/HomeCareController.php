<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Consultation;
use Illuminate\Http\Request;
use App\Models\HomeCarePatient;
use Illuminate\Support\Facades\Auth;

class HomeCareController extends Controller
{
    public function index(){
        $home_care_patient = HomeCarePatient::with('vital_sign')->where('patient_id', Auth::user()->id)->first();
        return view('home_care.index', compact('home_care_patient'));
    }

    public function getChat(){
        $raw_consultations = Consultation::whereHas('home_care_patient', function($q){
            $q->where('patient_id', Auth::user()->id);
        })->orderBy('created_at', 'ASC')->get();     
                                    
        $consultations = [];
        foreach($raw_consultations as $consultation){
            $consultations[] = [
                'text' => $consultation->message,
                'picture' => asset($consultation->user_responded_id ? 'assets/img/avatar/avatar-1.png' : 'assets/img/avatar/avatar-2.png'),
                'position' => $consultation->user_responded_id ? 'chat-left' : 'chat-right',
            ];
        }

        return response([
            'chats' => $consultations
        ]);
    }

    public function sendChat(Request $request){
        try{
            Consultation::create([
                'home_care_patient_id' => Auth::user()->id,
                'message' => $request->message
            ]);

            return response([
                'success' => true,
                'message' => 'Kirim pesan berhasil!'
            ]);
        }catch(Exception $e){
            return response([
                'success' => false,
                'message' => 'Terjadi Kesalahan, SIlahkan Coba Lagi!'
            ]);
        }
    }
}
