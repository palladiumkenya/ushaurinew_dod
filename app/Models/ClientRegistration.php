<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientRegistration extends Model
{
    use HasFactory;

    public $table = 'tbl_age_distinction';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [

    ];
}
