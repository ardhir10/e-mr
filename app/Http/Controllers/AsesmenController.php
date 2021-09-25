<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AsesmenController extends Controller
{
    public function awalDewasaPerawat(){
        $data['page_title'] = "Asesmen Awal Rawat Jalan";
        return view('asesmen.awal-dewasa-perawat', $data);

    }
}
