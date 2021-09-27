<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
    public function index(){

        $data['total_rekam_medis'] = DB::select('select count(fs_mr) as jrm from tc_mr')[0];
        $data['total_rawat_jalan'] = DB::select("
        select	aa.fd_tgl_masuk, aa.fs_kd_reg, aa.fs_mr, 
		FS_NM_PASIEN, bb.FB_JNS_KELAMIN, '' fn_umur, 
		fs_nm_layanan, fs_nm_peg fs_dokter, fs_nm_jaminan 	 
        from	TA_REGISTRASI aa
        inner	join tc_mr bb on aa.fs_mr = bb.fs_mr
        inner	join TA_LAYANAN cc on aa.fs_kd_layanan = cc.fs_kd_layanan
        inner	join ta_jaminan dd on aa.fs_kd_jaminan = dd.fs_kd_jaminan 
        inner	join td_peg ee on aa.fs_kd_medis = ee.fs_kd_peg
        inner	join TA_INSTALASI ff on cc.FS_KD_INSTALASI = ff.FS_KD_INSTALASI
        where	aa.fd_tgl_void = '3000-01-01'
        and		ff.FS_KD_INSTALASI_DK in (1,2,4)");
        $data['total_rawat_inap'] = DB::select("
        select	aa.fd_tgl_masuk, aa.fs_kd_reg, aa.fs_mr, 
		FS_NM_PASIEN, bb.FB_JNS_KELAMIN, '' fn_umur, 
		fs_nm_layanan, fs_nm_peg fs_dokter, fs_nm_jaminan, 
		FD_TGL_KELUAR = case FD_TGL_KELUAR
		when '3000-01-01' then ''
		else	FD_TGL_KELUAR end 
        from	TA_REGISTRASI aa
        inner	join tc_mr bb on aa.fs_mr = bb.fs_mr
        inner	join TA_LAYANAN cc on aa.fs_kd_layanan = cc.fs_kd_layanan
        inner	join ta_jaminan dd on aa.fs_kd_jaminan = dd.fs_kd_jaminan 
        inner	join td_peg ee on aa.fs_kd_medis = ee.fs_kd_peg
        inner	join TA_INSTALASI ff on cc.FS_KD_INSTALASI = ff.FS_KD_INSTALASI
        where	aa.fd_tgl_void = '3000-01-01'
        and		ff.FS_KD_INSTALASI_DK in (3)");
        return view('dashboard.index',$data);
    }
}
