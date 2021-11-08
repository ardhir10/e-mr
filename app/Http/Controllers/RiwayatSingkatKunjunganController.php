<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;
class RiwayatSingkatKunjunganController extends Controller
{
    public function index(Request $request)
    {
        $no_mr = null;
        $namaPasien = null;

        $data['page_title'] = 'Riwayat Singkat Kunjungan';
        if ($request->mr) {
            $no_mr = $request->mr;
        }

        if ($request->nama_pasien) {
            $namaPasien = $request->nama_pasien;
        }

        $riwayatSingkat = DB::select("select aa.fs_kd_reg, ee.FS_NM_PASIEN, ee.FS_MR,fd_tgl_masuk, left(fs_jam_masuk,5) fs_jam_masuk ,
        fd_tgl_keluar = case fd_tgl_keluar
        when '3000-01-01' then ''
        Else fd_tgl_keluar
        end,
        fs_nm_layanan, fs_nm_peg, isnull(fs_kd_diagnosa,'')fs_kd_diagnosa
        from ta_registrasi aa
        inner join ta_layanan bb on aa.fs_kd_layanan_akhir = bb.fs_kd_layanan
        left join tc_mr2 cc on aa.fs_kd_reg = cc.fs_kd_reg
        and fb_utama = 1
        inner join td_peg dd on aa.fs_kd_medis = dd.fs_kd_peg
        inner join tc_mr ee on aa.fs_mr= ee.FS_MR
        where aa.fs_mr = '$no_mr'

        and aa.fd_tgl_void = '3000-01-01'
        order by fd_tgl_masuk desc, fs_jam_masuk desc");

        $data['riwayat_singkat'] = $riwayatSingkat;






        $data['_self'] = $this;
        $data['fs_mr'] = $no_mr;
        return view('riwayat.singkat-kunjungan.index', $data);
    }

    public function hitungUmur($tanggal_lahir)
    {
        $birthDate = new DateTime($tanggal_lahir);
        $today = new DateTime("today");
        if ($birthDate > $today) {
            exit("0 tahun 0 bulan 0 hari");
        }
        $y = $today->diff($birthDate)->y;
        $m = $today->diff($birthDate)->m;
        $d = $today->diff($birthDate)->d;
        return $y . " tahun " . $m . " bulan " . $d . " hari";
    }

}
