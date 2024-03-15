<?php

namespace App\Http\Controllers;

use App\Models\VitalSign;

class HomeController extends Controller
{
    public function index(){
        $vital_signs = [];
        $vital_sign_data = VitalSign::with('home_care_patient', 'dm_level_of_consciousness')->whereHas('home_care_patient', function($q){
            $q->where('dm_monitoring_status_id', 2);
        })->get();
        foreach($vital_sign_data->groupBy('home_care_patient_id') as $groupValue){
            $vital_signs[] = $groupValue->sortByDesc('time_acquired')->first();
        }

        return view('home.index', compact('vital_signs'));
    }
}
