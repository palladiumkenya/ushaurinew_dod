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
        $all_ok_clients = Ok::join('tbl_client', 'tbl_client.id', '=', 'tbl_ok.client_id')
        ->join('tbl_groups', 'tbl_groups.id', 'tbl_client.group_id')
        ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_client.phone_no, tbl_groups.name, tbl_client.client_status, tbl_ok.msg, tbl_ok.created_at');

        return view('wellness.ok_clients')->with('all_ok_clients', $all_ok_clients->get());

    }

    public function get_not_ok_clients()
    {
        $all_not_ok_clients = NotOk::join('tbl_client', 'tbl_client.id', '=', 'tbl_not_ok.client_id')
        ->join('tbl_groups', 'tbl_groups.id', 'tbl_client.group_id')
        ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_client.phone_no, tbl_groups.name, tbl_client.client_status, tbl_not_ok.msg, tbl_not_ok.created_at');

        return view('wellness.not_ok_clients')->with('all_not_ok_clients', $all_not_ok_clients->get());
    }

    public function get_unrecoginised_clients()
    {
        $all_unrecognised_clients = Unrecognised::join('tbl_client', 'tbl_client.id', '=', 'tbl_unrecognised.client_id')
        ->join('tbl_groups', 'tbl_groups.id', 'tbl_client.group_id')
        ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_client.phone_no, tbl_groups.name, tbl_client.client_status, tbl_unrecognised.msg, tbl_unrecognised.created_at');

        return view('wellness.unrecognised_response')->with('all_unrecognised_clients', $all_unrecognised_clients->get());
    }
}
