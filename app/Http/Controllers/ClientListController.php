<?php

namespace App\Http\Controllers;

ini_set('max_execution_time', 0);
ini_set('memory_limit', '1024M');

use Illuminate\Http\Request;
use App\Models\ClientList;
use App\Models\Group;
use App\Models\Clinic;

class ClientListController extends Controller
{
    public function get_client_list()
    {
        $all_clients = ClientList:: selectRaw('client_list.client_name, client_list.file_no, client_list.group_name, client_list.dob, client_list.status, client_list.clinic_number, client_list.phone_no, client_list.created_at, client_list.enrollment_date, client_list.art_date, client_list.client_status')
        ->whereNotNull('clinic_number')->limit(5000);

        return view('clients.clients-list')->with('all_clients', $all_clients->get());
    }
}
