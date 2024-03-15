<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Carbon\Carbon;

class Patient extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $timestamps = false;
    protected $fillable = [
        'nik',
        'name',
        'birth_date',
        'bpjs_number',
        'phone_number',
        'address',
        'email',
        'password',
        'dm_gender_id'
    ];

    protected $appends = ['age'];

    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['birth_date'])->age;
    }

    public function dm_gender(){
        return $this->belongsTo(DmGender::class);
    }
}
