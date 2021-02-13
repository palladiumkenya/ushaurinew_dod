<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotOk extends Model
{
    use HasFactory;

    public $table = 'tbl_not_ok';
    public $timestamps = false;
    public $incrementing = false;
    
    protected $fillable = [
        
    ];
}
