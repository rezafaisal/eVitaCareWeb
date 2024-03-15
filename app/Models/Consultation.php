<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;
    protected $fillable = [
        'home_care_patient_id',
        'user_responded_id',
        'message'
    ];

    public function user_responded(){
        return $this->belongsTo(User::class);
    }

    public function home_care_patient(){
        return $this->belongsTo(HomeCarePatient::class);
    }
}
