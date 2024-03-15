<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DmGender extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $incrementing = false;
    public $keyType = 'string'; 
    protected $fillable = [
        'id',
        'gender'
    ];
}
