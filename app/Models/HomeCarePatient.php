<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeCarePatient extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'patient_id',
        'dm_monitoring_status_id',
        'registration_date',
        'monitoring_start_date',
        'monitoring_end_date',
        'doctor_dpjp_id',
        'enrolled_by',
        'discharged_by',
    ];

    public function patient(){
        return $this->belongsTo(Patient::class);
    }

    public function dm_monitoring_status(){
        return $this->belongsTo(DmMonitoringStatus::class);
    }

    public function doctor_dpjp(){
        return $this->belongsTo(User::class);
    }

    public function vital_sign(){
        return $this->hasMany(VitalSign::class);
    }
}
