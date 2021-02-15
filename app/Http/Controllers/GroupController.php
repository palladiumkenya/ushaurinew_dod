<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Group;

class GroupController extends Controller
{
    public function get_pmtct_clients()
    {
        $all_pmtct_clients = Client::join('tbl_groups', 'tbl_group.id', '=', 'tbl_client.group_id')
        ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_client.client_status, tbl_client.phone_no, tbl_client.enrollment_date, tbl_groups.name')
        ->where('tbl_groups.name', '=', 'PMTCT');

        return view('clients.pmtct_clients')->with('all_pmtct_clients', $all_pmtct_clients->get());
    }

    public function get_psc_clients()
    {
        $all_psc_clients = Client::join('tbl_groups', 'tbl_group.id', '=', 'tbl_client.group_id')
        ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_client.client_status, tbl_client.phone_no, tbl_client.enrollment_date, tbl_groups.name')
        ->where('tbl_groups.name', '=', 'PSC');

        return view('clients.pmtct_clients')->with('all_psc_clients', $all_psc_clients->get());
    }

    public function get_adolescents_clients()
    {
        $all_adolescents_clients = Client::join('tbl_groups', 'tbl_group.id', '=', 'tbl_client.group_id')
        ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_client.client_status, tbl_client.phone_no, tbl_client.enrollment_date, tbl_groups.name')
        ->where('tbl_groups.name', '=', 'Adoscescents');

        return view('clients.pmtct_clients')->with('all_adolescents_clients', $all_adolescents_clients->get());
    }

    public function get_paeds_clients()
    {
        $all_paeds_clients = Client::join('tbl_groups', 'tbl_group.id', '=', 'tbl_client.group_id')
        ->selectRaw('tbl_client.clinic_number, tbl_client.f_name, tbl_client.m_name, tbl_client.l_name, tbl_client.client_status, tbl_client.phone_no, tbl_client.enrollment_date, tbl_groups.name')
        ->where('tbl_groups.name', '=', 'Paeds');

        return view('clients.pmtct_clients')->with('all_paeds_clients', $all_paeds_clients->get());
    }

}
