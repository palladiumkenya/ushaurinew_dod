<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outcome extends Model
{
    use HasFactory;
    public $table = 'tbl_clnt_outcome';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [

    ];
}
