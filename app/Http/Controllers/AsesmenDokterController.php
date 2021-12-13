<?php

namespace App\Http\Controllers;

use App\AsesmenDokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use PDF;
class AsesmenDokterController extends Controller
{
    public function create($from, $type, $nomorMr, $kdReg = '')
    {
        $cariKdDokter = "select * from TA_REGISTRASI where fs_kd_reg = '$kdReg'";
        $dt = DB::select($cariKdDokter);

        if ($dt) {
            $kdDokter = $dt[0]->FS_KD_MEDIS;
        } else {
            $kdDokter = '';
        }
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


        return view('asesmen.awal-dokter', $data);
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
        $parameterInsert['FS_RO'] = $request->cRo;

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
        ];
        $parameterInsert['FJ_DO'] = $FJ_DO;
        $FJ_PEMERIKSAAN_FISIK  = [
                'KepalaNormal' => $request->cPfKepalaNormal ?? null,
                'KepalaTidakNormal' => $request->cPfKepalaTidakNormal ?? null,
                'MulutNormal' => $request->cPfMulutNormal ?? null,
                'MulutTidakNormal' => $request->cPfMulutTidakNormal ?? null,
                'LeherNormal' => $request->cPfLeherNormal ?? null,
                'LeherTidakNormal' => $request->cPfLeherTidakNormal ?? null,
                'JantungNormal' => $request->cPfJantungNormal ?? null,
                'JantungTidakNormal' => $request->cPfJantungTidakNormal ?? null,
                'ParuParuNormal' => $request->cPfParuParuNormal ?? null,
                'ParuParuTidakNormal' => $request->cPfParuParuTidakNormal ?? null,
                'PerutNormal' => $request->cPfPerutNormal ?? null,
                'PerutTidakNormal' => $request->cPfPerutTidakNormal ?? null,
                'AlatGerakNormal' => $request->cPfAlatGerakNormal ?? null,
                'AlatGerakTidakNormal' => $request->cPfAlatGerakTidakNormal ?? null,
                'AnusGenitaliaNormal' => $request->cPfAnusGenitaliaNormal ?? null,
                'AnusGenitaliaTidakNormal' => $request->cPfAnusGenitaliaTidakNormal ?? null,
        ];
        $parameterInsert['FJ_PEMERIKSAAN_FISIK '] = json_encode($FJ_PEMERIKSAAN_FISIK);

        $parameterInsert['FS_PEMERIKSAAN_PENUNJANG '] = $request->cPemeriksaanPenunjang;
        $parameterInsert['FS_TINDAKAN_TERAPI'] = $request->cTindakanTerapi;
        $parameterInsert['FS_KODE_DIAGNOSIS'] = $request->cKodeDiagnosis;

        $FJ_DIAGNOSA_SEKUNDER = [
            '1' => $request->cDiagnosaSekunder1 ?? null,
            '2' => $request->cDiagnosaSekunder2 ?? null,
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
            AsesmenDokter::create($parameterInsert);

            return redirect()->route('rekam-medis.detail', [$request->cFrom, $request->cNomorMR,  $request->cRegister])->with(['success' => 'Data Asesmen Dokter berhasil dibuat !']);
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->route('rekam-medis.detail', [$request->cFrom, $request->cNomorMR,  $request->cRegister])->with(['failed' => $th->getMessage()]);
        }


        // DB::table('TAR_ASESMEN_PERAWAT')->insert($parameterInsert);
    }

    function getIcd(Request $request){
        // $QUERY = "select fs_kd_icd, fs_nm_icd From   tc_icd10 order   by fs_kd_icd";
        if($request->input('term', '') != ''){
            $icd = DB::table('tc_icd10')->select('fs_kd_icd as id', 'fs_nm_icd as text')
            ->where('fs_nm_icd','LIKE',"%".$request->input('term', '')."%")
            ->orWhere('fs_kd_icd','LIKE',"%".$request->input('term', '')."%")
            ->get();
        }else{
            $icd = DB::table('tc_icd10')->select('fs_kd_icd as id', 'fs_nm_icd as text')
            ->get();
        }
        // $cities = City::where('name', 'LIKE', '%' . $request->input('term', '') . '%')
        // ->get(['id', 'name as text']);
        $results = [];
        foreach ($icd as $ic) {
            # code...
            $results[] = [
                'id'=>$ic->id,
                'text'=> "($ic->id) ".$ic->text,
            ];
        }
        return ['results' => $results];
    }


    public function detail($type, $id)
    {
        $data['page_title'] = "Detail Asesmen Dokter ";
        $data['type'] = $type;
        $data['from'] = $type;
        $data['id'] = $id;


        $dataAsesmen = AsesmenDokter::find($id);
        $data['data_asesmen'] = $dataAsesmen;
         // --- DETAIL HEADER
        $QUERY = "select aa.FS_MR,aa.FS_NM_PASIEN,aa.FD_TGL_LAHIR,
        aa.FB_JNS_KELAMIN,bb.fs_nm_agama,cc.FS_KD_REG,cc.FD_TGL_MASUK,
        cc.FS_JAM_MASUK,dd.FS_NM_PEG,fs_nm_jaminan,dd.FS_KD_PEG
        from
        tc_mr aa
        inner join TA_AGAMA bb on aa.FS_KD_AGAMA = bb.fs_kd_agama
        inner join TA_REGISTRASI cc on aa.FS_MR = cc.FS_MR
        inner join TD_PEG dd on cc.FS_KD_MEDIS = dd.FS_KD_PEG
        inner join ta_jaminan ee on cc.fs_kd_jaminan = ee.fs_kd_jaminan


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

        return view('asesmen.awal-dokter-detail', $data);
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
        $parameterInsert['FS_RO'] = $request->cRo;

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
        ];
        $parameterInsert['FJ_DO'] = json_encode($FJ_DO);
        $FJ_PEMERIKSAAN_FISIK  = [
            'KepalaNormal' => $request->cPfKepalaNormal ?? null,
            'KepalaTidakNormal' => $request->cPfKepalaTidakNormal ?? null,
            'MulutNormal' => $request->cPfMulutNormal ?? null,
            'MulutTidakNormal' => $request->cPfMulutTidakNormal ?? null,
            'LeherNormal' => $request->cPfLeherNormal ?? null,
            'LeherTidakNormal' => $request->cPfLeherTidakNormal ?? null,
            'JantungNormal' => $request->cPfJantungNormal ?? null,
            'JantungTidakNormal' => $request->cPfJantungTidakNormal ?? null,
            'ParuParuNormal' => $request->cPfParuParuNormal ?? null,
            'ParuParuTidakNormal' => $request->cPfParuParuTidakNormal ?? null,
            'PerutNormal' => $request->cPfPerutNormal ?? null,
            'PerutTidakNormal' => $request->cPfPerutTidakNormal ?? null,
            'AlatGerakNormal' => $request->cPfAlatGerakNormal ?? null,
            'AlatGerakTidakNormal' => $request->cPfAlatGerakTidakNormal ?? null,
            'AnusGenitaliaNormal' => $request->cPfAnusGenitaliaNormal ?? null,
            'AnusGenitaliaTidakNormal' => $request->cPfAnusGenitaliaTidakNormal ?? null,
        ];
        $parameterInsert['FJ_PEMERIKSAAN_FISIK '] = json_encode($FJ_PEMERIKSAAN_FISIK);

        $parameterInsert['FS_PEMERIKSAAN_PENUNJANG '] = $request->cPemeriksaanPenunjang;
        $parameterInsert['FS_TINDAKAN_TERAPI'] = $request->cTindakanTerapi;
        $parameterInsert['FS_KODE_DIAGNOSIS'] = $request->cKodeDiagnosis;

        $FJ_DIAGNOSA_SEKUNDER = [
            '1' => $request->cDiagnosaSekunder1 ?? null,
            '2' => $request->cDiagnosaSekunder2 ?? null,
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

        // --- HANDLE PROCESS
        try {
            AsesmenDokter::where('FN_ID', $id)->update($parameterInsert);

            return redirect()->route('rekam-medis.detail', [$request->cFrom, $request->cNomorMR,  $request->cRegister])->with(['success' => 'Data Asesmen Dokter berhasil diupdate !']);
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->route('rekam-medis.detail', [$request->cFrom, $request->cNomorMR,  $request->cRegister])->with(['failed' => $th->getMessage()]);
        }


        // DB::table('TAR_ASESMEN_PERAWAT')->insert($parameterInsert);
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
            DB::table('TAR_ASESMEN_DOKTER')
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
            DB::table('TAR_ASESMEN_DOKTER')
            ->where('FN_ID', $id)
                ->update($dataUpdate);
            return redirect()->back()->with(['success' => 'Data berhasil di unverifikasi !']);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['failed' => $th->getMessage()]);
        }
    }


    public function pdfPrint($from, $id)
    {
        $data['page_title'] = "Detail Catatan SOAP";
        $data['from'] = $from;


        $data['page_title'] = "Detail Asesmen Dokter ";
        $data['type'] = $from;
        $data['from'] = $from;
        $data['id'] = $id;


        $dataAsesmen = AsesmenDokter::find($id);
        $data['data_asesmen'] = $dataAsesmen;
        // --- DETAIL HEADER
        $QUERY = "select aa.FS_MR,aa.FS_NM_PASIEN,aa.FD_TGL_LAHIR,
        aa.FB_JNS_KELAMIN,bb.fs_nm_agama,cc.FS_KD_REG,cc.FD_TGL_MASUK,
        cc.FS_JAM_MASUK,dd.FS_NM_PEG,fs_nm_jaminan,dd.FS_KD_PEG
        from
        tc_mr aa
        inner join TA_AGAMA bb on aa.FS_KD_AGAMA = bb.fs_kd_agama
        inner join TA_REGISTRASI cc on aa.FS_MR = cc.FS_MR
        inner join TD_PEG dd on cc.FS_KD_MEDIS = dd.FS_KD_PEG
        inner join ta_jaminan ee on cc.fs_kd_jaminan = ee.fs_kd_jaminan


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

        $QUERY_LAYANAN = "select	aa.FS_KD_LAYANAN, FS_NM_LAYANAN, FS_NM_INSTALASI
        from	TA_LAYANAN aa
        inner	join TA_INSTALASI bb on aa.fs_kd_instalasi = bb.FS_KD_INSTALASI
        where	1=1
        order	by FS_NM_INSTALASI desc";
        $data['layanan_bagian'] = DB::select($QUERY_LAYANAN);


        $data['rumah_sakit'] = DB::select("select	fs_nm_rs, fs_alm_rs, fs_tlp_rs , FS_FAX_RS from	t_parameter");

        $pdf = PDF::loadView('asesmen.awal-dokter-pdf', $data)->setOptions(['isRemoteEnabled' => true]);



        return $pdf->stream('asesmen.awal-dokter-pdf');
    }

}
