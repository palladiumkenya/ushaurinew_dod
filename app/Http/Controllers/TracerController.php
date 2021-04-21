<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tracer;
use App\Models\User;
use Auth;
use DB;

class TracerController extends Controller
{
    public function tracer_client()
    {
        $tracer_client_list = Tracer::join('tbl_tracers', 'tbl_tracer_client.tracer_id', '=', 'tbl_tracers.id')
        ->join('tbl_client', 'tbl_tracer_client.client_id', '=', 'tbl_client.id')
        ->join('tbl_users', 'tbl_tracers.user_id', '=', 'tbl_users.id')
        ->join('tbl_clinic', 'tbl_client.clinic_id', '=', 'tbl_clinic.id')
        ->select('tbl_client.clinic_number', 'tbl_client.phone_no as client_contact', 'tbl_clinic.name as clinic', DB::raw("CONCAT(`tbl_users`.`f_name`, ' ', `tbl_users`.`m_name`, ' ', `tbl_users`.`l_name`) as tracer_name"), 'tbl_users.phone_no as tracer_contact')
        ->get();

      //  dd($tracer_client_list);

        return view('users.tracerclient')->with($tracer_client_list );

    }
}
