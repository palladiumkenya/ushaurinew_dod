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
            'mfl_code' => 'required|exsists:facilities,id',
            'group' => 'required',
            'gender' => 'required',
            'message' => 'required'
        ],[
            'facility_id.exsists' => 'Invalid facility ID',
        ]);

        foreach($request['group'] as $group_id) {

            $group = Group::find($group_id);

            if (is_null($group))
                continue;

            $clients = Client::where('mfl_code', $request->$facility_id)->where('group_id', $group_id)->where('gender_id', $gender_id)->get();    

            if ($clients->count() == 0)
                continue;

            foreach ($clients as $client) {

                $dest = $client->phone_no;

                $msg = $request->message;

                $sender = new SenderController;

                $sender->send($dest, $msg);
 
            }    
  
        }

        return ["Sent"];

    }

}
