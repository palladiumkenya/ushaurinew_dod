<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\Unit;
use App\Models\Facility;
use Illuminate\Http\Request;

class DataController extends Controller
{

    public function get_units(Request $request)
    {
        $service_id = $request->service_id;

        $units = Unit::where('service_id', $service_id)->get();

        return $units;

    }

    public function get_facilities(Request $request)
    {
        $unit_id = $request->unit_id;

        $units = Facility::where('unit_id', $unit_id)->get();

        return $units;

    }
    
}
