<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    public $table = 'tbl_client';
    public $timestamps = false;

    protected $fillable = [

        'clinic_number', 'consent_date', 'smsenable', 'language_id', 'motivational_enable', 'txt_time', 'phone_no'
    ];
    

}
