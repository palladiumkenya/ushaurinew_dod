<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Appointments;
use DB;
use Auth;

class ReportController extends Controller
{
    public function deactivated_clients()
    {
        $all_deactivated_clients = Client::join('tbl_groups', 'tbl_groups.id', 'tbl_client.group_id')
        ->select('tbl_client.clinic_number', 'tbl_client.file_no', DB::raw("CONCAT(`tbl_client`.`f_name`, ' ', `tbl_client`.`m_name`, ' ', `tbl_client`.`l_name`) as full_name"), 'tbl_client.phone_no', 'tbl_client.dob', 'tbl_client.client_type', 'tbl_groups.name', 'tbl_client.created_at')
        ->where('tbl_client.status', '=', 'Disabled');

        if (Auth::user()->access_level == 'Facility') {
            $all_deactivated_clients->where('facility_id', Auth::user()->facility_id);
        }

        if (Auth::user()->access_level == 'Partner') {
            $all_deactivated_clients->where('partner_id', Auth::user()->partner_id);
        }

        if (Auth::user()->access_level == 'Donor') {
            $all_deactivated_clients->where('donor_id', Auth::user()->donor_id);
        }

        return view('reports.deactivated_clients')->with('all_deactivated_clients', $all_deactivated_clients->get());
    }

    public function transfer_out()
    {
        $all_transfer_clients = Client::join('tbl_groups', 'tbl_groups.id', 'tbl_client.group_id')
        ->join('tbl_master_facility', 'tbl_master_facility.code', '=', 'tbl_client.prev_clinic')
        ->select('tbl_client.clinic_number', 'tbl_client.file_no', DB::raw("CONCAT(`tbl_client`.`f_name`, ' ', `tbl_client`.`m_name`, ' ', `tbl_client`.`l_name`) as full_name"), DB::raw("CONCAT(`tbl_client`.`prev_clinic`, '', `tbl_master_facility`.`name`) as clinic_previous"),'tbl_client.phone_no', 'tbl_client.dob', 'tbl_client.client_status', 'tbl_groups.name', 'tbl_client.created_at')
        ->where('tbl_client.client_type', '=', 'Transfer Out');

        if (Auth::user()->access_level == 'Facility') {
            $all_transfer_clients->where('facility_id', Auth::user()->facility_id);
        }

        if (Auth::user()->access_level == 'Partner') {
            $all_transfer_clients->where('partner_id', Auth::user()->partner_id);
        }

        if (Auth::user()->access_level == 'Donor') {
            $all_transfer_clients->where('donor_id', Auth::user()->donor_id);
        }

        return view('reports.transfer_out_clients')->with('all_transfer_clients', $all_transfer_clients->get());
    }

    public function transfer_in()
    {
        $all_transfer_in = Client::join('tbl_groups', 'tbl_groups.id', 'tbl_client.group_id')
        ->join('tbl_master_facility', 'tbl_master_facility.code', '=', 'tbl_client.prev_clinic')
        ->select('tbl_client.clinic_number', 'tbl_client.file_no', DB::raw("CONCAT(`tbl_client`.`f_name`, ' ', `tbl_client`.`m_name`, ' ', `tbl_client`.`l_name`) as full_name"), DB::raw("CONCAT(`tbl_client`.`prev_clinic`, '', `tbl_master_facility`.`name`) as clinic_previous"),'tbl_client.phone_no', 'tbl_client.dob', 'tbl_client.client_status', 'tbl_groups.name', 'tbl_client.created_at')
        ->where('tbl_client.client_type', '=', 'Transfer In');

        if (Auth::user()->access_level == 'Facility') {
            $all_transfer_in->where('facility_id', Auth::user()->facility_id);
        }

        if (Auth::user()->access_level == 'Partner') {
            $all_transfer_in->where('partner_id', Auth::user()->partner_id);
        }

        if (Auth::user()->access_level == 'Donor') {
            $all_transfer_in->where('donor_id', Auth::user()->donor_id);
        }

        return view('reports.transfer_in_clients')->with('all_transfer_in', $all_transfer_in->get());
    }

    public function today_appointments()
    {
        $all_today_appointments = Appointments::join('tbl_appointment_types', 'tbl_appointment_types.id', '=', 'tbl_appointment.app_type_1')
        ->join('tbl_client');
    }
}
