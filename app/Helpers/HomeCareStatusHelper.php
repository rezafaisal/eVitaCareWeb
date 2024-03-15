<?php 

namespace App\Helpers;

use App\Models\HomeCarePatient;
use Illuminate\Support\Facades\Auth;

class HomeCareStatusHelper{
    public static function isInMonitoring(){
        $userId = Auth::guard('patient')->user()->id;
        $isNotFinishedCount = HomeCarePatient::where('patient_id', $userId)
                                               ->where('dm_monitoring_status_id', "!=", 3)
                                               ->count();
        return $isNotFinishedCount > 0;
    }
}
?>