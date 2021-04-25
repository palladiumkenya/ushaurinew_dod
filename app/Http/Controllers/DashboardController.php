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
use App\Models\SubCounty;
use App\Models\MainDashboardBar;
use App\Models\ClientRegistration;
use App\Models\PartnerFacility;
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

        $all_clients_number = ClientPerformance::selectRaw('actual_clients')->sum('actual_clients');
        $pec_client_sum = ClientRegistration::select('total_percentage')->sum('total_percentage');
        $pec_client_count = ClientRegistration::select('total_percentage')->avg('total_percentage');
       // $all_client_pec = $pec_client_sum / $pec_client_count * 1000;
        $all_target_clients = ClientPerformance::selectRaw('target_clients')->sum('target_clients');
        $all_consented_clients = ClientRegistration::select('consented')->sum('consented');
        $all_future_appointments = Appointments::where('appntmnt_date', '>', Now())->whereNotNull('client_id');
        $number_of_facilities = ClientPerformance::whereNotNull('mfl_code');

        $registered_clients = MainDashboardBar::select('clients')->sum('clients')->groupBy('MONTH')->get();
        $consented_clients = MainDashboardBar::select('consented')->sum('consented')->groupBy('MONTH')->get();
        $month_count = MainDashboardBar::select('MONTH')->orderBy('MONTH', 'asc');



        $data['all_clients_number'] = $all_clients_number;
        $data['pec_client_count'] = $pec_client_count;
        $data['all_target_clients'] = $all_target_clients;
        $data['all_consented_clients'] = $all_consented_clients;
        $data['all_future_appointments'] = $all_future_appointments->count();
        $data['number_of_facilities'] = $number_of_facilities->count();

        $data['registered_clients'] = $registered_client;
       $data['consented_clients'] = $consented_clients;
       $data['month_count'] = $month_count->get();


        //return view('dashboard.dashboardv1', compact('data', 'registered_clients', 'consented_clients', 'month_count'));
      //  dd($data);

        return $data;
    }

    public function main_graph_dashboard()
    {

        $data                = [];

        if (Auth::user()->access_level == 'Partner') { //user is partner
            $selected_partners = [Auth::user()->partner_id];
        }
        if (Auth::user()->access_level == 'Facility') { //user is facility
            $selected_facilities = [Auth::user()->facility_id];
        }
        if (Auth::user()->access_level == 'County') { // user is a county user
            $selected_counties = [Auth::user()->county_id];
        }

        $partners_with_data = ClientRegistration::select('partner_id')->groupBy('partner_id');

        $counties_with_data = ClientRegistration::select('county_id')->groupBy('county_id');


        $all_partners = Partner::where('status', '=', 'Active')->pluck('name', 'id');
        $all_counties = County::select('id', 'name')->distinct('id')->whereIn('id', $counties_with_data)->get();


        $all_clients_number = ClientPerformance::selectRaw('actual_clients')->sum('actual_clients');
        $pec_client_sum = ClientRegistration::select('total_percentage')->sum('total_percentage');
        $pec_client_count = ClientRegistration::select('total_percentage')->avg('total_percentage');
        $all_target_clients = ClientPerformance::selectRaw('target_clients')->sum('target_clients');
        $all_consented_clients = ClientRegistration::select('consented')->sum('consented');
        $all_future_appointments = Appointments::where('appntmnt_date', '>', Now())
        ->whereNotNull('client_id')
        ->count();
        $number_of_facilities = ClientPerformance::whereNotNull('mfl_code')->count();

        $registered_clients = MainDashboardBar::select(\DB::raw("SUM(clients) as count"))
        ->groupBy('MONTH')
        ->orderBy('MONTH', 'asc')
        ->get()->toArray();
        $registered_clients = array_column($registered_clients, 'count');

        $consented_clients = MainDashboardBar::select(\DB::raw("SUM(consented) as count"))
        ->groupBy('MONTH')
        ->orderBy('MONTH', 'asc')
        ->get()->toArray();
        $consented_clients = array_column($consented_clients, 'count');
        $month_count = MainDashboardBar::select('MONTH as months')
        ->groupBy('MONTH')
        ->orderBy('MONTH', 'asc')
        ->get()->toArray();
        $month_count = array_column($month_count, 'months');

        $chart_consent = array($month_count);
        foreach ($month_count as $index => $month) {
            $chart_consent[$month] = $consented_clients [$index];

        }
        $chart_registered = array($month_count);
        foreach ($month_count as $index => $month) {
            $chart_registered[$month] = $registered_clients [$index];
        }

        $registered_clients_count = ClientRegistration::select(\DB::raw("SUM(clients) as count"))
        ->pluck('count');
        $consented_clients_count = ClientRegistration::select(\DB::raw("SUM(consented) as count"))
        ->pluck('count');

       // dd($registered_clients_count);


        $data["all_clients_number"]        = $all_clients_number;
        $data["pec_client_count"]        = $pec_client_count;
        $data["all_target_clients"]         = $all_target_clients;
        $data["all_consented_clients"]        = $all_consented_clients;
        $data["all_future_appointments"]        = $all_future_appointments;
        $data["all_target_clients"]         = $number_of_facilities;
        $data["all_partners"]         = $all_partners;
        $data["all_counties"]         = $all_counties;

        //return view('dashboard.dashboardv1', compact('data'));

       return view('dashboard.dashboardv1', compact('all_partners', 'all_counties', 'chart_consent', 'chart_registered', 'month_count', 'all_clients_number', 'all_target_clients',
      'all_consented_clients', 'all_future_appointments', 'number_of_facilities', 'pec_client_count', 'registered_clients_count', 'consented_clients_count',
    'registered_clients'));

    }

    public function filter_dashboard(Request $request){

        $data                = [];

        $selected_partners = $request->partners;
        $selected_counties = $request->counties;
        $selected_subcounties = $request->subcounties;
        $selected_facilites = $request->facilities;

        if (Auth::user()->access_level == 'Partner') { //user is partner
            $selected_partners = [Auth::user()->partner_id];
        }
        if (Auth::user()->access_level == 'Facility') { //user is facility
            $selected_facilities = [Auth::user()->facility_id];
        }
        if (Auth::user()->access_level == 'County') { // user is a county user
            $selected_counties = [Auth::user()->county_id];
        }


        $all_clients_number = ClientPerformance::selectRaw('actual_clients')->sum('actual_clients');
        $pec_client_sum = ClientRegistration::select('total_percentage')->sum('total_percentage');
        $pec_client_count = ClientRegistration::select('total_percentage')->avg('total_percentage');
        $all_target_clients = ClientPerformance::selectRaw('target_clients')->sum('target_clients');
        $all_consented_clients = ClientRegistration::select('consented')->sum('consented');
        $all_future_appointments = Appointments::where('appntmnt_date', '>', Now())
        ->whereNotNull('client_id')
        ->count();
        $number_of_facilities = ClientPerformance::whereNotNull('mfl_code')->count();

        $registered_clients = MainDashboardBar::select(\DB::raw("SUM(clients) as count"))
        ->groupBy('MONTH')
        ->orderBy('MONTH', 'asc')
        ->get()->toArray();
        $registered_clients = array_column($registered_clients, 'count');

        $consented_clients = MainDashboardBar::select(\DB::raw("SUM(consented) as count"))
        ->groupBy('MONTH')
        ->orderBy('MONTH', 'asc')
        ->get()->toArray();
        $consented_clients = array_column($consented_clients, 'count');
        $month_count = MainDashboardBar::select('MONTH as months')
        ->groupBy('MONTH')
        ->orderBy('MONTH', 'asc')
        ->get()->toArray();
        $month_count = array_column($month_count, 'months');

        $chart_consent = array($month_count);
        foreach ($month_count as $index => $month) {
            $chart_consent[$month] = $consented_clients [$index];

        }
        $chart_registered = array($month_count);
        foreach ($month_count as $index => $month) {
            $chart_registered[$month] = $registered_clients [$index];
        }


        $data["all_clients_number"]        = $all_clients_number;
        $data["pec_client_count"]        = $pec_client_count;
        $data["all_target_clients"]         = $all_target_clients;
        $data["all_consented_clients"]        = $all_consented_clients;
        $data["all_future_appointments"]        = $all_future_appointments;
        $data["all_target_clients"]         = $number_of_facilities;

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
        $counties_with_data = ClientRegistration::select('county_id')->distinct('county_id')->groupBy('county_id')->get();

        if (!empty($partner_ids)) {
            $all_counties = County::join('tbl_sub_county', 'county.id', '=', 'tbl_sub_county.county_id')
                ->join('tbl_partner_facility', 'tbl_sub_county.id', '=', 'tbl_partner_facility.sub_county_id')
                ->select('tbl_county.id as id', 'tbl_county.name as name')
                ->distinct('tbl_county.id')
                ->whereIn('tbl_partner_facility.partner_id', $partner_ids)
                ->whereIn('tbl_county.id', $counties_with_data)
                ->groupBy('tbl_county.id', 'tbl_county.name')
                ->get('tbl_county.id');
        } else {
            $all_counties = County::join('tbl_sub_county', 'county.id', '=', 'tbl_sub_county.county_id')
            ->join('tbl_partner_facility', 'tbl_sub_county.id', '=', 'tbl_partner_facility.sub_county_id')
            ->select('tbl_county.id as id', 'tbl_county.name as name')
            ->distinct('tbl_county.id')
            ->whereIn('tbl_county.id', $counties_with_data)
            ->groupBy('tbl_county.id', 'tbl_county.name')
            ->get();
        }
        return $all_counties;
    }

    public function get_counties($id)
    {
        $counties = PartnerFacility::join('tbl_county', 'tbl_partner_facility.county_id', '=', 'tbl_county.id')
                    ->where("tbl_partner_facility.partner_id",$id)
                    ->pluck("tbl_county.name","tbl_county.id");
        return json_encode($counties);
    }

    public function get_dashboard_sub_counties($id)
    {
        $subcounties = PartnerFacility::join('tbl_sub_county', 'tbl_partner_facility.sub_county_id', '=', 'tbl_sub_county.id')
                    ->where("tbl_partner_facility.county_id",$id)
                    ->pluck("tbl_sub_county.name","tbl_sub_county.id");
        return json_encode($subcounties);
    }

    public function get_dashboard_facilities(Request $request)
    {
        $sub_county_ids = array();
        $strings_array = $request->sub_counties;
        $partner_ids = $request->partners;
        if (!empty($strings_array)) {
            foreach ($strings_array as $each_id) {
                $sub_county_ids[] = (int) $each_id;
            }
        }

        $withResults = ClientRegistration::select('mfl_code')->groupBy('mfl_code')->get();

        $all_facilities = Facility::select('code', 'name')->distinct('code')->wherein('Sub_County_ID', $sub_county_ids)->wherein('partner_id', $partner_ids)->wherein('code', $withResults)->groupBy('code', 'name')->get();

        return $all_facilities;
    }


    public function facility_dashboard()
    {
        // clients count
        if (Auth::user()->access_level == 'Admin') {

            $clients_count = Client::whereNotNull('clinic_number')
           ->select(\DB::raw("COUNT(id) as count"))
           ->pluck('count');
           $consented_count = Client::where('smsenable', '=', 'Yes')
           ->select(\DB::raw("COUNT(id) as count"))
           ->pluck('count');
           $appointment_count = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
           ->whereNotNull('tbl_appointment.id')
           ->select(\DB::raw("COUNT(tbl_appointment.id) as count"))
           ->pluck('count');
           $messages_count = Message::join('tbl_client', 'tbl_client.id', '=', 'tbl_clnt_outgoing.clnt_usr_id')
           ->where('tbl_clnt_outgoing.recepient_type', '=', 'Client')
           ->select(\DB::raw("COUNT(tbl_clnt_outgoing.id) as count"))
           ->pluck('count');

           // today's appointments
           $today_appointment = TodayAppointment::select('clinic_no', 'file_no', 'client_name', 'client_phone_no', 'appntmnt_date', 'appointment_type')
           ->get();
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

           }

        if (Auth::user()->access_level == 'Facility') {

         $clients_count = Client::whereNotNull('clinic_number')
        ->select(\DB::raw("COUNT(id) as count"))
        ->where('mfl_code', Auth::user()->facility_id)
        ->pluck('count');
        $consented_count = Client::where('smsenable', '=', 'Yes')
        ->select(\DB::raw("COUNT(id) as count"))
        ->where('mfl_code', Auth::user()->facility_id)
        ->pluck('count');
        $appointment_count = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->whereNotNull('tbl_appointment.id')
        ->select(\DB::raw("COUNT(tbl_appointment.id) as count"))
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->pluck('count');
        $messages_count = Message::join('tbl_client', 'tbl_client.id', '=', 'tbl_clnt_outgoing.clnt_usr_id')
        ->where('tbl_clnt_outgoing.recepient_type', '=', 'Client')
        ->select(\DB::raw("COUNT(tbl_clnt_outgoing.id) as count"))
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->pluck('count');

        // today's appointments
        $today_appointment = TodayAppointment::select('clinic_no', 'file_no', 'client_name', 'client_phone_no', 'appntmnt_date', 'appointment_type')
        ->where('mfl_code', Auth::user()->facility_id)
        ->get();
        $missed_appoitment = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->join('tbl_appointment_types', 'tbl_appointment_types.id', '=', 'tbl_appointment.app_type_1')
        ->select('tbl_client.clinic_number', 'tbl_client.file_no', DB::raw("CONCAT(`tbl_client`.`f_name`, ' ', `tbl_client`.`m_name`, ' ', `tbl_client`.`l_name`) as full_name"), 'tbl_client.phone_no', 'tbl_appointment.appntmnt_date', 'tbl_appointment_types.name', 'tbl_appointment.app_msg', 'tbl_appointment.no_calls', 'tbl_appointment.home_visits', 'tbl_appointment.no_msgs')
        ->whereNotNull('tbl_appointment.id')
        ->where('tbl_appointment.app_status', '=', 'Missed')
        ->where('tbl_appointment.active_app', '=', 1)
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->get();
        $defaulted_appoitment = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->join('tbl_appointment_types', 'tbl_appointment_types.id', '=', 'tbl_appointment.app_type_1')
        ->select('tbl_client.clinic_number', 'tbl_client.file_no', DB::raw("CONCAT(`tbl_client`.`f_name`, ' ', `tbl_client`.`m_name`, ' ', `tbl_client`.`l_name`) as full_name"), 'tbl_client.phone_no', 'tbl_appointment.appntmnt_date', 'tbl_appointment_types.name', 'tbl_appointment.app_msg', 'tbl_appointment.no_calls', 'tbl_appointment.home_visits', 'tbl_appointment.no_msgs')
        ->whereNotNull('tbl_appointment.id')
        ->where('tbl_appointment.app_status', '=', 'Defaulted')
        ->where('tbl_appointment.active_app', '=', 1)
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->get();
        $ltfu_appoitment = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->join('tbl_appointment_types', 'tbl_appointment_types.id', '=', 'tbl_appointment.app_type_1')
        ->select('tbl_client.clinic_number', 'tbl_client.file_no', DB::raw("CONCAT(`tbl_client`.`f_name`, ' ', `tbl_client`.`m_name`, ' ', `tbl_client`.`l_name`) as full_name"), 'tbl_client.phone_no', 'tbl_appointment.appntmnt_date', 'tbl_appointment_types.name', 'tbl_appointment.app_msg', 'tbl_appointment.no_calls', 'tbl_appointment.home_visits', 'tbl_appointment.no_msgs')
        ->whereNotNull('tbl_appointment.id')
        ->where('tbl_appointment.app_status', '=', 'LTFU')
        ->where('tbl_appointment.active_app', '=', 1)
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->get();

        }

        if (Auth::user()->access_level == 'Partner') {

        $clients_count = Client::whereNotNull('clinic_number')
        ->select(\DB::raw("COUNT(id) as count"))
        ->where('partner_id', Auth::user()->partner_id)
        ->pluck('count');
        $consented_count = Client::where('smsenable', '=', 'Yes')
        ->select(\DB::raw("COUNT(id) as count"))
        ->where('partner_id', Auth::user()->partner_id)
        ->pluck('count');
        $appointment_count = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->whereNotNull('tbl_appointment.id')
        ->select(\DB::raw("COUNT(tbl_appointment.id) as count"))
        ->where('tbl_client.partner_id', Auth::user()->partner_id)
        ->pluck('count');
        $messages_count = Message::join('tbl_client', 'tbl_client.id', '=', 'tbl_clnt_outgoing.clnt_usr_id')
        ->where('tbl_clnt_outgoing.recepient_type', '=', 'Client')
        ->select(\DB::raw("COUNT(tbl_clnt_outgoing.id) as count"))
        ->where('tbl_client.partner_id', Auth::user()->partner_id)
        ->pluck('count');

        // today's appointments
        $today_appointment = TodayAppointment::select('clinic_no', 'file_no', 'client_name', 'client_phone_no', 'appntmnt_date', 'appointment_type')
        ->where('id', Auth::user()->id)
        ->get();
        $missed_appoitment = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->join('tbl_appointment_types', 'tbl_appointment_types.id', '=', 'tbl_appointment.app_type_1')
        ->select('tbl_client.clinic_number', 'tbl_client.file_no', DB::raw("CONCAT(`tbl_client`.`f_name`, ' ', `tbl_client`.`m_name`, ' ', `tbl_client`.`l_name`) as full_name"), 'tbl_client.phone_no', 'tbl_appointment.appntmnt_date', 'tbl_appointment_types.name', 'tbl_appointment.app_msg', 'tbl_appointment.no_calls', 'tbl_appointment.home_visits', 'tbl_appointment.no_msgs')
        ->whereNotNull('tbl_appointment.id')
        ->where('tbl_appointment.app_status', '=', 'Missed')
        ->where('tbl_appointment.active_app', '=', 1)
        ->where('tbl_client.partner_id', Auth::user()->partner_id)
        ->get();
        $defaulted_appoitment = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->join('tbl_appointment_types', 'tbl_appointment_types.id', '=', 'tbl_appointment.app_type_1')
        ->select('tbl_client.clinic_number', 'tbl_client.file_no', DB::raw("CONCAT(`tbl_client`.`f_name`, ' ', `tbl_client`.`m_name`, ' ', `tbl_client`.`l_name`) as full_name"), 'tbl_client.phone_no', 'tbl_appointment.appntmnt_date', 'tbl_appointment_types.name', 'tbl_appointment.app_msg', 'tbl_appointment.no_calls', 'tbl_appointment.home_visits', 'tbl_appointment.no_msgs')
        ->whereNotNull('tbl_appointment.id')
        ->where('tbl_appointment.app_status', '=', 'Defaulted')
        ->where('tbl_appointment.active_app', '=', 1)
        ->where('tbl_client.partner_id', Auth::user()->partner_id)
        ->get();
        $ltfu_appoitment = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->join('tbl_appointment_types', 'tbl_appointment_types.id', '=', 'tbl_appointment.app_type_1')
        ->select('tbl_client.clinic_number', 'tbl_client.file_no', DB::raw("CONCAT(`tbl_client`.`f_name`, ' ', `tbl_client`.`m_name`, ' ', `tbl_client`.`l_name`) as full_name"), 'tbl_client.phone_no', 'tbl_appointment.appntmnt_date', 'tbl_appointment_types.name', 'tbl_appointment.app_msg', 'tbl_appointment.no_calls', 'tbl_appointment.home_visits', 'tbl_appointment.no_msgs')
        ->whereNotNull('tbl_appointment.id')
        ->where('tbl_appointment.app_status', '=', 'LTFU')
        ->where('tbl_appointment.active_app', '=', 1)
        ->where('tbl_client.partner_id', Auth::user()->partner_id)
        ->get();

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

    public function active_facilities()
    {
        $all_active_facilities = ClientPerformance::join('tbl_county', 'tbl_county.id', '=', 'vw_client_performance_monitor.county_id')
        ->join('tbl_sub_county', 'tbl_sub_county.id', '=', 'vw_client_performance_monitor.sub_county_id')
        ->join('tbl_partner', 'tbl_partner.id', '=', 'vw_client_performance_monitor.partner_id')
        ->select('vw_client_performance_monitor.facility', 'vw_client_performance_monitor.mfl_code', 'vw_client_performance_monitor.actual_clients', 'tbl_county.name as county', 'tbl_sub_county.name as sub_county', 'tbl_partner.name as partner')
        ->get();

        return view('facilities.active_facilities', compact('all_active_facilities'));
    }
}
