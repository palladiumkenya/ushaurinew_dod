<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donor;

class DonorController extends Controller
{
    public function index()
    {
        $all_donor = Donor::all();

        return view('donor.donor')->with('all_donor', $all_donor);
    }
}
