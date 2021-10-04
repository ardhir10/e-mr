<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class CpptController extends Controller
{
    public function create($nomorMr){
        $data['page_title'] = "Tambah Catatan SOAP";

        $QUERY = "select aa.FS_MR,aa.FS_NM_PASIEN,aa.FD_TGL_LAHIR,
        aa.FB_JNS_KELAMIN,bb.fs_nm_agama,cc.FS_KD_REG,cc.FD_TGL_MASUK,
        cc.FS_JAM_MASUK,dd.FS_NM_PEG,fs_nm_jaminan
        from
        tc_mr aa
        inner join TA_AGAMA bb on aa.FS_KD_AGAMA = bb.fs_kd_agama
        inner join TA_REGISTRASI cc on aa.FS_MR = cc.FS_MR
        inner join TD_PEG dd on cc.FS_KD_MEDIS = dd.FS_KD_PEG
        inner	join ta_jaminan ee on cc.fs_kd_jaminan = ee.fs_kd_jaminan

        where aa.FS_MR = '$nomorMr'";
        $dataRekamMedis = DB::select($QUERY);
        if (count($dataRekamMedis) < 1) {
            $dataRekamMedis = [];
        } else {
            $dataRekamMedis = $dataRekamMedis[0];
        }

        $data['rekam_medis'] = $dataRekamMedis;

        $QUERY_LAYANAN = "select	aa.FS_KD_LAYANAN, FS_NM_LAYANAN, FS_NM_INSTALASI
        from	TA_LAYANAN aa
        inner	join TA_INSTALASI bb on aa.fs_kd_instalasi = bb.FS_KD_INSTALASI
        where	1=1
        order	by FS_NM_INSTALASI desc";
        $data['layanan_bagian'] = DB::select($QUERY_LAYANAN);

        return view('cppt.create', $data);
    }

    public function store(Request $request,$nomorMr){

        // --- BAGIAN VALIDASI
        $messages = [
            'cProfesi.required' => 'Profesi wajib diisi !',
            'cLayanan.required' => 'Layanan wajib diisi !',
            'cSubjective.required' => 'Subjective wajib diisi !',
            'cObjective.required' => 'Objective wajib diisi !',
            'cAssesmen.required' => 'Assesmen wajib diisi !',
        ];
        $request->validate([
            'cProfesi' => 'required',
            'cLayanan' => 'required',
            'cSubjective' => 'required',
            'cObjective' => 'required',
            'cAssesmen' => 'required',
        ], $messages);


        $parameterInsert['FD_DATE'] = date('Y-m-d H:i:s');
        $parameterInsert['FS_MR'] = $request->cNomorMR;
        $parameterInsert['FS_KD_LAYANAN'] = $request->cLayanan;
        $parameterInsert['FS_PROFESI'] = $request->cProfesi;
        $parameterInsert['FT_SUBJECTIVE'] = $request->cSubjective;
        $parameterInsert['FT_OBJECTIVE'] = $request->cObjective;
        $parameterInsert['FT_ASSESMENT'] = $request->cAssesmen;
        $parameterInsert['FS_PLAN1'] = $request->cPlan1;
        $parameterInsert['FS_PLAN2'] = $request->cPlan2;
        $parameterInsert['FS_PLAN3'] = $request->cPlan3;
        $parameterInsert['FS_PLAN4'] = $request->cPlan4;
        $parameterInsert['FS_IPPA1A'] = $request->cIppa1a;
        $parameterInsert['FS_IPPA1B'] = $request->cIppa1b;
        $parameterInsert['FS_IPPA2A'] = $request->cIpp2a;
        $parameterInsert['FS_IPPA2B'] = $request->cIppa2b;
        $parameterInsert['FS_IPPA3A'] = $request->cIppa3a;
        $parameterInsert['FS_IPPA3B'] = $request->cIppa3b;
        $parameterInsert['FS_IPPA3C'] = $request->cIppa3c;
        $parameterInsert['FS_DPJP'] = $request->cDpjp;
        $parameterInsert['FS_USER'] = Auth::user()->name;


        // --- HANDLE PROCESS
        try {
            DB::table('TAR_CPPT')->insert($parameterInsert);
            return redirect()->route('rekam-medis.detail',$nomorMr)->with(['success' => 'Data berhasil dibuat !']);
        } catch (\Throwable $th) {
            return redirect()->route('rekam-medis.detail', $nomorMr)->with(['failed' => $th->getMessage()]);
        }
    }

    public function detail($id)
    {
        $data['page_title'] = "Detail Catatan SOAP";

        $QUERY_CPPT = "select * from TAR_CPPT where FN_ID = '$id' order by FN_ID desc";
        $data['CPPT'] = DB::select($QUERY_CPPT);
        $nomorMr = $data['CPPT'][0]->FS_MR;

        $QUERY = "select aa.FS_MR,aa.FS_NM_PASIEN,aa.FD_TGL_LAHIR,
        aa.FB_JNS_KELAMIN,bb.fs_nm_agama,cc.FS_KD_REG,cc.FD_TGL_MASUK,
        cc.FS_JAM_MASUK,dd.FS_NM_PEG,fs_nm_jaminan
        from
        tc_mr aa
        inner join TA_AGAMA bb on aa.FS_KD_AGAMA = bb.fs_kd_agama
        inner join TA_REGISTRASI cc on aa.FS_MR = cc.FS_MR
        inner join TD_PEG dd on cc.FS_KD_MEDIS = dd.FS_KD_PEG
        inner	join ta_jaminan ee on cc.fs_kd_jaminan = ee.fs_kd_jaminan

        where aa.FS_MR = '$nomorMr'";
        $dataRekamMedis = DB::select($QUERY);
        if (count($dataRekamMedis) < 1) {
            $dataRekamMedis = [];
        } else {
            $dataRekamMedis = $dataRekamMedis[0];
        }

        $data['rekam_medis'] = $dataRekamMedis;

        $QUERY_LAYANAN = "select	aa.FS_KD_LAYANAN, FS_NM_LAYANAN, FS_NM_INSTALASI
        from	TA_LAYANAN aa
        inner	join TA_INSTALASI bb on aa.fs_kd_instalasi = bb.FS_KD_INSTALASI
        where	1=1
        order	by FS_NM_INSTALASI desc";
        $data['layanan_bagian'] = DB::select($QUERY_LAYANAN);



        $data['CPPT'] = $data['CPPT'][0];
        return view('cppt.detail', $data);
    }
}
