<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public $table = 'tbl_role';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [

    ];
}
