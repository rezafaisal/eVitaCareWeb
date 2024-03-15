<?php

namespace App\Http\Controllers;

use App\Models\HomeCarePatient;

class ReportController extends Controller
{
    public function index(){
        $now_month = date('m', strtotime(now()));

        $home_care_patient = HomeCarePatient::with('patient')->whereMonth('monitoring_start_date', $now_month)->orWhereMonth('monitoring_end_date', $now_month)->get();
        $home_care_patient_count = count($home_care_patient);

        $in_monitoring_count = HomeCarePatient::whereMonth('monitoring_start_date', $now_month)->where('dm_monitoring_status_id', 2)->count();
        $done_monitoring_count = HomeCarePatient::whereMonth('monitoring_end_date', $now_month)->where('dm_monitoring_status_id', 3)->count();
        
        $female_count = 0;
        $male_count = 0;
        foreach($home_care_patient as $home_care){
            if($home_care->patient->dm_gender_id == "L"){
                $male_count++;
            }else if($home_care->patient->dm_gender_id == "P"){
                $female_count++;
            }
        }
        
        return view('report.index', compact('home_care_patient_count','in_monitoring_count', 'done_monitoring_count', 'male_count', 'female_count'));
    }

    public function graphic($dateRange){
        $month_values = array (
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );

        $start = explode('|', $dateRange)[0];
        $end = explode('|', $dateRange)[1];

        $startMonth = date('m', strtotime($start));
        $endMonth = date('m', strtotime($end));

        $response = [];
        $datas = HomeCarePatient::whereMonth('monitoring_start_date', '>=', $startMonth)->orWhereMonth('monitoring_end_date', '<=', $endMonth)->get();

        foreach($datas as $data){
            $begin_month = intval(date('m', strtotime($data->monitoring_start_date)));
            if($data->monitoring_end_date){
                $final_month = intval(date('m', strtotime($data->monitoring_end_date)));
                for($i = $begin_month; $i <= $final_month; $i++){
                    if(isset($response[$i])){
                        $response[$i] = 1;
                    }else{
                        $response[$i]++;
                    }
                }
            }else{
                if(!isset($response[$begin_month])){
                    $response[$begin_month] = 1;
                }else{
                    $response[$begin_month]++;
                }
            }
        }

        ksort($response);

        $months = [];
        foreach(array_keys($response) as $month){
            $months[] = $month_values[(int) $month];
        }

        return response([
            'months' => $months,
            'values' => array_values($response)
        ]);
    }
}
