<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tracer extends Model
{
    use HasFactory;
    public $table = 'tbl_tracer_client';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [

    ];
}
