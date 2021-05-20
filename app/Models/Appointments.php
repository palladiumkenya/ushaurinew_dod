<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointments extends Model
{
    use HasFactory;
    public $table = 'tbl_appointment';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'app_type_1', 'reason', 'appntmnt_date'

    ];

    public function client(){
        return $this->belongsTo('App\Models\Client','client_id','id');
    }
}
