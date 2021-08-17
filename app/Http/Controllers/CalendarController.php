<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointments;
use App\Models\AppointmentType;
use Calendar;
use Auth;
use DB;

class CalendarController extends Controller
{
    public function index()
    {
        return view('appointments.appointment_calender');

    }
    public function app_calendar()
    {

        if (Auth::user()->access_level == 'Facility') {
        $app_calendar_data = Appointments::join('tbl_appointment_types', 'tbl_appointment_types.id', '=', 'tbl_appointment.app_type_1')
        ->join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select('tbl_appointment.appntmnt_date as start', DB::raw('COUNT(tbl_appointment_types.id) AS title'), 'tbl_appointment.appntmnt_date as end')
        ->groupBy('tbl_appointment.appntmnt_date')
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->get();

        return response()->json($app_calendar_data);
        }
    }
    public function refill_calendar()
    {
        if (Auth::user()->access_level == 'Facility') {
            $app_calendar_data = Appointments::join('tbl_appointment_types', 'tbl_appointment_types.id', '=', 'tbl_appointment.app_type_1')
            ->join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select('tbl_appointment.appntmnt_date as start', DB::raw('COUNT(tbl_appointment_types.id) AS title'), 'tbl_appointment.appntmnt_date as end')
            ->groupBy('tbl_appointment.appntmnt_date')
            ->where('tbl_appointment_types.name' , '=', 'Re-fill')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->get();
            return response()->json($app_calendar_data);
        }
    }

    public function clinical_calendar()
    {
        if (Auth::user()->access_level == 'Facility') {
            $app_calendar_data = Appointments::join('tbl_appointment_types', 'tbl_appointment_types.id', '=', 'tbl_appointment.app_type_1')
            ->join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select('tbl_appointment.appntmnt_date as start', DB::raw('COUNT(tbl_appointment_types.id) AS title'), 'tbl_appointment.appntmnt_date as end')
            ->groupBy('tbl_appointment.appntmnt_date')
            ->where('tbl_appointment_types.name' , '=', 'Clinical Review')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->get();
            return response()->json($app_calendar_data);
        }
    }

    public function adherence_calendar()
    {
        if (Auth::user()->access_level == 'Facility') {
            $app_calendar_data = Appointments::join('tbl_appointment_types', 'tbl_appointment_types.id', '=', 'tbl_appointment.app_type_1')
            ->join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select('tbl_appointment.appntmnt_date as start', DB::raw('COUNT(tbl_appointment_types.id) AS title'), 'tbl_appointment.appntmnt_date as end')
            ->groupBy('tbl_appointment.appntmnt_date')
            ->where('tbl_appointment_types.name' , '=', 'Enhanced Adherence')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->get();
            return response()->json($app_calendar_data);
        }
    }

    public function lab_calendar()
    {
        if (Auth::user()->access_level == 'Facility') {
            $app_calendar_data = Appointments::join('tbl_appointment_types', 'tbl_appointment_types.id', '=', 'tbl_appointment.app_type_1')
            ->join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select('tbl_appointment.appntmnt_date as start', DB::raw('COUNT(tbl_appointment_types.id) AS title'), 'tbl_appointment.appntmnt_date as end')
            ->groupBy('tbl_appointment.appntmnt_date')
            ->where('tbl_appointment_types.name' , '=', 'Lab Investigation')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->get();
            return response()->json($app_calendar_data);
        }
    }

}
