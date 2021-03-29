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
       ->where('tbl_appointment.appntmnt_date', '>=', Now())
       ->get();

       $all_schedule_appointment_clients = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_appointment.appntmnt_date')
        ->where('visit_type', '=', 'Scheduled')
        ->get();

        $all_unschedule_appointment_clients = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
        ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_appointment.appntmnt_date')
        ->where('visit_type', '=', 'Un-Scheduled')
        ->get();
        }

        if (Auth::user()->access_level == 'Facility') {
            $all_booked_pmtct_clients = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_appointment.appntmnt_date')
           ->where('tbl_appointment.app_status', '=', 'Booked')
           ->where('tbl_appointment.appntmnt_date', '>=', Now())
           ->where('tbl_client.mfl_code', Auth::user()->facility_id)
           ->get();

           $all_schedule_appointment_clients = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_appointment.appntmnt_date')
            ->where('visit_type', '=', 'Scheduled')
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->get();

            $all_unschedule_appointment_clients = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_appointment.appntmnt_date')
            ->where('visit_type', '=', 'Un-Scheduled')
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
                ->where('visit_type', '=', 'Scheduled')
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->get();

                $all_unschedule_appointment_clients = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_appointment.appntmnt_date')
                ->where('visit_type', '=', 'Un-Scheduled')
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
            ->whereNotNull('tbl_client.hei_no')
            ->get();

            $all_unscheduled_heis = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_client.hei_no, tbl_client.phone_no, tbl_appointment.appntmnt_date, tbl_appointment.app_type_1, tbl_appointment.visit_type')
            ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
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
        ->where('tbl_client.mfl_code', Auth::user()->facility_id)
        ->whereNotNull('tbl_client.hei_no')
        ->get();

        $all_unscheduled_heis = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
        ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_client.hei_no, tbl_client.phone_no, tbl_appointment.appntmnt_date, tbl_appointment.app_type_1, tbl_appointment.visit_type')
        ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
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
            ->where('tbl_client.partner_id', Auth::user()->partner_id)
            ->whereNotNull('tbl_client.hei_no')
            ->get();

            $all_unscheduled_heis = Appointments::join('tbl_client', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_client.hei_no, tbl_client.phone_no, tbl_appointment.appntmnt_date, tbl_appointment.app_type_1, tbl_appointment.visit_type')
            ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
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
        $test = Client::whereNotNull('dob')
        ->age;
        dd($test);

        return view('pmtct/hei_final_outcome', compact('test'));
    }
}