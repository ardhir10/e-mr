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
                    # code...
                    break;
            }
            array_push($parameterSeachQuery,'and '.$key." like '%$value%'");
        }
        $whereQuery = implode($parameterSeachQuery, ' ') ;
        
        $QUERY = "select fs_mr, fs_nm_pasien, fd_tgl_lahir, FS_ALM_PASIEN, FS_TLP_PASIEN, FS_HP_PASIEN from tc_mr where 1=1 $whereQuery ";
        $data['rekam_medis'] = DB::select($QUERY);

        // $data['datatables'] = Datatables::of($data['rekam_medis'])->make(true);

        
        return view('rekam-medis.index',$data);
    }

    public function detail(){
        $data['page_title'] = "Rekam Medis Pasien";
        return view('rekam-medis.detail', $data);
    }
}
