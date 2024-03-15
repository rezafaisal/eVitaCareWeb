<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $timestamps = false;
    protected $fillable = [
        'name',
        'email',
        'password',
        'nip',
        'phone_number',
        'dm_user_status_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function user_role(){
        return $this->hasMany(UserRole::class);
    }

    public function dm_user_status(){
        return $this->belongsTo(DmUserStatus::class);
    }
}
