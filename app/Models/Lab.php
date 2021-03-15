<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    use HasFactory;
    public $table = 'vw_lab_investigation';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [

    ];
}
