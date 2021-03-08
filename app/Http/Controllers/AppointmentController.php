<?php

namespace App\Http\Controllers;

ini_set('max_execution_time', 0);
ini_set('memory_limit', '1024M');

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Appointments;
use App\Models\Marital;
use App\Models\AppointmentType;
use Redirect,Response;
use Auth;

class AppointmentController extends Controller
{
    public function get_future_appointments()
    {
        $all_future_appointments = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->selectRaw('tbl_client.clinic_number, tbl_client.file_no, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_client.phone_no, tbl_appointment.appntmnt_date, tbl_appointment.app_type_1')
        ->where('tbl_appointment.appntmnt_date', '>', Now());

        if (Auth::user()->role_id == 4 || Auth::user()->role_id == 7 || Auth::user()->role_id == 8) {
            $all_future_appointments->where('facility', Auth::user()->facility->name);
        }

        return view('appointments.future_appointments')->with('all_future_appointments', $all_future_appointments->get());
    }

    public function get_missed_appointments()
    {
        $all_missed_appointments = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->selectRaw('tbl_client.clinic_number, tbl_client.file_no, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_client.phone_no, tbl_appointment.appntmnt_date, tbl_appointment.app_type_1, tbl_appointment.app_msg, tbl_appointment.no_calls, tbl_appointment.no_msgs, tbl_appointment.home_visits')
        ->where('tbl_appointment.app_status', '=', 'Missed');

        return view('appointments.missed_appointments')->with('all_missed_appointments', $all_missed_appointments->get());
    }

    public function get_defaulted_appointments()
    {
        $all_defaulted_appointments = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->selectRaw('tbl_client.clinic_number, tbl_client.file_no, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_client.phone_no, tbl_appointment.appntmnt_date, tbl_appointment.app_type_1, tbl_appointment.app_msg, tbl_appointment.no_calls, tbl_appointment.no_msgs, tbl_appointment.home_visits')
        ->where('tbl_appointment.app_status', '=', 'Defaulted');

        return view('appointments.defaulted_appointments')->with('all_defaulted_appointments', $all_defaulted_appointments->get());
    }

    public function get_ltfu_appointments()
    {
        $all_ltfu_appointments = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->selectRaw('tbl_client.clinic_number, tbl_client.file_no, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_client.phone_no, tbl_appointment.appntmnt_date, tbl_appointment.app_type_1, tbl_appointment.app_msg, tbl_appointment.no_calls, tbl_appointment.no_msgs, tbl_appointment.home_visits')
        ->where('tbl_appointment.app_status', '=', 'LTFU');

        return view('appointments.ltfu_appointments')->with('all_ltfu_appointments', $all_ltfu_appointments->get());
    }

    public function get_appointment_list()
    {
        $all_appointments = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->selectRaw('tbl_client.clinic_number, tbl_client.file_no, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_client.phone_no, tbl_appointment.appntmnt_date, tbl_appointment.app_type_1, tbl_client.status, tbl_client.enrollment_date, tbl_client.art_date, tbl_client.created_at')
        ->whereNotNull('tbl_appointment.appntmnt_date')->orderBy('tbl_appointment.appntmnt_date')->limit(1000);

        return view('appointments.appointments_list')->with('all_appointments', $all_appointments->get());

    }

    public function get_count_appointments()
    {
        $data = [];
        $all_count_appointment = Appointments::selectRaw('tbl_appointment_types.name, tbl_client.clinic_number, tbl_appointment.appntmnt_date AS start, COUNT(tbl_appointment.id) AS title')
        ->join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->join('tbl_appointment_types', 'tbl_appointment_types.id', '=', 'tbl_appointment.app_type_1')
        ->whereNotNull('tbl_appointment.id');

       // ->innerJoin('tbl_appointment_types') ON 'tbl_appointment_types.id' = 'tbl_appointment.app_type_1'

       $data['all_count_appointment'] = $all_count_appointment->get();
       return $data;
    }

    public function get_appointment_count()
    {
        $data = [
            'start AS appntmnt_date',
            'end AS appntmnt_',
            'title AS name',
        ];
        $all_count_appointment = Appointments::selectRaw('tbl_appointment_types.name, tbl_appointment.appntmnt_date AS start, COUNT(tbl_appointment.id) AS title')
        ->join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->join('tbl_appointment_types', 'tbl_appointment_types.id', '=', 'tbl_appointment.app_type_1')
        ->whereNotNull('tbl_appointment.id')
        ->get($data);

        $calender_data = $all_count_appointment->toJson();
        //console.log( $calender_data );
    }
    public function get_created_appointments()
    {
        $data = [];

        $all_created_appointment = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->where('tbl_client.mfl_code', '=', 12345);

        $data['all_created_appointment'] = $all_created_appointment->count();

        return $data;
    }

    public function get_active_missed()
    {
        $data = [];

        $all_active_missed = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->where('tbl_client.mfl_code', '=', 12345)
         ->where('active_app', '=', 1)
        ->where('app_status', '=', 'Missed');

        $data['all_active_missed'] = $all_active_missed->count();

        return $data;
    }
    public function get_active_defaulted()
    {
        $data = [];

        $all_active_defaulted = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->where('tbl_client.mfl_code', '=', 12345)
         ->where('active_app', '=', 1)
        ->where('app_status', '=', 'Defaulted');

        $data['all_active_defaulted'] = $all_active_defaulted->count();

        return $data;
    }
    public function get_active_ltfu()
    {
        $data = [];

        $all_active_ltfu = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->where('tbl_client.mfl_code', '=', 12345)
         ->where('active_app', '=', 1)
        ->where('app_status', '=', 'LTFU');

        $data['all_active_ltfu'] = $all_active_ltfu->count();

        return $data;
    }
    public function get_app_honourned()
    {
        $data = [];

        $all_app_honourned = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->where('tbl_client.mfl_code', '=', 12345)
         ->where('tbl_appointment.active_app', '=', 0)
         ->where('tbl_appointment.appointment_kept', '=', 'Yes')
         ->where('tbl_appointment.appntmnt_date', '<', Now());
       // ->where('tbl_appointment.app_status', '=', 'Notified');

        $data['all_app_honourned'] = $all_app_honourned->count();

        return $data;
    }
    public function appointment_dashboard()
    {

        $all_missed_app_over25 = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->whereDate('tbl_client.dob', '>=',  now()->subYears(25))
        ->where('tbl_client.mfl_code', '=', 12345)
        ->where('active_app', '=', 1)
        ->where('app_status', '=', 'Missed');

        $all_missed_app_0_9 = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->whereDate('tbl_client.dob', '>=',  now()->subYears(9))
        ->where('tbl_client.mfl_code', '=', 12345)
        ->where('active_app', '=', 1)
        ->where('app_status', '=', 'Missed');

        // appointments count
        $created_appointmnent_count = Appointments::select(\DB::raw("COUNT(id) as count"))
        ->whereNotNull('id')
        ->pluck('count');

        $kept_appointmnent_count = Appointments::select(\DB::raw("COUNT(id) as count"))
        ->whereNotNull('id')
        ->where('appointment_kept', '=', 'Yes')
        ->pluck('count');

        $defaulted_appointmnent_count = Appointments::select(\DB::raw("COUNT(id) as count"))
        ->whereNotNull('id')
        ->where('active_app', '=', 1)
        ->where('app_status', '=', 'Defaulted')
        ->pluck('count');

        $missed_appointmnent_count = Appointments::select(\DB::raw("COUNT(id) as count"))
        ->whereNotNull('id')
        ->where('active_app', '=', 1)
        ->where('app_status', '=', 'Missed')
        ->pluck('count');

        $ltfu_appointmnent_count = Appointments::select(\DB::raw("COUNT(id) as count"))
        ->whereNotNull('id')
        ->where('active_app', '=', 1)
        ->where('app_status', '=', 'LTFU')
        ->pluck('count');


        // single active appointment

        $all_appointment_by_marital_single_missed = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->join('tbl_marital_status', 'tbl_marital_status.id', '=', 'tbl_client.marital')
        ->select(\DB::raw("COUNT(tbl_appointment.id) as count"))
        ->where('tbl_appointment.active_app', '=', 1)
        ->where('tbl_appointment.app_status', '=', 'Missed')
        ->where('tbl_marital_status.marital', '=', 'Single')
        ->pluck('count');

        $all_appointment_by_marital_single_defaulted = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->join('tbl_marital_status', 'tbl_marital_status.id', '=', 'tbl_client.marital')
        ->select(\DB::raw("COUNT(tbl_appointment.id) as count"))
        ->where('tbl_appointment.active_app', '=', 1)
        ->where('tbl_appointment.app_status', '=', 'Defaulted')
        ->where('tbl_marital_status.marital', '=', 'Single')
        ->pluck('count');

        $all_appointment_by_marital_single_ltfu = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->join('tbl_marital_status', 'tbl_marital_status.id', '=', 'tbl_client.marital')
        ->select(\DB::raw("COUNT(tbl_appointment.id) as count"))
        ->where('tbl_appointment.active_app', '=', 1)
        ->where('tbl_appointment.app_status', '=', 'LTFU')
        ->where('tbl_marital_status.marital', '=', 'Single')
        ->pluck('count');

        // Married Monogomous Active Appointment

        $all_appointment_by_marital_monogomous_missed = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->join('tbl_marital_status', 'tbl_marital_status.id', '=', 'tbl_client.marital')
        ->select(\DB::raw("COUNT(tbl_appointment.id) as count"))
        ->where('tbl_appointment.active_app', '=', 1)
        ->where('tbl_appointment.app_status', '=', 'Missed')
        ->where('tbl_marital_status.marital', '=', 'Married Monogamous')
        ->pluck('count');

        $all_appointment_by_marital_monogomous_defaulted = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->join('tbl_marital_status', 'tbl_marital_status.id', '=', 'tbl_client.marital')
        ->select(\DB::raw("COUNT(tbl_appointment.id) as count"))
        ->where('tbl_appointment.active_app', '=', 1)
        ->where('tbl_appointment.app_status', '=', 'Defaulted')
        ->where('tbl_marital_status.marital', '=', 'Married Monogamous')
        ->pluck('count');

        $all_appointment_by_marital_monogomous_lftu = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->join('tbl_marital_status', 'tbl_marital_status.id', '=', 'tbl_client.marital')
        ->select(\DB::raw("COUNT(tbl_appointment.id) as count"))
        ->where('tbl_appointment.active_app', '=', 1)
        ->where('tbl_appointment.app_status', '=', 'LTFU')
        ->where('tbl_marital_status.marital', '=', 'Married Monogamous')
        ->pluck('count');

        // Divorced Active Appointment

        $all_appointment_by_marital_divorced_missed = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->join('tbl_marital_status', 'tbl_marital_status.id', '=', 'tbl_client.marital')
        ->select(\DB::raw("COUNT(tbl_appointment.id) as count"))
        ->where('tbl_appointment.active_app', '=', 1)
        ->where('tbl_appointment.app_status', '=', 'Missed')
        ->where('tbl_marital_status.marital', '=', 'Divorced')
        ->pluck('count');

        $all_appointment_by_marital_divorced_defaulted = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->join('tbl_marital_status', 'tbl_marital_status.id', '=', 'tbl_client.marital')
        ->select(\DB::raw("COUNT(tbl_appointment.id) as count"))
        ->where('tbl_appointment.active_app', '=', 1)
        ->where('tbl_appointment.app_status', '=', 'Defaulted')
        ->where('tbl_marital_status.marital', '=', 'Divorced')
        ->pluck('count');

        $all_appointment_by_marital_divorced_lftu = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->join('tbl_marital_status', 'tbl_marital_status.id', '=', 'tbl_client.marital')
        ->select(\DB::raw("COUNT(tbl_appointment.id) as count"))
        ->where('tbl_appointment.active_app', '=', 1)
        ->where('tbl_appointment.app_status', '=', 'LTFU')
        ->where('tbl_marital_status.marital', '=', 'Divorced')
        ->pluck('count');

        // Widowed Active Appointment

        $all_appointment_by_marital_widowed_missed = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->join('tbl_marital_status', 'tbl_marital_status.id', '=', 'tbl_client.marital')
        ->select(\DB::raw("COUNT(tbl_appointment.id) as count"))
        ->where('tbl_appointment.active_app', '=', 1)
        ->where('tbl_appointment.app_status', '=', 'Missed')
        ->where('tbl_marital_status.marital', '=', 'Widowed')
        ->pluck('count');

        $all_appointment_by_marital_widowed_defaulted = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->join('tbl_marital_status', 'tbl_marital_status.id', '=', 'tbl_client.marital')
        ->select(\DB::raw("COUNT(tbl_appointment.id) as count"))
        ->where('tbl_appointment.active_app', '=', 1)
        ->where('tbl_appointment.app_status', '=', 'Defaulted')
        ->where('tbl_marital_status.marital', '=', 'Widowed')
        ->pluck('count');

        $all_appointment_by_marital_widowed_lftu = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->join('tbl_marital_status', 'tbl_marital_status.id', '=', 'tbl_client.marital')
        ->select(\DB::raw("COUNT(tbl_appointment.id) as count"))
        ->where('tbl_appointment.active_app', '=', 1)
        ->where('tbl_appointment.app_status', '=', 'LTFU')
        ->where('tbl_marital_status.marital', '=', 'Widowed')
        ->pluck('count');

        // Cohabiting Active Appointment

        $all_appointment_by_marital_cohabiting_missed = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->join('tbl_marital_status', 'tbl_marital_status.id', '=', 'tbl_client.marital')
        ->select(\DB::raw("COUNT(tbl_appointment.id) as count"))
        ->where('tbl_appointment.active_app', '=', 1)
        ->where('tbl_appointment.app_status', '=', 'Missed')
        ->where('tbl_marital_status.marital', '=', 'Cohabiting')
        ->pluck('count');

        $all_appointment_by_marital_cohabiting_defaulted = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->join('tbl_marital_status', 'tbl_marital_status.id', '=', 'tbl_client.marital')
        ->select(\DB::raw("COUNT(tbl_appointment.id) as count"))
        ->where('tbl_appointment.active_app', '=', 1)
        ->where('tbl_appointment.app_status', '=', 'Defaulted')
        ->where('tbl_marital_status.marital', '=', 'Cohabiting')
        ->pluck('count');

        $all_appointment_by_marital_cohabiting_lftu = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->join('tbl_marital_status', 'tbl_marital_status.id', '=', 'tbl_client.marital')
        ->select(\DB::raw("COUNT(tbl_appointment.id) as count"))
        ->where('tbl_appointment.active_app', '=', 1)
        ->where('tbl_appointment.app_status', '=', 'LTFU')
        ->where('tbl_marital_status.marital', '=', 'Cohabiting')
        ->pluck('count');

        // Unavailable Active Appointment

        $all_appointment_by_marital_unavailable_missed = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->join('tbl_marital_status', 'tbl_marital_status.id', '=', 'tbl_client.marital')
        ->select(\DB::raw("COUNT(tbl_appointment.id) as count"))
        ->where('tbl_appointment.active_app', '=', 1)
        ->where('tbl_appointment.app_status', '=', 'Missed')
        ->where('tbl_marital_status.marital', '=', 'Unavailable')
        ->pluck('count');

        $all_appointment_by_marital_unavailable_defaulted = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->join('tbl_marital_status', 'tbl_marital_status.id', '=', 'tbl_client.marital')
        ->select(\DB::raw("COUNT(tbl_appointment.id) as count"))
        ->where('tbl_appointment.active_app', '=', 1)
        ->where('tbl_appointment.app_status', '=', 'Defaulted')
        ->where('tbl_marital_status.marital', '=', 'Unavailable')
        ->pluck('count');

        $all_appointment_by_marital_unavailable_lftu = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->join('tbl_marital_status', 'tbl_marital_status.id', '=', 'tbl_client.marital')
        ->select(\DB::raw("COUNT(tbl_appointment.id) as count"))
        ->where('tbl_appointment.active_app', '=', 1)
        ->where('tbl_appointment.app_status', '=', 'LTFU')
        ->where('tbl_marital_status.marital', '=', 'Unavailable')
        ->pluck('count');

        // Polygamous Active Appointment

        $all_appointment_by_marital_polygamous_missed = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->join('tbl_marital_status', 'tbl_marital_status.id', '=', 'tbl_client.marital')
        ->select(\DB::raw("COUNT(tbl_appointment.id) as count"))
        ->where('tbl_appointment.active_app', '=', 1)
        ->where('tbl_appointment.app_status', '=', 'Missed')
        ->where('tbl_marital_status.marital', '=', 'Maried polygamous')
        ->pluck('count');

        $all_appointment_by_marital_polygamous_defaulted = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->join('tbl_marital_status', 'tbl_marital_status.id', '=', 'tbl_client.marital')
        ->select(\DB::raw("COUNT(tbl_appointment.id) as count"))
        ->where('tbl_appointment.active_app', '=', 1)
        ->where('tbl_appointment.app_status', '=', 'Defaulted')
        ->where('tbl_marital_status.marital', '=', 'Maried polygamous')
        ->pluck('count');

        $all_appointment_by_marital_polygamous_lftu = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->join('tbl_marital_status', 'tbl_marital_status.id', '=', 'tbl_client.marital')
        ->select(\DB::raw("COUNT(tbl_appointment.id) as count"))
        ->where('tbl_appointment.active_app', '=', 1)
        ->where('tbl_appointment.app_status', '=', 'LTFU')
        ->where('tbl_marital_status.marital', '=', 'Maried polygamous')
        ->pluck('count');

        // Not applicable Active Appointment

        $all_appointment_by_marital_notapplicable_missed = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->join('tbl_marital_status', 'tbl_marital_status.id', '=', 'tbl_client.marital')
        ->select(\DB::raw("COUNT(tbl_appointment.id) as count"))
        ->where('tbl_appointment.active_app', '=', 1)
        ->where('tbl_appointment.app_status', '=', 'Missed')
        ->where('tbl_marital_status.marital', '=', 'Not Applicable')
        ->pluck('count');


        $all_appointment_by_marital_notapplicable_defaulted = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->join('tbl_marital_status', 'tbl_marital_status.id', '=', 'tbl_client.marital')
        ->select(\DB::raw("COUNT(tbl_appointment.id) as count"))
        ->where('tbl_appointment.active_app', '=', 1)
        ->where('tbl_appointment.app_status', '=', 'Defaulted')
        ->where('tbl_marital_status.marital', '=', 'Not Applicable')
        ->pluck('count');

        $all_appointment_by_marital_notapplicable_lftu = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->join('tbl_marital_status', 'tbl_marital_status.id', '=', 'tbl_client.marital')
        ->select(\DB::raw("COUNT(tbl_appointment.id) as count"))
        ->where('tbl_appointment.active_app', '=', 1)
        ->where('tbl_appointment.app_status', '=', 'LTFU')
        ->where('tbl_marital_status.marital', '=', 'Not Applicable')
        ->pluck('count');

        return view('appointments.appointment_dashboard', compact('created_appointmnent_count', 'kept_appointmnent_count', 'missed_appointmnent_count', 'defaulted_appointmnent_count', 'ltfu_appointmnent_count', 'all_appointment_by_marital_single_missed', 'all_appointment_by_marital_single_defaulted', 'all_appointment_by_marital_single_ltfu', 'all_appointment_by_marital_monogomous_missed', 'all_appointment_by_marital_monogomous_defaulted', 'all_appointment_by_marital_monogomous_lftu',
        'all_appointment_by_marital_divorced_missed', 'all_appointment_by_marital_divorced_defaulted', 'all_appointment_by_marital_divorced_lftu', 'all_appointment_by_marital_widowed_missed', 'all_appointment_by_marital_widowed_defaulted', 'all_appointment_by_marital_widowed_lftu', 'all_appointment_by_marital_cohabiting_missed',
        'all_appointment_by_marital_cohabiting_defaulted', 'all_appointment_by_marital_cohabiting_lftu', 'all_appointment_by_marital_unavailable_missed', 'all_appointment_by_marital_unavailable_defaulted', 'all_appointment_by_marital_unavailable_lftu',
        'all_appointment_by_marital_polygamous_missed', 'all_appointment_by_marital_polygamous_defaulted', 'all_appointment_by_marital_polygamous_lftu', 'all_appointment_by_marital_notapplicable_missed', 'all_appointment_by_marital_notapplicable_defaulted', 'all_appointment_by_marital_notapplicable_lftu'));
    }
}
