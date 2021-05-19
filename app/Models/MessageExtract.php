<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageExtract extends Model
{
    use HasFactory;

    public $table = 'client_message_report';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [

    ];
}
