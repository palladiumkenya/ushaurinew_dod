<?php

namespace App\Http\Controllers;

ini_set('max_execution_time', 0);
ini_set('memory_limit', '1024M');

use Illuminate\Http\Request;

use App\Models\Dcm;
use App\Models\DcmUnstable;
use App\Models\Client;
use App\Models\Appointment;
use Carbon\Carbon;

class DcmReportController extends Controller
{
    //
    public function index(){

        $facilities = Facility::with('sub_county.county','partner')->whereNotNull('mobile')->whereNotNull('partner_id');

        if(Auth::user()->user_level == 2){
            $facilities->where('partner_id', Auth::user()->partner_id);
        }
        if(Auth::user()->user_level == 5){
            $facilities->join('sub_county','sub_county.id', '=', 'health_facilities.Sub_County_ID')->where('sub_county.county_id', Auth::user()->county_id);
        }

        return view('facility.facility')->with('facilities', $facilities->get());
    }
    public function get_dcm_less_well()
    {
        $all_clients_duration_less_well = DcmUnstable::join('tbl_client', 'tbl_client.id', '=', 'tbl_dfc_module.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_dfc_module.duration_less, tbl_appointment.appntmnt_date')
        ->where('duration_less', '=', 'Well');

        return view('dashboard/dcm_less_well')->with('all_clients_duration_less_well', $all_clients_duration_less_well->get());
    }
public function get_dcm_less_advanced()
{
    $all_clients_duration_less_advanced = DcmUnstable::join('tbl_client', 'tbl_client.id', '=', 'tbl_dfc_module.client_id')
    ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
    ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_dfc_module.duration_less, tbl_appointment.appntmnt_date')
    ->where('duration_less', '=', 'Advanced');

    return view('dashboard/dcm_less_advanced')->with('all_clients_duration_less_advanced', $all_clients_duration_less_advanced->get());
}
public function get_dcm_more_stable()
{
    $all_clients_duration_more_stable = Dcm::where('duration_more', '=', 'Stable');

    return view('dashboard/dcm_more_stable')->with('all_clients_duration_more_stable', $all_clients_duration_more_stable->get());
}
public function get_dcm_more_unstable()
{

    $all_clients_duration_more_unstable = DcmUnstable::join('tbl_client', 'tbl_client.id', '=', 'tbl_dfc_module.client_id')
    ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
    ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_dfc_module.duration_more, tbl_appointment.appntmnt_date')
    ->where('tbl_dfc_module.duration_more', '=', 'Unstable')
    ->where('tbl_appointment.active_app', '=', 1);

    return view('dashboard/dcm_more_unstable')->with('all_clients_duration_more_unstable', $all_clients_duration_more_unstable->get());
}
public function dcm_report()
{
    $all_clients_duration_less_well = DcmUnstable::join('tbl_client', 'tbl_client.id', '=', 'tbl_dfc_module.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_dfc_module.duration_less, tbl_appointment.appntmnt_date')
        ->where('duration_less', '=', 'Well')->get();

        $all_clients_duration_less_advanced = DcmUnstable::join('tbl_client', 'tbl_client.id', '=', 'tbl_dfc_module.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_dfc_module.duration_less, tbl_appointment.appntmnt_date')
        ->where('duration_less', '=', 'Advanced')->get();

        $all_clients_duration_more_stable = Dcm::where('duration_more', '=', 'Stable')->get();

    $all_clients_duration_more_unstable = DcmUnstable::join('tbl_client', 'tbl_client.id', '=', 'tbl_dfc_module.client_id')
    ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
    ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_dfc_module.duration_more, tbl_appointment.appntmnt_date')
    ->where('tbl_dfc_module.duration_more', '=', 'Unstable')
    ->where('tbl_appointment.active_app', '=', 1)->get();

    return view('reports.dcm_reports', compact('all_clients_duration_less_well', 'all_clients_duration_less_advanced', 'all_clients_duration_more_stable', 'all_clients_duration_more_unstable'));
}
}