<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class RekamMedisController extends Controller
{
    public function index(Request $request){
        $data['page_title'] = "Pencarian Rekam Medis Pasien";
        $data['request'] = $request;
        $allParameterSearch = array_filter($request->all());

        $parameterSeachQuery = [];
        foreach ($allParameterSearch as $key => $value) {
            $isSearcable = true;
            switch ($key) {
                case 'nama':
                    $key = 'fs_nm_pasien';
                    break;
                case 'alamat':
                    $key = 'FS_ALM_PASIEN';
                    break;
                case 'telepon':
                    $key = 'FS_TLP_PASIEN';
                    break;
                case 'hp':
                    $key = 'FS_HP_PASIEN';
                    break;
                case 'nomor_mr':
                    $key = 'fs_mr';
                    break;
                case 'tgl_lahir':
                    $key = 'fd_tgl_lahir';
                    break;
                default:
                    $isSearcable = false;
                    break;
            }
            if($isSearcable){
                array_push($parameterSeachQuery,'and '.$key." like '%$value%'");
            }
        }
        $whereQuery = implode($parameterSeachQuery, ' ') ;

        $QUERY = "select fs_mr, fs_nm_pasien, fd_tgl_lahir, FS_ALM_PASIEN, FS_TLP_PASIEN, FS_HP_PASIEN from tc_mr where 1=1 $whereQuery ";
        $data['rekam_medis'] = $request->seach == true? DB::select($QUERY) : [];

        // $data['datatables'] = Datatables::of($data['rekam_medis'])->make(true);


        return view('rekam-medis.index',$data);
    }

    public function detail($nomorMr){
        $QUERY = "select aa.*,bb.fs_nm_agama,fs_nm_kelurahan,fs_nm_kecamatan,fs_nm_kabupaten from
        tc_mr aa
        inner join TA_AGAMA bb on aa.FS_KD_AGAMA = bb.fs_kd_agama
        left join TA_KELURAHAN cc on aa.fs_kd_kelurahan = cc.fs_kd_kelurahan
        left join TA_KECAMATAN dd on cc.fs_kd_kecamatan = dd.fs_kd_kecamatan
        left join TA_KABUPATEN ee on dd.fs_kd_kabupaten = ee.fs_kd_kabupaten
        where FS_MR = '$nomorMr'";
        $dataRekamMedis = DB::select($QUERY);
        if(count($dataRekamMedis) < 1){
            $dataRekamMedis = [];
        }else{
            $dataRekamMedis = $dataRekamMedis[0];
        }

        $QUERY_CPPT = "select * from TAR_CPPT where FS_MR = '$nomorMr' order by FN_ID desc";
        $data['CPPT']= DB::select($QUERY_CPPT);

        // --- RIWAYAT KUNJUNGAN
        $QUERY_RIWAYAT_KUNJUNGAN = "select	aa.fs_kd_reg, aa.fd_tgl_masuk, fs_nm_layanan, fs_nm_peg fs_dokter
        from	TA_REGISTRASI aa
        inner	join tc_mr bb on aa.fs_mr = bb.fs_mr
        inner	join TA_LAYANAN cc on aa.FS_KD_LAYANAN = cc.FS_KD_LAYANAN
        inner	join TD_PEG dd on aa.FS_KD_MEDIS = dd.fs_kd_peg
        where	bb.fs_mr = '$nomorMr'
        and		aa.fd_tgl_void = '3000-01-01'
        order	by aa.FD_TGL_MASUK desc, FS_NM_LAYANAN";
        $data['riwayat_kunjungan'] = DB::select($QUERY_RIWAYAT_KUNJUNGAN);



        $data['page_title'] = "Rekam Medis Pasien";

        $data['rekam_medis'] = $dataRekamMedis;
        return view('rekam-medis.detail', $data);
    }
}
