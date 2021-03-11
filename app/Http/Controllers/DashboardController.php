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
use App\Models\TodayAppointment;
use App\Models\Message;
use App\Models\County;
use Carbon\Carbon;
use DB;
use Auth;

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

    public function facility_dashboard()
    {
        // clients count
        $clients_count = Client::whereNotNull('clinic_number')
        ->select(\DB::raw("COUNT(id) as count"))
        ->pluck('count');
        $consented_count = Client::where('smsenable', '=', 'Yes')
        ->select(\DB::raw("COUNT(id) as count"))
        ->pluck('count');
        $appointment_count = Appointments::whereNotNull('id')
        ->select(\DB::raw("COUNT(id) as count"))
        ->pluck('count');
        $messages_count = Message::join('tbl_client', 'tbl_client.id', '=', 'tbl_clnt_outgoing.clnt_usr_id')
        ->where('tbl_clnt_outgoing.recepient_type', '=', 'Client')
        ->select(\DB::raw("COUNT(tbl_clnt_outgoing.id) as count"))
        ->pluck('count');

        // today's appointments
        $today_appointment = TodayAppointment::select('clinic_no', 'file_no', 'client_name', 'client_phone_no', 'appntmnt_date', 'appointment_type')->get();
        $missed_appoitment = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->join('tbl_appointment_types', 'tbl_appointment_types.id', '=', 'tbl_appointment.app_type_1')
        ->select('tbl_client.clinic_number', 'tbl_client.file_no', DB::raw("CONCAT(`tbl_client`.`f_name`, ' ', `tbl_client`.`m_name`, ' ', `tbl_client`.`l_name`) as full_name"), 'tbl_client.phone_no', 'tbl_appointment.appntmnt_date', 'tbl_appointment_types.name', 'tbl_appointment.app_msg', 'tbl_appointment.no_calls', 'tbl_appointment.home_visits', 'tbl_appointment.no_msgs')
        ->whereNotNull('tbl_appointment.id')
        ->where('tbl_appointment.app_status', '=', 'Missed')
        ->where('tbl_appointment.active_app', '=', 1)
        ->get();
        $defaulted_appoitment = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->join('tbl_appointment_types', 'tbl_appointment_types.id', '=', 'tbl_appointment.app_type_1')
        ->select('tbl_client.clinic_number', 'tbl_client.file_no', DB::raw("CONCAT(`tbl_client`.`f_name`, ' ', `tbl_client`.`m_name`, ' ', `tbl_client`.`l_name`) as full_name"), 'tbl_client.phone_no', 'tbl_appointment.appntmnt_date', 'tbl_appointment_types.name', 'tbl_appointment.app_msg', 'tbl_appointment.no_calls', 'tbl_appointment.home_visits', 'tbl_appointment.no_msgs')
        ->whereNotNull('tbl_appointment.id')
        ->where('tbl_appointment.app_status', '=', 'Defaulted')
        ->where('tbl_appointment.active_app', '=', 1)
        ->get();
        $ltfu_appoitment = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->join('tbl_appointment_types', 'tbl_appointment_types.id', '=', 'tbl_appointment.app_type_1')
        ->select('tbl_client.clinic_number', 'tbl_client.file_no', DB::raw("CONCAT(`tbl_client`.`f_name`, ' ', `tbl_client`.`m_name`, ' ', `tbl_client`.`l_name`) as full_name"), 'tbl_client.phone_no', 'tbl_appointment.appntmnt_date', 'tbl_appointment_types.name', 'tbl_appointment.app_msg', 'tbl_appointment.no_calls', 'tbl_appointment.home_visits', 'tbl_appointment.no_msgs')
        ->whereNotNull('tbl_appointment.id')
        ->where('tbl_appointment.app_status', '=', 'LTFU')
        ->where('tbl_appointment.active_app', '=', 1)
        ->get();


        return view('dashboard.facility_dashboard', compact('clients_count', 'consented_count', 'appointment_count', 'messages_count', 'today_appointment', 'missed_appoitment', 'defaulted_appoitment', 'ltfu_appoitment'));

        public function client_distribution_graphs()
        {
            $gender_male = Client::whereNotNull('clinic_number')
            ->select(\DB::raw("COUNT(id) as count"))
            ->where('gender', '=', 2)
            ->pluck('count');

            $gender_female = Client::whereNotNull('clinic_number')
            ->select(\DB::raw("COUNT(id) as count"))
            ->where('gender', '=', 2)
            ->pluck('count');

            $gender_male = Client::whereNotNull('clinic_number')
            ->select(\DB::raw("COUNT(id) as count"))
            ->where('gender', '=', 5)
            ->pluck('count');

            $language_swahili = Client::whereNotNull('clinic_number')
            ->select(\DB::raw("COUNT(id) as count"))
            ->where('language_id', '=', 1)
            ->pluck('count');

            $english_swahili = Client::whereNotNull('clinic_number')
            ->select(\DB::raw("COUNT(id) as count"))
            ->where('language_id', '=', 1)
            ->pluck('count');
        }
    }
}
