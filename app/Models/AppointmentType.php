<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentType extends Model
{
    use HasFactory;

    public $table = 'tbl_appointment_types';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [

    ];
}
