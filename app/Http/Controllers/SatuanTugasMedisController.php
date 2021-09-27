<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SatuanTugasMedisController extends Controller
{
    public function index(){
        $data['page_title'] = "Satuan Tugas Medis";

        $QUERY = "select	FS_KD_SAT_TUGAS, FS_NM_SAT_TUGAS 
        from	TD_SAT_TUGAS
        where	FB_MEDIS = 1";
        $data['satuan_tugas_medis'] = DB::select($QUERY);
        return view('master-data.satuan-tugas-medis.index',$data);
    }

    public function create(){
        $data['page_title'] = "Buat Satuan Tugas Medis";
        return view('master-data.satuan-tugas-medis.create',$data);
    }
    public function edit($id){
        $data['page_title'] = "Edit Satuan Tugas Medis";

        $data['satuan_tugas_medis'] = DB::table('TD_SAT_TUGAS')
        ->where('FS_KD_SAT_TUGAS',$id)
        ->first();

        return view('master-data.satuan-tugas-medis.edit',$data);
    }


    public function store(Request $request){

        // --- BAGIAN VALIDASI
        $messages = [
            'kd_satuan_tugas_medis.required' => 'Kode satuan tugas wajib diisi !',
            'nm_satuan_tugas_medis.required' => 'Nama satuan tugas wajib diisi !',
        ];
        $request->validate([
            'kd_satuan_tugas_medis' => 'required',
            'nm_satuan_tugas_medis' => 'required',
        ], $messages);
        
        $parameterInsert = [
            'FS_KD_SAT_TUGAS'=> $request->kd_satuan_tugas_medis,
            'FS_NM_SAT_TUGAS'=> $request->nm_satuan_tugas_medis,
            'FB_MEDIS' => 1
        ];


        // --- HANDLE PROCESS
        try {
            DB::table('TD_SAT_TUGAS')->insert($parameterInsert);
            return redirect()->route('satuan-tugas-medis.index')->with(['success' => 'Data berhasil dibuat !']);
        } catch (\Throwable $th) {
            return redirect()->route('satuan-tugas-medis.index')->with(['failed' => $th->getMessage()]);
        }
    }

    public function update(Request $request,$id)
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
            DB::table('TD_SAT_TUGAS')->where('FS_KD_SAT_TUGAS',$id)->update($parameterUpdate);
            return redirect()->route('satuan-tugas-medis.index')->with(['success' => 'Data berhasil disimpan !']);
        } catch (\Throwable $th) {
            return redirect()->route('satuan-tugas-medis.index')->with(['failed' => $th->getMessage()]);
        }
    }


    public function delete($id){

        try {
            DB::table('TD_SAT_TUGAS')->where('FS_KD_SAT_TUGAS', $id)->delete();
            return redirect()->route('satuan-tugas-medis.index')->with(['failed' => 'Data berhasil dihapus !']);
        } catch (\Throwable $th) {
            return redirect()->route('satuan-tugas-medis.index')->with(['failed' => $th->getMessage()]);
        }
    }


}
