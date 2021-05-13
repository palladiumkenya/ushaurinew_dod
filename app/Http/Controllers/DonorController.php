<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donor;
use Auth;
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
        try{
            $donor = new Donor;

            $donor->name = $request->name;
            $donor->description = $request->description;
            $donor->phone_no = $request->phone;
            $donor->e_mail = $request->email;


           // $donor->created_by = Auth::;

            if($donor->save()){
                Session::flash('statuscode', 'success');

                return redirect('admin/donors')->with('status', 'Donor has been saved successfully!');
            }else{

                Session::flash('statuscode', 'error');
                return back()->with('error', 'An error has occurred please try again later.');
            }
        }catch(Exception $e){
            Session::flash('statuscode', 'error');
                return back()->with('error', 'An error has occurred please try again later.');
        }
    }

    public function deletedonor(Request $request)
    {
        try{
            $donor = Donor::find($request->did);
           // $donor->update_at = date('Y-m-d H:i:s');
           if($donor->save()){

            return response(['status' => 'success', 'details' => 'Donor has been deleted successfully']);
        }else{
            return response(['status' => 'error', 'details' => 'An error has occurred please try again later.']);
        }

        }catch(Exception $e){

        }
    }

}
