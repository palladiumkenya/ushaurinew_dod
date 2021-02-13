<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ok extends Model
{
    use HasFactory;

    public $table = 'tbl_ok';
    public $timestamps = false;
    public $incrementing = false;
    
    protected $fillable = [
        
    ];
}
