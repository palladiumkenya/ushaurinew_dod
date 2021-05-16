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

class FilterController extends Controller
{
    public function filter_pmtct_dashboard(Request $request)
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
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tonineteen_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 19)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $totwentyfour_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 24)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $totwentynine_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 25) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 29)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tothirtyfour_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 30) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 34)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tothirtynine_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 35) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 39)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tofortyfour_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 40) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 44)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tofortynine_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 45) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 49)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tofiftyplus_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 50)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tototal_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) >=10)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            // Un-Scheduled
            $tonine_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 9)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tofourteen_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 14)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tonineteen_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 19)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $totwentyfour_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 24)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $totwentynine_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 25) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 29)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tothirtyfour_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 30) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 34)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tothirtynine_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 35) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 39)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tofortyfour_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 40) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 44)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tofortynine_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 45) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 49)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tofifty_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 50) and ((year(curdate()) - year(`tbl_client`.`dob`)) >= 50)) then `tbl_pmtct`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tototal_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->whereNull('tbl_client.hei_no')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) >=10)) then `tbl_client`.`id` end)) AS count"))
            ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            //Booked
            $tonine_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 9)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Booked')
            ->where('tbl_appointment.appntmnt_date', '>', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tofourteen_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 14)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Booked')
            ->where('tbl_appointment.appntmnt_date', '>', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tonineteen_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 19)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Booked')
            ->where('tbl_appointment.appntmnt_date', '>', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $totwentyfour_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 24)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Booked')
            ->where('tbl_appointment.appntmnt_date', '>', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $totwentynine_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 25) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 29)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Booked')
            ->where('tbl_appointment.appntmnt_date', '>', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tothirtyfour_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 30) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 34)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Booked')
            ->where('tbl_appointment.appntmnt_date', '>', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tothirtynine_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 35) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 39)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Booked')
            ->where('tbl_appointment.appntmnt_date', '>', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tofortyfour_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 40) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 44)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Booked')
            ->where('tbl_appointment.appntmnt_date', '>', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tofortynine_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 45) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 49)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Booked')
            ->where('tbl_appointment.appntmnt_date', '>', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tofifty_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 50) and ((year(curdate()) - year(`tbl_client`.`dob`)) >= 50)) then `tbl_pmtct`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Booked')
            ->where('tbl_appointment.appntmnt_date', '>', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tototal_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->whereNull('tbl_client.hei_no')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) >=10)) then `tbl_client`.`id` end)) AS count"))
            ->where('tbl_appointment.app_status', '=', 'Booked')
            ->where('tbl_appointment.appntmnt_date', '>', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            // Defaulter

            $tonine_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 9)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Defaulted')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tofourteen_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 14)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Defaulted')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tonineteen_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 19)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Defaulted')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $totwentyfour_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 24)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Defaulted')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $totwentynine_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 25) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 29)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Defaulted')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tothirtyfour_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 30) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 34)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Defaulted')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tothirtynine_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 35) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 39)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Defaulted')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tofortyfour_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 40) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 44)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Defaulted')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tofortynine_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 45) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 49)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Defaulted')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tofifty_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 50) and ((year(curdate()) - year(`tbl_client`.`dob`)) >= 50)) then `tbl_pmtct`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Defaulted')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tototal_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->whereNull('tbl_client.hei_no')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) >=10)) then `tbl_client`.`id` end)) AS count"))
            ->where('tbl_appointment.app_status', '=', 'Defaulted')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            // Missed
            $tonine_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 9)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Missed')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tofourteen_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 14)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Missed')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tonineteen_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 19)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Missed')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $totwentyfour_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 24)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Missed')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $totwentynine_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 25) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 29)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Missed')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tothirtyfour_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 30) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 34)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Missed')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tothirtynine_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 35) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 39)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Missed')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tofortyfour_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 40) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 44)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Missed')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tofortynine_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 45) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 49)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Missed')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tofifty_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 50) and ((year(curdate()) - year(`tbl_client`.`dob`)) >= 50)) then `tbl_pmtct`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Missed')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tototal_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->whereNull('tbl_client.hei_no')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) >=10)) then `tbl_client`.`id` end)) AS count"))
            ->where('tbl_appointment.app_status', '=', 'Missed')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            // LTFU
            $tonine_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 9)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'LTFU')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tofourteen_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 14)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'LTFU')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tonineteen_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 19)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'LTFU')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $totwentyfour_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 24)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'LTFU')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $totwentynine_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 25) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 29)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'LTFU')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tothirtyfour_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 30) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 34)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'LTFU')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tothirtynine_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 35) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 39)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'LTFU')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tofortyfour_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 40) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 44)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'LTFU')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tofortynine_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 45) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 49)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'LTFU')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tofifty_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 50) and ((year(curdate()) - year(`tbl_client`.`dob`)) >= 50)) then `tbl_pmtct`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'LTFU')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tototal_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->whereNull('tbl_client.hei_no')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) >=10)) then `tbl_client`.`id` end)) AS count"))
            ->where('tbl_appointment.app_status', '=', 'LTFU')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            // honoured appointments
            $tonine_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 9)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appointment_kept', '=', 'Yes')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tofourteen_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 14)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appointment_kept', '=', 'Yes')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tonineteen_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 19)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appointment_kept', '=', 'Yes')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $totwentyfour_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 24)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appointment_kept', '=', 'Yes')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $totwentynine_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 25) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 29)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appointment_kept', '=', 'Yes')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tothirtyfour_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 30) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 34)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appointment_kept', '=', 'Yes')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tothirtynine_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 35) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 39)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appointment_kept', '=', 'Yes')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tofortyfour_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 40) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 44)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appointment_kept', '=', 'Yes')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tofortynine_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 45) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 49)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appointment_kept', '=', 'Yes')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tofifty_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 50) and ((year(curdate()) - year(`tbl_client`.`dob`)) >= 50)) then `tbl_pmtct`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appointment_kept', '=', 'Yes')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->where('tbl_client.mfl_code', Auth::user()->facility_id)
            ->pluck('count');

            $tototal_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->whereNull('tbl_client.hei_no')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) >=10)) then `tbl_client`.`id` end)) AS count"))
            ->where('tbl_appointment.appointment_kept', '=', 'Yes')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
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
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tofourteen_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                 ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 14)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.appntmnt_date', '<', Now())
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tonineteen_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                 ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 19)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.appntmnt_date', '<', Now())
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $totwentyfour_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                 ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 24)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.appntmnt_date', '<', Now())
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $totwentynine_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 25) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 29)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.appntmnt_date', '<', Now())
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tothirtyfour_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 30) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 34)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.appntmnt_date', '<', Now())
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tothirtynine_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 35) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 39)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.appntmnt_date', '<', Now())
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tofortyfour_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 40) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 44)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.appntmnt_date', '<', Now())
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tofortynine_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 45) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 49)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.appntmnt_date', '<', Now())
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tofiftyplus_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 50)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.appntmnt_date', '<', Now())
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tototal_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) >=10)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.appntmnt_date', '<', Now())
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                // Un-Scheduled
                $tonine_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                 ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 9)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
                ->where('tbl_appointment.appntmnt_date', '<', Now())
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tofourteen_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                 ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 14)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
                ->where('tbl_appointment.appntmnt_date', '<', Now())
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tonineteen_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                 ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 19)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
                ->where('tbl_appointment.appntmnt_date', '<', Now())
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $totwentyfour_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                 ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 24)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
                ->where('tbl_appointment.appntmnt_date', '<', Now())
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $totwentynine_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 25) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 29)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
                ->where('tbl_appointment.appntmnt_date', '<', Now())
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tothirtyfour_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 30) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 34)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
                ->where('tbl_appointment.appntmnt_date', '<', Now())
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tothirtynine_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 35) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 39)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
                ->where('tbl_appointment.appntmnt_date', '<', Now())
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tofortyfour_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 40) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 44)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
                ->where('tbl_appointment.appntmnt_date', '<', Now())
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tofortynine_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 45) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 49)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
                ->where('tbl_appointment.appntmnt_date', '<', Now())
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tofifty_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 50) and ((year(curdate()) - year(`tbl_client`.`dob`)) >= 50)) then `tbl_pmtct`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
                ->where('tbl_appointment.appntmnt_date', '<', Now())
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tototal_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->whereNull('tbl_client.hei_no')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) >=10)) then `tbl_client`.`id` end)) AS count"))
                ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
                ->where('tbl_appointment.appntmnt_date', '<', Now())
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                //Booked
                $tonine_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                 ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 9)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Booked')
                ->where('tbl_appointment.appntmnt_date', '>', Now())
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tofourteen_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 14)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Booked')
                ->where('tbl_appointment.appntmnt_date', '>', Now())
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tonineteen_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                 ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 19)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Booked')
                ->where('tbl_appointment.appntmnt_date', '>', Now())
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $totwentyfour_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                 ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 24)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Booked')
                ->where('tbl_appointment.appntmnt_date', '>', Now())
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $totwentynine_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 25) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 29)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Booked')
                ->where('tbl_appointment.appntmnt_date', '>', Now())
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tothirtyfour_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 30) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 34)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Booked')
                ->where('tbl_appointment.appntmnt_date', '>', Now())
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tothirtynine_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 35) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 39)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Booked')
                ->where('tbl_appointment.appntmnt_date', '>', Now())
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tofortyfour_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 40) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 44)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Booked')
                ->where('tbl_appointment.appntmnt_date', '>', Now())
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tofortynine_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 45) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 49)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Booked')
                ->where('tbl_appointment.appntmnt_date', '>', Now())
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tofifty_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 50) and ((year(curdate()) - year(`tbl_client`.`dob`)) >= 50)) then `tbl_pmtct`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Booked')
                ->where('tbl_appointment.appntmnt_date', '>', Now())
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tototal_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->whereNull('tbl_client.hei_no')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) >=10)) then `tbl_client`.`id` end)) AS count"))
                ->where('tbl_appointment.app_status', '=', 'Booked')
                ->where('tbl_appointment.appntmnt_date', '>', Now())
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                // Defaulter

                $tonine_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                 ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 9)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Defaulted')
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tofourteen_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 14)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Defaulted')
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tonineteen_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                 ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 19)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Defaulted')
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $totwentyfour_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                 ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 24)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Defaulted')
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $totwentynine_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 25) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 29)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Defaulted')
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tothirtyfour_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 30) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 34)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Defaulted')
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tothirtynine_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 35) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 39)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Defaulted')
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tofortyfour_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 40) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 44)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Defaulted')
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tofortynine_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 45) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 49)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Defaulted')
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tofifty_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 50) and ((year(curdate()) - year(`tbl_client`.`dob`)) >= 50)) then `tbl_pmtct`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Defaulted')
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tototal_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->whereNull('tbl_client.hei_no')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) >=10)) then `tbl_client`.`id` end)) AS count"))
                ->where('tbl_appointment.app_status', '=', 'Defaulted')
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                // Missed
                $tonine_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                 ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 9)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Missed')
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tofourteen_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 14)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Missed')
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tonineteen_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                 ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 19)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Missed')
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $totwentyfour_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                 ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 24)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Missed')
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $totwentynine_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 25) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 29)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Missed')
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tothirtyfour_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 30) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 34)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Missed')
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tothirtynine_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 35) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 39)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Missed')
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tofortyfour_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 40) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 44)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Missed')
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tofortynine_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 45) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 49)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Missed')
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tofifty_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 50) and ((year(curdate()) - year(`tbl_client`.`dob`)) >= 50)) then `tbl_pmtct`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'Missed')
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tototal_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->whereNull('tbl_client.hei_no')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) >=10)) then `tbl_client`.`id` end)) AS count"))
                ->where('tbl_appointment.app_status', '=', 'Missed')
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                // LTFU
                $tonine_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                 ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 9)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'LTFU')
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tofourteen_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 14)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'LTFU')
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tonineteen_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                 ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 19)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'LTFU')
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $totwentyfour_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                 ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 24)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'LTFU')
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $totwentynine_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 25) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 29)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'LTFU')
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tothirtyfour_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 30) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 34)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'LTFU')
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tothirtynine_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 35) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 39)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'LTFU')
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tofortyfour_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 40) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 44)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'LTFU')
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tofortynine_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 45) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 49)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'LTFU')
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tofifty_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 50) and ((year(curdate()) - year(`tbl_client`.`dob`)) >= 50)) then `tbl_pmtct`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.app_status', '=', 'LTFU')
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tototal_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->whereNull('tbl_client.hei_no')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) >=10)) then `tbl_client`.`id` end)) AS count"))
                ->where('tbl_appointment.app_status', '=', 'LTFU')
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                // honoured appointments
                $tonine_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                 ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 9)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.appointment_kept', '=', 'Yes')
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tofourteen_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 14)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.appointment_kept', '=', 'Yes')
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tonineteen_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                 ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 19)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.appointment_kept', '=', 'Yes')
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $totwentyfour_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                 ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 24)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.appointment_kept', '=', 'Yes')
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $totwentynine_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 25) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 29)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.appointment_kept', '=', 'Yes')
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tothirtyfour_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 30) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 34)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.appointment_kept', '=', 'Yes')
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tothirtynine_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 35) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 39)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.appointment_kept', '=', 'Yes')
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tofortyfour_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 40) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 44)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.appointment_kept', '=', 'Yes')
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tofortynine_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 45) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 49)) then `tbl_client`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.appointment_kept', '=', 'Yes')
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tofifty_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 50) and ((year(curdate()) - year(`tbl_client`.`dob`)) >= 50)) then `tbl_pmtct`.`id` end)) AS count"))
                ->whereNull('tbl_client.hei_no')
                ->where('tbl_appointment.appointment_kept', '=', 'Yes')
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
                ->where('tbl_client.partner_id', Auth::user()->partner_id)
                ->pluck('count');

                $tototal_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
                ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
                ->whereNull('tbl_client.hei_no')
                ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) >=10)) then `tbl_client`.`id` end)) AS count"))
                ->where('tbl_appointment.appointment_kept', '=', 'Yes')
                ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
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
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $tofourteen_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 14)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
           // ->where('tbl_appointment.visit_type', '=', 'Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $tonineteen_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 19)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            //->where('tbl_appointment.visit_type', '=', 'Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $totwentyfour_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 24)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            //->where('tbl_appointment.visit_type', '=', 'Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $totwentynine_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 25) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 29)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
          //  ->where('tbl_appointment.visit_type', '=', 'Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $tothirtyfour_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 30) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 34)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
           // ->where('tbl_appointment.visit_type', '=', 'Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $tothirtynine_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 35) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 39)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            //->where('tbl_appointment.visit_type', '=', 'Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $tofortyfour_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 40) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 44)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
           // ->where('tbl_appointment.visit_type', '=', 'Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $tofortynine_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 45) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 49)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
           // ->where('tbl_appointment.visit_type', '=', 'Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $tofiftyplus_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 50)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            //->where('tbl_appointment.visit_type', '=', 'Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $tototal_scheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) >=10)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
           // ->where('tbl_appointment.visit_type', '=', 'Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            // Un-Scheduled
            $tonine_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 9)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $tofourteen_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 14)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $tonineteen_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 19)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $totwentyfour_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 24)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $totwentynine_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 25) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 29)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $tothirtyfour_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 30) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 34)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $tothirtynine_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 35) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 39)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $tofortyfour_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 40) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 44)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $tofortynine_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 45) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 49)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $tofifty_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 50) and ((year(curdate()) - year(`tbl_client`.`dob`)) >= 50)) then `tbl_pmtct`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $tototal_unscheduled = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->whereNull('tbl_client.hei_no')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) >=10)) then `tbl_client`.`id` end)) AS count"))
            ->where('tbl_appointment.visit_type', '=', 'Un-Scheduled')
            ->where('tbl_appointment.appntmnt_date', '<', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            //Booked
            $tonine_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 9)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Booked')
            ->where('tbl_appointment.appntmnt_date', '>', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $tofourteen_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 14)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Booked')
            ->where('tbl_appointment.appntmnt_date', '>', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $tonineteen_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 19)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Booked')
            ->where('tbl_appointment.appntmnt_date', '>', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $totwentyfour_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 24)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Booked')
            ->where('tbl_appointment.appntmnt_date', '>', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $totwentynine_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 25) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 29)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Booked')
            ->where('tbl_appointment.appntmnt_date', '>', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $tothirtyfour_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 30) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 34)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Booked')
            ->where('tbl_appointment.appntmnt_date', '>', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $tothirtynine_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 35) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 39)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Booked')
            ->where('tbl_appointment.appntmnt_date', '>', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $tofortyfour_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 40) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 44)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Booked')
            ->where('tbl_appointment.appntmnt_date', '>', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $tofortynine_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 45) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 49)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Booked')
            ->where('tbl_appointment.appntmnt_date', '>', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $tofifty_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 50) and ((year(curdate()) - year(`tbl_client`.`dob`)) >= 50)) then `tbl_pmtct`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Booked')
            ->where('tbl_appointment.appntmnt_date', '>', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $tototal_booked = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->whereNull('tbl_client.hei_no')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) >=10)) then `tbl_client`.`id` end)) AS count"))
            ->where('tbl_appointment.app_status', '=', 'Booked')
            ->where('tbl_appointment.appntmnt_date', '>', Now())
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            // Defaulter

            $tonine_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 9)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Defaulted')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $tofourteen_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 14)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Defaulted')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $tonineteen_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 19)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Defaulted')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $totwentyfour_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 24)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Defaulted')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $totwentynine_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 25) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 29)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Defaulted')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $tothirtyfour_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 30) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 34)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Defaulted')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $tothirtynine_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 35) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 39)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Defaulted')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $tofortyfour_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 40) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 44)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Defaulted')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $tofortynine_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 45) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 49)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Defaulted')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $tofifty_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 50) and ((year(curdate()) - year(`tbl_client`.`dob`)) >= 50)) then `tbl_pmtct`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Defaulted')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $tototal_defaulted = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->whereNull('tbl_client.hei_no')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) >=10)) then `tbl_client`.`id` end)) AS count"))
            ->where('tbl_appointment.app_status', '=', 'Defaulted')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            // Missed
            $tonine_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 9)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Missed')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $tofourteen_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 14)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Missed')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $tonineteen_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 19)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Missed')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $totwentyfour_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 24)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Missed')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $totwentynine_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 25) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 29)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Missed')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $tothirtyfour_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 30) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 34)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Missed')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $tothirtynine_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 35) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 39)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Missed')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $tofortyfour_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 40) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 44)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Missed')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $tofortynine_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 45) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 49)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Missed')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $tofifty_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 50) and ((year(curdate()) - year(`tbl_client`.`dob`)) >= 50)) then `tbl_pmtct`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'Missed')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $tototal_missed = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->whereNull('tbl_client.hei_no')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) >=10)) then `tbl_client`.`id` end)) AS count"))
            ->where('tbl_appointment.app_status', '=', 'Missed')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            // LTFU
            $tonine_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 9)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'LTFU')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $tofourteen_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 14)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'LTFU')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
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
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $totwentynine_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 25) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 29)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'LTFU')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $tothirtyfour_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 30) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 34)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'LTFU')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $tothirtynine_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 35) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 39)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'LTFU')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $tofortyfour_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 40) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 44)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'LTFU')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $tofortynine_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 45) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 49)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'LTFU')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $tofifty_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 50) and ((year(curdate()) - year(`tbl_client`.`dob`)) >= 50)) then `tbl_pmtct`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.app_status', '=', 'LTFU')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $tototal_ltfu = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->whereNull('tbl_client.hei_no')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) >=10)) then `tbl_client`.`id` end)) AS count"))
            ->where('tbl_appointment.app_status', '=', 'LTFU')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            // honoured appointments
            $tonine_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 9)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appointment_kept', '=', 'Yes')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $tofourteen_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 10) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 14)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appointment_kept', '=', 'Yes')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $tonineteen_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 15) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 19)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appointment_kept', '=', 'Yes')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $totwentyfour_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
             ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 20) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 24)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appointment_kept', '=', 'Yes')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $totwentynine_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 25) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 29)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appointment_kept', '=', 'Yes')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $tothirtyfour_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 30) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 34)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appointment_kept', '=', 'Yes')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $tothirtynine_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 35) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 39)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appointment_kept', '=', 'Yes')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $tofortyfour_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 40) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 44)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appointment_kept', '=', 'Yes')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $tofortynine_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 45) and ((year(curdate()) - year(`tbl_client`.`dob`)) <= 49)) then `tbl_client`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appointment_kept', '=', 'Yes')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $tofifty_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) >= 50) and ((year(curdate()) - year(`tbl_client`.`dob`)) >= 50)) then `tbl_pmtct`.`id` end)) AS count"))
            ->whereNull('tbl_client.hei_no')
            ->where('tbl_appointment.appointment_kept', '=', 'Yes')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
            ->pluck('count');

            $tototal_honoured = Pmtct::join('tbl_client', 'tbl_client.id', '=', 'tbl_pmtct.client_id')
            ->join('tbl_appointment', 'tbl_client.id', '=', 'tbl_appointment.client_id')
            ->whereNull('tbl_client.hei_no')
            ->select(\DB::raw("count((case when (((year(curdate()) - year(`tbl_client`.`dob`)) > 0) and ((year(curdate()) - year(`tbl_client`.`dob`)) >=10)) then `tbl_client`.`id` end)) AS count"))
            ->where('tbl_appointment.appointment_kept', '=', 'Yes')
            ->whereDate('tbl_appointment.appntmnt_date', '>=', date($request->from))->whereDate('tbl_appointment.appntmnt_date', '<=', date($request->to))
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
}
