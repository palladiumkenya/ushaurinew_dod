<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointments;
use App\Models\Message;
use App\Models\Client;
use App\Models\Facility;
use App\Models\County;
use App\Models\Partner;

class ILUushauriController extends Controller
{
    public function il_dashboard()
    {

        $il_appointments = Appointments::select(\DB::raw("COUNT(client_id) as count"))
        ->where('db_source', '=', 'KENYAEMR')
        ->orwhere('db_source', '=', 'ADT')
        ->pluck('count');

        $il_future_apps = Appointments::select(\DB::raw("COUNT(client_id) as count"))
        ->where('appntmnt_date', '>', Now())
        ->where('db_source', '=', 'KENYAEMR')
        ->orwhere('db_source', '=', 'ADT')
        ->pluck('count');

        $messages_count = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
           ->join('tbl_clnt_outgoing', 'tbl_clnt_outgoing.clnt_usr_id', '=', 'tbl_client.id')
           ->select(\DB::raw("COUNT(tbl_clnt_outgoing.id) as count"))
           ->where('tbl_clnt_outgoing.recepient_type', '=', 'Client')
           ->where('tbl_appointment.client_id', '=', 'tbl_client.id')
           ->where('tbl_appointment.db_source', '=', 'KENYAEMR')
           ->orwhere('tbl_appointment.db_source', '=', 'ADT')
           ->pluck('count');
        $il_facilities = Client::join('tbl_appointment', 'tbl_appointment.client_id', '=', 'tbl_client.id')
        ->join('tbl_master_facility', 'tbl_master_facility.code', '=', 'tbl_client.mfl_code')
       // ->join('tbl_partner', 'tbl_partner.id', '=', 'tbl_client.partner_id')
        ->select(\DB::raw("COUNT(tbl_master_facility.name) as count"))
       // ->select('tbl_master_facility.name as facility', 'tbl_master_facility.code', 'tbl_partner.name as partner')
        ->groupBy('tbl_client.mfl_code')
        ->where('tbl_appointment.client_id', '=', 'tbl_client.id')
        ->where('tbl_appointment.db_source', '=', 'KENYAEMR')
        ->orwhere('tbl_appointment.db_source', '=', 'ADT')
        ->pluck('count');

       $il_partners = Client::join('tbl_appointment', 'tbl_appointment.client_id', '=', 'tbl_client.id')
        ->join('tbl_partner', 'tbl_partner.id', '=', 'tbl_client.partner_id')
        ->select(\DB::raw("COUNT(tbl_partner.name ) as count"))
       // ->select('tbl_partner.name as partner')
        ->groupBy('tbl_partner.name')
        ->where('tbl_appointment.client_id', '=', 'tbl_client.id')
        ->where('tbl_appointment.db_source', '=', 'KENYAEMR')
        ->orwhere('tbl_appointment.db_source', '=', 'ADT')
        ->pluck('count');

       $il_kenyaemr = Appointments::select(\DB::raw("COUNT(client_id) as count"))
        ->where('db_source', '=', 'KENYAEMR')
        ->pluck('count');

        $il_adt = Appointments::select(\DB::raw("COUNT(client_id) as count"))
        ->where('db_source', '=', 'ADT')
        ->pluck('count');

        $il_registration = Client::select(\DB::raw("COUNT(id) as count"))
        ->where('entry_point', '=', 'IL')
        ->pluck('count');

        $all_partners = Partner::select('id', 'name')->get();
        $all_counties = County::select('id', 'name')->get();


       //dd($il_kenyaemr);

        return view('dashboard.il_dashboard', compact('all_partners', 'all_counties', 'il_appointments', 'il_registration', 'il_future_apps', 'messages_count', 'il_facilities', 'il_partners', 'il_kenyaemr', 'il_adt'));
    }

    public function facilities_il()
    {
      $il_facilities_list = Client::join('tbl_appointment', 'tbl_appointment.client_id', '=', 'tbl_client.id')
        ->join('tbl_master_facility', 'tbl_master_facility.code', '=', 'tbl_client.mfl_code')
        ->join('tbl_partner', 'tbl_partner.id', '=', 'tbl_client.partner_id')
        ->select('tbl_master_facility.name as facility', 'tbl_master_facility.code', 'tbl_partner.name as partner')
        ->groupBy('tbl_client.mfl_code')
        ->where('tbl_appointment.client_id', '=', 'tbl_client.id')
        ->where('tbl_appointment.db_source', '=', 'KENYAEMR')
        ->orwhere('tbl_appointment.db_source', '=', 'ADT')
        ->get();

        return view('facilities.facilities_il', compact('il_facilities_list'));
    }

    public function partners_il()
    {
      $il_partners = Client::join('tbl_appointment', 'tbl_appointment.client_id', '=', 'tbl_client.id')

        ->join('tbl_partner', 'tbl_partner.id', '=', 'tbl_client.partner_id')
        ->select('tbl_partner.name as partner')
        ->groupBy('tbl_partner.name')
        ->where('tbl_appointment.client_id', '=', 'tbl_client.id')
        ->where('tbl_appointment.db_source', '=', 'KENYAEMR')
        ->orwhere('tbl_appointment.db_source', '=', 'ADT')
        ->get();

        return view('partners.partner_il', compact('il_partners'));
    }
}
