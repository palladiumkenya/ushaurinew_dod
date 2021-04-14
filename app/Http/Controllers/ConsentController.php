<?php

namespace App\Http\Controllers;
use App\Models\Client;

use Illuminate\Http\Request;
use Auth;
use DB;

class ConsentController extends Controller
{
    public function index()
    {

            if (Auth::user()->access_level == 'Facility') {
                $consented_clients = Client::join('tbl_groups', 'tbl_groups.id', 'tbl_client.group_id')
                ->select('tbl_client.clinic_number', 'tbl_client.file_no', DB::raw("CONCAT(`tbl_client`.`f_name`, ' ', `tbl_client`.`m_name`, ' ', `tbl_client`.`l_name`) as full_name"),'tbl_client.phone_no', 'tbl_client.dob', 'tbl_client.client_status', 'tbl_groups.name', 'tbl_client.created_at', 'tbl_client.smsenable', 'tbl_client.enrollment_date', 'tbl_client.art_date', 'tbl_client.updated_at', 'tbl_client.status', 'tbl_client.consent_date')
                ->where('tbl_client.smsenable', '=', 'Yes')
                ->where('tbl_client.mfl_code', Auth::user()->facility_id)
                ->get();
            }
            return view('clients.consent')->with('consented_clients', $consented_clients);

    }
    public function addconsentform()
    {
        return view('clients.addconsent');
    }
    public function client_consent(Request $request)
    {

       $client = Client::where('clinic_number', '=',$request->clinic_number)->exists();

        if ($client) {
            return response()->json([
                'success' => 'Client: $request->clinic_number already in the system'
            ]);
        }else{
            return response()->json([
                'success' => 'Client: $request->clinic_number Not Found in the system'
            ]);
        }
    }
}
