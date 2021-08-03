<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarClient extends Model
{
    use HasFactory;

    public $table = 'tbl_main_bar_clients_aggregate';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [

    ];
}
