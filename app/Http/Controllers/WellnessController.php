<?php

namespace App\Http\Controllers;

ini_set('max_execution_time', 0);
ini_set('memory_limit', '1024M');

use Illuminate\Http\Request;

use\App\Models\Client;
use\App\Models\Group;
use\App\Models\Ok;
use\App\Models\NotOk;
use\App\Models\Unrecognised;

class WellnessController extends Controller
{
    public function get_ok_clients()
    {

    }

    public function get_not_ok_clients()
    {

    }

    public function get_unrecoginised_clients()
    {

    }
}
