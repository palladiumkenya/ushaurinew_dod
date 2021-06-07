<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donor;
use Auth;
use PhpParser\Node\Stmt\TryCatch;
use Session;

class DonorController extends Controller
{
    public function index()
    {
        $all_donor = Donor::all();

        return view('donor.donors')->with('all_donor', $all_donor);
    }

    public function adddonorform()
    {
        return view('donor.adddonor');
    }

    public function adddonor(Request $request)
    {
        try {
            $donor = new Donor;
            $validate = Donor::where('phone_no', $request->phone)
                ->first();

            if ($validate) {
                Session::flash('statuscode', 'error');

                return redirect('admin/donors/form')->with('status', 'Phone Number is already used in the system!');
            }

            $donor->name = $request->name;
            $donor->description = $request->description;
            $donor->phone_no = $request->phone;
            $donor->e_mail = $request->email;
            $donor->status = $request->status;


            // $donor->created_by = Auth::;

            if ($donor->save()) {
                Session::flash('statuscode', 'success');

                return redirect('admin/donors')->with('status', 'Donor has been saved successfully!');
            } else {

                Session::flash('statuscode', 'error');
                return back()->with('error', 'An error has occurred please try again later.');
            }
        } catch (Exception $e) {
            Session::flash('statuscode', 'error');
            return back()->with('error', 'An error has occurred please try again later.');
        }
    }
    public function editdonor(Request $request)
    {
        try {
            $donor = Donor::where('id', $request->id)
                ->update([
                    'name' => $request->name,
                    'description' => $request->description,
                    'phone_no' => $request->phone,
                    'e_mail' => $request->email,
                    'status' => $request->status,
                ]);
            if ($donor) {
                Session::flash('statuscode', 'success');
                return redirect('admin/donors')->with('status', 'Donor was successfully Updated in the system!');
            } else {
                Session::flash('statuscode', 'error');
                return back()->with('error', 'Could not update donor please try again later.');
            }
        } catch (Exception $e) {
            return back();
        }
    }

    public function deletedonor(Request $request)
    {
        try {
            $donor = Donor::find($request->id);
            // $donor->update_at = date('Y-m-d H:i:s');
            if ($donor->save()) {

                return response(['status' => 'success', 'details' => 'Donor has been deleted successfully']);
            } else {
                return response(['status' => 'error', 'details' => 'An error has occurred please try again later.']);
            }
        } catch (Exception $e) {
        }
    }
}
