<?php

namespace App\Http\Controllers;

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
        $all_clients_duration_less_well = Dcm::where('status_two', '=', 'Well'); 
             
        $all_clients_stsbility_status_on = Dcm::where('stability_status', '=', 'DCM');
        $all_clients_stability_status_not = Dcm::where('stability_status', '=', 'NotDCM');
        $all_clients_clinical_app = Dcm::whereNotNull('clinical_visit_date');
        $all_clients_refill_app = Dcm::whereNotNull('refill_date');
        $all_clients_facility_based = Dcm::whereNotNull('facility_based');
        $all_clients_community_based = Dcm::whereNotNull('community_based');
      
        return view('dashboard/dcm_less_well')->with('all_clients_duration_less_well', $all_clients_duration_less_well->get());
}
public function get_dcm_less_advanced()
{          
    $all_clients_duration_less_advanced = Dcm::where('duration_less', '=', 'Advanced');
    
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
    ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_dfc_module.duration_more, tbl_appointment.appntmnt_date')->where('tbl_dfc_module.duration_more', '=', 'Unstable');

    return view('dashboard/dcm_more_unstable')->with('all_clients_duration_more_unstable', $all_clients_duration_more_unstable->get());
}
}