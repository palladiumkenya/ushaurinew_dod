<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clinic;
use App\Models\User;
use App\Models\Client;
use App\Models\AccessLevel;
use App\Models\Facility;
use App\Models\Donor;
use App\Models\Partner;
use App\Models\County;
use App\Models\Role;
use App\Models\SubCounty;
use App\Models\PartnerFacility;
use Auth;
use DB;

class UserController extends Controller
{
    //
    public function showUsers()
    {
        $all_users = User::join('tbl_clinic', 'tbl_clinic.id', '=', 'tbl_users.clinic_id')
        ->select(DB::raw("CONCAT(`tbl_users`.`f_name`, ' ', `tbl_users`.`m_name`, ' ', `tbl_users`.`l_name`) as user_name"), 'tbl_users.dob', 'tbl_users.phone_no', 'tbl_users.e_mail', 'tbl_users.access_level', 'tbl_users.status', 'tbl_users.created_at', 'tbl_users.updated_at', 'tbl_clinic.name AS clinic_name');

        $data = array(
            'all_users' =>$all_users->get(),
        );
        return view('users.users')->with($data);
    }

    public function adduserform(Request $request)
    {
        $partners = Partner::all();
        $donors = Donor::all();
        $facilities = PartnerFacility::join('tbl_master_facility', 'tbl_partner_facility.mfl_code', '=', 'tbl_master_facility.code')
        ->select('tbl_partner_facility.id', 'tbl_master_facility.name', 'tbl_partner_facility.mfl_code as code')
        ->orderBy('tbl_master_facility.name', 'asc')
       // ->where('tbl_partner_facility.mfl_code', '=', 'tbl_master_facility.code')
        ->get();
        $counties = County::all();
        $clinics = Clinic::all();
        $roles = Role::all()->where('status', '=', 'Active');
        $sub_counties = SubCounty::all();
        $access_level = AccessLevel::all()->where('status', '=', 'Active');
        $clients = Client::select('tbl_client.ccc_number', 'tbl_clinic.name')
        ->join('tbl_clinic', 'tbl_client.clinic_id', '=', 'tbl_clinic.id')
        ->get();




        $data = array(
            'facilities' => $facilities,
            'counties' => $counties,
            'donors' => $donors,
            'partners' => $partners,
            'sub_counties' => $sub_counties,
            'access_level' => $access_level,
            'roles' => $roles,
            'clinics' => $clinics,
        );

       // dd($facilities);

        return view('users.adduser')->with($data);

    }

    public function access_level_load(Request $request)
{
    $select = $request->get('select');
    $value = $request->get('value');
    $dependant = $dependant->get('value');

    $level = Role::where($select, $value)
    ->groupBy($dependant).'</option>'
    ->get();

    $ouput = '<option value="">Select '.ucfirst($dependant).'</option>';
    foreach ($level as $row)
    {
        $ouput .= '<option value="'.$row->dependant.'">'.$row->dependant.'</option>';
    }
    echo $ouput;
}
}
