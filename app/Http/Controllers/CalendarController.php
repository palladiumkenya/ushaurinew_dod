<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointments;
use App\Models\AppointmentType;
use Calendar;
use Auth;

class CalendarController extends Controller
{
    public function app_calendar()
    {
        $data                = [];
        if (Auth::user()->access_level == 'Facility') {
        $app_calendar_data = Appointments::join('tbl_appointment_types', 'tbl_appointment_types.id', '=', 'tbl_appointment.app_type_1')
        ->join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select('tbl_appointment.appntmnt_date as app_date', 'tbl_appointment_types.name as app_type')
        ->where('tbl_client.mfl_code', Auth::user()->facility_id);

        $data["app_calendar_data"]        = $app_calendar_data->groupBy('tbl_appointment_types.name');

        }
       // dd($app_calendar_data);


        return view('appointments.appointment_calender', compact('data', 'app_calendar_data'));
    }

}
