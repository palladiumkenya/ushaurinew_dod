<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facility;
use App\Models\County;
use App\Models\Partner;
use App\Models\SubCounty;
use App\Models\PartnerFacility;
use Auth;

class FacilityController extends Controller
{
    public function admin_facilities()
    {
        $admin_facilities = Facility::join('tbl_county', 'tbl_master_facility.county_id', '=', 'tbl_county.id')
            ->join('tbl_sub_county', 'tbl_master_facility.Sub_County_ID', '=', 'tbl_sub_county.id')
            ->join('tbl_consituency', 'tbl_master_facility.consituency_id', '=', 'tbl_consituency.id')
            ->select(
                'tbl_master_facility.name as facility_name',
                'tbl_master_facility.code',
                'tbl_master_facility.owner',
                'tbl_county.name as county_name',
                'tbl_sub_county.name as sub_county_name',
                'tbl_consituency.name as consituency_name',
                'tbl_master_facility.facility_type',
                'tbl_master_facility.keph_level as level'
            )
            ->where('tbl_master_facility.assigned', '=', '0')
            ->get();

        $all_partners = Partner::all()->where('status', '=', 'Active');

        return view('facilities.admin_facilities', compact('admin_facilities', 'all_partners'));
    }
    public function add_facility(Request $request)
    {
        try{
            $facility = new PartnerFacility;

            $facility->mfl_code = $request->mfl_code;
            $facility->status = 'Active';
            $facility->partner_id = $request->partner;


        }catch(Exception $e)
        {

        }
    }
    public function my_facility()
    {
        $facilities = Facility::join('tbl_county', 'tbl_master_facility.county_id', '=', 'tbl_county.id')
        ->join('tbl_sub_county', 'tbl_master_facility.Sub_County_ID', '=', 'tbl_sub_county.id')
        ->join('tbl_partner_facility', 'tbl_master_facility.code', '=', 'tbl_partner_facility.mfl_code')
        ->join('tbl_consituency', 'tbl_master_facility.consituency_id', '=', 'tbl_consituency.id')
        ->select(
            'tbl_master_facility.name as facility_name',
            'tbl_master_facility.code',
            'tbl_master_facility.owner',
            'tbl_county.name as county_name',
            'tbl_sub_county.name as sub_county_name',
            'tbl_consituency.name as consituency_name',
            'tbl_master_facility.facility_type',
            'tbl_master_facility.keph_level as level'
        )
        ->get();
        return view('facilities.my_facilities', compact('facilities'));
    }
}
