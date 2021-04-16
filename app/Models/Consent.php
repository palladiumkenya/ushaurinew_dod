<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consent extends Model
{
    use HasFactory;

    public $table = 'tbl_client';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'smsenable', 'consent_date', 'phone_no', 'txt_time',
    ];
}
