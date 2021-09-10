<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rank;
use Session;

class RankController extends Controller
{
    public function index()
    {
        $all_rank = Rank::all()->where('status', '=', 'Active');

        return view('ranks.rank', compact('all_rank'));
    }

    public function addRank(Request $request)
    {
        try {
            $rank = new Rank;

            $rank->rank_name = $request->rank_name;
            $rank->status = $request->status;


            // $donor->created_by = Auth::;

            if ($rank->save()) {
                Session::flash('statuscode', 'success');

                return redirect('admin/ranks')->with('status', 'Rank has been saved successfully!');
            } else {

                Session::flash('statuscode', 'error');
                return back()->with('error', 'An error has occurred please try again later.');
            }
        } catch (Exception $e) {
            Session::flash('statuscode', 'error');
            return back()->with('error', 'An error has occurred please try again later.');
        }
    }
    public function editRank(Request $request)
    {
    }
    public function deleteRank(Request $request)
    {
    }
}
