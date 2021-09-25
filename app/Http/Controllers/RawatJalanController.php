<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RawatJalanController extends Controller
{
    public function index()
    {
        $data['page_title'] = "List Pasien Rawat Jalan";
        return view('rawat-jalan.index', $data);
    }
}
