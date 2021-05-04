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
        ->select(DB::raw("CONCAT(`tbl_users`.`f_name`, ' ', `tbl_users`.`m_name`, ' ', `tbl_users`.`l_name`) as user_name"), 'tbl_users.dob', 'tbl_users.phone_no', 'tbl_users.e_mail', 'tbl_users.access_level', 'tbl_users.status', 'tbl_users.created_at', 'tbl_users.updated_at', 'tbl_clinic.name AS clinic_name')
        ->where('tbl_users.status', '=', 'Active');

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
        $clients = Client::select('tbl_client.clinic_number', 'tbl_clinic.name')
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
public function get_roles($id)
    {
        $roles = Role::join('tbl_access_level', 'tbl_role.access_level', '=', 'tbl_access_level.id')
                    ->where("tbl_role.access_level",$id)
                    ->where('tbl_role.status', '=', 'Active')
                    ->pluck("tbl_role.name","tbl_role.id");
        return json_encode($roles);
    }
    public function get_counties($id)
    {
        $counties = PartnerFacility::join('tbl_county', 'tbl_partner_facility.county_id', '=', 'tbl_county.id')
                    ->where("tbl_partner_facility.partner_id",$id)
                    ->pluck("tbl_county.name","tbl_county.id");
        return json_encode($counties);
    }

    public function get_sub_counties($id)
    {
        $subcounties = SubCounty::join('tbl_county', 'tbl_sub_county.county_id', '=', 'tbl_county.id')
                    ->where("tbl_sub_county.county_id",$id)
                    ->pluck("tbl_sub_county.name","tbl_sub_county.id");
        return json_encode($subcounties);
    }

    public function adduser()
{
    try {
        $user = new User;

        $user->f_name = $request->fname;
        $user->l_name = $request->mname;
        $user->l_name = $request->lname;
        $user->email = $request->email;
        $user->phone_no = $request->phone;
        $user->access_level = $request->add_access_level;

        if ($request->add_access_level =='Admin') {
            $user->role_id = $request->rolename;
        }
        if ($request->add_access_level =='Donor') {
            $user->role_id = $request->rolename;
            $user->donor_id = $request->donor;
        }
        if ($request->add_access_level =='County') {
            $user->role_id = $request->rolename;
            $user->county_id = $request->county;
        }
        if ($request->add_access_level =='Partner') {
            $user->role_id = $request->rolename;
            $user->partner_id = $request->partner;
        }
        if ($request->add_access_level =='Sub County') {
            $user->role_id = $request->rolename;
            $user->subcounty_id = $request->sub_county;
        }
        if ($request->add_access_level =='Facility') {
            $user->role_id = $request->rolename;
            $user->facility_id = $request->facilityname;
            $user->clinic_id = $request->clinicname;
        }
        $user->view_client = $request->bio_data;
        $user->rcv_app_list = $request->app_receive;
        $user->daily_report = $request->daily_report;
        $user->weekly_report = $request->weekly_report;
        $user->monthly_report = $request->monthly_report;
        $user->month3_report = $request->month3_report;
        $user->month6_report = $request->month6_report;
        $user->yearly_report = $request->yearly_report;
        $user->password = bcrypt($request->phone);
        $user->first_access = "Yes";
        $user->status = $request->status;


        if ($user->save()) {

            toastr()->success('User has been saved successfully!');

            return redirect()->route('admin-users');
        } else {
            toastr()->error('An error has occurred please try again later.');

            return back();
        }
    } catch (Exception $e) {
        toastr()->error('An error has occurred please try again later.');

        return back();
    }
}
}
