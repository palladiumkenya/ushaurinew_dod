<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointments;
use App\Models\AppointmentType;
use Calendar;

class CalendarController extends Controller
{
    public function app_calendar()
    {
        
        return view('appointments.appointment_calender');
    }

}
