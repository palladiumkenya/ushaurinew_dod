<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientPerformance extends Model
{
    use HasFactory;
    public $table = 'vw_client_performance_monitor';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [

    ];
}
