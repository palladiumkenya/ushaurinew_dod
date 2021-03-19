<?php

namespace App\Http\Controllers;

ini_set('max_execution_time', 0);
ini_set('memory_limit', '1024M');

use Illuminate\Http\Request;
use App\Models\ClientList;
use App\Models\Group;
use App\Models\Clinic;
use App\Models\Facility;
use Auth;

class ClientListController extends Controller
{
    public function get_client_list()
    {


        $all_clients = ClientList:: selectRaw('client_list.client_name, tbl_clinic.name, client_list.file_no, client_list.group_name, client_list.dob, client_list.status, client_list.clinic_number, client_list.phone_no, client_list.created_at, client_list.enrollment_date, client_list.art_date, client_list.client_status')
        ->join('tbl_client', 'tbl_client.id', '=', 'client_list.client_id')
        ->join('tbl_clinic', 'tbl_clinic.id', 'tbl_client.clinic_id')
        ->whereNotNull('client_list.clinic_number');

        if (Auth::user()->access_level == 'Facility') {
            $all_clients->where('facility_id', Auth::user()->facility_id);
        }

        if (Auth::user()->access_level == 'Partner') {
            $all_clients->where('partner_id', Auth::user()->partner_id);
        }

        if (Auth::user()->access_level == 'Donor') {
            $all_clients->where('donor_id', Auth::user()->donor_id);
        }
        return view('clients.clients-list')->with('all_clients', $all_clients->get());
    }
}
