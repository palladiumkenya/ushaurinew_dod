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
    public function get_clients()
    {
        $data = [];

        $facilities_with_clients = Dashboard::select('facility_id')->groupBy('facility_id');
        $partner_with_clients = Dashboard::select('partner_id')->groupBy('partner_id');
       // $all_future_appointments = Appointments::select('client_id')->where('appointment_date', '>', )

        $all_facilities_numbers = Facility::select('id', 'name')->whereIn('id', $facilities_with_clients);
        $all_partners_numbers = Partner::select('id', 'name')->whereIn('id', $partner_with_clients);

        $all_clients = Dashboard::whereNotNull('clinic_number');
        $all_active_clients = Dashboard::where('status', '=', 'active');
        $all_consented_clients = Dashboard::where('smsenable', '=', 'Yes');
       


        $data['all_clients'] = $all_clients->count();
        $data['all_active_clients'] = $all_active_clients->count();
        $data['all_consented_clients'] = $all_consented_clients->count();
        $data['all_facilities_numbers'] = $all_facilities_numbers->get();
        $data['all_partners_numbers'] = $all_partners_numbers->get();

        return $data;
    }
}
