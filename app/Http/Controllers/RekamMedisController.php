<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RekamMedisController extends Controller
{
    public function index(){
        $data['page_title'] = "Pencarian Rekam Medis Pasien";
        return view('rekam-medis.index',$data);
    }

    public function detail(){
        $data['page_title'] = "Rekam Medis Pasien";
        return view('rekam-medis.detail', $data);
    }
}
