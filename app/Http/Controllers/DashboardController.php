<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
    public function index(){

        $data['total_rekam_medis'] = DB::select('select count(fs_mr) as jrm from tc_mr')[0];
        $data['total_rawat_jalan'] = DB::select("
        select	aa.fd_tgl_masuk
        from	TA_REGISTRASI aa
        inner	join TA_LAYANAN cc on aa.fs_kd_layanan = cc.fs_kd_layanan
        inner	join TA_INSTALASI ff on cc.FS_KD_INSTALASI = ff.FS_KD_INSTALASI
        where	aa.fd_tgl_void = '3000-01-01'
        and		ff.FS_KD_INSTALASI_DK in (1,2,4)");
        $data['total_rawat_inap'] = DB::select("
        select	aa.fd_tgl_masuk 
        from	TA_REGISTRASI aa
        inner	join TA_LAYANAN cc on aa.fs_kd_layanan = cc.fs_kd_layanan
        inner	join TA_INSTALASI ff on cc.FS_KD_INSTALASI = ff.FS_KD_INSTALASI
        where	aa.fd_tgl_void = '3000-01-01'
        and		ff.FS_KD_INSTALASI_DK in (3)");
        return view('dashboard.index',$data);
    }
}
