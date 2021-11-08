<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use Illuminate\Support\Facades\DB;

class RiwayatRadiologiController extends Controller
{
    public function index(Request $request)
    {
        $no_mr = null;
        $data['page_title'] = 'Riwayat Hasil Pemeriksaan Radiologi';

        if ($request->mr) {
            $no_mr = $request->mr;
        }



        $data['riwayat'] = DB::select("select  aa.fs_kd_hasil, aa.FS_JAM_HASIL ,aa.fd_tgl_hasil, fs_nm_pasien, aa.fs_kd_reg, bb.fs_mr,
            fs_dokter_pengirim, fs_nm_tarif, fs_nm_peg fs_nm_dokter_pemeriksa,
            cc.fd_tgl_lahir , cc.fb_jns_kelamin , aa.fs_ket , hh.FS_NO_FILM,
            fs_nm_jaminan, fs_nm_kelas,aa.FS_KD_TRS_TINDAKAN
            from    ta_trs_tindakan_hasil_ro aa
            inner   join ta_registrasi bb on aa.fs_kd_reg = bb.fs_kd_reg
            inner   join tc_mr cc on bb.fs_mr = cc.fs_mr
            inner   join td_peg dd on aa.fs_kd_petugas_medis = dd.fs_kd_peg
            inner   join ta_tarif ee on aa.fs_kd_tarif = ee.fs_kd_tarif
            inner   join ta_jaminan ff on bb.fs_kd_jaminan = ff.fs_kd_jaminan
            inner   join ta_kelas gg on bb.fs_kd_kelas = gg.fs_kd_kelas
            inner   join ta_trs_tindakan_hasil_ro2 hh on aa.fs_kd_hasil= hh.fs_kd_hasil
            where cc.fs_mr = '$no_mr'
            order by fd_tgl_hasil desc
            ");
        // if(!$data['riwayat']){
        //     return redirect()->back()->with(['failed'=>'Radiologi tidak ditemukan !']);
        // }

        $fs_kd_hasil = $data['riwayat'][0]->fs_kd_hasil ?? '';
        if ($request->ro) {
            $fs_kd_hasil = $request->ro;
        }
        $data['_self'] = $this;
        $data['fs_mr'] = $no_mr;
        $data['fs_kd_hasil'] = $fs_kd_hasil;

        $data['header'] = DB::select("select  aa.fs_kd_hasil, aa.fd_tgl_hasil, fs_nm_pasien, aa.fs_kd_reg, bb.fs_mr,
            fs_dokter_pengirim, fs_nm_tarif, fs_nm_peg fs_nm_dokter_pemeriksa,
            cc.fd_tgl_lahir , cc.fb_jns_kelamin , aa.fs_ket , hh.FS_NO_FILM,
            fs_nm_jaminan, fs_nm_kelas,aa.FS_KD_TRS_TINDAKAN
            from    ta_trs_tindakan_hasil_ro aa
            inner   join ta_registrasi bb on aa.fs_kd_reg = bb.fs_kd_reg
            inner   join tc_mr cc on bb.fs_mr = cc.fs_mr
            inner   join td_peg dd on aa.fs_kd_petugas_medis = dd.fs_kd_peg
            inner   join ta_tarif ee on aa.fs_kd_tarif = ee.fs_kd_tarif
            inner   join ta_jaminan ff on bb.fs_kd_jaminan = ff.fs_kd_jaminan
            inner   join ta_kelas gg on bb.fs_kd_kelas = gg.fs_kd_kelas
            inner   join ta_trs_tindakan_hasil_ro2 hh on aa.fs_kd_hasil= hh.fs_kd_hasil
            where aa.fs_kd_hasil = '$fs_kd_hasil'");



        $data['detail'] = DB::select(" select  aa.fs_kd_hasil, aa.FS_JAM_HASIL ,aa.fd_tgl_hasil, fs_nm_pasien, aa.fs_kd_reg, bb.fs_mr,
            fs_dokter_pengirim, fs_nm_tarif, fs_nm_peg fs_nm_dokter_pemeriksa,
            cc.fd_tgl_lahir , cc.fb_jns_kelamin , aa.fs_ket , hh.FS_NO_FILM,
            fs_nm_jaminan, fs_nm_kelas,aa.FS_KD_TRS_TINDAKAN
            from    ta_trs_tindakan_hasil_ro aa
            inner   join ta_registrasi bb on aa.fs_kd_reg = bb.fs_kd_reg
            inner   join tc_mr cc on bb.fs_mr = cc.fs_mr
            inner   join td_peg dd on aa.fs_kd_petugas_medis = dd.fs_kd_peg
            inner   join ta_tarif ee on aa.fs_kd_tarif = ee.fs_kd_tarif
            inner   join ta_jaminan ff on bb.fs_kd_jaminan = ff.fs_kd_jaminan
            inner   join ta_kelas gg on bb.fs_kd_kelas = gg.fs_kd_kelas
            inner   join ta_trs_tindakan_hasil_ro2 hh on aa.fs_kd_hasil= hh.fs_kd_hasil
            where aa.fs_kd_hasil = '$fs_kd_hasil'
            order by fd_tgl_hasil desc");
        $data['_self'] = $this;
        $data['fs_mr'] = $no_mr;
        $data['fs_kd_hasil'] = $fs_kd_hasil;
        return view('riwayat.radiologi.index', $data);
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
