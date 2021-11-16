<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
class RawatInapController extends Controller
{
    public function index(Request $request)
    {
        $data['page_title'] = "List Pasien Rawat Inap";
        $data['request'] = $request;


        // --- QERY AWAL UNTUK PASIEN BELUM PULANG
        $whereNotHome = "and FD_TGL_KELUAR = '3000-01-01'";

        // ---  UNTUK MENDAPATKAN DATA DOKTER
        $QUERY_DOKTER = "select	fs_kd_peg fs_kd_dokter ,
		fs_nm_peg fs_dokter
        from	td_peg
        where	fn_profesi_medis in (0,1,2)
        and		FB_SUDAH_RESIGN = 0
        order	by fs_nm_peg";
        $data['dokter'] = DB::select($QUERY_DOKTER);

        // ---  UNTUK MENDAPATKAN DATA LAYANAN
        $QUERY_LAYANAN = "select	aa.FS_KD_LAYANAN, FS_NM_LAYANAN, FS_NM_INSTALASI
        from	TA_LAYANAN aa
        inner	join TA_INSTALASI bb on aa.fs_kd_instalasi = bb.FS_KD_INSTALASI
        where	1=1
        order	by FS_NM_INSTALASI desc";
        $data['layanan'] = DB::select($QUERY_LAYANAN);

        // ---  UNTUK MENDAPATKAN DATA RAWAT INAP
        $whereDokter = "";
        if ($request->get('dokter')) {
            $whereDokter = "and fs_nm_peg like '%{$request->get('dokter')}%'";
        }
        $whereStatus = "";
        if ($request->get('status') == 'aktif') {
            $whereStatus = "and FD_TGL_KELUAR = '3000-01-01'";
        }elseif($request->get('status') == 'tidakaktif'){
            $whereStatus = "and FD_TGL_KELUAR <> '3000-01-01'";
        }


        if ($request->seach == true) {
            $whereNotHome = "";
        }

        $tglMasuk = $request->get('tgl_masuk') != '' ? date('Y-m-d', strtotime($request->get('tgl_masuk'))) : date('Y-m-d');
        $tglMasukSampai = $request->get('tgl_masuk_sampai') != '' ?  date('Y-m-d', strtotime($request->get('tgl_masuk_sampai'))) : date('Y-m-d');

        // --- DEFAULT LIST ADALAH FD_TGL_KELUAR = 3000-01-01
        $QUERY_RAWAT_JALAN = "select	aa.fd_tgl_masuk, aa.fs_kd_reg, aa.fs_mr,
		FS_NM_PASIEN, bb.FB_JNS_KELAMIN,
        DATEDIFF(YYYY, bb.fd_tgl_lahir,aa.fd_tgl_masuk ) fn_umur,
		 DATEDIFF(m, bb.fd_tgl_lahir,aa.fd_tgl_masuk )%12 fn_umur_bulan,
		fs_nm_layanan, fs_nm_peg fs_dokter, fs_nm_jaminan,ee.fs_kd_peg fs_kd_dokter,
		FD_TGL_KELUAR = case FD_TGL_KELUAR
		    when '3000-01-01' then ''
		else	FD_TGL_KELUAR end
        from	TA_REGISTRASI aa
        inner	join tc_mr bb on aa.fs_mr = bb.fs_mr
        inner	join TA_LAYANAN cc on aa.fs_kd_layanan = cc.fs_kd_layanan
        inner	join ta_jaminan dd on aa.fs_kd_jaminan = dd.fs_kd_jaminan
        inner	join td_peg ee on aa.fs_kd_medis = ee.fs_kd_peg
        inner	join TA_INSTALASI ff on cc.FS_KD_INSTALASI = ff.FS_KD_INSTALASI
        where	1=1
        and aa.fd_tgl_void = '3000-01-01'
        and		ff.FS_KD_INSTALASI_DK in (3) ";
        $QUERY_RAWAT_JALAN .= "
        and	((fd_tgl_masuk between '$tglMasuk' and '$tglMasukSampai') or fd_tgl_keluar = '3000-01-01' )
        $whereStatus
        $whereDokter
        ";
        $data['rawat_inap'] = DB::select($QUERY_RAWAT_JALAN);

        if ($request->from == 'yajra') {
            return $data['datatables'] = Datatables::of($data['rawat_inap'])

            ->addColumn('tanggal', function ($qr) {
                return date('d-m-Y', strtotime($qr->fd_tgl_masuk));
            })
            ->addColumn('tanggal_plg', function ($qr) {
                if($qr->FD_TGL_KELUAR != ''){
                    return date('d-m-Y', strtotime($qr->FD_TGL_KELUAR));

                }else{
                    return '';
                }
            })
                ->addColumn('umur', function ($qr) {
                    return $qr->fn_umur . ' Th ' . $qr->fn_umur_bulan . ' Bl';
                })
                ->addColumn('jenis_kelamin', function ($qr) {
                    if ($qr->FB_JNS_KELAMIN == 1) {
                        return 'P';
                    } else {
                        return 'L';
                    }
                })
                ->addColumn('action', function ($qr) {
                    return '<a href="' . route('rekam-medis.detail', ['rawatinap', $qr->fs_mr, $qr->fs_kd_dokter, $qr->fs_kd_reg]) . '" class=" "> Lihat Detail</a>';
                })
                ->escapeColumns([])
                ->addIndexColumn()
                ->toJson();
        }


        // dd($QUERY_RAWAT_JALAN);

        $data['jumlah_data'] = count($data['rawat_inap']);

        return view('rawat-inap.index', $data);
    }
}
