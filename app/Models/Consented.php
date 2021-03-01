<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consented extends Model
{
    use HasFactory;

    public $table = 'vw_consented_clients_report';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [

    ];
}
