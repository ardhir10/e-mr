<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:menu-dashboard', ['only' => 'index']);
    }
    public function index(Request $request)
    {
        $kd_dokter = Auth::user()->fs_kd_peg;


        $date_from = date('Y-m-d', strtotime($request->date_from)) ?? date('Y-m-d');
        $date_to = date('Y-m-d', strtotime($request->date_to)) ?? date('Y-m-d');

        $data['request'] = $request;

        if (Auth::user()->fs_kd_peg) {
            $data['jml_pasien_rj'] = DB::select("select
        	DATEPART(Year, aa.fd_tgl_masuk) Year,
            DATEPART(Month, aa.fd_tgl_masuk) Month,
            count(aa.fd_tgl_masuk) [TotalAmount]
            from TA_REGISTRASI aa
            inner join TA_LAYANAN cc on aa.fs_kd_layanan = cc.fs_kd_layanan
            inner join TA_INSTALASI ff on cc.FS_KD_INSTALASI = ff.FS_KD_INSTALASI
            inner join td_peg ee on aa.fs_kd_medis = ee.fs_kd_peg
                where aa.fd_tgl_void = '3000-01-01'
                and ff.FS_KD_INSTALASI_DK in (1,2,4)
              and FD_TGL_MASUK >= '$date_from'
			and FD_TGL_MASUK <= '$date_to'
            and FS_KD_PEG = '$kd_dokter'
            GROUP BY DATEPART(Year, aa.fd_tgl_masuk),
            DATEPART(Month, aa.fd_tgl_masuk),
            FS_NM_PEG
            ORDER BY Year, Month
            ");

            // dd($data['jml_pasien_rj']);
            $vals = array_column($data['jml_pasien_rj'], 'TotalAmount');
            $data['jml_pasien_rj'] = array_sum($vals);


            $data['jml_pasien_ri'] = DB::select(" select fs_mr
                from	TA_REGISTRASI aa
                inner	join TA_LAYANAN cc on aa.fs_kd_layanan = cc.fs_kd_layanan
                inner	join TA_INSTALASI ff on cc.FS_KD_INSTALASI = ff.FS_KD_INSTALASI
                inner join td_peg ee on aa.fs_kd_medis = ee.fs_kd_peg

                where	aa.fd_tgl_void = '3000-01-01'
                and		ff.FS_KD_INSTALASI_DK in (3)
                and	((fd_tgl_masuk between '$date_from' and '$date_to') or fd_tgl_keluar = '3000-01-01' )

                and FS_KD_PEG = '$kd_dokter'

            ");

            $kd_dokter = Auth::user()->fs_kd_peg;
            $data['jml_blm_verif'] = DB::select("		select
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
            where FS_KD_PEG = '$kd_dokter'
            and FS_VERIFIED_BY IS NULL
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
            where FS_KD_PEG = '$kd_dokter'
            and FS_VERIFIED_BY IS NULL
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
            where FS_KD_PEG = '$kd_dokter'
            and FS_VERIFIED_BY IS NULL

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
            where FS_KD_PEG = '$kd_dokter'
            and FS_VERIFIED_BY IS NULL
            order by FD_DATE desc");
            return view('dashboard.dashboard-dokter', $data);
        } else {


            $data['jml_pasien_rj'] = DB::select("select	aa.fs_mr
            from	TA_REGISTRASI aa
            inner	join tc_mr bb on aa.fs_mr = bb.fs_mr
            inner	join TA_LAYANAN cc on aa.fs_kd_layanan = cc.fs_kd_layanan
            inner	join ta_jaminan dd on aa.fs_kd_jaminan = dd.fs_kd_jaminan
            inner	join td_peg ee on aa.fs_kd_medis = ee.fs_kd_peg
            inner	join TA_INSTALASI ff on cc.FS_KD_INSTALASI = ff.FS_KD_INSTALASI
            where	aa.fd_tgl_void = '3000-01-01'
            and		fd_tgl_masuk between '$date_from' and '$date_to'
            and		ff.FS_KD_INSTALASI_DK in (1,2,4)
            ");
            $data['jml_pasien_rj'] = count($data['jml_pasien_rj']);



            // $data['jml_pasien_ri'] = DB::select("select aa.fd_tgl_masuk,
            //     FD_TGL_KELUAR = case FD_TGL_KELUAR when '3000-01-01' then ''
            //     else FD_TGL_KELUAR end from TA_REGISTRASI aa
            //     inner join tc_mr bb on aa.fs_mr = bb.fs_mr
            //     inner join TA_LAYANAN cc on aa.fs_kd_layanan = cc.fs_kd_layanan
            //     inner join ta_jaminan dd on aa.fs_kd_jaminan = dd.fs_kd_jaminan
            //     inner join td_peg ee on aa.fs_kd_medis = ee.fs_kd_peg
            //     inner join TA_INSTALASI ff on cc.FS_KD_INSTALASI = ff.FS_KD_INSTALASI
            //     where aa.fd_tgl_void = '3000-01-01' and ff.FS_KD_INSTALASI_DK in (3)
            //     and	((fd_tgl_masuk between '$date_from' and '$date_to') or fd_tgl_keluar = '3000-01-01' )
            //     and FD_TGL_KELUAR = '3000-01-01'
            //     ");
            $data['jml_pasien_baru'] = DB::select("select aa.fd_tgl_masuk,
                FD_TGL_KELUAR = case FD_TGL_KELUAR when '3000-01-01' then ''
                else FD_TGL_KELUAR end from TA_REGISTRASI aa
                inner join tc_mr bb on aa.fs_mr = bb.fs_mr
                inner join TA_LAYANAN cc on aa.fs_kd_layanan = cc.fs_kd_layanan
                inner join ta_jaminan dd on aa.fs_kd_jaminan = dd.fs_kd_jaminan
                inner join td_peg ee on aa.fs_kd_medis = ee.fs_kd_peg
                inner join TA_INSTALASI ff on cc.FS_KD_INSTALASI = ff.FS_KD_INSTALASI
                where  ff.FS_KD_INSTALASI_DK in (3)
                and fd_tgl_void = '3000-01-01'
                and 	fs_kd_jenis_inap <> ''
                and 	fd_tgl_masuk between '$date_from' and '$date_to'

                ");

            // $data['jml_pasien_terkini'] = DB::select("
            // select aa.fd_tgl_masuk,
            //     FD_TGL_KELUAR = case FD_TGL_KELUAR when '3000-01-01' then ''
            //     else FD_TGL_KELUAR end from TA_REGISTRASI aa
            //     inner join tc_mr bb on aa.fs_mr = bb.fs_mr
            //     inner join TA_LAYANAN cc on aa.fs_kd_layanan = cc.fs_kd_layanan
            //     inner join ta_jaminan dd on aa.fs_kd_jaminan = dd.fs_kd_jaminan
            //     inner join td_peg ee on aa.fs_kd_medis = ee.fs_kd_peg
            //     inner join TA_INSTALASI ff on cc.FS_KD_INSTALASI = ff.FS_KD_INSTALASI
            //     where aa.fd_tgl_void = '3000-01-01' and ff.FS_KD_INSTALASI_DK in (3)
            //   and	((fd_tgl_masuk between '$date_from' and '$date_to') or fd_tgl_keluar = '3000-01-01' )
            // ");
            $data['jml_pasien_terkini'] = DB::select("
            select aa.fd_tgl_masuk,
                FD_TGL_KELUAR = case FD_TGL_KELUAR when '3000-01-01' then ''
                else FD_TGL_KELUAR end from TA_REGISTRASI aa
                inner join tc_mr bb on aa.fs_mr = bb.fs_mr
                inner join TA_LAYANAN cc on aa.fs_kd_layanan = cc.fs_kd_layanan
                inner join ta_jaminan dd on aa.fs_kd_jaminan = dd.fs_kd_jaminan
                inner join td_peg ee on aa.fs_kd_medis = ee.fs_kd_peg
                inner join TA_INSTALASI ff on cc.FS_KD_INSTALASI = ff.FS_KD_INSTALASI
                where ff.FS_KD_INSTALASI_DK in (3)
                and     fd_tgl_void = '3000-01-01'
                and 	fs_kd_jenis_inap <> ''
                and 	fd_tgl_keluar = '3000-01-01'
            ");




            return view('dashboard.dashboard-non-dokter', $data);
        }
    }


    public function chartGraphicDokter(Request $request)
    {
        $dataRawatJalanDokter = DB::select("select	DATEPART(Year, aa.fd_tgl_masuk) Year, DATEPART(Month, aa.fd_tgl_masuk) Month,
		count(aa.fd_tgl_masuk) [TotalAmount]
        from	TA_REGISTRASI aa
        inner	join TA_LAYANAN cc on aa.fs_kd_layanan = cc.fs_kd_layanan
        inner	join TA_INSTALASI ff on cc.FS_KD_INSTALASI = ff.FS_KD_INSTALASI
		inner	join td_peg ee on aa.fs_kd_medis = ee.fs_kd_peg
        where	aa.fd_tgl_void = '3000-01-01'
        and		ff.FS_KD_INSTALASI_DK in (1,2,4)
		and ee.fs_kd_peg = '$request->kodeDokter'
		and DATEPART(Year, aa.fd_tgl_masuk) = '$request->tahun'
		GROUP BY DATEPART(Year, aa.fd_tgl_masuk), DATEPART(Month, aa.fd_tgl_masuk),FS_NM_PEG
		ORDER BY Year, Month");
        $dataRawatJalanDokter = array_map(function ($value) {
            return (array)$value;
        }, $dataRawatJalanDokter);


        $mL = [
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December'
        ];

        $months = array_column($dataRawatJalanDokter, 'Month');
        $vals = array_column($dataRawatJalanDokter, 'TotalAmount');

        $dataCharts = [];
        $i = 0;
        foreach ($mL as $key => $value) {
            $valueIn = array_search($key, $months);

            if (in_array($key, $months)) {
                $dataChart = [
                    'month' => $value,
                    'val' => (float)$vals[$valueIn]
                ];
            } else {
                $dataChart = [
                    'month' => $value,
                    'val' => 0
                ];
            }
            $dataCharts[] = $dataChart;
            $i++;
        }



        $data['months'] = array_column($dataCharts, 'month');
        $data['vals'] = array_column($dataCharts, 'val');
        return json_encode($data);
    }

    public function chartGraphicNonDokter(Request $request)
    {
        $dataRawatJalanDokter = DB::select("


        select	DATEPART(Year, aa.fd_tgl_masuk) Year, DATEPART(Month, aa.fd_tgl_masuk) Month,
		count(aa.fd_tgl_masuk) [TotalAmount]
        from	TA_REGISTRASI aa
         inner	join tc_mr bb on aa.fs_mr = bb.fs_mr
        inner	join TA_LAYANAN cc on aa.fs_kd_layanan = cc.fs_kd_layanan
        inner	join ta_jaminan dd on aa.fs_kd_jaminan = dd.fs_kd_jaminan
        inner	join td_peg ee on aa.fs_kd_medis = ee.fs_kd_peg
        inner	join TA_INSTALASI ff on cc.FS_KD_INSTALASI = ff.FS_KD_INSTALASI
        where	aa.fd_tgl_void = '3000-01-01'
        and		ff.FS_KD_INSTALASI_DK in (1,2,4)
		and DATEPART(Year, aa.fd_tgl_masuk) = '$request->tahun'
		GROUP BY DATEPART(Year, aa.fd_tgl_masuk), DATEPART(Month, aa.fd_tgl_masuk)
		ORDER BY Year, Month");

        $dataRawatJalanDokter = array_map(function ($value) {
            return (array)$value;
        }, $dataRawatJalanDokter);


        $mL = [
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December'
        ];

        $months = array_column($dataRawatJalanDokter, 'Month');
        $vals = array_column($dataRawatJalanDokter, 'TotalAmount');

        $dataCharts = [];
        $i = 0;
        foreach ($mL as $key => $value) {
            $valueIn = array_search($key, $months);

            if (in_array($key, $months)) {
                $dataChart = [
                    'month' => $value,
                    'val' => (float)$vals[$valueIn]
                ];
            } else {
                $dataChart = [
                    'month' => $value,
                    'val' => 0
                ];
            }
            $dataCharts[] = $dataChart;
            $i++;
        }



        $data['months'] = array_column($dataCharts, 'month');
        $data['vals'] = array_column($dataCharts, 'val');
        return json_encode($data);
    }
}
