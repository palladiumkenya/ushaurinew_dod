<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodayAppointment extends Model
{
    use HasFactory;
    public $table = 'tbl_todays_appointment';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [

    ];
}
