<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use\App\Models\Pmtct;
use\App\Models\Client;
use\App\Models\Appointments;

class PmtcController extends Controller
{
    public function get_pmtct_clients_data()
    {
        $data = [];

        $all_booked_pmtct_clients = Pmtct::whereNotNull('appointment_date');
        $all_booked_pmtct_clients_count = Pmtct::whereNotNull('appointment_date');

        $honored_appointment_clients = Appointments::select('client_id')->where('appointment_kept', '=', 'Yes');

        $all_honored_appointment_clients = Pmtct::select('client_id')->whereIn('client_id', $honored_appointment_clients);

        $data['all_booked_pmtct_clients_count'] = $all_booked_pmtct_clients_count->count();
        $data['all_honored_appointment_clients'] = $all_honored_appointment_clients->count();
        $data['all_booked_pmtct_clients'] = $all_booked_pmtct_clients->get();

        return $data;

    }
}