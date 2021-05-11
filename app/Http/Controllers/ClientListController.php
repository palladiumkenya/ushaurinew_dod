<?php

namespace App\Http\Controllers;
//use GuzzleHttp\Client;

ini_set('max_execution_time', 0);
ini_set('memory_limit', '1024M');

use Illuminate\Http\Request;
use App\Models\ClientList;
use App\Models\Group;
use App\Models\Clinic;
use App\Models\Client;
use App\Models\Facility;
use Auth;
use DB;

class ClientListController extends Controller
{
    public function get_client_list()
    {


        $all_clients = Client:: select('tbl_clinic.name', 'tbl_client.file_no', 'tbl_client.file_no', DB::raw("CONCAT(`tbl_client`.`f_name`, ' ', `tbl_client`.`m_name`, ' ', `tbl_client`.`l_name`) as client_name"), 'tbl_groups.name AS group_name', 'tbl_client.dob', 'tbl_client.status', 'tbl_client.clinic_number', 'tbl_client.phone_no', 'tbl_client.created_at', 'tbl_client.enrollment_date', 'tbl_client.art_date', 'tbl_client.client_status')
        ->join('tbl_groups', 'tbl_groups.id', '=', 'tbl_client.group_id')
        ->join('tbl_clinic', 'tbl_clinic.id', '=', 'tbl_client.clinic_id')
        ->whereNotNull('tbl_client.clinic_number');

        if (Auth::user()->access_level == 'Facility') {
            $all_clients->where('mfl_code', Auth::user()->facility_id);
        }

        if (Auth::user()->access_level == 'Partner') {
            $all_clients->where('partner_id', Auth::user()->partner_id);
        }

        if (Auth::user()->access_level == 'Donor') {
            $all_clients->where('donor_id', Auth::user()->donor_id);
        }
        return view('clients.clients-list')->with('all_clients', $all_clients->get());
    }

    public function get_client_profile(Request $request)
{
    $upn_search = $request->input('upn_search');

    $client_profile = Client::join('tbl_gender', 'tbl_client.gender', '=', 'tbl_gender.id')
    ->join('tbl_language', 'tbl_client.language_id', '=', 'tbl_language.id')
    ->join('tbl_marital_status', 'tbl_client.marital', '=', 'tbl_marital_status.id')
    ->select(DB::raw("CONCAT(`tbl_client`.`f_name`, ' ', `tbl_client`.`m_name`, ' ', `tbl_client`.`l_name`) as client_name"), 'tbl_client.phone_no', 'tbl_client.art_date', 'tbl_client.enrollment_date', 'tbl_client.file_no', 'tbl_client.dob', 'tbl_client.clinic_number',
    'tbl_client.client_status', 'tbl_client.status', 'tbl_client.smsenable', 'tbl_client.consent_date', 'tbl_gender.name as gender', 'tbl_language.name as language', 'tbl_marital_status.marital')
    ->where('tbl_client.clinic_number', 'LIKE', "%{$upn_search}%")
    ->get();


    return view('clients.client_profile')->with('client_profile', $client_profile);

}


}
