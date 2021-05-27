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
use Carbon\Carbon;


class BroadcastController extends Controller
{

    public function broadcast_form()
    {
        $facilities = Facility::all();

        $groups = Group::all();

        $genders = Gender::all();

        $data = array(
            'facilities' => $facilities,
            'groups' => $groups,
            'genders' => $genders
        );

        return view('broadcast.broadcast')->with($data);

    }

    public function sendSMS(Request $request)
    {

        $request->validate([
            'mfl_code' => 'required|exists:tbl_master_facility,code',
            'groups' => 'required',
            'genders' => 'required',
            'message' => 'required'
        ],[
            'mfl_code.exists' => 'Invalid facility ID',
        ]);

        //$groups = $request->groups;

        //foreach($groups as $group_id) {

            $group_id = Group::find($request->groups);

            $gender_id = Gender::find($request->genders);

            //return $gender_id->id;

            // if (is_null($group))
            //     continue;

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
  
        //}

        return ["Sent"];

    }

}
