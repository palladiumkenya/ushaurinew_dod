<?php
namespace App\Http\Controllers;

date_default_timezone_set('Africa/Nairobi');
ini_set('max_execution_time', 0);
ini_set('memory_limit', '1024M');
use Illuminate\Http\Request;
use App\Http\Controllers\SenderController;
use App\Models\Client;
use App\Models\Group;
use App\Models\Gender;
use App\Models\Facility;
use App\Models\PartnerFacility;
use Carbon\Carbon;
use Auth;


class BroadcastController extends Controller
{

    public function broadcast_form()
    {
        $facilities = Facility::all();

        $u_facilities = Facility::where('code', Auth::user()->facility_id)->get();

        $p_facilities = PartnerFacility::where('partner_id', Auth::user()->partner_id);

        $groups = Group::all();

        $genders = Gender::all();

        $data = array(
            'facilities' => $facilities,
            'groups' => $groups,
            'genders' => $genders
        );

        $p_data = array(
            'facilities' => $p_facilities,
            'groups' => $groups,
            'genders' => $genders
        );

        $u_data = array(
            'facilities' => $u_facilities,
            'groups' => $groups,
            'genders' => $genders
        );

        if (Auth::user()->access_level == 'Facility') {

            return view('broadcast.facility_broadcast')->with($u_data); 

        } else if(Auth::user()->access_level == 'Partner') {

            return view('broadcast.broadcast')->with($p_data); 

        } else if(Auth::user()->access_level == 'Admin') {

            return view('broadcast.broadcast')->with($data); 

        }

    }

    public function sendSMS(Request $request)
    {

        if (Auth::user()->access_level == 'Facility') {

            $request->validate([
                'groups' => 'required',
                'genders' => 'required',
                'message' => 'required'
            ]);

            $facility = Facility::where('code', Auth::user()->facility_id)->get();
        
            foreach($request['groups'] as $group_id) {
    
                $group = Group::find($group_id);
    
                if (is_null($group))
                    continue;

                foreach($request['genders'] as $gender_id) { 

                    $gender = Gender::find($gender_id);
                    
                    $clients = Client::where('mfl_code', $facility)->where('group_id', '=', $group->id)->where('gender', $gender->id)->get();     
                
                    if ($clients->count() == 0)
                        continue;
    
                    return $clients;
        
                    foreach ($clients as $client) {
        
                        $dest = $client->phone_no;
        
                        $msg = $request->message;
        
                        $sender = new SenderController;
        
                        $sender->send($dest, $msg);
        
                    }    
        
                }
    
            }

            return back();

        } else if (Auth::user()->access_level == 'Partner') {

            $request->validate([
                'mfl_code' => 'required|exists:tbl_partner_facility,code',
                'groups' => 'required',
                'genders' => 'required',
                'message' => 'required'
            ],[
                'mfl_code.exists' => 'Invalid facility ID',
            ]);
        
            foreach($request['groups'] as $group_id) {
    
                $group = Group::find($groups_id);
            
                if (is_null($group))
                    continue;
    
                $clients = Client::where('mfl_code', $request->mfl_code)
                                ->where(function($query) use ($gender_id,$group_id) {
                                        $query->where('gender', '=', $gender_id->id)
                                        ->orWhere('group_id', '=', $group_id->id);
                                })->get(); 
                
                // if ($clients->count() == 0)
                //     continue;
    
                //return $clients;
    
                foreach ($clients as $client) {
    
                    $dest = $client->phone_no;
    
                    $msg = $request->message;
    
                    $sender = new SenderController;
    
                    $sender->send($dest, $msg);
     
                }    
      
            }
    
            return back();


        } else if(Auth::user()->access_level == 'Admin') {

            $request->validate([
                'groups' => 'required',
                'genders' => 'required',
                'message' => 'required'
            ]);
        
            foreach($request['groups'] as $group_id) {

                $group = Group::find($group_id);
        
                if (is_null($group))
                    continue;

                foreach($request['genders'] as $gender_id) { 

                    $gender = Gender::find($gender_id);
                    
                    $clients = Client::where('group_id', '=', $group->id)->where('gender', $gender->id)->get(); 
                
                    if ($clients->count() == 0)
                        continue;
            
                    foreach ($clients as $client) {
        
                        $dest = $client->phone_no;
        
                        $msg = $request->message;
        
                        $sender = new SenderController;
        
                        $sender->send($dest, $msg);
        
                    }   

                }   
                  
            }

            return back();

        }    

    }

}
