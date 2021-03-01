<?php

namespace App\Http\Controllers;

ini_set('max_execution_time', 0);
ini_set('memory_limit', '1024M');

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Appointments;
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
}
