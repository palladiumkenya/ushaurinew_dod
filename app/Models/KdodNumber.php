<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KdodNumber extends Model
{
    use HasFactory;
    public $table = 'tbl_kdod_number';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [

    ];
}
