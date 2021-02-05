<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointments extends Model
{
    use HasFactory;
    public $table = 'tbl_appointment';
    public $timestamps = false;
    public $incrementing = false;
    
    protected $fillable = [
        
    ];
}
