<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Models\Dcm;
use App\Models\DcmUnstable;
use App\Models\Client;
use App\Models\Appointment;
use Carbon\Carbon;
use Auth;

class DcmReportController extends Controller
{
    //
public function dcm_report()
{

    if (Auth::user()->access_level == 'Facility') {
        $all_clients_duration_less_well = DcmUnstable::join('tbl_client', 'tbl_client.id', '=', 'tbl_dfc_module.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_dfc_module.duration_less, tbl_appointment.appntmnt_date')
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->where('duration_less', '=', 'Well')->get();

        $all_clients_duration_less_advanced = DcmUnstable::join('tbl_client', 'tbl_client.id', '=', 'tbl_dfc_module.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_dfc_module.duration_less, tbl_appointment.appntmnt_date')
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->where('duration_less', '=', 'Advanced')->get();

        $all_clients_duration_more_stable = Dcm::select('*')
        ->where('duration_more', '=', 'Stable')->get()
        ->where('mfl_code', Auth::user()->facility_id);



        $all_clients_duration_more_unstable = DcmUnstable::join('tbl_client', 'tbl_client.id', '=', 'tbl_dfc_module.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_dfc_module.duration_more, tbl_appointment.appntmnt_date')
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->where('tbl_dfc_module.duration_more', '=', 'Unstable')
        ->where('tbl_appointment.active_app', '=', 1)->get();

    }


    if (Auth::user()->access_level == 'Unit') {
            $all_clients_duration_less_well = DcmUnstable::join('tbl_client', 'tbl_client.id', '=', 'tbl_dfc_module.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->join('tbl_master_facility', 'tbl_master_facility.code', '=', 'tbl_client.mfl_code')
            ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_dfc_module.duration_less, tbl_appointment.appntmnt_date')
            ->where('tbl_master_facility.unit_id', Auth::user()->unit_id)
            ->where('duration_less', '=', 'Well')->get();

            $all_clients_duration_less_advanced = DcmUnstable::join('tbl_client', 'tbl_client.id', '=', 'tbl_dfc_module.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->join('tbl_master_facility', 'tbl_master_facility.code', '=', 'tbl_client.mfl_code')
            ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_dfc_module.duration_less, tbl_appointment.appntmnt_date')
            ->where('tbl_master_facility.unit_id', Auth::user()->unit_id)
            ->where('duration_less', '=', 'Advanced')->get();

            $all_clients_duration_more_stable = Dcm::select('*')
            ->where('unit_id', Auth::user()->unit_id)
            ->where('duration_more', '=', 'Stable')->get();
            



            $all_clients_duration_more_unstable = DcmUnstable::join('tbl_client', 'tbl_client.id', '=', 'tbl_dfc_module.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->join('tbl_master_facility', 'tbl_master_facility.code', '=', 'tbl_client.mfl_code')
            ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_dfc_module.duration_more, tbl_appointment.appntmnt_date')
            ->where('tbl_master_facility.unit_id', Auth::user()->unit_id)
            ->where('tbl_dfc_module.duration_more', '=', 'Unstable')
            ->where('tbl_appointment.active_app', '=', 1)->get();

    }

    if (Auth::user()->access_level == 'Admin' || Auth::user()->access_level == 'Donor') {
        $all_clients_duration_less_well = DcmUnstable::join('tbl_client', 'tbl_client.id', '=', 'tbl_dfc_module.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_dfc_module.duration_less, tbl_appointment.appntmnt_date')
            ->where('duration_less', '=', 'Well')->get();

            $all_clients_duration_less_advanced = DcmUnstable::join('tbl_client', 'tbl_client.id', '=', 'tbl_dfc_module.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_dfc_module.duration_less, tbl_appointment.appntmnt_date')
            ->where('duration_less', '=', 'Advanced')->get();

            $all_clients_duration_more_stable = Dcm::select('*')
            ->where('duration_more', '=', 'Stable')->get();



        $all_clients_duration_more_unstable = DcmUnstable::join('tbl_client', 'tbl_client.id', '=', 'tbl_dfc_module.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_dfc_module.duration_more, tbl_appointment.appntmnt_date')
        ->where('tbl_dfc_module.duration_more', '=', 'Unstable')
        ->where('tbl_appointment.active_app', '=', 1)->get();

    }

    return view('reports.dcm_reports', compact('all_clients_duration_less_well', 'all_clients_duration_less_advanced', 'all_clients_duration_more_stable', 'all_clients_duration_more_unstable'));
}
}