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


        // $dataChartRJ =DB::select("select	 COUNT(aa.fd_tgl_masuk) as jumlah,aa.FD_TGL_MASUK
        // from	TA_REGISTRASI aa

        // inner	join TA_LAYANAN cc on aa.fs_kd_layanan = cc.fs_kd_layanan
        // inner	join TA_INSTALASI ff on cc.FS_KD_INSTALASI = ff.FS_KD_INSTALASI
        // where	aa.fd_tgl_void = '3000-01-01'
        // and		fd_tgl_masuk between '" . date('Y') . "-01' and '" . date('Y') . "-12'
        // and		ff.FS_KD_INSTALASI_DK in (1,2,4)
        // GROUP BY FD_TGL_MASUK");
        // $tstampRJ = [];
        // $dataSeriesRJ = [];

        // foreach ($dataChartRJ as $key => $value) {
        //     $tstampRJ[] = $value->FD_TGL_MASUK;
        //     $dataSeriesRJ[] = $value->jumlah;
        // }

        // $dataChartRI =DB::select("select	aa.fd_tgl_masuk as tgl,COUNT(aa.fd_tgl_masuk) as jumlah
        // from	TA_REGISTRASI aa
        // inner	join tc_mr bb on aa.fs_mr = bb.fs_mr
        // inner	join TA_LAYANAN cc on aa.fs_kd_layanan = cc.fs_kd_layanan
        // inner	join ta_jaminan dd on aa.fs_kd_jaminan = dd.fs_kd_jaminan
        // inner	join td_peg ee on aa.fs_kd_medis = ee.fs_kd_peg
        // inner	join TA_INSTALASI ff on cc.FS_KD_INSTALASI = ff.FS_KD_INSTALASI
        // where	aa.fd_tgl_void = '3000-01-01'
        // and		fd_tgl_masuk between '" . date('Y') ."-01' and '" . date('Y') . "-12'
        // and		ff.FS_KD_INSTALASI_DK in (3)
        // group by FD_TGL_MASUK");


        // $dataChartRM =DB::select("select count(fs_mr) as jumlah,FD_TGL_MR as tgl from tc_mr where
        // FD_TGL_MR BETWEEN '".date('Y')."-01' and '" . date('Y') . "-12'
        // GROUP by FD_TGL_MR");




        // $data['chart'] = [
        //     'ts' => [
        //         'rm' => array_column($dataChartRM, 'tgl'),
        //         'ri' => array_column($dataChartRI, 'tgl'),
        //         'rj' => $tstampRJ
        //     ],
        //     'series' => [
        //         'rm' => array_column($dataChartRI, 'jumlah'),
        //         'ri' => array_column($dataChartRI, 'jumlah'),
        //         'rj' => $dataSeriesRJ
        //     ],
        // ];


        return view('dashboard.index',$data);
    }
}
