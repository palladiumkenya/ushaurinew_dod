<?php

namespace App\Http\Controllers;

ini_set('max_execution_time', 0);
ini_set('memory_limit', '1024M');

use App\Models\Dashboard;
use App\Models\Facility;
use App\Models\Client;
use App\Models\Partner;
use App\Models\ClientPerformance;
use App\Models\Consented;
use App\Models\Appointments;
use App\Models\County;
use Carbon\Carbon;

use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function get_client_data()
    {
        $data = [];

        $all_clients_number = ClientPerformance::selectRaw('sum(actual_clients)');
        $all_consented_clients = Client::where('smsenable', '=', 'Yes')->whereNotNull('clinic_number');
        $all_future_appointments = Appointments::where('appntmnt_date', '>', Now())->whereNotNull('client_id');
        $number_of_facilities = ClientPerformance::whereNotNull('mfl_code');
        $number_of_consented_clients = Consented::selectRaw('sum(no_of_consented_clients)');

        $data['all_clients_number'] = $all_clients_number->get();
        $data['all_consented_clients'] = $all_consented_clients->count();
        $data['all_future_appointments'] = $all_future_appointments->count();
        $data['number_of_facilities'] = $number_of_facilities->count();
        $data['number_of_consented_clients'] = $number_of_consented_clients->get();

        return $data;

    }
    public function get_dashboard_counties(Request $request)
    {
        $partner_ids = array();
        $strings_array = $request->partners;
        if (!empty($strings_array)) {
            foreach ($strings_array as $each_id) {
                $partner_ids[] = (int) $each_id;
            }
        }
        $counties_with_data = Dashboard::select('county_id')->distinct('county_id')->groupBy('county_id')->get();

        if (!empty($partner_ids)) {
            $all_counties = County::join('sub_county', 'county.id', '=', 'sub_county.county_id')
                ->join('tbl_master_facility', 'sub_county.id', '=', 'tbl_master_facility.Sub_County_ID')
                ->select('county.id as id', 'county.name as name')
                ->distinct('county.id')
                ->whereIn('health_facilities.partner_id', $partner_ids)
                ->whereIn('county.id', $counties_with_data)
                ->groupBy('county.id', 'county.name')
                ->get('county.id');
        } else {
            $all_counties = County::join('sub_county', 'county.id', '=', 'sub_county.county_id')
            ->join('tbl_master_facility', 'sub_county.id', '=', 'tbl_master_facility.Sub_County_ID')
            ->select('county.id as id', 'county.name as name')
            ->distinct('county.id')
            ->whereIn('county.id', $counties_with_data)
            ->groupBy('county.id', 'county.name')
            ->get();
        }
        return $all_counties;
    }
}
