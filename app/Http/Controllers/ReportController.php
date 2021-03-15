<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Appointments;
use DB;

class ReportController extends Controller
{
    public function deactivated_clients()
    {
        $all_deactivated_clients = Client::join('tbl_groups', 'tbl_groups.id', 'tbl_client.group_id')
        ->select('tbl_client.clinic_number', 'tbl_client.file_no', DB::raw("CONCAT(`tbl_client`.`f_name`, ' ', `tbl_client`.`m_name`, ' ', `tbl_client`.`l_name`) as full_name"), 'tbl_client.phone_no', 'tbl_client.dob', 'tbl_client.client_type', 'tbl_groups.name', 'tbl_client.created_at')
        ->where('tbl_client.status', '=', 'Disabled');

        return view('reports.deactivated_clients')->with('all_deactivated_clients', $all_deactivated_clients->get());
    }

    public function transfer_out()
    {
        $all_transfer_clients = Client::join('tbl_groups', 'tbl_groups.id', 'tbl_client.group_id')
        ->join('tbl_master_facility', 'tbl_master_facility.code', '=', 'tbl_client.prev_clinic')
        ->select('tbl_client.clinic_number', 'tbl_client.file_no', DB::raw("CONCAT(`tbl_client`.`f_name`, ' ', `tbl_client`.`m_name`, ' ', `tbl_client`.`l_name`) as full_name"), DB::raw("CONCAT(`tbl_client`.`prev_clinic`, '', `tbl_master_facility`.`name`) as clinic_previous"),'tbl_client.phone_no', 'tbl_client.dob', 'tbl_client.client_status', 'tbl_groups.name', 'tbl_client.created_at')
        ->where('tbl_client.client_type', '=', 'Transfer Out');

        return view('reports.deactivated_clients')->with('all_transfer_clients', $all_transfer_clients->get());
    }
}
