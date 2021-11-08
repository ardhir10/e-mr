<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;

class RiwayatResepDokterController extends Controller
{
    public function index(Request $request)
    {
        $no_mr = null;
        $data['page_title'] = 'Riwayat Resep Dokter';

        $no_mr = $request->mr;
        $riwayatResepDokter = DB::select(" select  aa.fs_kd_resep, fd_tgl_resep,
        fs_nm_peg , fs_nm_layanan,fs_nm_pasien
        from    tb_trs_resep_header aa
        inner   join ta_registrasi bb on aa.fs_kd_reg = bb.fs_kd_reg
        inner   join td_peg cc on aa.fs_kd_medis = cc.fs_kd_peg
        inner   join ta_layanan dd on aa.fs_kd_layanan_resep = dd.fs_kd_layanan
        where   aa.fd_tgl_void = '3000-01-01'
        and bb.fs_mr = '$no_mr'
        order   by fd_tgl_resep desc ");
        $data['riwayat_resep_dokter'] = $riwayatResepDokter;




        // if (!$riwayatResepDokter) {
        //     return redirect()->back()->with(['failed' => 'Resep Dokter tidak ditemukan !']);
        // }
        $fs_kd_resep = $riwayatResepDokter[0]->fs_kd_resep ?? '';

        if($request->resep){
            $fs_kd_resep = $request->resep;
        }

        $headerResepDokter = DB::select("  select  aa.fs_kd_resep, fd_tgl_resep,fs_jam_resep,
                fs_nm_peg , fs_nm_layanan,fs_mr,fs_nm_pasien,fs_nm_jaminan,ee.fs_kd_jaminan,cc.fs_kd_peg,aa.fs_kd_reg
        from    tb_trs_resep_header aa
        inner   join ta_registrasi bb on aa.fs_kd_reg = bb.fs_kd_reg
        inner   join td_peg cc on aa.fs_kd_medis = cc.fs_kd_peg
        inner   join ta_layanan dd on aa.fs_kd_layanan_resep = dd.fs_kd_layanan
        inner	join ta_jaminan ee on bb.fs_kd_jaminan= ee.fs_kd_jaminan

        where   aa.fd_tgl_void = '3000-01-01'
        and bb.fs_mr = '$no_mr'
        and fs_kd_resep = '$fs_kd_resep'
        order   by fd_tgl_resep desc ");
        $data['header_resep_dokter'] = $headerResepDokter;
        $detailResep = DB::select(" select  aa.* ,fs_nm_jenis_barang_resep , fs_nm_barang , fs_nm_satuan,
                fs_nm_satuan_dosis = isnull(( select    fs_nm_satuan from tb_satuan xx
                                            where     aa.fs_kd_satuan_dosis = xx.fs_kd_satuan),'')  ,
                fs_nm_aturan_pakai = case aa.fs_kd_aturan_pakai
                when 'X' then fs_ket_aturan_pakai
                else isnull(fs_nm_aturan_pakai,'') end,
                isnull(fs_nm_aturan_buat,'') fs_nm_aturan_buat
        from    tb_trs_resep_detail aa
        inner   join tb_satuan bb on aa.fs_kd_satuan = bb.fs_kd_satuan
        inner   join tb_barang cc on aa.fs_kd_barang = cc.fs_kd_barang
        inner   join tb_jenis_barang_resep dd on aa.fs_kd_jenis_barang = dd.fs_kd_jenis_barang_resep
        left    join tb_aturan_pakai ee on aa.fs_kd_aturan_pakai = ee.fs_kd_aturan_pakai
        left    join tb_aturan_buat ff on aa.fs_kd_aturan_buat = ff.fs_kd_aturan_buat
        where   fs_kd_resep = '$fs_kd_resep'
        order   by  fs_kd_jenis_barang , fs_nm_barang ");
        $data['detail_resep'] = $detailResep;



        $data['_self'] = $this;
        $data['no_mr'] = $no_mr;
        $data['fs_kd_resep'] = $fs_kd_resep;

        $data['rumah_sakit'] = DB::select("select	fs_nm_rs, fs_alm_rs, fs_tlp_rs , FS_FAX_RS from	t_parameter");



        return view('riwayat.resep-dokter.index', $data);
    }

    public function numberToRomanRepresentation($number)
    {
        $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
        $returnValue = '';
        while ($number > 0) {
            foreach ($map as $roman => $int) {
                if ($number >= $int) {
                    $number -= $int;
                    $returnValue .= $roman;
                    break;
                }
            }
        }
        return $returnValue;
    }


}
