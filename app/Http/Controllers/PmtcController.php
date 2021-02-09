<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use\App\Models\Pmtct;
use\App\Models\Client;
use\App\Models\Appointments;
use Carbon\Carbon;

class PmtcController extends Controller
{
    public function get_pmtct_clients_data()
    {
        $data = [];
         
        
         // mother pmtct
        $all_pmtct_clients = Pmtct::select('client_id')->whereNotNull('client_id');
 
        //mother appointment
        $honored_appointment_clients = Appointments::select('client_id')->where('appointment_kept', '=', 'Yes')->whereIn('client_id', $all_pmtct_clients);
        $unschedule_appointment_clients = Appointments::select('client_id')->where('visit_type', '=', 'Un-Scheduled')->whereIn('client_id', $all_pmtct_clients);
        $scheduled_appointment_clients = Appointments::select('client_id')->where('visit_type', '=', 'Scheduled')->whereIn('client_id', $all_pmtct_clients);
        $missed_appointment_clients = Appointments::select('client_id')->where('app_status', '=', 'Missed')->whereIn('client_id', $all_pmtct_clients);
        $defaulted_appointment_clients = Appointments::select('client_id')->where('app_status', '=', 'Defaulted')->whereIn('client_id', $all_pmtct_clients);
        $ltfu_appointment_clients = Appointments::select('client_id')->where('app_status', '=', 'LTFU')->whereIn('client_id', $all_pmtct_clients);
        $booked_appointment_clients = Appointments::select('client_id')->where('app_status', '=', 'Booked')->whereIn('client_id', $all_pmtct_clients);

        // mother as client
        $all_honored_appointment_clients = Client::select('id', 'clinic_number')->whereIn('id', $honored_appointment_clients);
        $all_unschedule_appointment_clients = Client::select('id', 'clinic_number')->whereIn('id', $unschedule_appointment_clients);
        $all_schedule_appointment_clients = Client::select('id', 'clinic_number')->whereIn('id', $scheduled_appointment_clients);
        $all_missed_appointment_clients = Client::select('id', 'clinic_number')->whereIn('id', $missed_appointment_clients);
        $all_defaulted_appointment_clients = Client::select('id', 'clinic_number')->whereIn('id', $defaulted_appointment_clients);
        $all_deceased_pmtct_clients = Client::select('id')->where('status', '=', 'Deceased')->whereIn('id', $all_pmtct_clients);
        $all_ltfu_pmtct_clients = Client::select('id', 'clinic_number')->whereIn('id', $ltfu_appointment_clients);
        $all_booked_pmtct_clients = Client::select('id', 'clinic_number')->whereIn('id', $booked_appointment_clients);
        
        
        // mother data
        $data['all_honored_appointment_clients'] = $all_honored_appointment_clients->count();
        $data['all_unschedule_appointment_clients'] = $all_unschedule_appointment_clients->count();
        $data['all_schedule_appointment_clients'] = $all_schedule_appointment_clients->count();
        $data['all_missed_appointment_clients'] = $all_missed_appointment_clients->count();
        $data['all_defaulted_appointment_clients'] = $all_defaulted_appointment_clients->count();
        $data['all_deceased_pmtct_clients'] = $all_deceased_pmtct_clients->count();
        $data['all_ltfu_pmtct_clients'] = $all_ltfu_pmtct_clients->count();
        $data['all_booked_pmtct_clients'] = $all_booked_pmtct_clients->count();
    
        return $data;

    }
}