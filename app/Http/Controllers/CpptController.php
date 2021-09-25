<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CpptController extends Controller
{
    public function create(){
        $data['page_title'] = "Tambah Catatan SOAP";
        return view('cppt.create', $data);
    }
}
