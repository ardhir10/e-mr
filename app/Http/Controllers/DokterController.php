<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class DokterController extends Controller
{
    public function index()
    {
        $data['page_title'] = "List Dokter";

        $QUERY = "select	fs_kd_peg fs_kd_dokter ,
		fs_nm_peg fs_dokter
        from	td_peg
        where	fn_profesi_medis in (0,1,2)
        and		FB_SUDAH_RESIGN = 0
        order	by fs_nm_peg";
        $data['dokter'] = DB::select($QUERY);
        return view('master-data.dokter.index', $data);
    }
}
