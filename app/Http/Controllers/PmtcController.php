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

        $all_booked_pmtct_clients = Pmtct::whereNotNull('appointment_date');
        $all_pmtct_clients = Pmtct::whereNotNull('client_id');
        $all_booked_pmtct_clients_count = Pmtct::whereNotNull('appointment_date');
        
        $test_client = Client::select('id')->where('clinic_id', '=', 2);
        $honored_appointment_clients = Appointments::select('client_id')->where('appointment_kept', '=', 'Yes')->whereIn('client_id', $test_client);
        $unschedule_clients = Appointments::select('client_id')->where('visit_type', '=', 'Un-Scheduled');
        $scheduled_clients = Appointments::select('client_id')->where('visit_type', '=', 'Scheduled');
        $missed_clients = Appointments::select('client_id')->where('app_status', '=', 'Missed');
        $defaulted_clients = Appointments::select('client_id')->where('app_status', '=', 'Defaulted');
        $ltfu_clients = Appointments::select('client_id')->where('app_status', '=', 'LTFU');
        $deceased_clients = Client::select('id')->where('status', '=', 'Deceased');

        $all_honored_appointment_clients = Pmtct::select('client_id')->whereIn('client_id', $honored_appointment_clients);
        $all_unschedule_clients = Pmtct::select('client_id')->whereIn('client_id', $unschedule_clients);
        $all_scheduled_clients = Pmtct::select('client_id')->whereIn('client_id', $scheduled_clients);
        $all_missed_clients = Pmtct::select('client_id')->whereIn('client_id', $missed_clients);
        $all_defaulted_clients = Pmtct::select('client_id')->whereIn('client_id', $defaulted_clients);
        $all_ltfu_clients = Pmtct::select('client_id')->whereIn('client_id', $ltfu_clients);
        $all_deceased_clients = Pmtct::select('client_id')->whereIn('client_id', $deceased_clients);


        $data['all_booked_pmtct_clients_count'] = $all_booked_pmtct_clients_count->count();
        $data['all_pmtct_clients'] = $all_pmtct_clients->count();
        $data['all_honored_appointment_clients'] = $all_honored_appointment_clients->count();
        $data['all_booked_pmtct_clients'] = $all_booked_pmtct_clients->count();
        $data['all_unschedule_clients'] = $all_unschedule_clients->count();
        $data['all_scheduled_clients'] = $all_scheduled_clients->count();
        $data['all_missed_clients'] = $all_missed_clients->count();
        $data['all_defaulted_clients'] = $all_defaulted_clients->count();
        $data['all_ltfu_clients'] = $all_ltfu_clients->count();
        $data['all_deceased_clients'] = $all_deceased_clients->count();

        return $data;

    }
}