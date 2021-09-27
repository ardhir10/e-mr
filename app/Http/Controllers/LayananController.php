<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class LayananController extends Controller
{
    public function index()
    {
        $data['page_title'] = "Layanan/Bagian";

        $QUERY = "select	aa.FS_KD_LAYANAN, FS_NM_LAYANAN, FS_NM_INSTALASI
        from	TA_LAYANAN aa
        inner	join TA_INSTALASI bb on aa.fs_kd_instalasi = bb.FS_KD_INSTALASI
        where	1=1
        order	by FS_NM_INSTALASI desc";
        $data['layanan_bagian'] = DB::select($QUERY);
        return view('master-data.layanan-bagian.index', $data);
    }

    public function create()
    {
        $data['page_title'] = "Buat Layanan/Bagian";

        $QUERY = "select FS_NM_INSTALASI from TA_INSTALASI";
        $data['instalasi'] = DB::select($QUERY);
        return view('master-data.layanan-bagian.create', $data);
    }
    public function edit($id)
    {
        $data['page_title'] = "Edit Satuan Tugas Medis";

        $data['satuan_tugas_medis'] = DB::table('TD_SAT_TUGAS')
            ->where('FS_KD_SAT_TUGAS', $id)
            ->first();

        return view('master-data.layanan-bagian.edit', $data);
    }


    public function store(Request $request)
    {

        // --- BAGIAN VALIDASI
        $messages = [
            'FS_KD_LAYANAN.required' => 'Kode layanan wajib diisi !',
            'FS_NM_LAYANAN.required' => 'Nama layanan wajib diisi !',
            'FS_NM_INSTALASI.required' => 'Instalasi wajib diisi !',
        ];
        $request->validate([
            'FS_KD_LAYANAN' => 'required',
            'FS_NM_LAYANAN' => 'required',
            'FS_NM_INSTALASI' => 'required',
        ], $messages);

        $parameterInsert = [
            'FS_KD_LAYANAN' => $request->FS_KD_LAYANAN,
            'FS_NM_LAYANAN' => $request->FS_NM_LAYANAN,
            'FS_NM_INSTALASI' => $request->FS_NM_INSTALASI
        ];


        // --- HANDLE PROCESS
        try {
            DB::table('TD_SAT_TUGAS')->insert($parameterInsert);
            return redirect()->route('layanan-bagian.index')->with(['success' => 'Data berhasil dibuat !']);
        } catch (\Throwable $th) {
            return redirect()->route('layanan-bagian.index')->with(['failed' => $th->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        // --- BAGIAN VALIDASI
        $messages = [
            'kd_satuan_tugas_medis.required' => 'Kode satuan tugas wajib diisi !',
            'nm_satuan_tugas_medis.required' => 'Nama satuan tugas wajib diisi !',
        ];
        $request->validate([
            'kd_satuan_tugas_medis' => 'required',
            'nm_satuan_tugas_medis' => 'required',
        ], $messages);

        $parameterUpdate = [
            'FS_KD_SAT_TUGAS' => $request->kd_satuan_tugas_medis,
            'FS_NM_SAT_TUGAS' => $request->nm_satuan_tugas_medis,
            'FB_MEDIS' => 1
        ];

        // --- HANDLE PROCESS
        try {
            DB::table('TD_SAT_TUGAS')->where('FS_KD_SAT_TUGAS', $id)->update($parameterUpdate);
            return redirect()->route('layanan-bagian.index')->with(['success' => 'Data berhasil disimpan !']);
        } catch (\Throwable $th) {
            return redirect()->route('layanan-bagian.index')->with(['failed' => $th->getMessage()]);
        }
    }


    public function delete($id)
    {

        try {
            DB::table('TD_SAT_TUGAS')->where('FS_KD_SAT_TUGAS', $id)->delete();
            return redirect()->route('layanan-bagian.index')->with(['failed' => 'Data berhasil dihapus !']);
        } catch (\Throwable $th) {
            return redirect()->route('layanan-bagian.index')->with(['failed' => $th->getMessage()]);
        }
    }

}
