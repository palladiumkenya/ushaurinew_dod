<?php

namespace App\Http\Controllers;
use App\Models\Dashboard;
use App\Models\Facility;
use App\Models\Partner;
use App\Models\Appointments;
use Carbon\Carbon;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
   
    public function get_client_data()
    {
        $data = [];

        $all_clients_number = Dashboard::selectRaw('SUM(no_clients)')->groupBy('partner_id');

        $data['all_clients_number'] = $all_clients_number->get();

        return $data;
        
    }
}
