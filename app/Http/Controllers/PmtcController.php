<?php

namespace App\Http\Controllers;

ini_set('max_execution_time', 0);
ini_set('memory_limit', '1024M');

use Illuminate\Http\Request;
use\App\Models\Pmtct;
use\App\Models\Client;
use\App\Models\Appointments;
use Carbon\Carbon;
use Auth;

class PmtcController extends Controller
{

    public function get_pmtct_honored_appointment()
    {
        $all_honored_appointment_clients = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
       //->innerJoin('tbl_appointment_types')->ON('tbl_appointment_types.id', '=', 'tbl_appointment.app_type_1')
        ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_appointment.appntmnt_date')
        ->where('appointment_kept', '=', 'Yes');

        return view('pmtct/kept_appointments')->with('all_honored_appointment_clients', $all_honored_appointment_clients->get());
    }

    Public function pmtct_appointment_dairy()
    {
        if (Auth::user()->access_level == 'Admin') {
        $all_booked_pmtct_clients = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_appointment.appntmnt_date')
       ->where('tbl_appointment.app_status', '=', 'Booked')
       ->whereNull('tbl_client.hei_no')
       ->where('tbl_appointment.appntmnt_date', '>=', Now())
       ->get();

       $all_schedule_appointment_clients = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_appointment.appntmnt_date')
        ->where('tbl_appointment.visit_type', '=', 'Scheduled')
        ->whereNull('tbl_client.hei_no')
        ->get();

        $all_unschedule_appointment_clients = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_appointment.appntmnt_date')
        ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
        ->whereNull('tbl_client.hei_no')
        ->get();
        }

        if (Auth::user()->access_level == 'Facility') {
            $all_booked_pmtct_clients = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_appointment.appntmnt_date')
           ->where('tbl_appointment.app_status', '=', 'Booked')
           ->whereNull('tbl_client.hei_no')
           ->where('tbl_appointment.appntmnt_date', '>=', Now())
           ->where('tbl_client.mfl_code', Auth::user()->facility_id)
           ->get();

           $all_schedule_appointment_clients = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_appointment.appntmnt_date')
            ->where('tbl_appointment.visit_type', '=', 'Scheduled')
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->get();

            $all_unschedule_appointment_clients = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_appointment.appntmnt_date')
            ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
           // ->whereNull('tbl_client.hei_no')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->get();
            }

            if (Auth::user()->access_level == 'Partner') {
                $all_booked_pmtct_clients = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_appointment.appntmnt_date')
               ->where('tbl_appointment.app_status', '=', 'Booked')
               ->where('tbl_appointment.appntmnt_date', '>=', Now())
               ->where('tbl_client.partner_id', Auth::user()->partner_id)
               ->get();

               $all_schedule_appointment_clients = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_appointment.appntmnt_date')
                ->where('tbl_appointment.visit_type', '=', 'Scheduled')
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->get();

                $all_unschedule_appointment_clients = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_appointment.appntmnt_date')
                ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->get();
                }

        return view('pmtct/pmtct_appointment_dairy', compact('all_booked_pmtct_clients', 'all_schedule_appointment_clients', 'all_unschedule_appointment_clients'));
    }

    public function pmtct_defaulter_dairy()
    {
        if (Auth::user()->access_level == 'Admin') {
        $all_missed_appointment_clients = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_appointment.appntmnt_date')
        ->where('app_status', '=', 'Missed')
        ->get();

        $all_defaulted_appointment_clients = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_appointment.appntmnt_date')
        ->where('app_status', '=', 'Defaulted')
        ->get();

        $all_ltfu_pmtct_clients = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_appointment.appntmnt_date')
        ->where('app_status', '=', 'LTFU')
        ->get();
        }

        if (Auth::user()->access_level == 'Facility') {
            $all_missed_appointment_clients = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_appointment.appntmnt_date')
            ->where('app_status', '=', 'Missed')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->get();

            $all_defaulted_appointment_clients = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_appointment.appntmnt_date')
            ->where('app_status', '=', 'Defaulted')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->get();

            $all_ltfu_pmtct_clients = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_appointment.appntmnt_date')
            ->where('app_status', '=', 'LTFU')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->get();
        }

        if (Auth::user()->access_level == 'Partner') {
            $all_missed_appointment_clients = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_appointment.appntmnt_date')
            ->where('app_status', '=', 'Missed')
            ->where('tbl_client.partner_id', Auth::user()->partner_id)
            ->get();

            $all_defaulted_appointment_clients = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_appointment.appntmnt_date')
            ->where('app_status', '=', 'Defaulted')
            ->where('tbl_client.partner_id', Auth::user()->partner_id)
            ->get();

            $all_ltfu_pmtct_clients = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_appointment.appntmnt_date')
            ->where('app_status', '=', 'LTFU')
            ->where('tbl_client.partner_id', Auth::user()->partner_id)
            ->get();
        }

        return view('pmtct/pmtct_defaulter_dairy', compact('all_missed_appointment_clients', 'all_defaulted_appointment_clients', 'all_ltfu_pmtct_clients'));
    }

    public function get_all_hei()
    {
        if (Auth::user()->access_level == 'Admin') {
        $all_hei = Client::select('clinic_number', 'f_name', 'm_name', 'l_name', 'dob', 'client_status', 'phone_no', 'enrollment_date', 'art_date', 'hei_no')
        ->whereNotNull('hei_no')->get();
        }

        if (Auth::user()->access_level == 'Facility') {
            $all_hei = Client::select('clinic_number', 'f_name', 'm_name', 'l_name', 'dob', 'client_status', 'phone_no', 'enrollment_date', 'art_date', 'hei_no')
            ->where('mfl_code', Auth::user()->facility_id)
            ->whereNotNull('hei_no')->get();
        }

        if (Auth::user()->access_level == 'Partner') {
            $all_hei = Client::select('clinic_number', 'f_name', 'm_name', 'l_name', 'dob', 'client_status', 'phone_no', 'enrollment_date', 'art_date', 'hei_no')
            ->where('partner_id', Auth::user()->partner_id)
            ->whereNotNull('hei_no')->get();
        }

        return view('pmtct/all_heis', compact('all_hei'));
    }
    public function hei_appointment_dairy()
    {

        if (Auth::user()->access_level == 'Admin') {
            $all_booked_heis = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_client.hei_no, tbl_client.phone_no, tbl_appointment.appntmnt_date, tbl_appointment.app_type_1')
            ->where('tbl_appointment.app_status', '=', 'Booked')
            ->where('tbl_appointment.active_app', '=', 1)
            ->whereNotNull('tbl_client.hei_no')
            ->get();;

            $all_scheduled_heis = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_client.hei_no, tbl_client.phone_no, tbl_appointment.appntmnt_date, tbl_appointment.app_type_1, tbl_appointment.visit_type')
            ->where('tbl_appointment.visit_type', '=', 'Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->whereNotNull('tbl_client.hei_no')
            ->get();

            $all_unscheduled_heis = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_client.hei_no, tbl_client.phone_no, tbl_appointment.appntmnt_date, tbl_appointment.app_type_1, tbl_appointment.visit_type')
            ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->whereNotNull('tbl_client.hei_no')
            ->get();

            }

        if (Auth::user()->access_level == 'Facility') {
        $all_booked_heis = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_client.hei_no, tbl_client.phone_no, tbl_appointment.appntmnt_date, tbl_appointment.app_type_1')
        ->where('tbl_appointment.app_status', '=', 'Booked')
        ->where('tbl_appointment.active_app', '=', 1)
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->whereNotNull('tbl_client.hei_no')
        ->get();;

        $all_scheduled_heis = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_client.hei_no, tbl_client.phone_no, tbl_appointment.appntmnt_date, tbl_appointment.app_type_1, tbl_appointment.visit_type')
        ->where('tbl_appointment.visit_type', '=', 'Scheduled')
        ->where('tbl_appointment.appntmnt_date', '<', Now())
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->whereNotNull('tbl_client.hei_no')
        ->get();

        $all_unscheduled_heis = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_client.hei_no, tbl_client.phone_no, tbl_appointment.appntmnt_date, tbl_appointment.app_type_1, tbl_appointment.visit_type')
        ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
        ->where('tbl_appointment.appntmnt_date', '<', Now())
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->whereNotNull('tbl_client.hei_no')
        ->get();

        }

        if (Auth::user()->access_level == 'Partner') {
            $all_booked_heis = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_client.hei_no, tbl_client.phone_no, tbl_appointment.appntmnt_date, tbl_appointment.app_type_1')
            ->where('tbl_appointment.app_status', '=', 'Booked')
            ->where('tbl_appointment.active_app', '=', 1)
            ->where('tbl_client.partner_id', Auth::user()->partner_id)
            ->whereNotNull('tbl_client.hei_no')
            ->get();;

            $all_scheduled_heis = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_client.hei_no, tbl_client.phone_no, tbl_appointment.appntmnt_date, tbl_appointment.app_type_1, tbl_appointment.visit_type')
            ->where('tbl_appointment.visit_type', '=', 'Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->where('tbl_client.partner_id', Auth::user()->partner_id)
            ->whereNotNull('tbl_client.hei_no')
            ->get();

            $all_unscheduled_heis = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_client.hei_no, tbl_client.phone_no, tbl_appointment.appntmnt_date, tbl_appointment.app_type_1, tbl_appointment.visit_type')
            ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->where('tbl_client.partner_id', Auth::user()->partner_id)
            ->whereNotNull('tbl_client.hei_no')
            ->get();

            }

        return view('pmtct/hei_appointment_dairy', compact('all_unscheduled_heis', 'all_booked_heis', 'all_scheduled_heis'));

    }

    public function hei_defaulter_dairy()
    {

      if (Auth::user()->access_level == 'Admin') {
        $all_missed_heis = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_client.hei_no, tbl_client.phone_no, tbl_appointment.appntmnt_date, tbl_appointment.app_type_1, tbl_appointment.app_status')
        ->where('tbl_appointment.app_status', '=', 'Missed')
        ->whereNotNull('tbl_client.hei_no')
        ->get();

        $all_defaulted_heis = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_client.hei_no, tbl_client.phone_no, tbl_appointment.appntmnt_date, tbl_appointment.app_type_1, tbl_appointment.app_status')
        ->where('tbl_appointment.app_status', '=', 'Defaulted')
        ->whereNotNull('tbl_client.hei_no')
        ->get();

        $all_ltfu_heis = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_client.hei_no, tbl_client.phone_no, tbl_appointment.appntmnt_date, tbl_appointment.app_type_1, tbl_appointment.app_status')
        ->where('tbl_appointment.app_status', '=', 'LTFU')
        ->whereNotNull('tbl_client.hei_no')
        ->get();
      }

      if (Auth::user()->access_level == 'Facility') {
        $all_missed_heis = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_client.hei_no, tbl_client.phone_no, tbl_appointment.appntmnt_date, tbl_appointment.app_type_1, tbl_appointment.app_status')
        ->where('tbl_appointment.app_status', '=', 'Missed')
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->whereNotNull('tbl_client.hei_no')
        ->get();

        $all_defaulted_heis = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_client.hei_no, tbl_client.phone_no, tbl_appointment.appntmnt_date, tbl_appointment.app_type_1, tbl_appointment.app_status')
        ->where('tbl_appointment.app_status', '=', 'Defaulted')
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->whereNotNull('tbl_client.hei_no')
        ->get();

        $all_ltfu_heis = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_client.hei_no, tbl_client.phone_no, tbl_appointment.appntmnt_date, tbl_appointment.app_type_1, tbl_appointment.app_status')
        ->where('tbl_appointment.app_status', '=', 'LTFU')
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->whereNotNull('tbl_client.hei_no')
        ->get();
      }

      if (Auth::user()->access_level == 'Partner') {
        $all_missed_heis = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_client.hei_no, tbl_client.phone_no, tbl_appointment.appntmnt_date, tbl_appointment.app_type_1, tbl_appointment.app_status')
        ->where('tbl_appointment.app_status', '=', 'Missed')
        ->where('tbl_client.partner_id', Auth::user()->partner_id)
        ->whereNotNull('tbl_client.hei_no')
        ->get();

        $all_defaulted_heis = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_client.hei_no, tbl_client.phone_no, tbl_appointment.appntmnt_date, tbl_appointment.app_type_1, tbl_appointment.app_status')
        ->where('tbl_appointment.app_status', '=', 'Defaulted')
        ->where('tbl_client.partner_id', Auth::user()->partner_id)
        ->whereNotNull('tbl_client.hei_no')
        ->get();

        $all_ltfu_heis = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_client.hei_no, tbl_client.phone_no, tbl_appointment.appntmnt_date, tbl_appointment.app_type_1, tbl_appointment.app_status')
        ->where('tbl_appointment.app_status', '=', 'LTFU')
        ->where('tbl_client.partner_id', Auth::user()->partner_id)
        ->whereNotNull('tbl_client.hei_no')
        ->get();
      }

        return view('pmtct/hei_defaulter_dairy', compact('all_missed_heis', 'all_defaulted_heis', 'all_ltfu_heis'));
    }

    public function hei_final_outcome()
    {
        if (Auth::user()->access_level == 'Admin') {
        $all_deceased_heis = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_client.hei_no, tbl_client.phone_no, tbl_appointment.appntmnt_date, tbl_appointment.app_type_1, tbl_appointment.app_status')
        ->where('tbl_client.status', '=', 'Deceased')
        ->whereNotNull('tbl_client.hei_no')
        ->get();

        $all_transfer_heis = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_client.hei_no, tbl_client.phone_no, tbl_appointment.appntmnt_date, tbl_appointment.app_type_1, tbl_appointment.app_status')
        ->where('tbl_client.status', '=', 'Transfer Out')
        ->whereNotNull('tbl_client.hei_no')
        ->get();

        $all_discharged_heis = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_client.hei_no, tbl_client.phone_no, tbl_appointment.appntmnt_date, tbl_appointment.app_type_1, tbl_appointment.app_status')
        ->where('tbl_client.status', '=', 'Discharged')
        ->whereNotNull('tbl_client.hei_no')
        ->get();

        }

        if (Auth::user()->access_level == 'Facility') {
            $all_deceased_heis = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_client.hei_no, tbl_client.phone_no, tbl_appointment.appntmnt_date, tbl_appointment.app_type_1, tbl_appointment.app_status')
            ->where('tbl_client.status', '=', 'Deceased')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->whereNotNull('tbl_client.hei_no')
            ->get();

            $all_transfer_heis = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_client.hei_no, tbl_client.phone_no, tbl_appointment.appntmnt_date, tbl_appointment.app_type_1, tbl_appointment.app_status')
            ->where('tbl_client.status', '=', 'Transfer Out')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->whereNotNull('tbl_client.hei_no')
            ->get();

            $all_discharged_heis = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_client.hei_no, tbl_client.phone_no, tbl_appointment.appntmnt_date, tbl_appointment.app_type_1, tbl_appointment.app_status')
            ->where('tbl_client.status', '=', 'Discharged')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->whereNotNull('tbl_client.hei_no')
            ->get();

        }

        if (Auth::user()->access_level == 'Partner') {
            $all_deceased_heis = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_client.hei_no, tbl_client.phone_no, tbl_appointment.appntmnt_date, tbl_appointment.app_type_1, tbl_appointment.app_status')
            ->where('tbl_client.status', '=', 'Deceased')
            ->where('tbl_client.partner_id', Auth::user()->partner_id)
            ->whereNotNull('tbl_client.hei_no')
            ->get();

            $all_transfer_heis = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_client.hei_no, tbl_client.phone_no, tbl_appointment.appntmnt_date, tbl_appointment.app_type_1, tbl_appointment.app_status')
            ->where('tbl_client.status', '=', 'Transfer Out')
            ->where('tbl_client.partner_id', Auth::user()->partner_id)
            ->whereNotNull('tbl_client.hei_no')
            ->get();

            $all_discharged_heis = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_client.hei_no, tbl_client.phone_no, tbl_appointment.appntmnt_date, tbl_appointment.app_type_1, tbl_appointment.app_status')
            ->where('tbl_client.status', '=', 'Discharged')
            ->where('tbl_client.partner_id', Auth::user()->partner_id)
            ->whereNotNull('tbl_client.hei_no')
            ->get();

        }

        return view('pmtct/hei_final_outcome', compact('all_deceased_heis', 'all_transfer_heis', 'all_discharged_heis'));
    }


    public function pmtct_dashboard()
    {

        if (Auth::user()->access_level == 'Facility') {
        $ranges = [

            'ToNine' => 0,
            'ToFourteen' => 10,
            'ToNineteen' => 15,
            'ToTwentyFour' => 20,
            'ToTwentyNine' => 25,
            'ToThirtyFour' => 30,
            'ToThirtyNine' => 35,
            'ToFortyFour' => 40,
            'ToFortyNine' => 45,
            'FiftyPlus' => 50
        ];

        $startdate = Appointments::select('appntmnt_date')->orderBy('appntmnt_date', 'asc')->first();
        $startdate = Carbon::parse($startdate->appntmnt_date)->format('Y-m-d');
        $enddate  = Appointments::select('appntmnt_date')->orderBy('appntmnt_date', 'desc')->first();
        $enddate = Carbon::parse($enddate->appntmnt_date)->format('Y-m-d');

            $tonine_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 9)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            //->where('tbl_appointment.visit_type', '=', 'Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
           // ->whereDate('tbl_appointment.appntmnt_date', '>=', $startdate)->whereDate('tbl_appointment.appntmnt_date', '<=', $enddate)
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tofourteen_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 14)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
           // ->whereDate('tbl_appointment.appntmnt_date', '>=', $startdate)->whereDate('tbl_appointment.appntmnt_date', '<=', $enddate)
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tonineteen_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 19)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
           // ->whereDate('tbl_appointment.appntmnt_date', '>=', $startdate)->whereDate('tbl_appointment.appntmnt_date', '<=', $enddate)
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $totwentyfour_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 24)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
           // ->whereDate('tbl_appointment.appntmnt_date', '>=', $startdate)->whereDate('tbl_appointment.appntmnt_date', '<=', $enddate)
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $totwentynine_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 25) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 29)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
           // ->whereDate('tbl_appointment.appntmnt_date', '>=', $startdate)->whereDate('tbl_appointment.appntmnt_date', '<=', $enddate)
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tothirtyfour_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 30) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 34)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            //->whereDate('tbl_appointment.appntmnt_date', '>=', $startdate)->whereDate('tbl_appointment.appntmnt_date', '<=', $enddate)
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tothirtynine_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 35) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 39)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
           // ->whereDate('tbl_appointment.appntmnt_date', '>=', $startdate)->whereDate('tbl_appointment.appntmnt_date', '<=', $enddate)
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tofortyfour_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 40) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 44)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
           // ->whereDate('tbl_appointment.appntmnt_date', '>=', $startdate)->whereDate('tbl_appointment.appntmnt_date', '<=', $enddate)
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tofortynine_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 45) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 49)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
           // ->whereDate('tbl_appointment.appntmnt_date', '>=', $startdate)->whereDate('tbl_appointment.appntmnt_date', '<=', $enddate)
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tofiftyplus_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 50)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            //->whereDate('tbl_appointment.appntmnt_date', '>=', $startdate)->whereDate('tbl_appointment.appntmnt_date', '<=', $enddate)
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tototal_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) >=10)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
           // ->whereDate('tbl_appointment.appntmnt_date', '>=', $startdate)->whereDate('tbl_appointment.appntmnt_date', '<=', $enddate)
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            // Un-Scheduled
            $tonine_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 9)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
           // ->whereDate('tbl_appointment.appntmnt_date', '>=', $startdate)->whereDate('tbl_appointment.appntmnt_date', '<=', $enddate)
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tofourteen_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 14)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            //->whereDate('tbl_appointment.appntmnt_date', '>=', $startdate)->whereDate('tbl_appointment.appntmnt_date', '<=', $enddate)
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tonineteen_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 19)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
           // ->whereDate('tbl_appointment.appntmnt_date', '>=', $startdate)->whereDate('tbl_appointment.appntmnt_date', '<=', $enddate)
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $totwentyfour_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 24)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            //->whereDate('tbl_appointment.appntmnt_date', '>=', $startdate)->whereDate('tbl_appointment.appntmnt_date', '<=', $enddate)
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $totwentynine_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 25) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 29)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
           // ->whereDate('tbl_appointment.appntmnt_date', '>=', $startdate)->whereDate('tbl_appointment.appntmnt_date', '<=', $enddate)
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tothirtyfour_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 30) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 34)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tothirtynine_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 35) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 39)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tofortyfour_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 40) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 44)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tofortynine_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 45) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 49)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tofifty_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 50) and ((year(curdate()) - year(`tbl_client`.`dob`)) >= 50)) then `tbl_pmtct`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tototal_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->whereNull('tbl_client.hei_no')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) >=10)) then `tbl_client`.`id` end)) AS count"))
            ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            //Booked
            $tonine_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 9)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Booked')
            ->where('tbl_appointment.appntmnt_date', '>', Now())
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tofourteen_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 14)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Booked')
            ->where('tbl_appointment.appntmnt_date', '>', Now())
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tonineteen_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 19)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Booked')
            ->where('tbl_appointment.appntmnt_date', '>', Now())
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $totwentyfour_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 24)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Booked')
            ->where('tbl_appointment.appntmnt_date', '>', Now())
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $totwentynine_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 25) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 29)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Booked')
            ->where('tbl_appointment.appntmnt_date', '>', Now())
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tothirtyfour_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 30) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 34)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Booked')
            ->where('tbl_appointment.appntmnt_date', '>', Now())
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tothirtynine_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 35) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 39)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Booked')
            ->where('tbl_appointment.appntmnt_date', '>', Now())
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tofortyfour_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 40) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 44)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Booked')
            ->where('tbl_appointment.appntmnt_date', '>', Now())
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tofortynine_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 45) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 49)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Booked')
            ->where('tbl_appointment.appntmnt_date', '>', Now())
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tofifty_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 50) and ((year(curdate()) - year(`tbl_client`.`dob`)) >= 50)) then `tbl_pmtct`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Booked')
            ->where('tbl_appointment.appntmnt_date', '>', Now())
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tototal_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->whereNull('tbl_client.hei_no')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) >=10)) then `tbl_client`.`id` end)) AS count"))
            ->where('tbl_appointment.app_status', '=', 'Booked')
            ->where('tbl_appointment.appntmnt_date', '>', Now())
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            // Defaulter

            $tonine_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 9)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Defaulted')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tofourteen_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 14)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Defaulted')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tonineteen_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 19)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Defaulted')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $totwentyfour_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 24)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Defaulted')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $totwentynine_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 25) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 29)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Defaulted')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tothirtyfour_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 30) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 34)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Defaulted')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tothirtynine_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 35) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 39)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Defaulted')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tofortyfour_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 40) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 44)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Defaulted')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tofortynine_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 45) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 49)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Defaulted')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tofifty_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 50) and ((year(curdate()) - year(`tbl_client`.`dob`)) >= 50)) then `tbl_pmtct`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Defaulted')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tototal_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->whereNull('tbl_client.hei_no')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) >=10)) then `tbl_client`.`id` end)) AS count"))
            ->where('tbl_appointment.app_status', '=', 'Defaulted')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            // Missed
            $tonine_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 9)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Missed')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tofourteen_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 14)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Missed')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tonineteen_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 19)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Missed')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $totwentyfour_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 24)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Missed')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $totwentynine_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 25) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 29)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Missed')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tothirtyfour_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 30) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 34)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Missed')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tothirtynine_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 35) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 39)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Missed')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tofortyfour_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 40) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 44)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Missed')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tofortynine_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 45) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 49)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Missed')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tofifty_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 50) and ((year(curdate()) - year(`tbl_client`.`dob`)) >= 50)) then `tbl_pmtct`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Missed')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tototal_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->whereNull('tbl_client.hei_no')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) >=10)) then `tbl_client`.`id` end)) AS count"))
            ->where('tbl_appointment.app_status', '=', 'Missed')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            // LTFU
            $tonine_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 9)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'LTFU')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tofourteen_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 14)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'LTFU')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tonineteen_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 19)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'LTFU')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $totwentyfour_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 24)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'LTFU')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $totwentynine_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 25) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 29)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'LTFU')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tothirtyfour_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 30) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 34)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'LTFU')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tothirtynine_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 35) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 39)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'LTFU')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tofortyfour_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 40) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 44)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'LTFU')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tofortynine_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 45) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 49)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'LTFU')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tofifty_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 50) and ((year(curdate()) - year(`tbl_client`.`dob`)) >= 50)) then `tbl_pmtct`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'LTFU')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tototal_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->whereNull('tbl_client.hei_no')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) >=10)) then `tbl_client`.`id` end)) AS count"))
            ->where('tbl_appointment.app_status', '=', 'LTFU')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            // honoured appointments
            $tonine_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 9)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appointment_kept', '=', 'Yes')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tofourteen_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 14)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appointment_kept', '=', 'Yes')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tonineteen_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 19)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appointment_kept', '=', 'Yes')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $totwentyfour_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 24)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appointment_kept', '=', 'Yes')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $totwentynine_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 25) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 29)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appointment_kept', '=', 'Yes')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tothirtyfour_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 30) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 34)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appointment_kept', '=', 'Yes')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tothirtynine_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 35) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 39)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appointment_kept', '=', 'Yes')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tofortyfour_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 40) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 44)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appointment_kept', '=', 'Yes')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tofortynine_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 45) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 49)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appointment_kept', '=', 'Yes')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tofifty_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 50) and ((year(curdate()) - year(`tbl_client`.`dob`)) >= 50)) then `tbl_pmtct`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appointment_kept', '=', 'Yes')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tototal_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->whereNull('tbl_client.hei_no')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) >=10)) then `tbl_client`.`id` end)) AS count"))
            ->where('tbl_appointment.appointment_kept', '=', 'Yes')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');
        }

        // partner level

        if (Auth::user()->access_level == 'Partner') {


                $tonine_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                 ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 9)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
               // ->where('tbl_appointment.visit_type', '=', 'Scheduled')
                ->where('tbl_appointment.appntmnt_date', '<', Now())
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tofourteen_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                 ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 14)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.appntmnt_date', '<', Now())
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tonineteen_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                 ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 19)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.appntmnt_date', '<', Now())
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $totwentyfour_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                 ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 24)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.appntmnt_date', '<', Now())
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $totwentynine_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 25) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 29)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.appntmnt_date', '<', Now())
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tothirtyfour_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 30) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 34)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.appntmnt_date', '<', Now())
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tothirtynine_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 35) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 39)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.appntmnt_date', '<', Now())
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tofortyfour_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 40) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 44)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.appntmnt_date', '<', Now())
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tofortynine_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 45) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 49)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.appntmnt_date', '<', Now())
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tofiftyplus_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 50)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.appntmnt_date', '<', Now())
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tototal_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) >=10)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.appntmnt_date', '<', Now())
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                // Un-Scheduled
                $tonine_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                 ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 9)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
                ->where('tbl_appointment.appntmnt_date', '<', Now())
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tofourteen_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                 ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 14)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
                ->where('tbl_appointment.appntmnt_date', '<', Now())
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tonineteen_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                 ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 19)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
                ->where('tbl_appointment.appntmnt_date', '<', Now())
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $totwentyfour_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                 ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 24)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
                ->where('tbl_appointment.appntmnt_date', '<', Now())
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $totwentynine_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 25) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 29)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
                ->where('tbl_appointment.appntmnt_date', '<', Now())
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tothirtyfour_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 30) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 34)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
                ->where('tbl_appointment.appntmnt_date', '<', Now())
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tothirtynine_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 35) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 39)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
                ->where('tbl_appointment.appntmnt_date', '<', Now())
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tofortyfour_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 40) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 44)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
                ->where('tbl_appointment.appntmnt_date', '<', Now())
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tofortynine_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 45) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 49)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
                ->where('tbl_appointment.appntmnt_date', '<', Now())
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tofifty_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 50) and ((year(curdate()) - year(`tbl_client`.`dob`)) >= 50)) then `tbl_pmtct`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
                ->where('tbl_appointment.appntmnt_date', '<', Now())
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tototal_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->whereNull('tbl_client.hei_no')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) >=10)) then `tbl_client`.`id` end)) AS count"))
                ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
                ->where('tbl_appointment.appntmnt_date', '<', Now())
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                //Booked
                $tonine_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                 ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 9)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Booked')
                ->where('tbl_appointment.appntmnt_date', '>', Now())
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tofourteen_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 14)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Booked')
                ->where('tbl_appointment.appntmnt_date', '>', Now())
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tonineteen_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                 ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 19)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Booked')
                ->where('tbl_appointment.appntmnt_date', '>', Now())
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $totwentyfour_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                 ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 24)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Booked')
                ->where('tbl_appointment.appntmnt_date', '>', Now())
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $totwentynine_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 25) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 29)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Booked')
                ->where('tbl_appointment.appntmnt_date', '>', Now())
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tothirtyfour_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 30) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 34)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Booked')
                ->where('tbl_appointment.appntmnt_date', '>', Now())
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tothirtynine_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 35) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 39)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Booked')
                ->where('tbl_appointment.appntmnt_date', '>', Now())
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tofortyfour_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 40) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 44)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Booked')
                ->where('tbl_appointment.appntmnt_date', '>', Now())
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tofortynine_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 45) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 49)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Booked')
                ->where('tbl_appointment.appntmnt_date', '>', Now())
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tofifty_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 50) and ((year(curdate()) - year(`tbl_client`.`dob`)) >= 50)) then `tbl_pmtct`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Booked')
                ->where('tbl_appointment.appntmnt_date', '>', Now())
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tototal_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->whereNull('tbl_client.hei_no')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) >=10)) then `tbl_client`.`id` end)) AS count"))
                ->where('tbl_appointment.app_status', '=', 'Booked')
                ->where('tbl_appointment.appntmnt_date', '>', Now())
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                // Defaulter

                $tonine_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                 ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 9)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Defaulted')
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tofourteen_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 14)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Defaulted')
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tonineteen_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                 ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 19)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Defaulted')
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $totwentyfour_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                 ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 24)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Defaulted')
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $totwentynine_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 25) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 29)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Defaulted')
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tothirtyfour_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 30) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 34)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Defaulted')
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tothirtynine_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 35) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 39)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Defaulted')
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tofortyfour_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 40) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 44)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Defaulted')
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tofortynine_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 45) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 49)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Defaulted')
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tofifty_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 50) and ((year(curdate()) - year(`tbl_client`.`dob`)) >= 50)) then `tbl_pmtct`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Defaulted')
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tototal_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->whereNull('tbl_client.hei_no')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) >=10)) then `tbl_client`.`id` end)) AS count"))
                ->where('tbl_appointment.app_status', '=', 'Defaulted')
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                // Missed
                $tonine_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                 ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 9)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Missed')
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tofourteen_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 14)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Missed')
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tonineteen_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                 ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 19)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Missed')
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $totwentyfour_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                 ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 24)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Missed')
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $totwentynine_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 25) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 29)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Missed')
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tothirtyfour_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 30) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 34)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Missed')
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tothirtynine_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 35) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 39)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Missed')
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tofortyfour_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 40) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 44)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Missed')
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tofortynine_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 45) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 49)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Missed')
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tofifty_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 50) and ((year(curdate()) - year(`tbl_client`.`dob`)) >= 50)) then `tbl_pmtct`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Missed')
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tototal_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->whereNull('tbl_client.hei_no')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) >=10)) then `tbl_client`.`id` end)) AS count"))
                ->where('tbl_appointment.app_status', '=', 'Missed')
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                // LTFU
                $tonine_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                 ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 9)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'LTFU')
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tofourteen_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 14)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'LTFU')
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tonineteen_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                 ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 19)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'LTFU')
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $totwentyfour_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                 ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 24)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'LTFU')
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $totwentynine_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 25) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 29)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'LTFU')
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tothirtyfour_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 30) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 34)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'LTFU')
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tothirtynine_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 35) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 39)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'LTFU')
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tofortyfour_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 40) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 44)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'LTFU')
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tofortynine_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 45) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 49)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'LTFU')
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tofifty_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 50) and ((year(curdate()) - year(`tbl_client`.`dob`)) >= 50)) then `tbl_pmtct`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'LTFU')
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tototal_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->whereNull('tbl_client.hei_no')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) >=10)) then `tbl_client`.`id` end)) AS count"))
                ->where('tbl_appointment.app_status', '=', 'LTFU')
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                // honoured appointments
                $tonine_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                 ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 9)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.appointment_kept', '=', 'Yes')
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tofourteen_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 14)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.appointment_kept', '=', 'Yes')
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tonineteen_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                 ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 19)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.appointment_kept', '=', 'Yes')
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $totwentyfour_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                 ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 24)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.appointment_kept', '=', 'Yes')
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $totwentynine_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 25) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 29)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.appointment_kept', '=', 'Yes')
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tothirtyfour_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 30) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 34)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.appointment_kept', '=', 'Yes')
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tothirtynine_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 35) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 39)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.appointment_kept', '=', 'Yes')
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tofortyfour_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 40) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 44)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.appointment_kept', '=', 'Yes')
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tofortynine_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 45) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 49)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.appointment_kept', '=', 'Yes')
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tofifty_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 50) and ((year(curdate()) - year(`tbl_client`.`dob`)) >= 50)) then `tbl_pmtct`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.appointment_kept', '=', 'Yes')
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tototal_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->whereNull('tbl_client.hei_no')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) >=10)) then `tbl_client`.`id` end)) AS count"))
                ->where('tbl_appointment.appointment_kept', '=', 'Yes')
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');
            }

            // Administrator

        if (Auth::user()->access_level == 'Admin') {


            $tonine_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 9)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
           // ->where('tbl_appointment.visit_type', '=', 'Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->pluck('count');

            $tofourteen_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 14)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
           // ->where('tbl_appointment.visit_type', '=', 'Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->pluck('count');

            $tonineteen_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 19)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            //->where('tbl_appointment.visit_type', '=', 'Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->pluck('count');

            $totwentyfour_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 24)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            //->where('tbl_appointment.visit_type', '=', 'Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->pluck('count');

            $totwentynine_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 25) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 29)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
          //  ->where('tbl_appointment.visit_type', '=', 'Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->pluck('count');

            $tothirtyfour_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 30) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 34)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
           // ->where('tbl_appointment.visit_type', '=', 'Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->pluck('count');

            $tothirtynine_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 35) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 39)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            //->where('tbl_appointment.visit_type', '=', 'Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->pluck('count');

            $tofortyfour_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 40) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 44)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
           // ->where('tbl_appointment.visit_type', '=', 'Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->pluck('count');

            $tofortynine_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 45) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 49)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
           // ->where('tbl_appointment.visit_type', '=', 'Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->pluck('count');

            $tofiftyplus_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 50)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            //->where('tbl_appointment.visit_type', '=', 'Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->pluck('count');

            $tototal_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) >=10)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
           // ->where('tbl_appointment.visit_type', '=', 'Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->pluck('count');

            // Un-Scheduled
            $tonine_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 9)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->pluck('count');

            $tofourteen_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 14)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->pluck('count');

            $tonineteen_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 19)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->pluck('count');

            $totwentyfour_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 24)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->pluck('count');

            $totwentynine_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 25) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 29)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->pluck('count');

            $tothirtyfour_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 30) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 34)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->pluck('count');

            $tothirtynine_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 35) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 39)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->pluck('count');

            $tofortyfour_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 40) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 44)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->pluck('count');

            $tofortynine_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 45) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 49)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->pluck('count');

            $tofifty_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 50) and ((year(curdate()) - year(`tbl_client`.`dob`)) >= 50)) then `tbl_pmtct`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->pluck('count');

            $tototal_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->whereNull('tbl_client.hei_no')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) >=10)) then `tbl_client`.`id` end)) AS count"))
            ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->pluck('count');

            //Booked
            $tonine_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 9)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Booked')
            ->where('tbl_appointment.appntmnt_date', '>', Now())
            ->pluck('count');

            $tofourteen_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 14)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Booked')
            ->where('tbl_appointment.appntmnt_date', '>', Now())
            ->pluck('count');

            $tonineteen_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 19)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Booked')
            ->where('tbl_appointment.appntmnt_date', '>', Now())
            ->pluck('count');

            $totwentyfour_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 24)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Booked')
            ->where('tbl_appointment.appntmnt_date', '>', Now())
            ->pluck('count');

            $totwentynine_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 25) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 29)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Booked')
            ->where('tbl_appointment.appntmnt_date', '>', Now())
            ->pluck('count');

            $tothirtyfour_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 30) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 34)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Booked')
            ->where('tbl_appointment.appntmnt_date', '>', Now())
            ->pluck('count');

            $tothirtynine_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 35) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 39)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Booked')
            ->where('tbl_appointment.appntmnt_date', '>', Now())
            ->pluck('count');

            $tofortyfour_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 40) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 44)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Booked')
            ->where('tbl_appointment.appntmnt_date', '>', Now())
            ->pluck('count');

            $tofortynine_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 45) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 49)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Booked')
            ->where('tbl_appointment.appntmnt_date', '>', Now())
            ->pluck('count');

            $tofifty_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 50) and ((year(curdate()) - year(`tbl_client`.`dob`)) >= 50)) then `tbl_pmtct`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Booked')
            ->where('tbl_appointment.appntmnt_date', '>', Now())
            ->pluck('count');

            $tototal_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->whereNull('tbl_client.hei_no')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) >=10)) then `tbl_client`.`id` end)) AS count"))
            ->where('tbl_appointment.app_status', '=', 'Booked')
            ->where('tbl_appointment.appntmnt_date', '>', Now())
            ->pluck('count');

            // Defaulter

            $tonine_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 9)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Defaulted')
            ->pluck('count');

            $tofourteen_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 14)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Defaulted')
            ->pluck('count');

            $tonineteen_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 19)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Defaulted')
            ->pluck('count');

            $totwentyfour_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 24)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Defaulted')
            ->pluck('count');

            $totwentynine_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 25) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 29)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Defaulted')
            ->pluck('count');

            $tothirtyfour_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 30) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 34)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Defaulted')
            ->pluck('count');

            $tothirtynine_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 35) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 39)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Defaulted')
            ->pluck('count');

            $tofortyfour_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 40) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 44)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Defaulted')
            ->pluck('count');

            $tofortynine_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 45) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 49)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Defaulted')
            ->pluck('count');

            $tofifty_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 50) and ((year(curdate()) - year(`tbl_client`.`dob`)) >= 50)) then `tbl_pmtct`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Defaulted')
            ->pluck('count');

            $tototal_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->whereNull('tbl_client.hei_no')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) >=10)) then `tbl_client`.`id` end)) AS count"))
            ->where('tbl_appointment.app_status', '=', 'Defaulted')
            ->pluck('count');

            // Missed
            $tonine_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 9)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Missed')
            ->pluck('count');

            $tofourteen_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 14)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Missed')
            ->pluck('count');

            $tonineteen_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 19)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Missed')
            ->pluck('count');

            $totwentyfour_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 24)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Missed')
            ->pluck('count');

            $totwentynine_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 25) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 29)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Missed')
            ->pluck('count');

            $tothirtyfour_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 30) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 34)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Missed')
            ->pluck('count');

            $tothirtynine_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 35) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 39)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Missed')
            ->pluck('count');

            $tofortyfour_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 40) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 44)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Missed')
            ->pluck('count');

            $tofortynine_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 45) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 49)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Missed')
            ->pluck('count');

            $tofifty_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 50) and ((year(curdate()) - year(`tbl_client`.`dob`)) >= 50)) then `tbl_pmtct`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Missed')
            ->pluck('count');

            $tototal_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->whereNull('tbl_client.hei_no')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) >=10)) then `tbl_client`.`id` end)) AS count"))
            ->where('tbl_appointment.app_status', '=', 'Missed')
            ->pluck('count');

            // LTFU
            $tonine_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 9)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'LTFU')
            ->pluck('count');

            $tofourteen_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 14)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'LTFU')
            ->pluck('count');

            $tonineteen_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 19)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'LTFU')
            ->pluck('count');

            $totwentyfour_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 24)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'LTFU')
            ->pluck('count');

            $totwentynine_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 25) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 29)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'LTFU')
            ->pluck('count');

            $tothirtyfour_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 30) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 34)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'LTFU')
            ->pluck('count');

            $tothirtynine_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 35) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 39)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'LTFU')
            ->pluck('count');

            $tofortyfour_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 40) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 44)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'LTFU')
            ->pluck('count');

            $tofortynine_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 45) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 49)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'LTFU')
            ->pluck('count');

            $tofifty_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 50) and ((year(curdate()) - year(`tbl_client`.`dob`)) >= 50)) then `tbl_pmtct`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'LTFU')
            ->pluck('count');

            $tototal_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->whereNull('tbl_client.hei_no')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) >=10)) then `tbl_client`.`id` end)) AS count"))
            ->where('tbl_appointment.app_status', '=', 'LTFU')
            ->pluck('count');

            // honoured appointments
            $tonine_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 9)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appointment_kept', '=', 'Yes')
            ->pluck('count');

            $tofourteen_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 14)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appointment_kept', '=', 'Yes')
            ->pluck('count');

            $tonineteen_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 19)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appointment_kept', '=', 'Yes')
            ->pluck('count');

            $totwentyfour_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 24)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appointment_kept', '=', 'Yes')
            ->pluck('count');

            $totwentynine_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 25) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 29)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appointment_kept', '=', 'Yes')
            ->pluck('count');

            $tothirtyfour_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 30) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 34)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appointment_kept', '=', 'Yes')
            ->pluck('count');

            $tothirtynine_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 35) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 39)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appointment_kept', '=', 'Yes')
            ->pluck('count');

            $tofortyfour_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 40) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 44)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appointment_kept', '=', 'Yes')
            ->pluck('count');

            $tofortynine_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 45) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 49)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appointment_kept', '=', 'Yes')
            ->pluck('count');

            $tofifty_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 50) and ((year(curdate()) - year(`tbl_client`.`dob`)) >= 50)) then `tbl_pmtct`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appointment_kept', '=', 'Yes')
            ->pluck('count');

            $tototal_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->whereNull('tbl_client.hei_no')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) >=10)) then `tbl_client`.`id` end)) AS count"))
            ->where('tbl_appointment.appointment_kept', '=', 'Yes')
            ->pluck('count');
        }

        return view('pmtct/pmtct_dashboard', compact('tonine_scheduled', 'tofourteen_scheduled', 'tonineteen_scheduled', 'totwentyfour_scheduled',
    'totwentynine_scheduled', 'tothirtyfour_scheduled', 'tothirtynine_scheduled', 'tofortyfour_scheduled', 'tofortynine_scheduled', 'tofiftyplus_scheduled', 'tototal_scheduled',
    'tonine_unscheduled', 'tofourteen_unscheduled', 'tonineteen_unscheduled', 'totwentyfour_unscheduled', 'totwentynine_unscheduled', 'tothirtyfour_unscheduled', 'tothirtynine_unscheduled',
    'tofortyfour_unscheduled', 'tofortynine_unscheduled', 'tofifty_unscheduled', 'tototal_unscheduled', 'tonine_booked', 'tofourteen_booked', 'tonineteen_booked', 'totwentyfour_booked',
    'totwentynine_booked', 'tothirtyfour_booked', 'tothirtynine_booked', 'tofortyfour_booked', 'tofortynine_booked', 'tofifty_booked', 'tototal_booked',
    'tonine_defaulted', 'tofourteen_defaulted', 'tonineteen_defaulted', 'totwentyfour_defaulted',
    'totwentynine_defaulted', 'tothirtyfour_defaulted', 'tothirtynine_defaulted', 'tofortyfour_defaulted', 'tofortynine_defaulted', 'tofifty_defaulted', 'tototal_defaulted',
    'tonine_missed', 'tofourteen_missed', 'tonineteen_missed', 'totwentyfour_missed',
    'totwentynine_missed', 'tothirtyfour_missed', 'tothirtynine_missed', 'tofortyfour_missed', 'tofortynine_missed', 'tofifty_missed', 'tototal_missed',
    'tonine_ltfu', 'tofourteen_ltfu', 'tonineteen_ltfu', 'totwentyfour_ltfu',
    'totwentynine_ltfu', 'tothirtyfour_ltfu', 'tothirtynine_ltfu', 'tofortyfour_ltfu', 'tofortynine_ltfu', 'tofifty_ltfu', 'tototal_ltfu',
    'tonine_honoured', 'tofourteen_honoured', 'tonineteen_honoured', 'totwentyfour_honoured',
    'totwentynine_honoured', 'tothirtyfour_honoured', 'tothirtynine_honoured', 'tofortyfour_honoured', 'tofortynine_honoured', 'tofifty_honoured', 'tototal_honoured'));
    }

    public function hei_dashboard()
{
    if (Auth::user()->access_level == 'Admin') {
        $toone_booked_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) > 0) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) < 1)) then `tbl_pmtct`.`id` end)) AS count"))
        ->where('tbl_appointment.app_status', '=', 'Booked')
        ->where('tbl_appointment.active_app', '=', 1)
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->pluck('count');

        $tofour_booked_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) >= 1) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) <= 4)) then `tbl_pmtct`.`id` end)) AS count"))
        ->where('tbl_appointment.app_status', '=', 'Booked')
        ->where('tbl_appointment.active_app', '=', 1)
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->pluck('count');

        $tonine_booked_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) >= 5) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) <= 9)) then `tbl_pmtct`.`id` end)) AS count"))
        ->where('tbl_appointment.app_status', '=', 'Booked')
        ->where('tbl_appointment.active_app', '=', 1)
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->pluck('count');

        $tofourteen_booked_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) >= 10) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) <= 14)) then `tbl_pmtct`.`id` end)) AS count"))
        ->where('tbl_appointment.app_status', '=', 'Booked')
        ->where('tbl_appointment.active_app', '=', 1)
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->pluck('count');

        $tototal_booked_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) > 0) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) <= 14)) then `tbl_pmtct`.`id` end)) AS count"))
        ->where('tbl_appointment.app_status', '=', 'Booked')
        ->where('tbl_appointment.active_app', '=', 1)
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->pluck('count');

        $toone_scheduled_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) > 0) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) < 1)) then `tbl_pmtct`.`id` end)) AS count"))
       // ->where('tbl_appointment.visit_type', '=', 'Scheduled')
        ->whereNotNull('tbl_client.hei_no')
        ->where('tbl_appointment.appntmnt_date', '<', Now())
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->pluck('count');

        $tofour_scheduled_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) >= 1) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) <= 4)) then `tbl_pmtct`.`id` end)) AS count"))
       // ->where('tbl_appointment.visit_type', '=', 'Scheduled')
        ->whereNotNull('tbl_client.hei_no')
        ->where('tbl_appointment.appntmnt_date', '<', Now())
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->pluck('count');

        $tonine_scheduled_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) >= 5) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) <= 9)) then `tbl_pmtct`.`id` end)) AS count"))
        //->where('tbl_appointment.visit_type', '=', 'Scheduled')
        ->whereNotNull('tbl_client.hei_no')
        ->where('tbl_appointment.appntmnt_date', '<', Now())
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->pluck('count');

        $tofourteen_scheduled_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) >= 10) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) <= 14)) then `tbl_pmtct`.`id` end)) AS count"))
        //->where('tbl_appointment.visit_type', '=', 'Scheduled')
        ->whereNotNull('tbl_client.hei_no')
        ->where('tbl_appointment.appntmnt_date', '<', Now())
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->pluck('count');

        $tototal_scheduled_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) > 0) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) <= 14)) then `tbl_pmtct`.`id` end)) AS count"))
       // ->where('tbl_appointment.visit_type', '=', 'Scheduled')
        ->whereNotNull('tbl_client.hei_no')
        ->where('tbl_appointment.appntmnt_date', '<', Now())
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->pluck('count');


        $toone_unscheduled_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) > 0) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) < 1)) then `tbl_pmtct`.`id` end)) AS count"))
        ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
        ->where('tbl_appointment.appntmnt_date', '<', Now())
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->pluck('count');

        $tofour_unscheduled_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) >= 1) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) <= 4)) then `tbl_pmtct`.`id` end)) AS count"))
        ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
        ->where('tbl_appointment.appntmnt_date', '<', Now())
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->pluck('count');

        $tonine_unscheduled_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) >= 5) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) <= 9)) then `tbl_pmtct`.`id` end)) AS count"))
        ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
        ->where('tbl_appointment.appntmnt_date', '<', Now())
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->pluck('count');

        $tofourteen_unscheduled_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) >= 10) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) <= 14)) then `tbl_pmtct`.`id` end)) AS count"))
        ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
        ->where('tbl_appointment.appntmnt_date', '<', Now())
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->pluck('count');

        $tototal_unscheduled_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) > 0) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) <= 14)) then `tbl_pmtct`.`id` end)) AS count"))
        ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
        ->where('tbl_appointment.appntmnt_date', '<', Now())
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->pluck('count');

        $toone_missed_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) > 0) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) < 1)) then `tbl_pmtct`.`id` end)) AS count"))
        ->where('tbl_appointment.app_status', '=', 'Missed')
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->pluck('count');

        $tofour_missed_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) >= 1) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) <= 4)) then `tbl_pmtct`.`id` end)) AS count"))
        ->where('tbl_appointment.app_status', '=', 'Missed')
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->pluck('count');

        $tonine_missed_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) >= 5) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) <= 9)) then `tbl_pmtct`.`id` end)) AS count"))
        ->where('tbl_appointment.app_status', '=', 'Missed')
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->pluck('count');

        $tofourteen_missed_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) >= 10) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) <= 14)) then `tbl_pmtct`.`id` end)) AS count"))
        ->where('tbl_appointment.app_status', '=', 'Missed')
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->pluck('count');

        $tototal_missed_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) > 0) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) <= 14)) then `tbl_pmtct`.`id` end)) AS count"))
        ->where('tbl_appointment.app_status', '=', 'Missed')
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->pluck('count');

        $toone_defaulted_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) > 0) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) < 1)) then `tbl_pmtct`.`id` end)) AS count"))
        ->where('tbl_appointment.app_status', '=', 'Defaulted')
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->pluck('count');

        $tofour_defaulted_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) >= 1) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) <= 4)) then `tbl_pmtct`.`id` end)) AS count"))
        ->where('tbl_appointment.app_status', '=', 'Defaulted')
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->pluck('count');

        $tonine_defaulted_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) >= 5) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) <= 9)) then `tbl_pmtct`.`id` end)) AS count"))
        ->where('tbl_appointment.app_status', '=', 'Defaulted')
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->pluck('count');

        $tofourteen_defaulted_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) >= 10) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) <= 14)) then `tbl_pmtct`.`id` end)) AS count"))
        ->where('tbl_appointment.app_status', '=', 'Defaulted')
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->pluck('count');

        $tototal_defaulted_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) > 0) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) <= 14)) then `tbl_pmtct`.`id` end)) AS count"))
        ->where('tbl_appointment.app_status', '=', 'Defaulted')
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->pluck('count');

        $toone_ltfu_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) > 0) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) < 1)) then `tbl_pmtct`.`id` end)) AS count"))
        ->where('tbl_appointment.app_status', '=', 'LTFU')
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->pluck('count');

        $tofour_ltfu_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) >= 1) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) <= 4)) then `tbl_pmtct`.`id` end)) AS count"))
        ->where('tbl_appointment.app_status', '=', 'LTFU')
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->pluck('count');

        $tonine_ltfu_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) >= 5) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) <= 9)) then `tbl_pmtct`.`id` end)) AS count"))
        ->where('tbl_appointment.app_status', '=', 'LTFU')
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->pluck('count');

        $tofourteen_ltfu_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) >= 10) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) <= 14)) then `tbl_pmtct`.`id` end)) AS count"))
        ->where('tbl_appointment.app_status', '=', 'LTFU')
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->pluck('count');

        $tototal_ltfu_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) > 0) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) <= 14)) then `tbl_pmtct`.`id` end)) AS count"))
        ->where('tbl_appointment.app_status', '=', 'LTFU')
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->pluck('count');

        // non-positive hei
        $count_booked_heis = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("COUNT(tbl_appointment.id) as count"))
        ->where('tbl_appointment.app_status', '=', 'Booked')
        ->where('tbl_appointment.active_app', '=', 1)
        ->whereNotNull('tbl_client.hei_no')
        ->pluck('count');

        $count_scheduled_heis = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("COUNT(tbl_appointment.id) as count"))
        ->where('tbl_appointment.visit_type', '=', 'Scheduled')
        ->whereNotNull('tbl_client.hei_no')
        ->pluck('count');

        $count_unscheduled_heis = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("COUNT(tbl_appointment.id) as count"))
        ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
        ->whereNotNull('tbl_client.hei_no')
        ->pluck('count');

        $count_deceased_heis = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("COUNT(tbl_client.id) as count"))
        ->where('tbl_client.status', '=', 'Deceased')
        ->whereNotNull('tbl_client.hei_no')
        ->pluck('count');

        $count_transfer_heis = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("COUNT(tbl_client.id) as count"))
        ->where('tbl_client.status', '=', 'Transfer Out')
        ->whereNotNull('tbl_client.hei_no')
        ->pluck('count');

        $count_discharged_heis = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("COUNT(tbl_client.id) as count"))
        ->where('tbl_client.status', '=', 'Discharged')
        ->whereNotNull('tbl_client.hei_no')
        ->pluck('count');

        $count_missed_heis = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("COUNT(tbl_client.id) as count"))
        ->where('tbl_appointment.app_status', '=', 'Missed')
        ->whereNotNull('tbl_client.hei_no')
        ->pluck('count');

        $count_defaulted_heis = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("COUNT(tbl_client.id) as count"))
        ->where('tbl_appointment.app_status', '=', 'Defaulted')
        ->whereNotNull('tbl_client.hei_no')
        ->pluck('count');

        $count_ltfu_heis = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("COUNT(tbl_client.id) as count"))
        ->where('tbl_appointment.app_status', '=', 'LTFU')
        ->whereNotNull('tbl_client.hei_no')
        ->pluck('count');

        $count_pcr_heis = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->join('tbl_pmtct', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->select(\DB::raw("COUNT(tbl_client.id) as count"))
        ->where('tbl_appointment.app_status', '=', 'LTFU')
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->pluck('count');

    }

    if (Auth::user()->access_level == 'Facility') {
        $toone_booked_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) > 0) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) < 1)) then `tbl_pmtct`.`id` end)) AS count"))
        ->where('tbl_appointment.app_status', '=', 'Booked')
        ->where('tbl_appointment.active_app', '=', 1)
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->pluck('count');

        $tofour_booked_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) >= 1) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) <= 4)) then `tbl_pmtct`.`id` end)) AS count"))
        ->where('tbl_appointment.app_status', '=', 'Booked')
        ->where('tbl_appointment.active_app', '=', 1)
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->pluck('count');

        $tonine_booked_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) >= 5) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) <= 9)) then `tbl_pmtct`.`id` end)) AS count"))
        ->where('tbl_appointment.app_status', '=', 'Booked')
        ->where('tbl_appointment.active_app', '=', 1)
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->pluck('count');

        $tofourteen_booked_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) >= 10) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) <= 14)) then `tbl_pmtct`.`id` end)) AS count"))
        ->where('tbl_appointment.app_status', '=', 'Booked')
        ->where('tbl_appointment.active_app', '=', 1)
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->pluck('count');

        $tototal_booked_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) > 0) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) <= 14)) then `tbl_pmtct`.`id` end)) AS count"))
        ->where('tbl_appointment.app_status', '=', 'Booked')
        ->where('tbl_appointment.active_app', '=', 1)
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->pluck('count');

        $toone_scheduled_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) > 0) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) < 1)) then `tbl_pmtct`.`id` end)) AS count"))
        ->where('tbl_appointment.visit_type', '=', 'Scheduled')
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->pluck('count');

        $tofour_scheduled_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) >= 1) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) <= 4)) then `tbl_pmtct`.`id` end)) AS count"))
        ->where('tbl_appointment.visit_type', '=', 'Scheduled')
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->pluck('count');

        $tonine_scheduled_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) >= 5) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) <= 9)) then `tbl_pmtct`.`id` end)) AS count"))
        ->where('tbl_appointment.visit_type', '=', 'Scheduled')
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->pluck('count');

        $tofourteen_scheduled_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) >= 10) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) <= 14)) then `tbl_pmtct`.`id` end)) AS count"))
        ->where('tbl_appointment.visit_type', '=', 'Scheduled')
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->pluck('count');

        $tototal_scheduled_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) > 0) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) <= 14)) then `tbl_pmtct`.`id` end)) AS count"))
        ->where('tbl_appointment.visit_type', '=', 'Scheduled')
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->pluck('count');


        $toone_unscheduled_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) > 0) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) < 1)) then `tbl_pmtct`.`id` end)) AS count"))
        ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->pluck('count');

        $tofour_unscheduled_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) >= 1) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) <= 4)) then `tbl_pmtct`.`id` end)) AS count"))
        ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->pluck('count');

        $tonine_unscheduled_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) >= 5) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) <= 9)) then `tbl_pmtct`.`id` end)) AS count"))
        ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->pluck('count');

        $tofourteen_unscheduled_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) >= 10) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) <= 14)) then `tbl_pmtct`.`id` end)) AS count"))
        ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->pluck('count');

        $tototal_unscheduled_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) > 0) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) <= 14)) then `tbl_pmtct`.`id` end)) AS count"))
        ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->pluck('count');

        $toone_missed_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) > 0) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) < 1)) then `tbl_pmtct`.`id` end)) AS count"))
        ->where('tbl_appointment.app_status', '=', 'Missed')
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->pluck('count');

        $tofour_missed_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) >= 1) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) <= 4)) then `tbl_pmtct`.`id` end)) AS count"))
        ->where('tbl_appointment.app_status', '=', 'Missed')
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->pluck('count');

        $tonine_missed_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) >= 5) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) <= 9)) then `tbl_pmtct`.`id` end)) AS count"))
        ->where('tbl_appointment.app_status', '=', 'Missed')
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->pluck('count');

        $tofourteen_missed_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) >= 10) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) <= 14)) then `tbl_pmtct`.`id` end)) AS count"))
        ->where('tbl_appointment.app_status', '=', 'Missed')
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->pluck('count');

        $tototal_missed_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) > 0) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) <= 14)) then `tbl_pmtct`.`id` end)) AS count"))
        ->where('tbl_appointment.app_status', '=', 'Missed')
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->pluck('count');

        $toone_defaulted_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) > 0) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) < 1)) then `tbl_pmtct`.`id` end)) AS count"))
        ->where('tbl_appointment.app_status', '=', 'Defaulted')
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->pluck('count');

        $tofour_defaulted_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) >= 1) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) <= 4)) then `tbl_pmtct`.`id` end)) AS count"))
        ->where('tbl_appointment.app_status', '=', 'Defaulted')
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->pluck('count');

        $tonine_defaulted_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) >= 5) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) <= 9)) then `tbl_pmtct`.`id` end)) AS count"))
        ->where('tbl_appointment.app_status', '=', 'Defaulted')
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->pluck('count');

        $tofourteen_defaulted_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) >= 10) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) <= 14)) then `tbl_pmtct`.`id` end)) AS count"))
        ->where('tbl_appointment.app_status', '=', 'Defaulted')
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->pluck('count');

        $tototal_defaulted_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) > 0) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) <= 14)) then `tbl_pmtct`.`id` end)) AS count"))
        ->where('tbl_appointment.app_status', '=', 'Defaulted')
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->pluck('count');

        $toone_ltfu_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) > 0) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) < 1)) then `tbl_pmtct`.`id` end)) AS count"))
        ->where('tbl_appointment.app_status', '=', 'LTFU')
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->pluck('count');

        $tofour_ltfu_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) >= 1) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) <= 4)) then `tbl_pmtct`.`id` end)) AS count"))
        ->where('tbl_appointment.app_status', '=', 'LTFU')
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->pluck('count');

        $tonine_ltfu_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) >= 5) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) <= 9)) then `tbl_pmtct`.`id` end)) AS count"))
        ->where('tbl_appointment.app_status', '=', 'LTFU')
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->pluck('count');

        $tofourteen_ltfu_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) >= 10) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) <= 14)) then `tbl_pmtct`.`id` end)) AS count"))
        ->where('tbl_appointment.app_status', '=', 'LTFU')
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->pluck('count');

        $tototal_ltfu_heis = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) > 0) and ((year(curdate()) - year(`tbl_pmtct`.`hei_dob`)) <= 14)) then `tbl_pmtct`.`id` end)) AS count"))
        ->where('tbl_appointment.app_status', '=', 'LTFU')
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->pluck('count');

        // non-positive hei
        $count_booked_heis = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("COUNT(tbl_appointment.id) as count"))
        ->where('tbl_appointment.app_status', '=', 'Booked')
        ->where('tbl_appointment.active_app', '=', 1)
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->whereNotNull('tbl_client.hei_no')
        ->pluck('count');

        $count_scheduled_heis = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("COUNT(tbl_appointment.id) as count"))
        ->where('tbl_appointment.visit_type', '=', 'Scheduled')
        ->whereNotNull('tbl_client.hei_no')
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->pluck('count');

        $count_unscheduled_heis = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("COUNT(tbl_appointment.id) as count"))
        ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
        ->whereNotNull('tbl_client.hei_no')
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->pluck('count');

        $count_deceased_heis = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("COUNT(tbl_client.id) as count"))
        ->where('tbl_client.status', '=', 'Deceased')
        ->whereNotNull('tbl_client.hei_no')
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->pluck('count');

        $count_transfer_heis = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("COUNT(tbl_client.id) as count"))
        ->where('tbl_client.status', '=', 'Transfer Out')
        ->whereNotNull('tbl_client.hei_no')
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->pluck('count');

        $count_discharged_heis = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("COUNT(tbl_client.id) as count"))
        ->where('tbl_client.status', '=', 'Discharged')
        ->whereNotNull('tbl_client.hei_no')
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->pluck('count');

        $count_missed_heis = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("COUNT(tbl_client.id) as count"))
        ->where('tbl_appointment.app_status', '=', 'Missed')
        ->whereNotNull('tbl_client.hei_no')
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->pluck('count');

        $count_defaulted_heis = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("COUNT(tbl_client.id) as count"))
        ->where('tbl_appointment.app_status', '=', 'Defaulted')
        ->whereNotNull('tbl_client.hei_no')
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->pluck('count');

        $count_ltfu_heis = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->select(\DB::raw("COUNT(tbl_client.id) as count"))
        ->where('tbl_appointment.app_status', '=', 'LTFU')
        ->whereNotNull('tbl_client.hei_no')
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->pluck('count');

        $count_pcr_heis = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->join('tbl_pmtct', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->select(\DB::raw("COUNT(tbl_client.id) as count"))
        ->where('tbl_appointment.app_status', '=', 'LTFU')
        ->whereNotNull('tbl_client.hei_no')
        ->whereNotNull('tbl_pmtct.date_confirmed_positive')
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->pluck('count');

    }

    return view('pmtct/hei_dashboard', compact('toone_booked_heis', 'tofour_booked_heis', 'tonine_booked_heis', 'tofourteen_booked_heis',
    'toone_scheduled_heis', 'tofour_scheduled_heis', 'tonine_scheduled_heis', 'tofourteen_scheduled_heis', 'toone_unscheduled_heis', 'tofour_unscheduled_heis',
    'tonine_unscheduled_heis', 'tofourteen_unscheduled_heis', 'toone_missed_heis', 'tofour_missed_heis', 'tonine_missed_heis', 'tofourteen_missed_heis',
    'toone_defaulted_heis', 'tofour_defaulted_heis', 'tonine_defaulted_heis', 'tofourteen_defaulted_heis', 'toone_ltfu_heis', 'tofour_ltfu_heis', 'tonine_ltfu_heis', 'tofourteen_ltfu_heis',
    'tototal_booked_heis', 'tototal_scheduled_heis', 'tototal_unscheduled_heis', 'tototal_missed_heis', 'tototal_defaulted_heis', 'tototal_ltfu_heis', 'count_booked_heis', 'count_scheduled_heis',
    'count_unscheduled_heis', 'count_deceased_heis', 'count_transfer_heis', 'count_discharged_heis', 'count_missed_heis', 'count_defaulted_heis', 'count_ltfu_heis'));

}
}