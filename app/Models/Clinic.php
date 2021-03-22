<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    use HasFactory;

    public $table = 'tbl_clinic';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [

    ];
}
