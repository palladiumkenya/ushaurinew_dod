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

    public function index()
    {

       // return view('dashboard.dashboardv1');
    }

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

        if (Auth::user()->access_level == 'Facility') {
            $clients_count->where('facility_id', Auth::user()->facility_id);

        }

        if (Auth::user()->access_level == 'Partner') {
            $clients_count->where('partner_id', Auth::user()->partner_id);
            $consented_count->where('partner_id', Auth::user()->partner_id);
            $appointment_count->where('partner_id', Auth::user()->partner_id);
            $messages_count->where('partner_id', Auth::user()->partner_id);
            $today_appointment->where('partner_id', Auth::user()->partner_id);
            $missed_appoitment->where('partner_id', Auth::user()->partner_id);
            $defaulted_appoitment->where('partner_id', Auth::user()->partner_id);
            $ltfu_appoitment->where('partner_id', Auth::user()->partner_id);
        }

        if (Auth::user()->access_level == 'Donor') {
            $clients_count->where('donor_id', Auth::user()->donor_id);
            $consented_count->where('donor_id', Auth::user()->donor_id);
            $appointment_count->where('donor_id', Auth::user()->donor_id);
            $messages_count->where('donor_id', Auth::user()->donor_id);
            $today_appointment->where('donor_id', Auth::user()->donor_id);
            $missed_appoitment->where('donor_id', Auth::user()->donor_id);
            $defaulted_appoitment->where('donor_id', Auth::user()->donor_id);
            $ltfu_appoitment->where('donor_id', Auth::user()->donor_id);
        }


        return view('dashboard.facility_dashboard', compact('clients_count', 'consented_count', 'appointment_count', 'messages_count', 'today_appointment', 'missed_appoitment', 'defaulted_appoitment', 'ltfu_appoitment'));
    }


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

        $gender_unavailable = Client::whereNotNull('clinic_number')
        ->select(\DB::raw("COUNT(id) as count"))
        ->where('gender', '=', 5)
        ->pluck('count');

        $language_swahili = Client::whereNotNull('clinic_number')
        ->select(\DB::raw("COUNT(id) as count"))
        ->where('language_id', '=', 1)
        ->pluck('count');

        $language_english = Client::whereNotNull('clinic_number')
        ->select(\DB::raw("COUNT(id) as count"))
        ->where('language_id', '=', 2)
        ->pluck('count');

        $language_nolanguage = Client::whereNotNull('clinic_number')
        ->select(\DB::raw("COUNT(id) as count"))
        ->where('language_id', '=', 5)
        ->pluck('count');

        $marital_single = Client::whereNotNull('clinic_number')
        ->select(\DB::raw("COUNT(id) as count"))
        ->where('marital', '=', 1)
        ->pluck('count');

        $marital_monogamous = Client::whereNotNull('clinic_number')
        ->select(\DB::raw("COUNT(id) as count"))
        ->where('marital', '=', 2)
        ->pluck('count');

        $marital_divorced = Client::whereNotNull('clinic_number')
        ->select(\DB::raw("COUNT(id) as count"))
        ->where('marital', '=', 3)
        ->pluck('count');

        $marital_widowed = Client::whereNotNull('clinic_number')
        ->select(\DB::raw("COUNT(id) as count"))
        ->where('marital', '=', 4)
        ->pluck('count');

        $marital_cohabating = Client::whereNotNull('clinic_number')
        ->select(\DB::raw("COUNT(id) as count"))
        ->where('marital', '=', 5)
        ->pluck('count');

        $marital_unavailable = Client::whereNotNull('clinic_number')
        ->select(\DB::raw("COUNT(id) as count"))
        ->where('marital', '=', 6)
        ->pluck('count');

        $marital_notapplicable = Client::whereNotNull('clinic_number')
        ->select(\DB::raw("COUNT(id) as count"))
        ->where('marital', '=', 7)
        ->pluck('count');

        $marital_polygamous = Client::whereNotNull('clinic_number')
        ->select(\DB::raw("COUNT(id) as count"))
        ->where('marital', '=', 8)
        ->pluck('count');

        $client_type_new = Client::whereNotNull('clinic_number')
        ->select(\DB::raw("COUNT(id) as count"))
        ->where('client_type', '=', 'New')
        ->pluck('count');

        $client_type_transfer = Client::whereNotNull('clinic_number')
        ->select(\DB::raw("COUNT(id) as count"))
        ->where('client_type', '=', 'Transfer')
        ->pluck('count');

        $client_entry_point_mobile = Client::whereNotNull('clinic_number')
        ->select(\DB::raw("COUNT(id) as count"))
        ->where('entry_point', '=', 'Mobile')
        ->pluck('count');

        $client_entry_point_web = Client::whereNotNull('clinic_number')
        ->select(\DB::raw("COUNT(id) as count"))
        ->where('entry_point', '=', 'Web')
        ->pluck('count');

        $client_entry_point_il = Client::whereNotNull('clinic_number')
        ->select(\DB::raw("COUNT(id) as count"))
        ->where('entry_point', '=', 'IL')
        ->pluck('count');

        $group_adults = Client::whereNotNull('clinic_number')
        ->select(\DB::raw("COUNT(id) as count"))
        ->where('group_id', '=', 1)
        ->pluck('count');

        $group_adolescents = Client::whereNotNull('clinic_number')
        ->select(\DB::raw("COUNT(id) as count"))
        ->where('group_id', '=', 2)
        ->pluck('count');

        $group_peads = Client::whereNotNull('clinic_number')
        ->select(\DB::raw("COUNT(id) as count"))
        ->where('group_id', '=', 3)
        ->pluck('count');

        $group_art_clients = Client::whereNotNull('clinic_number')
        ->select(\DB::raw("COUNT(id) as count"))
        ->where('group_id', '=', 4)
        ->pluck('count');

        $group_prenatal = Client::whereNotNull('clinic_number')
        ->select(\DB::raw("COUNT(id) as count"))
        ->where('group_id', '=', 5)
        ->pluck('count');

        $group_postalnatal = Client::whereNotNull('clinic_number')
        ->select(\DB::raw("COUNT(id) as count"))
        ->where('group_id', '=', 10)
        ->pluck('count');

       // dd($client_entry_point_mobile);

        return view('dashboard.client_registration_distribution', compact('gender_male', 'gender_female', 'gender_unavailable', 'language_swahili', 'language_english',
        'language_nolanguage', 'group_postalnatal', 'group_prenatal', 'group_art_clients', 'group_peads', 'group_adolescents', 'group_adults',
        'client_entry_point_il', 'client_entry_point_web', 'client_entry_point_mobile', 'client_type_transfer', 'client_type_new', 'marital_polygamous',
        'marital_notapplicable', 'marital_unavailable', 'marital_cohabating', 'marital_widowed', 'marital_divorced', 'marital_monogamous', 'marital_single'));
    }
}
