<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Dcm;
use Carbon\Carbon;

class DcmReportController extends Controller
{
    //
    public function get_dfc_clients()
    {
        $data = [];

        $all_clients_duration_less_well = Dcm::where('duration_less', '=', 'Well');
        $all_clients_duration_less_advanced = Dcm::where('duration_less', '=', 'Advanced');
        $all_clients_duration_more_unstable = Dcm::where('duration_more', '=', 'Unstable');
        $all_clients_duration_more_stable = Dcm::where('duration_more', '=', 'Stable');
        $all_clients_stsbility_status_on = Dcm::where('stability_status', '=', 'DCM');
        $all_clients_stability_status_not = Dcm::where('stability_status', '=', 'NotDCM');
        $all_clients_clinical_app = Dcm::whereNotNull('clinical_visit_date');
        $all_clients_refill_app = Dcm::whereNotNull('refill_date');
        $all_clients_facility_based = Dcm::whereNotNull('facility_based');
        $all_clients_community_based = Dcm::whereNotNull('community_based');

        $data['all_clients_duration_less_well'] = $all_clients_duration_less_well->get();
        $data['all_clients_duration_less_advanced'] = $all_clients_duration_less_advanced->get();
        $data['all_clients_duration_more_unstable'] = $all_clients_duration_more_unstable->get();
        $data['all_clients_duration_more_stable'] = $all_clients_duration_more_stable->get();
        $data['all_clients_stability_status_on'] = $all_clients_stsbility_status_on->get();
        $data['all_clients_stability_status_not'] = $all_clients_stability_status_not->get();
        $data['all_clients_clinical_app'] = $all_clients_clinical_app->get();
        $data['all_clients_refill_app'] = $all_clients_refill_app->get();
        $data['all_clients_facility_based'] = $all_clients_facility_based->get();
        $data['all_clients_community_based'] = $all_clients_community_based->get();


        return $data;
    }
}
