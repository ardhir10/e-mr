<?php

namespace App\Http\Controllers;

use App\AsesmenDokterBidan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AsesmenBidanController extends Controller
{
    public function create($from, $type, $nomorMr, $kdDokter = '', $kdReg = '')
    {
        $data['page_title'] = "Asesmen Awal Dokter";
        $data['kd_reg'] = $kdReg;
        $data['from'] = $from;
        $data['type'] = $type;


        // --- DETAIL HEADER
        $QUERY = "select aa.FS_MR,aa.FS_NM_PASIEN,aa.FD_TGL_LAHIR,
        aa.FB_JNS_KELAMIN,bb.fs_nm_agama,cc.FS_KD_REG,cc.FD_TGL_MASUK,
        cc.FS_JAM_MASUK,dd.FS_NM_PEG,fs_nm_jaminan,dd.FS_KD_PEG,cc.FS_KD_LAYANAN
        from
        tc_mr aa
        inner join TA_AGAMA bb on aa.FS_KD_AGAMA = bb.fs_kd_agama
        inner join TA_REGISTRASI cc on aa.FS_MR = cc.FS_MR
        inner join TD_PEG dd on cc.FS_KD_MEDIS = dd.FS_KD_PEG
        inner	join ta_jaminan ee on cc.fs_kd_jaminan = ee.fs_kd_jaminan

        where aa.FS_MR = '$nomorMr'";
        if ($kdDokter != '') {
            $QUERY .= "and dd.FS_KD_PEG = '$kdDokter'";
        }
        if ($kdReg != '') {
            $QUERY .= "and cc.FS_KD_REG = '$kdReg'";
        }

        $QUERY .= 'ORDER BY cc.FS_KD_REG desc';
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


        return view('asesmen.awal-dokter-bidan', $data);
    }

    public function store(Request $request)
    {


        // --- BAGIAN VALIDASI
        $messages = [
            'cProfesi.required' => 'Profesi wajib diisi !',
            'cLayanan.required' => 'Layanan wajib diisi !',
        ];
        $request->validate([
            'cProfesi' => 'required',
            'cLayanan' => 'required',
        ], $messages);


        $parameterInsert['FD_DATE'] = date('Y-m-d H:i:s');
        $parameterInsert['FS_MR'] = $request->cNomorMR;
        $parameterInsert['FS_KD_LAYANAN'] = $request->cLayanan;
        $parameterInsert['FS_PROFESI'] = $request->cProfesi;
        $parameterInsert['FS_DPJP'] = $request->cDpjp;
        $parameterInsert['FS_USER'] = Auth::user()->name;
        $parameterInsert['FS_REGISTER'] = $request->cRegister;
        $parameterInsert['FS_KD_PEG'] = $request->cKdpeg;
        $parameterInsert['FS_FROM'] = $request->cFrom;
        $parameterInsert['FS_TYPE'] = $request->cType;
        $parameterInsert['FS_VERIFIED_BY'] = null;

        // --- PENGKAJIAN
        $FJ_DS = [
            'Auto' => $request->cDsAuto ?? null,
            'Allo' => $request->cDsAllo ?? null,
            'Text' => $request->cDsText ?? null,
        ];
        $parameterInsert['FJ_DS'] = $FJ_DS;
        $parameterInsert['FS_RPD'] = $request->cRpd;

        $FJ_RK = [
            'Gravida' => $request->cRkGravida ?? null,
            'Aterm' => $request->cRkAterm ?? null,
            'Prematur' => $request->cRkPrematur ?? null,
            'Abortus' => $request->cRkAbortus ?? null,
            'AnakHidup' => $request->cRkAnakHidup ?? null,
            'SC' => $request->cRkSC ?? null,

        ];
        $parameterInsert['FJ_RK'] = $FJ_RK;

        $FJ_RP  = [
            'Menikah' => $request->cRpMenikah ?? null,
            'BelumMenikah' => $request->cRpBelumMenikah ?? null,
        ];
        $parameterInsert['FJ_RP'] = $FJ_RP ;

        $FJ_RH  = [
            'HaidPertamaUsia' => $request->cRhHaidPertamaUsia ?? null,
            'SiklusHaid' => $request->cRhSiklusHaid ?? null,
            'HaidTeraturYa' => $request->cRhHaidTeraturYa ?? null,
            'HaidTeraturTidak' => $request->cRhHaidTeraturTidak ?? null,
            'HaidPertamaTerakhir' => $request->cRhHaidHariPertamaTerakhir ?? null,
            'NyeriHaidYa' => $request->cRhNyeriHaidYa ?? null,
            'NyeriHaidTidak' => $request->cRhNyeriHaidTidak ?? null,
            'TaksiranPersalinan' => $request->cRhTaksiranPersalinan ?? null,
            'LamaHaid' => $request->cRhLamaHaid ?? null,
        ];
        $parameterInsert['FJ_RH'] = $FJ_RH ;
        $parameterInsert['FJ_RPSL'] = $request->cRpsl;





        $FJ_DO = [
            'KeadaanUmum' => $request->cDoKeadaanUmum ?? null,
            'Kesadaran' => $request->cDoKesadaran ?? null,
            'GCSE' => $request->cDoGCSE ?? null,
            'GCSV' => $request->cDoGCSV ?? null,
            'GCSM' => $request->cDoGCSM ?? null,
            'TD' => $request->cDoTD ?? null,
            'Nadi' => $request->cDoNadi ?? null,
            'Respirasi' => $request->cDoRespirasi ?? null,
            'Suhu' => $request->cDoSuhu ?? null,
            'TFU' => $request->cDoTFU ?? null,
            'DJJ' => $request->cDoDJJ ?? null,
            'His' => $request->cDoHis ?? null,
            'TBJ' => $request->cDoTBJ ?? null,
        ];
        $parameterInsert['FJ_DO'] = $FJ_DO;



        $parameterInsert['FS_PEMERIKSAAN_FISIK_TAMBAHAN'] = $request->cPemeriksaanFisikTambahan;

        $parameterInsert['FS_PEMERIKSAAN_PENUNJANG '] = $request->cPemeriksaanPenunjang;
        $parameterInsert['FS_TINDAKAN_TERAPI'] = $request->cTindakanTerapi;
        $parameterInsert['FS_KODE_DIAGNOSIS'] = $request->cKodeDiagnosis;

        $FJ_DIAGNOSA_SEKUNDER = [
            '1' => $request->cDiagnosaSekunder1 ?? null,
            '2' => $request->cDiagnosaSekunder2 ?? null,
            '3' => $request->cDiagnosaSekunder3 ?? null,
        ];
        $parameterInsert['FJ_DIAGNOSA_SEKUNDER'] = $FJ_DIAGNOSA_SEKUNDER;
        $parameterInsert['FS_DETAIL_DIAGNOSIS'] = $request->cDetailDiagnosis;


        $FJ_RENCANA_TINDAK_LANJUT = [
            'Pulang' => $request->cRtlPulang ?? null,
            'KontrolTanggal' => $request->cRtlKontrolTanggal ?? null,
            'KontrolTanggalText' => $request->cRtlKontrolTanggalText ?? null,
            'KonsulKe' => $request->cRtlKonsulKe ?? null,
            'KonsulKeText' => $request->cRtlKontulKeText ?? null,
            'RujukKe' => $request->cRtlRujukKe ?? null,
            'RujukKeText' => $request->cRtlRujukKeText ?? null,
            'RawatInap' => $request->cRtlRawatInap ?? null,
            'RawatInapText' => $request->cRtlRawatInapText ?? null,
        ];
        $parameterInsert['FJ_RENCANA_TINDAK_LANJUT'] = $FJ_RENCANA_TINDAK_LANJUT;

        // dd($parameterInsert);
        // --- HANDLE PROCESS
        try {
            AsesmenDokterBidan::create($parameterInsert);

            return redirect()->route('rekam-medis.detail', [$request->cFrom, $request->cNomorMR, $request->cKdpeg, $request->cRegister])->with(['success' => 'Data Asesmen Dokter berhasil dibuat !']);
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->route('rekam-medis.detail', [$request->cFrom, $request->cNomorMR, $request->cKdpeg, $request->cRegister])->with(['failed' => $th->getMessage()]);
        }


        // DB::table('TAR_ASESMEN_PERAWAT')->insert($parameterInsert);
    }

    public function update(Request $request,$id)
    {


        // --- BAGIAN VALIDASI
        $messages = [
            'cProfesi.required' => 'Profesi wajib diisi !',
            'cLayanan.required' => 'Layanan wajib diisi !',
        ];
        $request->validate([
            'cProfesi' => 'required',
            'cLayanan' => 'required',
        ], $messages);


        $parameterInsert['FD_DATE'] = date('Y-m-d H:i:s');
        $parameterInsert['FS_MR'] = $request->cNomorMR;
        $parameterInsert['FS_KD_LAYANAN'] = $request->cLayanan;
        $parameterInsert['FS_PROFESI'] = $request->cProfesi;
        $parameterInsert['FS_DPJP'] = $request->cDpjp;
        $parameterInsert['FS_USER'] = Auth::user()->name;
        $parameterInsert['FS_REGISTER'] = $request->cRegister;
        $parameterInsert['FS_KD_PEG'] = $request->cKdpeg;
        $parameterInsert['FS_FROM'] = $request->cFrom;
        $parameterInsert['FS_TYPE'] = $request->cType;
        $parameterInsert['FS_VERIFIED_BY'] = null;

        // --- PENGKAJIAN
        $FJ_DS = [
            'Auto' => $request->cDsAuto ?? null,
            'Allo' => $request->cDsAllo ?? null,
            'Text' => $request->cDsText ?? null,
        ];
        $parameterInsert['FJ_DS'] = json_encode($FJ_DS);
        $parameterInsert['FS_RPD'] = $request->cRpd;

        $FJ_RK = [
            'Gravida' => $request->cRkGravida ?? null,
            'Aterm' => $request->cRkAterm ?? null,
            'Prematur' => $request->cRkPrematur ?? null,
            'Abortus' => $request->cRkAbortus ?? null,
            'AnakHidup' => $request->cRkAnakHidup ?? null,
            'SC' => $request->cRkSC ?? null,

        ];
        $parameterInsert['FJ_RK'] = json_encode($FJ_RK);

        $FJ_RP  = [
            'Menikah' => $request->cRpMenikah ?? null,
            'BelumMenikah' => $request->cRpBelumMenikah ?? null,
        ];
        $parameterInsert['FJ_RP'] = json_encode($FJ_RP);

        $FJ_RH  = [
            'HaidPertamaUsia' => $request->cRhHaidPertamaUsia ?? null,
            'SiklusHaid' => $request->cRhSiklusHaid ?? null,
            'HaidTeraturYa' => $request->cRhHaidTeraturYa ?? null,
            'HaidTeraturTidak' => $request->cRhHaidTeraturTidak ?? null,
            'HaidPertamaTerakhir' => $request->cRhHaidHariPertamaTerakhir ?? null,
            'NyeriHaidYa' => $request->cRhNyeriHaidYa ?? null,
            'NyeriHaidTidak' => $request->cRhNyeriHaidTidak ?? null,
            'TaksiranPersalinan' => $request->cRhTaksiranPersalinan ?? null,
            'LamaHaid' => $request->cRhLamaHaid ?? null,
        ];
        $parameterInsert['FJ_RH'] = json_encode($FJ_RH);
        $parameterInsert['FJ_RPSL'] = json_encode($request->cRpsl);





        $FJ_DO = [
            'KeadaanUmum' => $request->cDoKeadaanUmum ?? null,
            'Kesadaran' => $request->cDoKesadaran ?? null,
            'GCSE' => $request->cDoGCSE ?? null,
            'GCSV' => $request->cDoGCSV ?? null,
            'GCSM' => $request->cDoGCSM ?? null,
            'TD' => $request->cDoTD ?? null,
            'Nadi' => $request->cDoNadi ?? null,
            'Respirasi' => $request->cDoRespirasi ?? null,
            'Suhu' => $request->cDoSuhu ?? null,
            'TFU' => $request->cDoTFU ?? null,
            'DJJ' => $request->cDoDJJ ?? null,
            'His' => $request->cDoHis ?? null,
            'TBJ' => $request->cDoTBJ ?? null,
        ];
        $parameterInsert['FJ_DO'] = json_encode($FJ_DO);



        $parameterInsert['FS_PEMERIKSAAN_FISIK_TAMBAHAN'] = $request->cPemeriksaanFisikTambahan;

        $parameterInsert['FS_PEMERIKSAAN_PENUNJANG '] = $request->cPemeriksaanPenunjang;
        $parameterInsert['FS_TINDAKAN_TERAPI'] = $request->cTindakanTerapi;
        $parameterInsert['FS_KODE_DIAGNOSIS'] = $request->cKodeDiagnosis;

        $FJ_DIAGNOSA_SEKUNDER = [
            '1' => $request->cDiagnosaSekunder1 ?? null,
            '2' => $request->cDiagnosaSekunder2 ?? null,
            '3' => $request->cDiagnosaSekunder3 ?? null,
        ];
        $parameterInsert['FJ_DIAGNOSA_SEKUNDER'] = json_encode($FJ_DIAGNOSA_SEKUNDER);
        $parameterInsert['FS_DETAIL_DIAGNOSIS'] = $request->cDetailDiagnosis;


        $FJ_RENCANA_TINDAK_LANJUT = [
            'Pulang' => $request->cRtlPulang ?? null,
            'KontrolTanggal' => $request->cRtlKontrolTanggal ?? null,
            'KontrolTanggalText' => $request->cRtlKontrolTanggalText ?? null,
            'KonsulKe' => $request->cRtlKonsulKe ?? null,
            'KonsulKeText' => $request->cRtlKontulKeText ?? null,
            'RujukKe' => $request->cRtlRujukKe ?? null,
            'RujukKeText' => $request->cRtlRujukKeText ?? null,
            'RawatInap' => $request->cRtlRawatInap ?? null,
            'RawatInapText' => $request->cRtlRawatInapText ?? null,
        ];
        $parameterInsert['FJ_RENCANA_TINDAK_LANJUT'] = json_encode($FJ_RENCANA_TINDAK_LANJUT);

        // dd($parameterInsert);
        // --- HANDLE PROCESS
        try {
            AsesmenDokterBidan::where('FN_ID',$id)->update($parameterInsert);

            return redirect()->route('rekam-medis.detail', [$request->cFrom, $request->cNomorMR, $request->cKdpeg, $request->cRegister])->with(['success' => 'Data Asesmen Dokter berhasil diupdate !']);
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->route('rekam-medis.detail', [$request->cFrom, $request->cNomorMR, $request->cKdpeg, $request->cRegister])->with(['failed' => $th->getMessage()]);
        }


        // DB::table('TAR_ASESMEN_PERAWAT')->insert($parameterInsert);
    }

    public function detail($type, $id)
    {
        $data['page_title'] = "Detail Asesmen Dokter ";
        $data['type'] = $type;
        $data['from'] = 'ALL';


        $dataAsesmen = AsesmenDokterBidan::find($id);
        $data['data_asesmen'] = $dataAsesmen;
        // dd($dataAsesmen);
        // --- DETAIL HEADER
        $QUERY = "select aa.FS_MR,aa.FS_NM_PASIEN,aa.FD_TGL_LAHIR,
        aa.FB_JNS_KELAMIN,bb.fs_nm_agama,cc.FS_KD_REG,cc.FD_TGL_MASUK,
        cc.FS_JAM_MASUK,dd.FS_NM_PEG,fs_nm_jaminan,dd.FS_KD_PEG
        from
        tc_mr aa
        inner join TA_AGAMA bb on aa.FS_KD_AGAMA = bb.fs_kd_agama
        inner join TA_REGISTRASI cc on aa.FS_MR = cc.FS_MR
        inner join TD_PEG dd on cc.FS_KD_MEDIS = dd.FS_KD_PEG
        inner	join ta_jaminan ee on cc.fs_kd_jaminan = ee.fs_kd_jaminan

        where aa.FS_MR = '$dataAsesmen->FS_MR'";
        if ($dataAsesmen->FS_KD_PEG != '') {
            $QUERY .= "and dd.FS_KD_PEG = '$dataAsesmen->FS_KD_PEG'";
        }
        if ($dataAsesmen->FS_REGISTER != '') {
            $QUERY .= "and cc.FS_KD_REG = '$dataAsesmen->FS_REGISTER'";
        }

        $QUERY .= 'ORDER BY cc.FS_KD_REG desc';
        $dataRekamMedis = DB::select($QUERY);
        if (count($dataRekamMedis) < 1) {
            $dataRekamMedis = [];
        } else {
            $dataRekamMedis = $dataRekamMedis[0];
        }
        // dd($dataAsesmen);

        $data['rekam_medis'] = $dataRekamMedis;

        $QUERY_LAYANAN = "select	aa.FS_KD_LAYANAN, FS_NM_LAYANAN, FS_NM_INSTALASI
        from	TA_LAYANAN aa
        inner	join TA_INSTALASI bb on aa.fs_kd_instalasi = bb.FS_KD_INSTALASI
        where	1=1
        order	by FS_NM_INSTALASI desc";
        $data['layanan_bagian'] = DB::select($QUERY_LAYANAN);

        return view('asesmen.awal-dokter-bidan-detail', $data);
    }

    public function verified($id)
    {


        $kodePeg = Auth::user()->fs_kd_peg;
        if ($kodePeg == null) {
            return redirect()->back()->with(['failed' => 'User tidak diizinkan !']);
        }

        // --- HANDLE PROCESS
        try {
            $dokter = DB::table('TD_PEG')->where('FS_KD_PEG', $kodePeg)->first();
            $namaDokter = $dokter->FS_NM_PEG;
            $dataUpdate = [
                'FS_VERIFIED_BY' => $kodePeg,
                'FS_DPJP' => $namaDokter
            ];
            DB::table('TAR_ASESMEN_DOKTER_BIDAN')
            ->where('FN_ID', $id)
                ->update($dataUpdate);
            return redirect()->back()->with(['success' => 'Data berhasil di verifikasi !']);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['failed' => $th->getMessage()]);
        }
    }

    public function unverified($id)
    {

        $kodePeg = Auth::user()->fs_kd_peg;
        if ($kodePeg == null) {
            return redirect()->back()->with(['failed' => 'User tidak diizinkan !']);
        }

        // --- HANDLE PROCESS
        try {
            $dokter = DB::table('TD_PEG')->where('FS_KD_PEG', $kodePeg)->first();
            $namaDokter = $dokter->FS_NM_PEG;
            $dataUpdate = [
                'FS_VERIFIED_BY' => null,
                'FS_DPJP' => null
            ];
            DB::table('TAR_ASESMEN_DOKTER_BIDAN')
            ->where('FN_ID', $id)
                ->update($dataUpdate);
            return redirect()->back()->with(['success' => 'Data berhasil di unverifikasi !']);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['failed' => $th->getMessage()]);
        }
    }
}
