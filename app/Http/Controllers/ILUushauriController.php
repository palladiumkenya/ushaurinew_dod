<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointments;
use App\Models\Message;
use App\Models\Client;
use App\Models\Facility;

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
        $il_facilities = Client::join('tbl_appointment', 'tbl_appointment.client_id', '=', 'tbl_client.id')
        ->join('tbl_master_facility', 'tbl_master_facility.code', '=', 'tbl_client.mfl_code')
       // ->select(\DB::raw("COUNT(tbl_master_facility.name) as count"))
        ->select('tbl_master_facility.name')
        ->groupBy('tbl_client.mfl_code')
        ->where('tbl_appointment.client_id', '=', 'tbl_client.id')
        ->where('tbl_appointment.db_source', '=', 'KENYAEMR')
        ->orwhere('tbl_appointment.db_source', '=', 'ADT')
       ->get();
        //->pluck('count');

        dd($il_facilities);

        return view('dashboard.il_dashboard', compact('il_appointments', 'il_future_apps'));
    }
}
