<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DmMonitoringStatus extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'status',
        'description'
    ];
}
