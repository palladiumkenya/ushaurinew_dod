<?php

namespace App\Http\Controllers;
use App\Models\Client;
use App\Models\Consent;
use Session;

use Illuminate\Http\Request;
use Auth;
use DB;

class ConsentController extends Controller
{
    public function index()
    {

            if (Auth::user()->access_level == 'Facility') {
                $consented_clients = Client::join('tbl_groups', 'tbl_groups.id', 'tbl_client.group_id')
                ->select('tbl_client.clinic_number', 'tbl_client.file_no', DB::raw("CONCAT(`tbl_client`.`f_name`, ' ', `tbl_client`.`m_name`, ' ', `tbl_client`.`l_name`) as full_name"),'tbl_client.phone_no', 'tbl_client.dob', 'tbl_client.client_status', 'tbl_groups.name', 'tbl_client.created_at', 'tbl_client.smsenable', 'tbl_client.enrollment_date', 'tbl_client.art_date', 'tbl_client.updated_at', 'tbl_client.status', 'tbl_client.consent_date', 'tbl_client.txt_time')
                ->whereNull('tbl_client.consent_date')
                ->where('tbl_client.mfl_code', Auth::user()->facility_id)
                ->get();
            }
            return view('clients.consent')->with('consented_clients', $consented_clients);

    }
    public function addconsentform()
    {
        return view('clients.addconsent');
    }
    public function client_consent(Request $request)
    {

        try {
            $client = Client::find($request->cid);
            if (!empty($request->clinic_number)) {
                $client->clinic_number = $request->clinic_number;
            }
                $client->consent_date = date("Y-m-d", strtotime($request->consent_date));
                $client->smsenable = $request->smsenable;
                $client->language_id = $request->language_id;
                $client->motivational_enable = $request->motivational_enable;
                $client->txt_time = date("Y-m-d", strtotime($request->txt_time));
                $client->phone_no = $request->phone_no;


            $client->updated_at = date('Y-m-d H:i:s');

            if ($client->save()) {
                toastr()->success('Client was successfully consented in the system!');

                return redirect()->route('consent-clients');
            } else {
                toastr()->error('Could not consent client please try again later.');

                return back();
            }
        } catch (Exception $e) {
            toastr()->error('An error has occurred please try again later.');

            return back();
        }
    }

    public function consent_test(Request $request)
    {
        try {
        $client = Client::where('clinic_number', $request->clinic_number)
                 ->update([
                     'consent_date' => date("Y-m-d", strtotime($request->consent_date)),
                     'smsenable' => $request->smsenable,
                     'language_id' => $request->language_id,
                     'motivational_enable' => $request->motivational_enable,
                     'txt_time' => date("H", strtotime($request->txt_time)),
                     'phone_no' => $request->phone_no,

                 ]);
                 if ($client) {
                     Session::flash('statuscode', 'success');
                    return redirect('consent/clients')->with('status', 'Client was successfully consented in the system!');
                } else {
                    Session::flash('statuscode', 'error');
                    return back()->with('error', 'Could not consent client please try again later.');
                }
            } catch (Exception $e) {
                return back();
            }

    }
}
