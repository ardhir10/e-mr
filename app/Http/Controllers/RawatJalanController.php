<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RawatJalanController extends Controller
{
    public function index()
    {
        $data['page_title'] = "List Pasien Rawat Jalan";

        $QUERY_DOKTER = "select	fs_kd_peg fs_kd_dokter , 
		fs_nm_peg fs_dokter 
        from	td_peg
        where	fn_profesi_medis in (0,1,2)
        and		FB_SUDAH_RESIGN = 0
        order	by fs_nm_peg";
        $data['dokter'] = DB::select($QUERY_DOKTER);

        $QUERY_RAWAT_JALAN = "select	aa.fd_tgl_masuk, aa.fs_kd_reg, aa.fs_mr, 
		FS_NM_PASIEN, bb.FB_JNS_KELAMIN, '' fn_umur, 
		fs_nm_layanan, fs_nm_peg fs_dokter, fs_nm_jaminan 	 
        from	TA_REGISTRASI aa
        inner	join tc_mr bb on aa.fs_mr = bb.fs_mr
        inner	join TA_LAYANAN cc on aa.fs_kd_layanan = cc.fs_kd_layanan
        inner	join ta_jaminan dd on aa.fs_kd_jaminan = dd.fs_kd_jaminan 
        inner	join td_peg ee on aa.fs_kd_medis = ee.fs_kd_peg
        inner	join TA_INSTALASI ff on cc.FS_KD_INSTALASI = ff.FS_KD_INSTALASI
        where	aa.fd_tgl_void = '3000-01-01'
        and		fd_tgl_masuk between '2021-09-10' and '2021-09-10'
        and		ff.FS_KD_INSTALASI_DK in (1,2,4)";
        $data['rawat_jalan'] = DB::select($QUERY_RAWAT_JALAN);
        return view('rawat-jalan.index', $data);
    }
}
