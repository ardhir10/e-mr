<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RiwayatLaboratoriumController extends Controller
{
    public function index(Request $request){
        $no_mr = null;
        $data['page_title'] = 'Riwayat Hasil Pemeriksaan Laboratorium';

        if($request->mr){
            $no_mr = $request->mr;
        }

        $data['riwayat'] = DB::select(" select  aa.fs_kd_hasil, fs_nm_pasien, aa.fs_kd_reg, bb.fs_mr,
            cc.fb_jns_kelamin, cc.fd_tgl_lahir, fs_dokter_pengirim, fs_nm_peg,
            fd_tgl_sample , fs_jam_sample, fb_hasil_lis , fs_kd_trs_tindakan
            from    ta_trs_tindakan_hasil_lab aa
            inner   join ta_registrasi bb on aa.fs_kd_reg = bb.fs_kd_reg
            inner   join tc_mr cc on bb.fs_mr = cc.fs_mr
            inner   join td_peg dd on aa.fs_kd_petugas_medis = dd.fs_kd_peg
            inner   join ta_trs_tindakan ee on aa.fs_kd_trs_tindakan = ee.fs_kd_trs
            where cc.fs_mr = '$no_mr'
            order by fd_tgl_sample desc
            ");


            $fs_kd_hasil = $data['riwayat'][0]->fs_kd_hasil ?? '';
            if($request->lab){
                $fs_kd_hasil = $request->lab;
            }
            $data['_self'] = $this;
            $data['fs_mr'] = $no_mr;
            $data['fs_kd_hasil'] = $fs_kd_hasil;

        $data['header'] = DB::select(" select  aa.fs_kd_hasil, fs_nm_pasien, aa.fs_kd_reg, bb.fs_mr,
            cc.fb_jns_kelamin, cc.fd_tgl_lahir, fs_dokter_pengirim, fs_nm_peg,
            fd_tgl_sample , fs_jam_sample, fb_hasil_lis , fs_kd_trs_tindakan
            from    ta_trs_tindakan_hasil_lab aa
            inner   join ta_registrasi bb on aa.fs_kd_reg = bb.fs_kd_reg
            inner   join tc_mr cc on bb.fs_mr = cc.fs_mr
            inner   join td_peg dd on aa.fs_kd_petugas_medis = dd.fs_kd_peg
            inner   join ta_trs_tindakan ee on aa.fs_kd_trs_tindakan = ee.fs_kd_trs
            where aa.fs_kd_hasil = '$fs_kd_hasil'");


        $data['detail'] = DB::select("  select  fn_urut,fn_jenis_periksa, aa.fs_kd_periksa  , aa.fs_kd_gol_rentang,
            fs_nm_periksa, '' fs_nilai_normal, isnull(fs_nm_gol_rentang,'') fs_nm_gol_rentang,
            isnull(fs_nm_satuan,'') fs_nm_satuan,
            fs_hasil, fs_ket_hasil, fs_catatan, aa.fn_batas_bawah, aa.fn_batas_atas,
            fs_normal_kualitatif , aa.fs_kd_satuan, fb_paket, fn_tab, fb_hasil_rahasia
            from    ta_trs_tindakan_hasil_lab2 aa
            inner   join tg_pemeriksaan bb on aa.fs_kd_periksa = bb.fs_kd_periksa
            left    join tg_gol_rentang cc on aa.fs_kd_gol_rentang = cc.fs_kd_gol_rentang
            left    join tg_satuan dd on aa.fs_kd_satuan = dd.fs_kd_satuan
            where   fs_kd_hasil = '$fs_kd_hasil'
            order   by aa.fn_urut");
            $data['_self'] = $this;
            $data['fs_mr'] = $no_mr;
            $data['fs_kd_hasil'] = $fs_kd_hasil;





        return view('riwayat.laboratorium.index',$data);
    }

    public function hitungUmur($tanggal_lahir){
        $birthDate = new DateTime($tanggal_lahir);
        $today = new DateTime("today");
        if ($birthDate > $today) {
            exit("0 tahun 0 bulan 0 hari");
        }
        $y = $today->diff($birthDate)->y;
        $m = $today->diff($birthDate)->m;
        $d = $today->diff($birthDate)->d;
        return $y." tahun ".$m." bulan ".$d." hari";
    }

}
