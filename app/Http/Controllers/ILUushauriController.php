<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointments;
use App\Models\Message;
use App\Models\Client;

class ILUushauriController extends Controller
{
    public function il_dashboard()
    {
        $il_appointments = Appointments::select('client_id')
        ->where('db_source', '=', 'KENYAEMR')
        ->orwhere('db_source', '=', 'ADT')
        ->count();

        $il_future_apps = Appointments::where('appntmnt_date', '>', Now())
        ->where('db_source', '=', 'KENYAEMR')
        ->orwhere('db_source', '=', 'ADT')
        ->count();

        $messages_count = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
           ->join('tbl_clnt_outgoing', 'tbl_clnt_outgoing.clnt_usr_id', '=', 'tbl_client.id')
           ->where('tbl_clnt_outgoing.recepient_type', '=', 'Client')
           ->where('tbl_appointment.client_id', '=', 'tbl_client.id')
           ->where('tbl_appointment.db_source', '=', 'KENYAEMR')
           ->orwhere('tbl_appointment.db_source', '=', 'ADT')
           ->count();
        $il_facilities = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->join('tbl_master_facility', 'tbl_master_facility.code', '=', 'tbl_client.mfl_code')

        dd($messages_count);

        return view('dashboard.il_dashboard', compact('il_appointments', 'il_future_apps'));
    }
}
