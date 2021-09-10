<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    use HasFactory;

    public $table = 'tbl_rank';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [];
}
