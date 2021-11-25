<?php

namespace App\Http\Controllers;

use App\Exports\MrExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use PDF;
use Excel;
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
                    $key = 'aa.fs_mr';
                    break;
                case 'tgl_lahir':
                    $key = 'fd_tgl_lahir';
                    $value = date('Y-m-d',strtotime($value));
                    break;
                default:
                    $isSearcable = false;
                    break;
            }
            if($isSearcable){
                array_push($parameterSeachQuery,'and '.$key." like '%$value%'");
            }
        }

        // dd($parameterSeachQuery);
        $whereQuery = implode($parameterSeachQuery, ' ') ;

        $QUERY = "select TOP 5000 bb.fs_kd_reg,aa.fs_mr, fs_nm_pasien, fd_tgl_lahir, FS_ALM_PASIEN, FS_TLP_PASIEN, FS_HP_PASIEN from tc_mr aa
        left join
        (
              SELECT  max(fs_kd_reg) as fs_kd_reg,fs_mr
              FROM      TA_REGISTRASI
              group by fs_mr
          )
        bb on aa.fs_mr = bb.fs_mr
        where 1=1 $whereQuery order by fs_kd_reg desc ";
        $data['rekam_medis'] = $request->seach == true? DB::select($QUERY) : [];

        if($request->from == 'yajra'){
            return $data['datatables'] = Datatables::of($data['rekam_medis'])
            ->addColumn('tgl_lahir', function($qr) {
                return date('d-m-Y',strtotime($qr->fd_tgl_lahir));
            })

            ->addColumn('action', function ($qr) {
                return '<a href="'.route('rekam-medis.detail',['rekammedis',$qr->fs_mr]).'" class=" "> Lihat Detail</a>';
            })
            ->escapeColumns([])
            ->addIndexColumn()
            ->toJson();

        }
        $data['jumlah_data'] = count( $data['rekam_medis']);

        return view('rekam-medis.index',$data);
    }

    public function getRekamMedis(Request $request){
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
        return  $data['datatables'] = Datatables::of($data['rekam_medis'])->make(true);


    }

    public function detail($from,$nomorMr,$kdDokter = '',$kdReg=''){

        $data['kd_dokter'] = $kdDokter;
        $data['kd_reg'] = $kdReg;
        $data['from'] = $from;

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


        $QUERY_CPPT = "select
        aa.FN_ID,
        aa.FD_DATE,
        FS_NM_LAYANAN,
        FT_SUBJECTIVE,
        FT_OBJECTIVE,
        FT_ASSESMENT,
        FS_PLAN1,
        FS_PLAN2,
        FS_PLAN3,
        FS_PLAN4,
        FS_IPPA1A,
        FS_IPPA1B,
        FS_IPPA1C,
        FS_IPPA2A,
        FS_IPPA2B,
        FS_IPPA2C,
        FS_IPPA3A,
        FS_IPPA3B,
        FS_IPPA3C,
        FS_IPPA4A,
        FS_IPPA4B,
        FS_IPPA4C,
        FS_PROFESI,
        FS_VERIFIED_BY,
        FS_DPJP,
        FS_KD_PEG,
        FS_USER,
        'cppt' AS TB_FROM,
        NULL AS TD,
        NULL AS TB,
        NULL AS NADI,
        NULL AS BB,
        NULL AS RESPIRASI,
        NULL AS SUHU
        from TAR_CPPT aa
        left join TA_LAYANAN bb on aa.FS_KD_LAYANAN = bb.FS_KD_LAYANAN
        where FS_MR = '$nomorMr'
        UNION ALL

        SELECT
        cc.FN_ID AS FN_ID,
        cc.FD_DATE,
        dd.FS_NM_LAYANAN AS FS_NM_LAYANAN,
        [FS_ALASAN_KUNJUNGAN] AS FT_SUBJECTIVE,
        NULL AS FT_OBJECTIVE,
        NULL AS FT_ASSESMENT,
        NULL AS FS_PLAN1,
        NULL AS FS_PLAN2,
        NULL AS FS_PLAN3,
        NULL AS FS_PLAN4,
        NULL AS FS_IPPA1A,
        NULL AS FS_IPPA1B,
        NULL AS FS_IPPA1C,
        NULL AS FS_IPPA2A,
        NULL AS FS_IPPA2B,
        NULL AS FS_IPPA2C,
        NULL AS FS_IPPA3A,
        NULL AS FS_IPPA3B,
        NULL AS FS_IPPA3C,
        NULL AS FS_IPPA4A,
        NULL AS FS_IPPA4B,
        NULL AS FS_IPPA4C,
        [FS_PROFESI] AS FS_PROFESI,
        FS_VERIFIED_BY AS FS_VERIFIED_BY,
        FS_DPJP AS FS_DPJP,
        FS_KD_PEG,
        NULL AS FS_USER,
        'asesmen' AS TB_FROM,
        [FN_PF_TD] AS TD,
        [FN_PF_TB] AS TB,
        [FN_PF_NADI] AS NADI,
        [FN_PF_BB] AS BB,
        [FN_PF_RESPIRASI] AS RESPIRASI,
        [FN_PF_SUHU] AS SUHU
        FROM TAR_ASESMEN_PERAWAT cc
        left join TA_LAYANAN dd on cc.FS_KD_LAYANAN = dd.FS_KD_LAYANAN
        where FS_MR = '$nomorMr'
            UNION ALL

        SELECT
        ee.FN_ID AS FN_ID,
        ee.FD_DATE,
        ff.FS_NM_LAYANAN AS FS_NM_LAYANAN,
        [FJ_DS] AS FT_SUBJECTIVE,
        [FJ_DO] AS FT_OBJECTIVE,
        FS_TINDAKAN_TERAPI AS FT_ASSESMENT,
        NULL AS FS_PLAN1,
        NULL AS FS_PLAN2,
        NULL AS FS_PLAN3,
        NULL AS FS_PLAN4,
        NULL AS FS_IPPA1A,
        NULL AS FS_IPPA1B,
        NULL AS FS_IPPA1C,
        NULL AS FS_IPPA2A,
        NULL AS FS_IPPA2B,
        NULL AS FS_IPPA2C,
        NULL AS FS_IPPA3A,
        NULL AS FS_IPPA3B,
        NULL AS FS_IPPA3C,
        NULL AS FS_IPPA4A,
        NULL AS FS_IPPA4B,
        NULL AS FS_IPPA4C,
        [FS_PROFESI] AS FS_PROFESI,
        FS_VERIFIED_BY AS FS_VERIFIED_BY,
        FS_DPJP AS FS_DPJP,
        FS_KD_PEG,
        NULL AS FS_USER,
        'asesmen_dokter' AS TB_FROM,
        null AS TD,
        null AS TB,
        null AS NADI,
        null AS BB,
        null AS RESPIRASI,
        null AS SUHU
        FROM TAR_ASESMEN_DOKTER ee
        left join TA_LAYANAN ff on ee.FS_KD_LAYANAN = ff.FS_KD_LAYANAN
        where FS_MR = '$nomorMr'

        UNION ALL
        SELECT
        gg.FN_ID AS FN_ID,
        gg.FD_DATE,
        hh.FS_NM_LAYANAN AS FS_NM_LAYANAN,
        [FJ_DS] AS FT_SUBJECTIVE,
        [FJ_DO] AS FT_OBJECTIVE,
        FS_TINDAKAN_TERAPI AS FT_ASSESMENT,
        NULL AS FS_PLAN1,
        NULL AS FS_PLAN2,
        NULL AS FS_PLAN3,
        NULL AS FS_PLAN4,
        NULL AS FS_IPPA1A,
        NULL AS FS_IPPA1B,
        NULL AS FS_IPPA1C,
        NULL AS FS_IPPA2A,
        NULL AS FS_IPPA2B,
        NULL AS FS_IPPA2C,
        NULL AS FS_IPPA3A,
        NULL AS FS_IPPA3B,
        NULL AS FS_IPPA3C,
        NULL AS FS_IPPA4A,
        NULL AS FS_IPPA4B,
        NULL AS FS_IPPA4C,
        [FS_PROFESI] AS FS_PROFESI,
        FS_VERIFIED_BY AS FS_VERIFIED_BY,
        FS_DPJP AS FS_DPJP,
        FS_KD_PEG,
        NULL AS FS_USER,
        'asesmen_dokter_bidan' AS TB_FROM,
        null AS TD,
        null AS TB,
        null AS NADI,
        null AS BB,
        null AS RESPIRASI,
        null AS SUHU
        FROM TAR_ASESMEN_DOKTER_BIDAN gg
        left join TA_LAYANAN hh on gg.FS_KD_LAYANAN = hh.FS_KD_LAYANAN
        where FS_MR = '$nomorMr'

        order by FD_DATE desc";
        $data['CPPT']= DB::select($QUERY_CPPT);



        // --- RIWAYAT KUNJUNGAN
        $QUERY_RIWAYAT_KUNJUNGAN = "select	aa.fs_kd_reg, aa.fd_tgl_masuk,fs_jam_masuk, fs_nm_layanan, fs_nm_peg fs_dokter
        from	TA_REGISTRASI aa
        inner	join tc_mr bb on aa.fs_mr = bb.fs_mr
        inner	join TA_LAYANAN cc on aa.FS_KD_LAYANAN = cc.FS_KD_LAYANAN
        inner	join TD_PEG dd on aa.FS_KD_MEDIS = dd.fs_kd_peg
        where	bb.fs_mr = '$nomorMr'
        and		aa.fd_tgl_void = '3000-01-01'
        order	by aa.FD_TGL_MASUK desc, aa.fs_jam_masuk desc, FS_NM_LAYANAN";
        $data['riwayat_kunjungan'] = DB::select($QUERY_RIWAYAT_KUNJUNGAN);
        $data['page_title'] = "Rekam Medis Pasien";
        $data['rekam_medis'] = $dataRekamMedis;


        // ---- CEK RIWAYAT
        $data['cek_riwayat_lab'] = DB::select(" select  aa.fs_kd_hasil, fs_nm_pasien, aa.fs_kd_reg, bb.fs_mr,
            cc.fb_jns_kelamin, cc.fd_tgl_lahir, fs_dokter_pengirim, fs_nm_peg,
            fd_tgl_sample , fs_jam_sample, fb_hasil_lis , fs_kd_trs_tindakan
            from    ta_trs_tindakan_hasil_lab aa
            inner   join ta_registrasi bb on aa.fs_kd_reg = bb.fs_kd_reg
            inner   join tc_mr cc on bb.fs_mr = cc.fs_mr
            inner   join td_peg dd on aa.fs_kd_petugas_medis = dd.fs_kd_peg
            inner   join ta_trs_tindakan ee on aa.fs_kd_trs_tindakan = ee.fs_kd_trs
            where cc.fs_mr = '$nomorMr'
            order by fd_tgl_sample desc
            ");
        $data['cek_riwayat_radiologi'] = DB::select("select  aa.fs_kd_hasil, aa.FS_JAM_HASIL ,aa.fd_tgl_hasil, fs_nm_pasien, aa.fs_kd_reg, bb.fs_mr,
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
            where cc.fs_mr = '$nomorMr'
            order by fd_tgl_hasil desc
            ");

        $riwayatResepDokter = DB::select(" select  aa.fs_kd_resep, fd_tgl_resep,
            fs_nm_peg , fs_nm_layanan,fs_nm_pasien
            from    tb_trs_resep_header aa
            inner   join ta_registrasi bb on aa.fs_kd_reg = bb.fs_kd_reg
            inner   join td_peg cc on aa.fs_kd_medis = cc.fs_kd_peg
            inner   join ta_layanan dd on aa.fs_kd_layanan_resep = dd.fs_kd_layanan
            where   aa.fd_tgl_void = '3000-01-01'
            and bb.fs_mr = '$nomorMr'
            order   by fd_tgl_resep desc ");
            $data['cek_riwayat_resep_dokter'] = $riwayatResepDokter;

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
            where aa.fs_mr = '$nomorMr'

            and aa.fd_tgl_void = '3000-01-01'
            order by fd_tgl_masuk desc, fs_jam_masuk desc");

            $data['cek_riwayat_singkat'] = $riwayatSingkat;

        $data['rumah_sakit'] = DB::select("select	fs_nm_rs, fs_alm_rs, fs_tlp_rs , FS_FAX_RS from	t_parameter");

        return view('rekam-medis.detail', $data);
    }

    public function detailFiltered(Request $request,$from,$nomorMr,$kdDokter = '',$kdReg=''){
        $data['kd_dokter'] = $kdDokter;
        $data['kd_reg'] = $kdReg;
        $data['from'] = $from;
        $data['filtered'] = $request->filter ?? [];
        $filterWhereIn = implode("','",  $request->filter ?? []);
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

        $QUERY_CPPT = "select
        aa.FN_ID,
        aa.FD_DATE,
        FS_NM_LAYANAN,
        FT_SUBJECTIVE,
        FT_OBJECTIVE,
        FT_ASSESMENT,
        FS_PLAN1,
        FS_PLAN2,
        FS_PLAN3,
        FS_PLAN4,
        FS_IPPA1A,
        FS_IPPA1B,
        FS_IPPA1C,
        FS_IPPA2A,
        FS_IPPA2B,
        FS_IPPA2C,
        FS_IPPA3A,
        FS_IPPA3B,
        FS_IPPA3C,
        FS_IPPA4A,
        FS_IPPA4B,
        FS_IPPA4C,
        FS_PROFESI,
        FS_VERIFIED_BY,
        FS_DPJP,
        FS_KD_PEG,
        FS_USER,
        'cppt' AS TB_FROM,
        NULL AS TD,
        NULL AS TB,
        NULL AS NADI,
        NULL AS BB,
        NULL AS RESPIRASI,
        NULL AS SUHU
        from TAR_CPPT aa
        left join TA_LAYANAN bb on aa.FS_KD_LAYANAN = bb.FS_KD_LAYANAN
        where FS_MR = '$nomorMr'
        and FS_REGISTER IN ('$filterWhereIn')

        UNION ALL

        SELECT
        cc.FN_ID AS FN_ID,
        cc.FD_DATE,
        dd.FS_NM_LAYANAN AS FS_NM_LAYANAN,
        [FS_ALASAN_KUNJUNGAN] AS FT_SUBJECTIVE,
        NULL AS FT_OBJECTIVE,
        NULL AS FT_ASSESMENT,
        NULL AS FS_PLAN1,
        NULL AS FS_PLAN2,
        NULL AS FS_PLAN3,
        NULL AS FS_PLAN4,
        NULL AS FS_IPPA1A,
        NULL AS FS_IPPA1B,
        NULL AS FS_IPPA1C,
        NULL AS FS_IPPA2A,
        NULL AS FS_IPPA2B,
        NULL AS FS_IPPA2C,
        NULL AS FS_IPPA3A,
        NULL AS FS_IPPA3B,
        NULL AS FS_IPPA3C,
        NULL AS FS_IPPA4A,
        NULL AS FS_IPPA4B,
        NULL AS FS_IPPA4C,
        [FS_PROFESI] AS FS_PROFESI,
        FS_VERIFIED_BY AS FS_VERIFIED_BY,
        FS_DPJP AS FS_DPJP,
        FS_KD_PEG,
        NULL AS FS_USER,
        'asesmen' AS TB_FROM,
        [FN_PF_TD] AS TD,
        [FN_PF_TB] AS TB,
        [FN_PF_NADI] AS NADI,
        [FN_PF_BB] AS BB,
        [FN_PF_RESPIRASI] AS RESPIRASI,
        [FN_PF_SUHU] AS SUHU
        FROM TAR_ASESMEN_PERAWAT cc
        left join TA_LAYANAN dd on cc.FS_KD_LAYANAN = dd.FS_KD_LAYANAN
        where FS_MR = '$nomorMr'
        and FS_REGISTER IN ('$filterWhereIn')
        UNION ALL
        SELECT
        ee.FN_ID AS FN_ID,
        ee.FD_DATE,
        ff.FS_NM_LAYANAN AS FS_NM_LAYANAN,
        [FJ_DS] AS FT_SUBJECTIVE,
        [FJ_DO] AS FT_OBJECTIVE,
        FS_TINDAKAN_TERAPI AS FT_ASSESMENT,
        NULL AS FS_PLAN1,
        NULL AS FS_PLAN2,
        NULL AS FS_PLAN3,
        NULL AS FS_PLAN4,
        NULL AS FS_IPPA1A,
        NULL AS FS_IPPA1B,
        NULL AS FS_IPPA1C,
        NULL AS FS_IPPA2A,
        NULL AS FS_IPPA2B,
        NULL AS FS_IPPA2C,
        NULL AS FS_IPPA3A,
        NULL AS FS_IPPA3B,
        NULL AS FS_IPPA3C,
        NULL AS FS_IPPA4A,
        NULL AS FS_IPPA4B,
        NULL AS FS_IPPA4C,
        [FS_PROFESI] AS FS_PROFESI,
        FS_VERIFIED_BY AS FS_VERIFIED_BY,
        FS_DPJP AS FS_DPJP,
        FS_KD_PEG,
        NULL AS FS_USER,
        'asesmen_dokter' AS TB_FROM,
        null AS TD,
        null AS TB,
        null AS NADI,
        null AS BB,
        null AS RESPIRASI,
        null AS SUHU
        FROM TAR_ASESMEN_DOKTER ee
        left join TA_LAYANAN ff on ee.FS_KD_LAYANAN = ff.FS_KD_LAYANAN
        where FS_MR = '$nomorMr'
        and FS_REGISTER IN ('$filterWhereIn')

        UNION ALL
        SELECT
        gg.FN_ID AS FN_ID,
        gg.FD_DATE,
        hh.FS_NM_LAYANAN AS FS_NM_LAYANAN,
        [FJ_DS] AS FT_SUBJECTIVE,
        [FJ_DO] AS FT_OBJECTIVE,
        FS_TINDAKAN_TERAPI AS FT_ASSESMENT,
        NULL AS FS_PLAN1,
        NULL AS FS_PLAN2,
        NULL AS FS_PLAN3,
        NULL AS FS_PLAN4,
        NULL AS FS_IPPA1A,
        NULL AS FS_IPPA1B,
        NULL AS FS_IPPA1C,
        NULL AS FS_IPPA2A,
        NULL AS FS_IPPA2B,
        NULL AS FS_IPPA2C,
        NULL AS FS_IPPA3A,
        NULL AS FS_IPPA3B,
        NULL AS FS_IPPA3C,
        NULL AS FS_IPPA4A,
        NULL AS FS_IPPA4B,
        NULL AS FS_IPPA4C,
        [FS_PROFESI] AS FS_PROFESI,
        FS_VERIFIED_BY AS FS_VERIFIED_BY,
        FS_DPJP AS FS_DPJP,
        FS_KD_PEG,
        NULL AS FS_USER,
        'asesmen_dokter_bidan' AS TB_FROM,
        null AS TD,
        null AS TB,
        null AS NADI,
        null AS BB,
        null AS RESPIRASI,
        null AS SUHU
        FROM TAR_ASESMEN_DOKTER_BIDAN gg
        left join TA_LAYANAN hh on gg.FS_KD_LAYANAN = hh.FS_KD_LAYANAN
        where FS_MR = '$nomorMr'
        and FS_REGISTER IN ('$filterWhereIn')

        order by FD_DATE desc";
        $data['CPPT']= DB::select($QUERY_CPPT);



        // --- RIWAYAT KUNJUNGAN
        $QUERY_RIWAYAT_KUNJUNGAN = "select	aa.fs_kd_reg, aa.fd_tgl_masuk, fs_nm_layanan, fs_nm_peg fs_dokter
        from	TA_REGISTRASI aa
        inner	join tc_mr bb on aa.fs_mr = bb.fs_mr
        inner	join TA_LAYANAN cc on aa.FS_KD_LAYANAN = cc.FS_KD_LAYANAN
        inner	join TD_PEG dd on aa.FS_KD_MEDIS = dd.fs_kd_peg
        where	bb.fs_mr = '$nomorMr'
        and		aa.fd_tgl_void = '3000-01-01'
        order	by aa.FD_TGL_MASUK desc, aa.fs_jam_masuk desc, FS_NM_LAYANAN";

        $data['riwayat_kunjungan'] = DB::select($QUERY_RIWAYAT_KUNJUNGAN);



        $data['page_title'] = "Rekam Medis Pasien";

        $data['rekam_medis'] = $dataRekamMedis;
        return view('rekam-medis.detail-filter', $data);
    }


    public function pdfPrint($from, $nomorMr, $kdDokter = '', $kdReg = '')
    {

        $data['kd_dokter'] = $kdDokter;
        $data['kd_reg'] = $kdReg;
        $data['from'] = $from;

        $QUERY = "select aa.*,bb.fs_nm_agama,fs_nm_kelurahan,fs_nm_kecamatan,fs_nm_kabupaten from
        tc_mr aa
        inner join TA_AGAMA bb on aa.FS_KD_AGAMA = bb.fs_kd_agama
        left join TA_KELURAHAN cc on aa.fs_kd_kelurahan = cc.fs_kd_kelurahan
        left join TA_KECAMATAN dd on cc.fs_kd_kecamatan = dd.fs_kd_kecamatan
        left join TA_KABUPATEN ee on dd.fs_kd_kabupaten = ee.fs_kd_kabupaten

        where FS_MR = '$nomorMr'";

        $dataRekamMedis = DB::select($QUERY);
        if (count($dataRekamMedis) < 1) {
            $dataRekamMedis = [];
        } else {
            $dataRekamMedis = $dataRekamMedis[0];
        }


        $QUERY_CPPT = "select
        aa.FN_ID,
        aa.FD_DATE,
        FS_NM_LAYANAN,
        FT_SUBJECTIVE,
        FT_OBJECTIVE,
        FT_ASSESMENT,
        FS_PLAN1,
        FS_PLAN2,
        FS_PLAN3,
        FS_PLAN4,
        FS_IPPA1A,
        FS_IPPA1B,
        FS_IPPA1C,
        FS_IPPA2A,
        FS_IPPA2B,
        FS_IPPA2C,
        FS_IPPA3A,
        FS_IPPA3B,
        FS_IPPA3C,
        FS_IPPA4A,
        FS_IPPA4B,
        FS_IPPA4C,
        FS_PROFESI,
        FS_VERIFIED_BY,
        FS_DPJP,
        FS_KD_PEG,
        FS_USER,
        'cppt' AS TB_FROM,
        NULL AS TD,
        NULL AS TB,
        NULL AS NADI,
        NULL AS BB,
        NULL AS RESPIRASI,
        NULL AS SUHU
        from TAR_CPPT aa
        left join TA_LAYANAN bb on aa.FS_KD_LAYANAN = bb.FS_KD_LAYANAN
        where FS_MR = '$nomorMr'
        UNION ALL

        SELECT
        cc.FN_ID AS FN_ID,
        cc.FD_DATE,
        dd.FS_NM_LAYANAN AS FS_NM_LAYANAN,
        [FS_ALASAN_KUNJUNGAN] AS FT_SUBJECTIVE,
        NULL AS FT_OBJECTIVE,
        NULL AS FT_ASSESMENT,
        NULL AS FS_PLAN1,
        NULL AS FS_PLAN2,
        NULL AS FS_PLAN3,
        NULL AS FS_PLAN4,
        NULL AS FS_IPPA1A,
        NULL AS FS_IPPA1B,
        NULL AS FS_IPPA1C,
        NULL AS FS_IPPA2A,
        NULL AS FS_IPPA2B,
        NULL AS FS_IPPA2C,
        NULL AS FS_IPPA3A,
        NULL AS FS_IPPA3B,
        NULL AS FS_IPPA3C,
        NULL AS FS_IPPA4A,
        NULL AS FS_IPPA4B,
        NULL AS FS_IPPA4C,
        [FS_PROFESI] AS FS_PROFESI,
        FS_VERIFIED_BY AS FS_VERIFIED_BY,
        FS_DPJP AS FS_DPJP,
        FS_KD_PEG,
        NULL AS FS_USER,
        'asesmen' AS TB_FROM,
        [FN_PF_TD] AS TD,
        [FN_PF_TB] AS TB,
        [FN_PF_NADI] AS NADI,
        [FN_PF_BB] AS BB,
        [FN_PF_RESPIRASI] AS RESPIRASI,
        [FN_PF_SUHU] AS SUHU
        FROM TAR_ASESMEN_PERAWAT cc
        left join TA_LAYANAN dd on cc.FS_KD_LAYANAN = dd.FS_KD_LAYANAN
        where FS_MR = '$nomorMr'
            UNION ALL

        SELECT
        ee.FN_ID AS FN_ID,
        ee.FD_DATE,
        ff.FS_NM_LAYANAN AS FS_NM_LAYANAN,
        [FJ_DS] AS FT_SUBJECTIVE,
        [FJ_DO] AS FT_OBJECTIVE,
        FS_TINDAKAN_TERAPI AS FT_ASSESMENT,
        NULL AS FS_PLAN1,
        NULL AS FS_PLAN2,
        NULL AS FS_PLAN3,
        NULL AS FS_PLAN4,
        NULL AS FS_IPPA1A,
        NULL AS FS_IPPA1B,
        NULL AS FS_IPPA1C,
        NULL AS FS_IPPA2A,
        NULL AS FS_IPPA2B,
        NULL AS FS_IPPA2C,
        NULL AS FS_IPPA3A,
        NULL AS FS_IPPA3B,
        NULL AS FS_IPPA3C,
        NULL AS FS_IPPA4A,
        NULL AS FS_IPPA4B,
        NULL AS FS_IPPA4C,
        [FS_PROFESI] AS FS_PROFESI,
        FS_VERIFIED_BY AS FS_VERIFIED_BY,
        FS_DPJP AS FS_DPJP,
        FS_KD_PEG,
        NULL AS FS_USER,
        'asesmen_dokter' AS TB_FROM,
        null AS TD,
        null AS TB,
        null AS NADI,
        null AS BB,
        null AS RESPIRASI,
        null AS SUHU
        FROM TAR_ASESMEN_DOKTER ee
        left join TA_LAYANAN ff on ee.FS_KD_LAYANAN = ff.FS_KD_LAYANAN
        where FS_MR = '$nomorMr'

        UNION ALL
        SELECT
        gg.FN_ID AS FN_ID,
        gg.FD_DATE,
        hh.FS_NM_LAYANAN AS FS_NM_LAYANAN,
        [FJ_DS] AS FT_SUBJECTIVE,
        [FJ_DO] AS FT_OBJECTIVE,
        FS_TINDAKAN_TERAPI AS FT_ASSESMENT,
        NULL AS FS_PLAN1,
        NULL AS FS_PLAN2,
        NULL AS FS_PLAN3,
        NULL AS FS_PLAN4,
        NULL AS FS_IPPA1A,
        NULL AS FS_IPPA1B,
        NULL AS FS_IPPA1C,
        NULL AS FS_IPPA2A,
        NULL AS FS_IPPA2B,
        NULL AS FS_IPPA2C,
        NULL AS FS_IPPA3A,
        NULL AS FS_IPPA3B,
        NULL AS FS_IPPA3C,
        NULL AS FS_IPPA4A,
        NULL AS FS_IPPA4B,
        NULL AS FS_IPPA4C,
        [FS_PROFESI] AS FS_PROFESI,
        FS_VERIFIED_BY AS FS_VERIFIED_BY,
        FS_DPJP AS FS_DPJP,
        FS_KD_PEG,
        NULL AS FS_USER,
        'asesmen_dokter_bidan' AS TB_FROM,
        null AS TD,
        null AS TB,
        null AS NADI,
        null AS BB,
        null AS RESPIRASI,
        null AS SUHU
        FROM TAR_ASESMEN_DOKTER_BIDAN gg
        left join TA_LAYANAN hh on gg.FS_KD_LAYANAN = hh.FS_KD_LAYANAN
        where FS_MR = '$nomorMr'

        order by FD_DATE desc";
        $data['CPPT'] = DB::select($QUERY_CPPT);



        // --- RIWAYAT KUNJUNGAN
        $QUERY_RIWAYAT_KUNJUNGAN = "select	aa.fs_kd_reg, aa.fd_tgl_masuk,fs_jam_masuk, fs_nm_layanan, fs_nm_peg fs_dokter
        from	TA_REGISTRASI aa
        inner	join tc_mr bb on aa.fs_mr = bb.fs_mr
        inner	join TA_LAYANAN cc on aa.FS_KD_LAYANAN = cc.FS_KD_LAYANAN
        inner	join TD_PEG dd on aa.FS_KD_MEDIS = dd.fs_kd_peg
        where	bb.fs_mr = '$nomorMr'
        and		aa.fd_tgl_void = '3000-01-01'
        order	by aa.FD_TGL_MASUK desc, aa.fs_jam_masuk desc, FS_NM_LAYANAN";
        $data['riwayat_kunjungan'] = DB::select($QUERY_RIWAYAT_KUNJUNGAN);
        $data['page_title'] = "Rekam Medis Pasien";
        $data['rekam_medis'] = $dataRekamMedis;


        // ---- CEK RIWAYAT
        $data['cek_riwayat_lab'] = DB::select(" select  aa.fs_kd_hasil, fs_nm_pasien, aa.fs_kd_reg, bb.fs_mr,
            cc.fb_jns_kelamin, cc.fd_tgl_lahir, fs_dokter_pengirim, fs_nm_peg,
            fd_tgl_sample , fs_jam_sample, fb_hasil_lis , fs_kd_trs_tindakan
            from    ta_trs_tindakan_hasil_lab aa
            inner   join ta_registrasi bb on aa.fs_kd_reg = bb.fs_kd_reg
            inner   join tc_mr cc on bb.fs_mr = cc.fs_mr
            inner   join td_peg dd on aa.fs_kd_petugas_medis = dd.fs_kd_peg
            inner   join ta_trs_tindakan ee on aa.fs_kd_trs_tindakan = ee.fs_kd_trs
            where cc.fs_mr = '$nomorMr'
            order by fd_tgl_sample desc
            ");
        $data['cek_riwayat_radiologi'] = DB::select("select  aa.fs_kd_hasil, aa.FS_JAM_HASIL ,aa.fd_tgl_hasil, fs_nm_pasien, aa.fs_kd_reg, bb.fs_mr,
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
            where cc.fs_mr = '$nomorMr'
            order by fd_tgl_hasil desc
            ");

        $riwayatResepDokter = DB::select(" select  aa.fs_kd_resep, fd_tgl_resep,
            fs_nm_peg , fs_nm_layanan,fs_nm_pasien
            from    tb_trs_resep_header aa
            inner   join ta_registrasi bb on aa.fs_kd_reg = bb.fs_kd_reg
            inner   join td_peg cc on aa.fs_kd_medis = cc.fs_kd_peg
            inner   join ta_layanan dd on aa.fs_kd_layanan_resep = dd.fs_kd_layanan
            where   aa.fd_tgl_void = '3000-01-01'
            and bb.fs_mr = '$nomorMr'
            order   by fd_tgl_resep desc ");
        $data['cek_riwayat_resep_dokter'] = $riwayatResepDokter;

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
            where aa.fs_mr = '$nomorMr'

            and aa.fd_tgl_void = '3000-01-01'
            order by fd_tgl_masuk desc, fs_jam_masuk desc");

        $data['cek_riwayat_singkat'] = $riwayatSingkat;

        $data['rumah_sakit'] = DB::select("select	fs_nm_rs, fs_alm_rs, fs_tlp_rs , FS_FAX_RS from	t_parameter");

        // return view('rekam-medis.detail', $data);

        $pdf = PDF::loadView('rekam-medis.pdf', $data)->setOptions(['isRemoteEnabled' => true])->setPaper('a4', 'landscape');
        return $pdf->stream('rekam-medis-list');
        dd($data);
    }

    public function exportExcel($from, $nomorMr, $kdDokter = '', $kdReg = '')
    {
        return Excel::download(new MrExport($from, $nomorMr, $kdDokter, $kdReg), 'invoices.xlsx');
    }



}
