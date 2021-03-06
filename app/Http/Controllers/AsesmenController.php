<?php

namespace App\Http\Controllers;

use App\AsesmenPerawat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PDF;
class AsesmenController extends Controller
{
    public function awalPerawat($from,$type,$nomorMr, $kdReg=''){
        $cariKdDokter = "select * from TA_REGISTRASI where fs_kd_reg = '$kdReg'";
        $dt = DB::select($cariKdDokter);

        if ($dt) {
            $kdDokter = $dt[0]->FS_KD_MEDIS;
        } else {
            $kdDokter = '';
        }
        $data['page_title'] = "Asesmen Awal";
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


        return view('asesmen.awal-perawat', $data);

    }

    public function store(Request $request){


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

        $parameterInsert['FS_ALASAN_KUNJUNGAN'] = $request->cAlasanKunjungan;
        // -- PEMERIKSAAN FISIK
        $parameterInsert['FN_PF_TD'] = $request->cTd;
        $parameterInsert['FN_PF_TB'] = $request->cTb;
        $parameterInsert['FN_PF_NADI'] = $request->cNadi;
        $parameterInsert['FN_PF_BB'] = $request->cBb;
        $parameterInsert['FN_PF_RESPIRASI'] = $request->cRespirasi;
        $parameterInsert['FN_PF_SUHU'] = $request->cSuhu;

        // -- RIWAYAT KELUHAN UTAMA
        $FM_RKU_RPD_PDRWT = [
            'Tidak' => $request->cRkuPernahDirawatTidak ?? null,
            'Ya' => $request->cRkuPernahDirawatYa ?? null,
            'Diagnosa' => $request->cRkuPernahDirawatDiagnosa ?? null,
            'Kapan' => $request->cRkuPernahDirawatKapan ?? null
        ];
        $parameterInsert['FJ_RKU_RPD_PDRWT'] = $FM_RKU_RPD_PDRWT;

        $FJ_RKU_RPD_PDOPR = [
            'Tidak' => $request->cRkuPernahDioperasiTidak ?? null,
            'Ya' => $request->cRkuPernahDioperasiYa ?? null,
            'Diagnosa' => $request->cRkuPernahDioperasiJenis ?? null,
            'Kapan' => $request->cRkuPernahDioperasiKapan ?? null
        ];
        $parameterInsert['FJ_RKU_RPD_PDOPR'] = $FJ_RKU_RPD_PDOPR;

        $FJ_RKU_RPD_MSDPO = [
            'Tidak' => $request->cRkuMsdpoTidak ?? null,
            'Ya' => $request->cRkuMsdpoYa ?? null,
            'Obat' => $request->cRkuMsdpoObat ?? null,
        ];
        $parameterInsert['FJ_RKU_RPD_MSDPO'] = $FJ_RKU_RPD_MSDPO;

        $FJ_RPK = [
            'Tidak' => $request->cRkuRpkTidak ?? null,
            'Ya' => $request->cRkuRpkYa ?? null,
            'Hipertensi' => $request->cRkuRpkHipertensi ?? null,
            'Jantung' => $request->cRkuRpkJantung ?? null,
            'DM' => $request->cRkuRpkDM ?? null,
            'Paru' => $request->cRkuRpkParu ?? null,
            'Hepatitis' => $request->cRkuRpkHepatitis ?? null,
            'Lainnya' => $request->cRkuRpkLainnya ?? null,
        ];
        $parameterInsert['FJ_RPK'] = $FJ_RPK;

        $FJ_KETERGANTUNGAN = [
            'Tidak' => $request->cRkuKetTidak ?? null,
            'Ya' => $request->cRkuKetYa ?? null,
            'Obat' => $request->cRkuKetObat ?? null,
            'Alkohol' => $request->cRkuKetAlkohol ?? null,
            'Rokok' => $request->cRkuKetRokok ?? null,
            'Lainnya' => $request->cRkuKetLainnya ?? null,
        ];
        $parameterInsert['FJ_KETERGANTUNGAN'] = $FJ_KETERGANTUNGAN;

        $FJ_RIWAYAT_ALERGI = [
            'Tidak' => $request->cRkuRaTidak ?? null,
            'Ya' => $request->cRkuRaYa ?? null,
            'Lainnya' => $request->cRkuRaLainnya ?? null,
        ];
        $parameterInsert['FJ_RIWAYAT_ALERGI'] = $FJ_RIWAYAT_ALERGI;


        // RIWAYAT PSIKOSOSIAL
        $FJ_RP_SPSI = [
            'Tenang' => $request->cRpSpsiTenang ?? null,
            'Cemas' => $request->cRpSpsiCemas ?? null,
            'Takut' => $request->cRpSpsiTakut ?? null,
            'Marah' => $request->cRpSpsiMarah ?? null,
            'Sedih' => $request->cRpSpsiSedih ?? null,
            'BunuhDiri' => $request->cRpSpsiBunuhDiri ?? null,
            'laporKe' => $request->cRpSpsilaporKe ?? null,
            'lainnya' => $request->cRpSpsiLainnya ?? null,

        ];
        $parameterInsert['FJ_RP_SPSI'] = $FJ_RP_SPSI;

        $FJ_RP_SMEN = [
            'Sadar' => $request->cRpSmenSadar ?? null,
            'MasalahPrilaku' => $request->cRpSmenMasalahPrilaku ?? null,
            'MasalahPrilakuSebutkan' => $request->cRpSmenMasalahPrilakuSebutkan ?? null,
            'PrilakuKekerasaSebelumnya' => $request->cRpSmenPrilakuKekerasaSebelumnya ?? null,
            'PrilakuKekerasaSebelumnyaSebutkan' => $request->cRpSmenPrilakuKekerasaSebelumnyaSebutkan ?? null,
            'TidakDinilai' => $request->cRpSmenTidakDinilai ?? null,
        ];
        $parameterInsert['FJ_RP_SMEN'] = $FJ_RP_SMEN;

        $FJ_RP_SSOS_HPDAK = [
            'Baik' => $request->cRpSsosHpdakBaik ?? null,
            'TidakBaik' => $request->cRpSsosHpdakTidakBaik ?? null,
        ];
        $parameterInsert['FJ_RP_SSOS_HPDAK'] = $FJ_RP_SSOS_HPDAK;

        $FJ_RP_SSOS_KTYDD = [
            'Nama' => $request->cRpSsosKtyddNama ?? null,
            'Hubungan' => $request->cRpSsosKtyddHubungan ?? null,
            'Telepon' => $request->cRpSsosKtyddTelepon ?? null,
        ];
        $parameterInsert['FJ_RP_SSOS_KTYDD'] = $FJ_RP_SSOS_KTYDD;

        $FJ_RP_SEKO = [
            'PNS' => $request->cRpSekoPNS ?? null,
            'Swasta' => $request->cRpSekoSwasta ?? null,
            'Wiraswasta' => $request->cRpSekoWiraswasta ?? null,
            'Petani' => $request->cRpSekoPetani ?? null,
            'PekerjaanLainnya' => $request->cRpSekoPekerjaanLainnya ?? null,
            'PekerjaanLainnyaText' => $request->cRpSekoPekerjaanLainnyaText ?? null,
            'JKN' => $request->cRpSekoJKN ?? null,
            'Jamkesda' => $request->cRpSekoJamkesda ?? null,
            'Asuransi' => $request->cRpSekoAsuransi ?? null,
            'Pribadi' => $request->cRpSekoPribadi ?? null,
            'AsuransiLainnya' => $request->cRpSekoAsuransiLainnya ?? null,
            'AsuransiLainnyaText' => $request->cRpSekoAsuransiLainnyaText ?? null,
        ];
        $parameterInsert['FJ_RP_SEKO'] = $FJ_RP_SEKO;

        $FJ_RP_AGAMA = [
            'Islam' => $request->cRpAgamaIslam ?? null,
            'Kristen' => $request->cRpAgamaKristen ?? null,
            'Katolik' => $request->cRpAgamaKatolik ?? null,
            'Hindu' => $request->cRpAgamaHindu ?? null,
            'Budha' => $request->cRpAgamaBudha ?? null,
            'KepercayaanLain' => $request->cRpAgamaKepercayaanLain ?? null,
            'KepercayaanLainText' => $request->cRpAgamaKepercayaanLainText ?? null,

        ];
        $parameterInsert['FJ_RP_AGAMA'] = $FJ_RP_AGAMA;

        $FJ_SN_RATE = [
            '0' => $request->cSnRate0 ?? null,
            '1' => $request->cSnRate1 ?? null,
            '2' => $request->cSnRate2 ?? null,
            '3' => $request->cSnRate3 ?? null,
            '4' => $request->cSnRate4 ?? null,
            'text' => $request->cSnText ?? null,
        ];
        $parameterInsert['FJ_SN_RATE'] = $FJ_SN_RATE;

        $FJ_SN_NYERI = [
            'Ya' => $request->cSnNyeriYa ?? null,
            'Tidak' => $request->cSnNyeriTidak ?? null,
        ];
        $parameterInsert['FJ_SN_NYERI'] = $FJ_SN_NYERI;
        $parameterInsert['FS_SN_LOKASI'] = $request->cSnLokasi;
        $parameterInsert['FS_SN_DURASI'] = $request->cSnDurasi;
        $parameterInsert['FS_SN_FREKUENSI'] = $request->cSnFrekuensi;


        $FJ_SN_NHB = [
            'MinumObat' => $request->cSnNhbMinumObat ?? null,
            'Istirahat' => $request->cSnNhbIstirahat ?? null,
            'MendengarkanMusik' => $request->cSnNhbMendengarkanMusik ?? null,
            'BerubahPosisiTidur' => $request->cSnNhbBerubahPosisiTidur ?? null,
            'Lainnya' => $request->cSnNhbLainnya ?? null,
            'LainnyaText' => $request->cSnNhbLainnyaText ?? null,
        ];
        $parameterInsert['FJ_SN_NHB'] = $FJ_SN_NHB;

        $FJ_SN_DKD = [
            'Ya' => $request->cSnDkdYa ?? null,
            'Pukul' => $request->cSnDkdPukul ?? null,
            'Tidak' => $request->cSnDkdTidak ?? null,
        ];
        $parameterInsert['FJ_SN_DKD'] = $FJ_SN_DKD;




        // --- HANDLE PROCESS
        try {
            AsesmenPerawat::create($parameterInsert);

            return redirect()->route('rekam-medis.detail', [$request->cFrom, $request->cNomorMR,  $request->cRegister])->with(['success' => 'Data Asesmen berhasil dibuat !']);
        } catch (\Throwable $th) {
            return redirect()->route('rekam-medis.detail', [$request->cFrom, $request->cNomorMR,  $request->cRegister])->with(['failed' => $th->getMessage()]);
        }


        // DB::table('TAR_ASESMEN_PERAWAT')->insert($parameterInsert);
    }

    public function detailPerawat($type,$id){
        $data['page_title'] = "Detail Asesmen Perawat";
        $data['type'] = $type;
        $data['from'] = $type;
        $data['id'] = $id;


        $dataAsesmenPerawat = AsesmenPerawat::find($id);
        $data['data_asesmen'] = $dataAsesmenPerawat;

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

        where aa.FS_MR = '$dataAsesmenPerawat->FS_MR'";
        if ($dataAsesmenPerawat->FS_KD_PEG != '') {
            $QUERY .= "and dd.FS_KD_PEG = '$dataAsesmenPerawat->FS_KD_PEG'";
        }
        if ($dataAsesmenPerawat->FS_REGISTER != '') {
            $QUERY .= "and cc.FS_KD_REG = '$dataAsesmenPerawat->FS_REGISTER'";
        }

        $QUERY .= 'ORDER BY cc.FS_KD_REG desc';
        $dataRekamMedis = DB::select($QUERY);
        if (count($dataRekamMedis) < 1) {
            $dataRekamMedis = [];
        } else {
            $dataRekamMedis = $dataRekamMedis[0];
        }
        // dd($dataAsesmenPerawat);

        $data['rekam_medis'] = $dataRekamMedis;

        $QUERY_LAYANAN = "select	aa.FS_KD_LAYANAN, FS_NM_LAYANAN, FS_NM_INSTALASI
        from	TA_LAYANAN aa
        inner	join TA_INSTALASI bb on aa.fs_kd_instalasi = bb.FS_KD_INSTALASI
        where	1=1
        order	by FS_NM_INSTALASI desc";
        $data['layanan_bagian'] = DB::select($QUERY_LAYANAN);

        return view('asesmen.awal-perawat-detail', $data);
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

        $parameterInsert['FS_ALASAN_KUNJUNGAN'] = $request->cAlasanKunjungan;
        // -- PEMERIKSAAN FISIK
        $parameterInsert['FN_PF_TD'] = $request->cTd;
        $parameterInsert['FN_PF_TB'] = $request->cTb;
        $parameterInsert['FN_PF_NADI'] = $request->cNadi;
        $parameterInsert['FN_PF_BB'] = $request->cBb;
        $parameterInsert['FN_PF_RESPIRASI'] = $request->cRespirasi;
        $parameterInsert['FN_PF_SUHU'] = $request->cSuhu;

        // -- RIWAYAT KELUHAN UTAMA
        $FM_RKU_RPD_PDRWT = [
            'Tidak' => $request->cRkuPernahDirawatTidak ?? null,
            'Ya' => $request->cRkuPernahDirawatYa ?? null,
            'Diagnosa' => $request->cRkuPernahDirawatDiagnosa ?? null,
            'Kapan' => $request->cRkuPernahDirawatKapan ?? null
        ];
        $parameterInsert['FJ_RKU_RPD_PDRWT'] = json_encode($FM_RKU_RPD_PDRWT);

        $FJ_RKU_RPD_PDOPR = [
            'Tidak' => $request->cRkuPernahDioperasiTidak ?? null,
            'Ya' => $request->cRkuPernahDioperasiYa ?? null,
            'Diagnosa' => $request->cRkuPernahDioperasiJenis ?? null,
            'Kapan' => $request->cRkuPernahDioperasiKapan ?? null
        ];
        $parameterInsert['FJ_RKU_RPD_PDOPR'] = json_encode($FJ_RKU_RPD_PDOPR);

        $FJ_RKU_RPD_MSDPO = [
            'Tidak' => $request->cRkuMsdpoTidak ?? null,
            'Ya' => $request->cRkuMsdpoYa ?? null,
            'Obat' => $request->cRkuMsdpoObat ?? null,
        ];
        $parameterInsert['FJ_RKU_RPD_MSDPO'] = json_encode($FJ_RKU_RPD_MSDPO);

        $FJ_RPK = [
            'Tidak' => $request->cRkuRpkTidak ?? null,
            'Ya' => $request->cRkuRpkYa ?? null,
            'Hipertensi' => $request->cRkuRpkHipertensi ?? null,
            'Jantung' => $request->cRkuRpkJantung ?? null,
            'DM' => $request->cRkuRpkDM ?? null,
            'Paru' => $request->cRkuRpkParu ?? null,
            'Hepatitis' => $request->cRkuRpkHepatitis ?? null,
            'Lainnya' => $request->cRkuRpkLainnya ?? null,
        ];
        $parameterInsert['FJ_RPK'] = json_encode($FJ_RPK);

        $FJ_KETERGANTUNGAN = [
            'Tidak' => $request->cRkuKetTidak ?? null,
            'Ya' => $request->cRkuKetYa ?? null,
            'Obat' => $request->cRkuKetObat ?? null,
            'Alkohol' => $request->cRkuKetAlkohol ?? null,
            'Rokok' => $request->cRkuKetRokok ?? null,
            'Lainnya' => $request->cRkuKetLainnya ?? null,
        ];
        $parameterInsert['FJ_KETERGANTUNGAN'] = json_encode($FJ_KETERGANTUNGAN);

        $FJ_RIWAYAT_ALERGI = [
            'Tidak' => $request->cRkuRaTidak ?? null,
            'Ya' => $request->cRkuRaYa ?? null,
            'Lainnya' => $request->cRkuRaLainnya ?? null,
        ];
        $parameterInsert['FJ_RIWAYAT_ALERGI'] = json_encode($FJ_RIWAYAT_ALERGI);


        // RIWAYAT PSIKOSOSIAL
        $FJ_RP_SPSI = [
            'Tenang' => $request->cRpSpsiTenang ?? null,
            'Cemas' => $request->cRpSpsiCemas ?? null,
            'Takut' => $request->cRpSpsiTakut ?? null,
            'Marah' => $request->cRpSpsiMarah ?? null,
            'Sedih' => $request->cRpSpsiSedih ?? null,
            'BunuhDiri' => $request->cRpSpsiBunuhDiri ?? null,
            'laporKe' => $request->cRpSpsilaporKe ?? null,
            'lainnya' => $request->cRpSpsiLainnya ?? null,

        ];
        $parameterInsert['FJ_RP_SPSI'] = json_encode($FJ_RP_SPSI);

        $FJ_RP_SMEN = [
            'Sadar' => $request->cRpSmenSadar ?? null,
            'MasalahPrilaku' => $request->cRpSmenMasalahPrilaku ?? null,
            'MasalahPrilakuSebutkan' => $request->cRpSmenMasalahPrilakuSebutkan ?? null,
            'PrilakuKekerasaSebelumnya' => $request->cRpSmenPrilakuKekerasaSebelumnya ?? null,
            'PrilakuKekerasaSebelumnyaSebutkan' => $request->cRpSmenPrilakuKekerasaSebelumnyaSebutkan ?? null,
            'TidakDinilai' => $request->cRpSmenTidakDinilai ?? null,
        ];
        $parameterInsert['FJ_RP_SMEN'] = json_encode($FJ_RP_SMEN);

        $FJ_RP_SSOS_HPDAK = [
            'Baik' => $request->cRpSsosHpdakBaik ?? null,
            'TidakBaik' => $request->cRpSsosHpdakTidakBaik ?? null,
        ];
        $parameterInsert['FJ_RP_SSOS_HPDAK'] = json_encode($FJ_RP_SSOS_HPDAK);

        $FJ_RP_SSOS_KTYDD = [
            'Nama' => $request->cRpSsosKtyddNama ?? null,
            'Hubungan' => $request->cRpSsosKtyddHubungan ?? null,
            'Telepon' => $request->cRpSsosKtyddTelepon ?? null,
        ];
        $parameterInsert['FJ_RP_SSOS_KTYDD'] = json_encode($FJ_RP_SSOS_KTYDD);

        $FJ_RP_SEKO = [
            'PNS' => $request->cRpSekoPNS ?? null,
            'Swasta' => $request->cRpSekoSwasta ?? null,
            'Wiraswasta' => $request->cRpSekoWiraswasta ?? null,
            'Petani' => $request->cRpSekoPetani ?? null,
            'PekerjaanLainnya' => $request->cRpSekoPekerjaanLainnya ?? null,
            'PekerjaanLainnyaText' => $request->cRpSekoPekerjaanLainnyaText ?? null,
            'JKN' => $request->cRpSekoJKN ?? null,
            'Jamkesda' => $request->cRpSekoJamkesda ?? null,
            'Asuransi' => $request->cRpSekoAsuransi ?? null,
            'Pribadi' => $request->cRpSekoPribadi ?? null,
            'AsuransiLainnya' => $request->cRpSekoAsuransiLainnya ?? null,
            'AsuransiLainnyaText' => $request->cRpSekoAsuransiLainnyaText ?? null,
        ];
        $parameterInsert['FJ_RP_SEKO'] = json_encode($FJ_RP_SEKO);

        $FJ_RP_AGAMA = [
            'Islam' => $request->cRpAgamaIslam ?? null,
            'Kristen' => $request->cRpAgamaKristen ?? null,
            'Katolik' => $request->cRpAgamaKatolik ?? null,
            'Hindu' => $request->cRpAgamaHindu ?? null,
            'Budha' => $request->cRpAgamaBudha ?? null,
            'KepercayaanLain' => $request->cRpAgamaKepercayaanLain ?? null,
            'KepercayaanLainText' => $request->cRpAgamaKepercayaanLainText ?? null,

        ];
        $parameterInsert['FJ_RP_AGAMA'] = json_encode($FJ_RP_AGAMA);

        $FJ_SN_RATE = [
            '0' => $request->cSnRate0 ?? null,
            '1' => $request->cSnRate1 ?? null,
            '2' => $request->cSnRate2 ?? null,
            '3' => $request->cSnRate3 ?? null,
            '4' => $request->cSnRate4 ?? null,
            'text' => $request->cSnText ?? null,

        ];
        $parameterInsert['FJ_SN_RATE'] = json_encode($FJ_SN_RATE);

        $FJ_SN_NYERI = [
            'Ya' => $request->cSnNyeriYa ?? null,
            'Tidak' => $request->cSnNyeriTidak ?? null,
        ];
        $parameterInsert['FJ_SN_NYERI'] = json_encode($FJ_SN_NYERI);
        $parameterInsert['FS_SN_LOKASI'] = $request->cSnLokasi;
        $parameterInsert['FS_SN_DURASI'] = $request->cSnDurasi;
        $parameterInsert['FS_SN_FREKUENSI'] = $request->cSnFrekuensi;


        $FJ_SN_NHB = [
            'MinumObat' => $request->cSnNhbMinumObat ?? null,
            'Istirahat' => $request->cSnNhbIstirahat ?? null,
            'MendengarkanMusik' => $request->cSnNhbMendengarkanMusik ?? null,
            'BerubahPosisiTidur' => $request->cSnNhbBerubahPosisiTidur ?? null,
            'Lainnya' => $request->cSnNhbLainnya ?? null,
            'LainnyaText' => $request->cSnNhbLainnyaText ?? null,
        ];
        $parameterInsert['FJ_SN_NHB'] = json_encode($FJ_SN_NHB);

        $FJ_SN_DKD = [
            'Ya' => $request->cSnDkdYa ?? null,
            'Pukul' => $request->cSnDkdPukul ?? null,
            'Tidak' => $request->cSnDkdTidak ?? null,
        ];
        $parameterInsert['FJ_SN_DKD'] = json_encode($FJ_SN_DKD);



        // --- HANDLE PROCESS
        try {
            AsesmenPerawat::where('FN_ID',$id)->update($parameterInsert);
            return redirect()->route('rekam-medis.detail', [$request->cFrom, $request->cNomorMR,  $request->cRegister])->with(['success' => 'Data Asesmen berhasil update !']);

        } catch (\Throwable $th) {
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
            DB::table('TAR_ASESMEN_PERAWAT')
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
            DB::table('TAR_ASESMEN_PERAWAT')
            ->where('FN_ID', $id)
                ->update($dataUpdate);
            return redirect()->back()->with(['success' => 'Data berhasil di unverifikasi !']);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['failed' => $th->getMessage()]);
        }
    }

    public function pdf($from, $id)
    {
        $data['page_title'] = "Detail Catatan SOAP";
        $data['from'] = $from;


        $dataAsesmenPerawat = AsesmenPerawat::find($id);
        $data['data_asesmen'] = $dataAsesmenPerawat;

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

        where aa.FS_MR = '$dataAsesmenPerawat->FS_MR'";
        if ($dataAsesmenPerawat->FS_KD_PEG != '') {
            $QUERY .= "and dd.FS_KD_PEG = '$dataAsesmenPerawat->FS_KD_PEG'";
        }
        if ($dataAsesmenPerawat->FS_REGISTER != '') {
            $QUERY .= "and cc.FS_KD_REG = '$dataAsesmenPerawat->FS_REGISTER'";
        }

        $QUERY .= 'ORDER BY cc.FS_KD_REG desc';
        $dataRekamMedis = DB::select($QUERY);
        if (count($dataRekamMedis) < 1) {
            $dataRekamMedis = [];
        } else {
            $dataRekamMedis = $dataRekamMedis[0];
        }
        // dd($dataAsesmenPerawat);

        $data['rekam_medis'] = $dataRekamMedis;

        $QUERY_LAYANAN = "select	aa.FS_KD_LAYANAN, FS_NM_LAYANAN, FS_NM_INSTALASI
        from	TA_LAYANAN aa
        inner	join TA_INSTALASI bb on aa.fs_kd_instalasi = bb.FS_KD_INSTALASI
        where	1=1
        order	by FS_NM_INSTALASI desc";
        $data['layanan_bagian'] = DB::select($QUERY_LAYANAN);


        $data['rumah_sakit'] = DB::select("select	fs_nm_rs, fs_alm_rs, fs_tlp_rs , FS_FAX_RS from	t_parameter");

        $pdf = PDF::loadView('asesmen.awal-perawat-pdf', $data)->setOptions(['isRemoteEnabled' => true]);



        return $pdf->stream('asesmen.awal-perawat-pdf');
    }


}
