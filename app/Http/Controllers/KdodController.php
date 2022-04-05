<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KdodNumber;
use Illuminate\Support\Facades\Http;
use Auth;
use Session;

class KdodController extends Controller
{
    // public function available_kdod()
    // {
    //     $id = Auth::user()->facility_id;
    //     $available_kdod = Http::get('https://ushauri-api.mod.go.ke/kdod/$id');

    //     $responseBody = json_decode($available_kdod->getBody());
    // }
    public function unassigned_kdod()
    {
        $data = [];
        $id = Auth::user()->facility_id;
        $unassigned_kdod = Http::get("https://ushauri-api.mod.go.ke/kdod/pkdod/{$id}");
        $unassigned_result = json_decode($unassigned_kdod->getBody());

        $available_kdod = Http::get("https://ushauri-api.mod.go.ke/kdod/{$id}");
        $availableResult = json_decode($available_kdod->getBody());
        if (is_null($unassigned_result)) {
            $data["unassigned_result_null"]         = $unassigned_result->kdod_num;
        } else {
            $data["unassigned_result"]         = $unassigned_result->kdod_num;

            $data["unassigned_result_kdod"]         = $unassigned_result->kdod_num;
        }



        foreach ($availableResult as $resultKdod) {

            $data["resultKdod"]         = $resultKdod->kdod_num;
        }
        return $data;
    }
    public function update_kdod(Request $request)
    {
        $id = $request->resultKdod;
        $id = Auth::user()->facility_id;
        $unassigned_kdod = Http::get("https://ushauri-api.mod.go.ke/kdod/pkdod/{$id}");
        $unassigned_result = json_decode($unassigned_kdod->getBody());

        $kdod_num = $unassigned_result->kdod_num;
        //dd($kdod_num);
        $assign = Http::post("https://ushauri-api.mod.go.ke/kdod/ukdod/{$kdod_num}");
        $body = $assign->body();
        if ($body) {
            Session::flash('statuscode', 'success');

            return redirect('Reports/facility_home')->with('status', $body);
        } else {

            return back()->with('error', 'An error has occurred please try again later.');
        }
        return $body;
    }
}
