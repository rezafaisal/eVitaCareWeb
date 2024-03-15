<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VitalSign extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function home_care_patient(){
        return $this->belongsTo(HomeCarePatient::class);
    }

    public function dm_level_of_consciousness(){
        return $this->belongsTo(DmLevelOfConsciousness::class);
    }
}
