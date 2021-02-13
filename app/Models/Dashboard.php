<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    use HasFactory;
    public $table = 'vw_client_summary_report';
    public $timestamps = false;
    public $incrementing = false;
    
    protected $fillable = [
        
    ];
}
