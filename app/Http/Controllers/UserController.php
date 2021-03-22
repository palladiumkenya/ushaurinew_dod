<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clinic;
use App\Models\User;
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
}
