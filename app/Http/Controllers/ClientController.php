<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Group;
use App\Models\Clinic;
use App\Models\Language;
use App\Models\Gender;
use App\Models\Marital;
use Session;
use Auth;

class ClientController extends Controller
{
    public function index()
    {
        return view('clients.new_client');
    }
    public function add_client(Request $request)
    {
        try
        {
        $new_client = new Client;

        $validate_client = Client::where('clinic_number', $request->clinic_number)
        $new_client->clinic_number = $request->clinic_number;
        $new_client->f_name = $request->first_name;
        $new_client->m_name = $request->middle_name;
        $new_client->l_name = $request->last_name;
        $new_client->dob = $request->birth;
        $new_client->gender = $request->gender;
        $new_client->marital = $request->marital;
        $new_client->client_status = $request->treatment;
        $new_client->enrollment_date = date("Y-m-d", strtotime($request->enrollment_date));
        $new_client->art_date = date("Y-m-d", strtotime($request->art_date));
        $new_client->phone_no = $request->phone;
        $new_client->language_id = $request->language;
        $new_client->smsenable = $request->smsenable;
        $new_client->motivational_enable = $request->motivational_enable;
        $new_client->txt_time = date("H", strtotime($request->txt_time));
        $new_client->status = $request->status;
        $new_client->group_id = $request->group;

        $validate_ccc = Client::where('clinic_number', $request->clinic_number)
        ->first();

        if ($validate_ccc) {
            Session::flash('statuscode', 'error');

            return redirect('add/client')->with('status', 'Clinic Number already exist in the system!');
        }
        if ($new_client->save()) {
            Session::flash('statuscode', 'success');

            return redirect('Reports/facility_home')->with('status', 'Client has been registered successfully!');
        } else {
            Session::flash('statuscode', 'error');
            return back()->with('error', 'An error has occurred please try again later.');
        }
    } catch (Exception $e) {
        toastr()->error('An error has occurred please try again later.');

        return back();
    }
    }
}
