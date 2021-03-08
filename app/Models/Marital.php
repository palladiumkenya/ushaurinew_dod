<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marital extends Model
{
    use HasFactory;
    public $table = 'tbl_marital_status';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [

    ];
}
