<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessLevel extends Model
{
    use HasFactory;

    public $table = 'tbl_access_level';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [

    ];
}
