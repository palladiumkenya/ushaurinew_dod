<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyApp extends Model
{
    use HasFactory;

    public $table = 'Monthly_Appointment_Summary';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [

    ];
}
