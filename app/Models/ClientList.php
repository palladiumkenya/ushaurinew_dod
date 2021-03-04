<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientList extends Model
{
    use HasFactory;
    public $table = 'client_list';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [

    ];
}
