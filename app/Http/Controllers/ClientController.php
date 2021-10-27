<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Group;
use App\Models\Clinic;
use App\Models\Language;
use App\Models\Condition;
use App\Models\Gender;
use App\Models\Marital;
use App\Models\Transit;
use App\Models\Partner;
use App\Models\Unit;
use Illuminate\Support\Facades\Validator;
use Session;
use Auth;

class ClientController extends Controller
{
    public function index()
    {
        $gender = Gender::all();
        $marital = Marital::all();
        $treatment = Condition::all();
        $grouping = Group::all();
        $clinics = Clinic::all();
        $services = Partner::all();
        $units = Unit::all();
        $language = Language::all()->where('status', '=', 'Active');
        return view('clients.new_client', compact('gender', 'marital', 'clinics', 'treatment', 'language', 'grouping', 'services', 'units'));
    }
    public function add_client(Request $request)
    {
        try
        {
            $validator = Validator::make($request->all(), [
                // 'clinic_number' => 'required|numeric|digits:10',
                'f_name' => 'required',
                'l_name' => 'required',
                'dob' => 'required',
                'gender' => 'required',
                'marital' => 'required',
                'client_status' => 'required',
                'enrollment_date' => 'required',
                'art_date' => 'required',
                'language_id' => 'required',
                'smsenable' => 'required',
                'motivational_enable' => 'required',
                'txt_time' => 'required',
                'status' => 'required',
                'group_id' => 'required',
            ]);

            if($validator->fails()) {
                return Redirect::back()->withErrors($validator);
            }

            $new_client = new Client;

            $new_client->file_no = $request->service_number;
            $new_client->f_name = $request->f_name;
            $new_client->m_name = $request->m_name;
            $new_client->l_name = $request->l_name;
            $new_client->dob = $request->dob;
            $new_client->gender = $request->gender;
            $new_client->marital = $request->marital;
            $new_client->client_status = $request->treatment;
            $new_client->enrollment_date = date("Y-m-d", strtotime($request->enrollment_date));
            $new_client->art_date = date("Y-m-d", strtotime($request->art_date));
            $new_client->phone_no = $request->phone;
            $new_client->language_id = $request->language_id;
            $new_client->smsenable = $request->smsenable;
            $new_client->motivational_enable = $request->motivational_enable;
            $new_client->txt_time = date("H", strtotime($request->txt_time));
            $new_client->status = $request->status;
            $new_client->group_id = $request->group_id;
            $new_client->clinic_id = $request->clinic;
            $new_client->mfl_code = $request->facility;
            $new_client->facility_id = $request->facility;

            // return $validate_ccc = Client::where('clinic_number', $request->clinic_number)->first();

            // if ($validate_ccc) {

            //     return 'Clinic Number already exist in the system!';
            //     Session::flash('statuscode', 'error');

            //     return redirect('add/client')->with('status', 'Kdod Number already exist in the system!');
            // }
            if ($new_client->save()) {
                $new_client->clinic_number = $new_client->id;
                Session::flash('statuscode', 'success');

                return redirect('Reports/facility_home')->with('status', 'Client has been registered successfully!');
            } else {

                Session::flash('statuscode', 'error');
                return back()->with('error', 'An error has occurred please try again later.');
            }
        } catch (Exception $e) {

            Session::flash('statuscode', 'error');
            return back()->with('error', 'An error has occurred please try again later.');
        }
    }
    public function transit_client(Request $request)
    {

        $all_transit = Transit::all();

        return view('clients.transit_client', compact('all_transit'));
    }
}
