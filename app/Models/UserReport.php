<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserReport extends Model
{
    use HasFactory;
    public $table = 'vw_user_access_report';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [

    ];
}
