<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Condition extends Model
{
    use HasFactory;
    public $table = 'tbl_condition';
    public $timestamps = false;
    public $incrementing = false;
}
