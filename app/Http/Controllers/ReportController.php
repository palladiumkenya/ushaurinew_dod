<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Appointments;
use App\Models\TodayAppointment;
use App\Models\OutcomeReport;
use App\Models\MessageExtract;
use DB;
use Auth;

class ReportController extends Controller
{
    public function deactivated_clients()
    {
        if (Auth::user()->access_level == 'Admin') {
            $all_deactivated_clients = Client::join('tbl_groups', 'tbl_groups.id', 'tbl_client.group_id')
                ->select('tbl_client.clinic_number', 'tbl_client.file_no', DB::raw("CONCAT(`tbl_client`.`f_name`, ' ', `tbl_client`.`m_name`, ' ', `tbl_client`.`l_name`) as full_name"), 'tbl_client.phone_no', 'tbl_client.dob', 'tbl_client.client_type', 'tbl_groups.name', 'tbl_client.created_at')
                ->where('tbl_client.status', '=', 'Disabled')
                ->get();
        }

        if (Auth::user()->access_level == 'Facility') {
            $all_deactivated_clients = Client::join('tbl_groups', 'tbl_groups.id', 'tbl_client.group_id')
                ->select('tbl_client.clinic_number', 'tbl_client.file_no', DB::raw("CONCAT(`tbl_client`.`f_name`, ' ', `tbl_client`.`m_name`, ' ', `tbl_client`.`l_name`) as full_name"), 'tbl_client.phone_no', 'tbl_client.dob', 'tbl_client.client_type', 'tbl_groups.name', 'tbl_client.created_at')
                ->where('tbl_client.status', '=', 'Disabled')
                ->where('tbl_client.mfl_code', Auth::user()->facility_id)
                ->get();
        }

        if (Auth::user()->access_level == 'Partner') {
            $all_deactivated_clients = Client::join('tbl_groups', 'tbl_groups.id', 'tbl_client.group_id')
                ->select('tbl_client.clinic_number', 'tbl_client.file_no', DB::raw("CONCAT(`tbl_client`.`f_name`, ' ', `tbl_client`.`m_name`, ' ', `tbl_client`.`l_name`) as full_name"), 'tbl_client.phone_no', 'tbl_client.dob', 'tbl_client.client_type', 'tbl_groups.name', 'tbl_client.created_at')
                ->where('tbl_client.status', '=', 'Disabled')
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->get();
        }

        return view('reports.deactivated_clients', compact('all_deactivated_clients'));
    }

    public function transfer_out()
    {
        if (Auth::user()->access_level == 'Admin') {
            $all_transfer_clients = Client::join('tbl_groups', 'tbl_groups.id', 'tbl_client.group_id')
                ->join('tbl_master_facility', 'tbl_master_facility.code', '=', 'tbl_client.prev_clinic')
                ->select('tbl_client.clinic_number', 'tbl_client.file_no', DB::raw("CONCAT(`tbl_client`.`f_name`, ' ', `tbl_client`.`m_name`, ' ', `tbl_client`.`l_name`) as full_name"), DB::raw("CONCAT(`tbl_client`.`prev_clinic`, ' ', `tbl_master_facility`.`name`) as clinic_previous"), 'tbl_client.phone_no', 'tbl_client.dob', 'tbl_client.client_status', 'tbl_groups.name', 'tbl_client.created_at')
                ->where('tbl_client.prev_clinic', '=', 'tbl_master_facility.code')
                ->get();

            $all_transfer_in = Client::join('tbl_groups', 'tbl_groups.id', 'tbl_client.group_id')
                ->join('tbl_master_facility', 'tbl_master_facility.code', '=', 'tbl_client.prev_clinic')
                ->select('tbl_client.clinic_number', 'tbl_client.file_no', DB::raw("CONCAT(`tbl_client`.`f_name`, ' ', `tbl_client`.`m_name`, ' ', `tbl_client`.`l_name`) as full_name"), DB::raw("CONCAT(`tbl_client`.`prev_clinic`, ' ', `tbl_master_facility`.`name`) as clinic_previous"), 'tbl_client.phone_no', 'tbl_client.dob', 'tbl_client.client_status', 'tbl_groups.name', 'tbl_client.created_at')
                ->where('tbl_client.mfl_code', '=', 'tbl_master_facility.code')
                ->get();
        }

        if (Auth::user()->access_level == 'Facility') {
            $all_transfer_clients = Client::join('tbl_groups', 'tbl_groups.id', 'tbl_client.group_id')
                ->join('tbl_master_facility', 'tbl_master_facility.code', '=', 'tbl_client.prev_clinic')
                ->select('tbl_client.clinic_number', 'tbl_client.file_no', DB::raw("CONCAT(`tbl_client`.`f_name`, ' ', `tbl_client`.`m_name`, ' ', `tbl_client`.`l_name`) as full_name"), DB::raw("CONCAT(`tbl_client`.`prev_clinic`, ' ', `tbl_master_facility`.`name`) as clinic_previous"), 'tbl_client.phone_no', 'tbl_client.dob', 'tbl_client.client_status', 'tbl_groups.name', 'tbl_client.created_at')
                // ->where('tbl_client.prev_clinic', '=', 'Transfer Out')
                ->where('tbl_client.prev_clinic', Auth::user()->facility_id)
                ->get();

            $all_transfer_in = Client::join('tbl_groups', 'tbl_groups.id', 'tbl_client.group_id')
                ->join('tbl_master_facility', 'tbl_master_facility.code', '=', 'tbl_client.prev_clinic')
                ->select('tbl_client.clinic_number', 'tbl_client.file_no', DB::raw("CONCAT(`tbl_client`.`f_name`, ' ', `tbl_client`.`m_name`, ' ', `tbl_client`.`l_name`) as full_name"), DB::raw("CONCAT(`tbl_client`.`prev_clinic`, ' ', `tbl_master_facility`.`name`) as clinic_previous"), 'tbl_client.phone_no', 'tbl_client.dob', 'tbl_client.client_status', 'tbl_groups.name', 'tbl_client.created_at')
                // ->where('tbl_client.client_type', '=', 'Transfer In')
                ->where('tbl_client.mfl_code', Auth::user()->facility_id)
                ->get();
        }

        if (Auth::user()->access_level == 'Partner') {
            $all_transfer_clients = Client::join('tbl_groups', 'tbl_groups.id', 'tbl_client.group_id')
                ->join('tbl_master_facility', 'tbl_master_facility.code', '=', 'tbl_client.prev_clinic')
                ->select('tbl_client.clinic_number', 'tbl_client.file_no', DB::raw("CONCAT(`tbl_client`.`f_name`, ' ', `tbl_client`.`m_name`, ' ', `tbl_client`.`l_name`) as full_name"), DB::raw("CONCAT(`tbl_client`.`prev_clinic`, ' ', `tbl_master_facility`.`name`) as clinic_previous"), 'tbl_client.phone_no', 'tbl_client.dob', 'tbl_client.client_status', 'tbl_groups.name', 'tbl_client.created_at')
                ->where('tbl_client.prev_clinic', '=', 'tbl_master_facility.code')
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->get();

            $all_transfer_in = Client::join('tbl_groups', 'tbl_groups.id', 'tbl_client.group_id')
                ->join('tbl_master_facility', 'tbl_master_facility.code', '=', 'tbl_client.prev_clinic')
                ->select('tbl_client.clinic_number', 'tbl_client.file_no', DB::raw("CONCAT(`tbl_client`.`f_name`, ' ', `tbl_client`.`m_name`, ' ', `tbl_client`.`l_name`) as full_name"), DB::raw("CONCAT(`tbl_client`.`prev_clinic`, '', `tbl_master_facility`.`name`) as clinic_previous"), 'tbl_client.phone_no', 'tbl_client.dob', 'tbl_client.client_status', 'tbl_groups.name', 'tbl_client.created_at')
                ->where('tbl_client.mfl_code', '=', 'tbl_master_facility.code')
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->get();
        }


        return view('reports.transfer_out_clients', compact('all_transfer_clients', 'all_transfer_in'));
    }

    public function today_appointments()
    {
        if (Auth::user()->access_level == 'Admin') {
            $all_today_appointments = TodayAppointment::select('clinic_no', 'client_name', 'file_no', 'client_phone_no', 'appointment_type', 'appntmnt_date')
                ->get();
        }

        if (Auth::user()->access_level == 'Facility') {
            $all_today_appointments = TodayAppointment::select('clinic_no', 'client_name', 'file_no', 'client_phone_no', 'appointment_type', 'appntmnt_date')
                ->where('mfl_code', Auth::user()->facility_id)
                ->get();
        }

        return view('reports.today_appointment', compact('all_today_appointments'));
    }
    public function consented_report()
    {
        if (Auth::user()->access_level == 'Admin') {
            $consented_clients = Client::join('tbl_groups', 'tbl_groups.id', 'tbl_client.group_id')
                ->select('tbl_client.clinic_number', 'tbl_client.file_no', DB::raw("CONCAT(`tbl_client`.`f_name`, ' ', `tbl_client`.`m_name`, ' ', `tbl_client`.`l_name`) as full_name"), 'tbl_client.phone_no', 'tbl_client.dob', 'tbl_client.client_status', 'tbl_groups.name', 'tbl_client.created_at', 'tbl_client.smsenable', 'tbl_client.enrollment_date', 'tbl_client.art_date', 'tbl_client.updated_at', 'tbl_client.status', 'tbl_client.consent_date')
                ->where('tbl_client.smsenable', '=', 'Yes')
                ->get();
        }

        if (Auth::user()->access_level == 'Facility') {
            $consented_clients = Client::join('tbl_groups', 'tbl_groups.id', 'tbl_client.group_id')
                ->select('tbl_client.clinic_number', 'tbl_client.file_no', DB::raw("CONCAT(`tbl_client`.`f_name`, ' ', `tbl_client`.`m_name`, ' ', `tbl_client`.`l_name`) as full_name"), 'tbl_client.phone_no', 'tbl_client.dob', 'tbl_client.client_status', 'tbl_groups.name', 'tbl_client.created_at', 'tbl_client.smsenable', 'tbl_client.enrollment_date', 'tbl_client.art_date', 'tbl_client.updated_at', 'tbl_client.status', 'tbl_client.consent_date')
                ->where('tbl_client.smsenable', '=', 'Yes')
                ->where('tbl_client.mfl_code', Auth::user()->facility_id)
                ->get();
        }

        if (Auth::user()->access_level == 'Partner') {
            $consented_clients = Client::join('tbl_groups', 'tbl_groups.id', 'tbl_client.group_id')
                ->join('tbl_master_facility', 'tbl_master_facility.code', '=', 'tbl_client.prev_clinic')
                ->select('tbl_client.clinic_number', 'tbl_client.file_no', DB::raw("CONCAT(`tbl_client`.`f_name`, ' ', `tbl_client`.`m_name`, ' ', `tbl_client`.`l_name`) as full_name"), DB::raw("CONCAT(`tbl_client`.`prev_clinic`, ' ', `tbl_master_facility`.`name`) as clinic_previous"), 'tbl_client.phone_no', 'tbl_client.dob', 'tbl_client.client_status', 'tbl_groups.name', 'tbl_client.created_at', 'tbl_client.smsenable', 'tbl_client.enrollment_date', 'tbl_client.art_date', 'tbl_client.updated_at', 'tbl_client.status', 'tbl_client.consent_date')
                ->where('tbl_client.smsenable', '=', 'Yes')
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->get();
        }

        return view('reports.consented', compact('consented_clients'));
    }

    public function tracing_outcome()
    {
        if (Auth::user()->access_level == 'Admin') {
            $outcome_report = OutcomeReport::select(
                'UPN',
                'Age',
                'Facility',
                'Gender',
                'Sub_County',
                'File_Number',
                'Appointment_Date',
                'Date_Came',
                'Tracer',
                'Days_Defaulted',
                'Tracing_Date',
                'Outcome',
                'Final_Outcome',
                'Other_Outcome'
            )
                ->get();
        }
        if (Auth::user()->access_level == 'Facility') {
            $outcome_report = OutcomeReport::select(
                'UPN',
                'Age',
                'Facility',
                'Gender',
                'Sub_County',
                'File_Number',
                'Appointment_Date',
                'Date_Came',
                'Tracer',
                'Days_Defaulted',
                'Tracing_Date',
                'Outcome',
                'Final_Outcome',
                'Other_Outcome'
            )
                ->where('MFL', Auth::user()->facility_id)
                ->get();
        }


        return view('reports.outcome', compact('outcome_report'));
    }

    public function messages_extract_report()
    {
        if (Auth::user()->access_level == 'Admin') {
            $message_extract = MessageExtract::select(
                'clinic_number',
                'gender',
                'group_name',
                'marital',
                'preferred_time',
                'language',
                'message_type',
                'month_year',
                'msg',
                'partner_name',
                'county',
                'sub_county',
                'mfl_code',
                'facility_name'
            )
                ->get();
        }
        if (Auth::user()->access_level == 'Facility') {
            $message_extract = MessageExtract::select(
                'clinic_number',
                'gender',
                'group_name',
                'marital',
                'preferred_time',
                'language',
                'message_type',
                'month_year',
                'msg',
                'partner_name',
                'county',
                'sub_county',
                'mfl_code',
                'facility_name'
            )
                ->where('mfl_code', Auth::user()->facility_id)
                ->get();
        }
        if (Auth::user()->access_level == 'Partner') {
            $message_extract = MessageExtract::select(
                'clinic_number',
                'gender',
                'group_name',
                'marital',
                'preferred_time',
                'language',
                'message_type',
                'month_year',
                'msg',
                'partner_name',
                'county',
                'sub_county',
                'mfl_code',
                'facility_name'
            )
                ->where('partner_id', Auth::user()->partner_id)
                ->get();
        }

        return view('reports.message_extract', compact('message_extract'));
    }
}
