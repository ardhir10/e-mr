<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RiwayatLaboratoriumController extends Controller
{
    public function index($no_mr = null){

        $data['page_title'] = '::Info :Hasil Pemeriksaan Laboratorium ::';
        return view('riwayat.laboratorium.index',$data);
    }
}
