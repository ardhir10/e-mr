<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RawatInapController extends Controller
{
    public function index()
    {
        $data['page_title'] = "List Pasien Rawat Inap";
        return view('rawat-inap.index', $data);
    }
}
