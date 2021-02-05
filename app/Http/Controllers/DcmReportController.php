<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Dsm;

class DcmReportController extends Controller
{
    //
    public function get_dfc_clients()
    {
        $data [];

        $all_clients_duration_less_well = Dsm::where('duration_less', '=', 'Well');
        $all_clients_duration_less_advanced = Dsm::where('duration_less', '=', 'Advanced');
        $all_clients_duration_more_unstable = Dsm::where('duration_more', '=', 'Unstable');
        $all_clients_duration_more_stable = Dsm::where('duration_more', '=', 'Stable');
        $all_clients_stsbility_status_on = Dsm::where('stability_status', '=', 'DCM');
        $all_clients_stability_status_not = Dsm::where('stability_status', '=', 'NotDCM');
        $all_clients_clinical_app = Dsm::whereNotNull('clinical_visit_date');
        $all_clients_refill_app = Dsm::whereNotNull('refill_date');
        $all_clients_facility_based = Dsm::whereNotNull('facility_based');
        $all_clients_community_based = Dsm::whereNotNull('community_based');

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
