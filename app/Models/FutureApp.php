<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FutureApp extends Model
{
    use HasFactory;
    public $table = 'tbl_future_appointments_query';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [

    ];
}
