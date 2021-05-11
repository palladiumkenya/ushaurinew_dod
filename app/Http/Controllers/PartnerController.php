<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partner;

class PartnerController extends Controller
{
    public function index()
    {
        $all_partners = Partner::join('tbl_partner_type', 'tbl_partner.partner_type_id', '=', 'tbl_partner_type.id')
        ->select('tbl_partner.name as partner_name', 'tbl_partner.phone_no', 'tbl_partner.e_mail', 'tbl_partner.location', 'tbl_partner.status', 'tbl_partner.created_at', 'tbl_partner.updated_at', 'tbl_partner_type.name as partner_type')
        ->get();

        return view('partner.partner')->with('all_partners', $all_partners);
    }
}
