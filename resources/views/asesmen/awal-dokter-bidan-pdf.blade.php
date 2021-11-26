<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$page_title}}</title>
    <style>
        body {
            background: white !important;
        }

        @page {
            margin: 20px;
        }

        .page-break {
            page-break-after: always;
        }
        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        .column {
            float: left;
            width: 50%;
        }

        #tableDetail tr td {
            padding: 5px;
            border: 1px solid black;
            border-collapse: collapse;

        }

        .riwayatPersalinan tr td {
            padding: 2px;
            border: 0.5px solid black !important;
            border-collapse: collapse;

        }

    </style>
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" > --}}

</head>

<body style="font-family:sans-serif ;">
    <div class="">
        <div style="font-size:14px;">
            <span style="float: right;font-weight:bolder;">FORM ASESMEN DOKTER BIDAN</span>
            <span style="display: block;font-weight:bold;font-size:16px;">{{$rumah_sakit[0]->fs_nm_rs ?? ''}}</span>
            <span style="display:block;font-size:14px;">{{$rumah_sakit[0]->fs_alm_rs ?? ''}}</span>
            Tlp : {{$rumah_sakit[0]->fs_tlp_rs ?? ''}}
            {{-- <img src="{{asset('assets/images/logo-solvus.jpeg')}}" alt="" width="100" class="auth-logo-light"> --}}
        </div>
        <hr>
        {{-- HEADER --}}
        <table style="font-size:12px; width:100%">
            <tr>
                <td style="width: 50%">
                    <table>
                        <tr>
                            <td>
                                <span style="width: 100px;">Nomor MR</span>
                            </td>
                            <td>
                                : {{$rekam_medis->FS_MR}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Nama Pasien
                            </td>
                            <td>
                                : {{$rekam_medis->FS_NM_PASIEN}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Tanggal Lahir
                            </td>
                            <td>
                                :  {{date('d-m-Y',strtotime($rekam_medis->FD_TGL_LAHIR))}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Jenis Kelamin
                            </td>
                            <td>
                                : {{$rekam_medis->FB_JNS_KELAMIN == 0 ? 'LAKI - LAKI':'PEREMPUAN'}}
                            </td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table>
                        <tr>
                            <td>
                                Register
                            </td>
                            <td>
                                : {{$rekam_medis->FS_KD_REG}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Tanggal Jam Masuk
                            </td>
                            <td>
                                : {{date('d-m-Y',strtotime($rekam_medis->FD_TGL_MASUK))}} {{$rekam_medis->FS_JAM_MASUK}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Dokter DPJP
                            </td>
                            <td>
                                : {{$rekam_medis->FS_NM_PEG}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Jaminan/ Cara Bayar
                            </td>
                            <td>
                                : {{$rekam_medis->fs_nm_jaminan}}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <hr>

        {{-- PROFESI/LAYANAN --}}
        <table style="font-size:12px; width:100%;">
            <tr>
                <td style="width: 50%">
                    <table>
                        <tr>
                            <td><span style="width: 110px;">Profesi </span></td>
                            <td> : Dokter</td>
                        </tr>

                    </table>
                </td>
                <td style="width: 50%">
                    <table>
                        <tr>
                            <td><span style="width: 120px;">Layanan / Bagian</span></td>
                            @foreach ($layanan_bagian as $lb)
                            @if ($data_asesmen->FS_KD_LAYANAN == $lb->FS_KD_LAYANAN)
                            <td> : {{$lb->FS_NM_LAYANAN}}</td>
                            @endif
                            @endforeach
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <hr>


        {{-- DETAIL --}}
        <div style="width: 100%;border:1px solid #ebebeb;border-collapse:collapse;">
            {{-- <span style="display: block">Assesmen Awal Terintegrasi Pasien rekammedis Rawat Jalan</span> --}}
            <table id="tableDetail" style="width: 100%;font-size:12px;">

                <tr>
                    <td>
                        <div class="" style="margin-bottom: 5px;">
                            <label for=""><strong> PENGKAJIANS (DIISI OLEH DOKTER)</strong>
                            </label>
                            <br>
                            <br>
                        </div>
                        <div class="row">
                            <div class="" style="vertical-align: top;width:15%;float:left;">
                                <u>Data Subyektif</u>
                                <i>Subjective Data</i>
                            </div>
                            <div class="" style="vertical-align: top;width:50%;float:left;">
                                <input type="checkbox"
                                    {{$data_asesmen->FJ_DS['Auto'] == 'on' ? 'checked':''}}>Auto&nbsp;
                                <input type="checkbox"
                                    {{$data_asesmen->FJ_DS['Allo'] == 'on' ? 'checked':''}}>Allo&nbsp;
                                <span
                                    style="vertical-align:top;font-weight: bold;font-size:12px;">{{$data_asesmen->FJ_DS['Text']}}</span>
                            </div>
                        </div>
                        <br>

                        <div class="row" style="width: 100%">
                            <div class="" style="vertical-align: top;width:20%;float:left;">
                                <u>Riwayat Penyakit Dulu</u>
                                <i>Past Diagnosis History</i>
                            </div>
                            <div class="" style="vertical-align: top;width:30%;float:left;">
                                <span
                                    style="vertical-align:top;font-weight: bold;font-size:12px;">{{$data_asesmen->FS_RPD}}</span>
                            </div>


                        </div>
                        <br>


                        <div class="row">
                            <div class="" style="vertical-align: top;width:15%;float:left;">
                                <span>Riwayat Kehamilan</span>
                            </div>
                        </div>

                        <div class="row" style="width: 100%">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Gravida : <span
                                style="vertical-align:top;font-weight: bold;font-size:12px;">{{$data_asesmen->FJ_RK['Gravida']}}</span>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Aterm : <span
                                style="vertical-align:top;font-weight: bold;font-size:12px;">{{$data_asesmen->FJ_RK['Aterm']}}</span>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Prematur : <span
                                style="vertical-align:top;font-weight: bold;font-size:12px;">{{$data_asesmen->FJ_RK['Prematur']}}</span>
                        </div>
                        <div class="row" style="width: 100%">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Abortus : <span
                                style="vertical-align:top;font-weight: bold;font-size:12px;">{{$data_asesmen->FJ_RK['Abortus']}}</span>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Anak Hidup : <span
                                style="vertical-align:top;font-weight: bold;font-size:12px;">{{$data_asesmen->FJ_RK['AnakHidup']}}</span>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SC : <span
                                style="vertical-align:top;font-weight: bold;font-size:12px;">{{$data_asesmen->FJ_RK['SC']}}</span>
                        </div>
                        <br>
                        <div class="row">
                            <div class="" style="vertical-align: top;width:100%;float:left;">
                                <span style="vertical-align:top;">Riwayat Pernikahan</span> &nbsp;&nbsp;&nbsp;
                                <input type="checkbox" name="cRtlPulang"
                                    {{$data_asesmen->FJ_RP['Menikah'] == 'on' ? 'checked':''}}>
                                <span style="font-size:12px;vertical-align:top;" class="align-top">Menikah</span>
                                &nbsp;&nbsp;&nbsp;

                                <input type="checkbox" name="cRtlPulang"
                                    {{$data_asesmen->FJ_RP['BelumMenikah'] == 'on' ? 'checked':''}}>
                                <span style="font-size:12px;vertical-align:top;" class="align-top">Belum Menikah</span>
                            </div>
                        </div>


                        <div class="row">
                            <div class="" style="vertical-align: top;width:100%;float:left;">
                                <span style="vertical-align:top;">Riwayat Haid</span> &nbsp;&nbsp;&nbsp;
                                <br>

                                &nbsp;&nbsp;&nbsp;Haid Pertama Usia :
                                <span style="font-size:12px;vertical-align:top;font-weight:bold;"
                                    class="align-top">{{$data_asesmen->FJ_RH['HaidPertamaUsia']}}</span> Tahun
                                &nbsp;&nbsp;&nbsp;Siklus Haid
                                <span style="font-size:12px;vertical-align:top;font-weight:bold;"
                                    class="align-top">{{$data_asesmen->FJ_RH['SiklusHaid']}}</span> Hari

                                <br>
                                &nbsp;&nbsp;&nbsp;Haid Teratur :
                                <input type="checkbox" name="cRtlPulang"
                                    {{$data_asesmen->FJ_RH['HaidTeraturYa'] == 'on' ? 'checked':''}}>
                                <span style="font-size:12px;vertical-align:top;" class="align-top">Ya</span>
                                &nbsp;&nbsp;&nbsp;<input type="checkbox" name="cRtlPulang"
                                    {{$data_asesmen->FJ_RH['HaidTeraturTidak'] == 'on' ? 'checked':''}}>
                                <span style="font-size:12px;vertical-align:top;" class="align-top">Tidak</span>
                                &nbsp;&nbsp;&nbsp;Haid Pertama Haid Terakhir :
                                <span style="font-size:12px;vertical-align:top;font-weight:bold;"
                                    class="align-top">{{$data_asesmen->FJ_RH['HaidPertamaTerakhir']}}</span>

                                <br>
                                &nbsp;&nbsp;&nbsp;Nyeri Haid :
                                <input type="checkbox" name="cRtlPulang"
                                    {{$data_asesmen->FJ_RH['NyeriHaidYa'] == 'on' ? 'checked':''}}>
                                <span style="font-size:12px;vertical-align:top;" class="align-top">Ya</span>
                                &nbsp;&nbsp;&nbsp;<input type="checkbox" name="cRtlPulang"
                                    {{$data_asesmen->FJ_RH['NyeriHaidTidak'] == 'on' ? 'checked':''}}>
                                <span style="font-size:12px;vertical-align:top;" class="align-top">Tidak</span>
                                &nbsp;&nbsp;&nbsp;Taksiran Persalinan :
                                <span style="font-size:12px;vertical-align:top;font-weight:bold;"
                                    class="align-top">{{$data_asesmen->FJ_RH['TaksiranPersalinan']}}</span>

                                <br>
                                &nbsp;&nbsp;&nbsp;Lama Haid :
                                <span style="font-size:12px;vertical-align:top;font-weight:bold;"
                                    class="align-top">{{$data_asesmen->FJ_RH['LamaHaid']}}</span> Hari

                            </div>
                        </div>




                    </td>
                </tr>
                <tr>
                    <td>
                        <table class="w-100" class="riwayatPersalinan" id="riwayatPersalinan" style="width: 100%">
                            <tr>
                                <td width="100%" class="p-0" style="vertical-align: top;">
                                    <span class="d-block fw-bold ">RIWAYAT PERSALINAN</span>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table class="riwayatPersalinan detail-asesmen w-100 table-bordered"
                                        style="width:100% !important">
                                        <thead>
                                            <tr style="" id="skn">
                                                <td align="center" rowspan="2">Persalinan Ke</td>
                                                <td align="center" rowspan="2">Tahun</td>
                                                <td align="center" rowspan="2">Jenis Persalinan</td>
                                                <td align="center" colspan="3">Anak</td>
                                            </tr>
                                            <tr>
                                                <td align="center">Sex</td>
                                                <td align="center">Berat Lahir</td>
                                                <td align="center">Keadaan</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($data_asesmen->FJ_RPSL != '')
                                            @for ($i = 0; $i < 5; $i++) <tr>
                                                <td><input type="number" name="cRpsl[{{$i}}][PersalinanKe]"
                                                        value="{{$data_asesmen->FJ_RPSL[$i]['PersalinanKe']}}"></td>
                                                <td>
                                                    <span>{{$data_asesmen->FJ_RPSL[$i]['Tahun']}}</span>
                                                </td>
                                                <td><input type="text" name="cRpsl[{{$i}}][JenisPersalinan]"
                                                        value="{{$data_asesmen->FJ_RPSL[$i]['JenisPersalinan']}}"></td>
                                                <td><input type="text" name="cRpsl[{{$i}}][Sex]"
                                                        value="{{$data_asesmen->FJ_RPSL[$i]['Sex']}}"></td>
                                                <td><input type="number" name="cRpsl[{{$i}}][BeratLahir]"
                                                        value="{{$data_asesmen->FJ_RPSL[$i]['BeratLahir']}}"
                                                        step="0.01"></td>
                                                <td><input type="text" name="cRpsl[{{$i}}][Keadaan]"
                                                        value="{{$data_asesmen->FJ_RPSL[$i]['Keadaan']}}"></td>
                            </tr>
                            @endfor
                            @else
                            @for ($i = 0; $i < 5; $i++)
                            <tr>
                                <td><input type="number" name="cRpsl[{{$i}}][PersalinanKe]"></td>
                                <td>
                                    <select name="cRpsl[{{$i}}][Tahun]" id="">
                                        <?php
                                                            for ($year = (int)date('Y'); 1900 <= $year; $year--): ?>
                                        <option value="<?=$year;?>"><?=$year;?></option>
                                        <?php endfor; ?>
                                    </select>
                                </td>
                                <td><input type="text" name="cRpsl[{{$i}}][JenisPersalinan]"></td>
                                <td><input type="text" name="cRpsl[{{$i}}][Sex]"></td>
                                <td><input type="number" name="cRpsl[{{$i}}][BeratLahir]" step="0.01"></td>
                                <td><input type="text" name="cRpsl[{{$i}}][Keadaan]"></td>
                            </tr>
                            @endfor
                            @endif
                </tbody>

            </table>
            </td>
            </tr>
            </td>
            </tr>
            <tr>
                <td>
                    <div class="row">
                        <div class="" style="vertical-align: top;width:15%;float:left;">
                            <u>Data Obyektif</u>
                            <i>Objective Data</i>
                        </div>
                    </div>

                    <div class="row" style="width: 100%">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Keadaan Umum : <span
                            style="vertical-align:top;font-weight: bold;font-size:12px;">{{$data_asesmen->FJ_DO['KeadaanUmum']}}</span>
                    </div>
                    <div class="row" style="width: 100%">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kesadaran : <span
                            style="vertical-align:top;font-weight: bold;font-size:12px;">{{$data_asesmen->FJ_DO['Kesadaran']}}</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        GCS E: <span
                            style="vertical-align:top;font-weight: bold;font-size:12px;">{{$data_asesmen->FJ_DO['GCSE']}}</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        V: <span
                            style="vertical-align:top;font-weight: bold;font-size:12px;">{{$data_asesmen->FJ_DO['GCSV']}}</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        M: <span
                            style="vertical-align:top;font-weight: bold;font-size:12px;">{{$data_asesmen->FJ_DO['GCSM']}}</span>
                    </div>
                    <div class="row" style="width: 100%">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TFU :
                        <span
                            style="vertical-align:top;font-weight: bold;font-size:12px;">{{$data_asesmen->FJ_DO['TFU']}}</span>
                        cm
                        &nbsp;&nbsp;&nbsp;&nbsp;DJJ :
                        <span
                            style="vertical-align:top;font-weight: bold;font-size:12px;">{{$data_asesmen->FJ_DO['DJJ']}}</span>
                        x/menit

                        &nbsp;&nbsp;&nbsp;&nbsp;His :
                        <span
                            style="vertical-align:top;font-weight: bold;font-size:12px;">{{$data_asesmen->FJ_DO['His']}}</span>
                        x/menit

                        &nbsp;&nbsp;&nbsp;&nbsp;TBJ :
                        <span
                            style="vertical-align:top;font-weight: bold;font-size:12px;">{{$data_asesmen->FJ_DO['TBJ']}}</span>
                        gram
                    </div>
                </td>
            </tr>



            </table>


        </div>
        <div class="page-break"></div>

         <table class="detail-asesmen w-100 table-bordered" style="width: 100%">
                <tr>
                    <td class="fw-bold p-1" colspan="4">Pemeriksaan Fisik Tambahan</td>
                </tr>
                <tr>
                    <td width="10%">
                        <img style="width: 200px;" src="{{asset('assets/images/pemeriksaan-dokter-bidan.PNG')}}"
                            class="" alt="">
                    </td>
                    <td style="vertical-align: top" width="90%">
                        <span style="font-size: 12px;font-weight:bold;">{{$data_asesmen->FS_PEMERIKSAAN_FISIK_TAMBAHAN}}</span>
                    </td>
                </tr>

                <tr>
                    <td>
                        <span class="fw-bold d-block">Pemeriksaan Penunjang : </span>
                        <textarea name="cPemeriksaanPenunjang" id="" style="width: 100%" rows="4">{{$data_asesmen->FS_PEMERIKSAAN_PENUNJANG}}</textarea>
                    </td>
                    <td colspan="3">
                        <span class="fw-bold d-block">TINDAKAN & TERAPI : </span>
                        <textarea name="cTindakanTerapi" id="" style="width: 100%" rows="4">{{$data_asesmen->FS_TINDAKAN_TERAPI}}</textarea>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: top">
                        <span class="fw-bold d-block">Diagnosa Utama : (kode ICD 10) </span>
                        <br>
                        <span style="font-weight:bold;">({{optional(optional($data_asesmen)->getIcd())->FS_KD_ICD}}) {{optional(optional($data_asesmen)->getIcd())->FS_NM_ICD}}</span>
                        <br>
                        <span class="fw-bold d-block">Diagnosa Sekunder : </span>
                        <ul>
                            <li>1. <input type="text" value="{{$data_asesmen->FJ_DIAGNOSA_SEKUNDER[1]}}" name="cDiagnosaSekunder1"></li>
                            <li>2. <input type="text" value="{{$data_asesmen->FJ_DIAGNOSA_SEKUNDER[2]}}" name="cDiagnosaSekunder2"></li>
                        </ul>
                    </td>
                    <td colspan="3" style="vertical-align: top">
                        <span class="fw-bold d-block"></span>
                        <textarea name="cDetailDiagnosis" id="" style="width: 100%" rows="10">{{$data_asesmen->FS_DETAIL_DIAGNOSIS}}</textarea>
                    </td>
                </tr>

            </table>

        <label style="font-size:12px;" for=""><strong> RENCANA TINDAK LANJUT</strong></label>
        <ul>
            <li class="d-flex">
                <div class="m-r-1" style="margin-left:30px;">
                    <input type="checkbox" name="cRtlPulang"
                        {{$data_asesmen->FJ_RENCANA_TINDAK_LANJUT['Pulang'] == 'on' ? 'checked':''}}>
                    <span style="font-size:12px;vertical-align:top;font-weight:bold;" class="align-top">Pulang</span>
                </div>
            </li>
            <li class="d-flex">
                <div class="m-r-1" style="margin-left:30px;">
                    <input type="checkbox" name="cRtlKontrolTanggal"
                        {{$data_asesmen->FJ_RENCANA_TINDAK_LANJUT['KontrolTanggal'] == 'on' ? 'checked':''}}>
                    <span style="font-size:12px;vertical-align:top;" class="align-top">Kontrol Tanggal : </span>
                    <span
                        style="font-size:12px;vertical-align:top;font-weight:bold;">{{$data_asesmen->FJ_RENCANA_TINDAK_LANJUT['KontrolTanggalText']}}</span>
                </div>
            </li>
            <li class="d-flex">
                <div class="m-r-1" style="margin-left:30px;">
                    <input type="checkbox" name="cRtlKonsulKe"
                        {{$data_asesmen->FJ_RENCANA_TINDAK_LANJUT['KonsulKe'] == 'on' ? 'checked':''}}>
                    <span style="font-size:12px;vertical-align:top;" class="align-top">Konsul Ke : </span>
                    <span
                        style="font-size:12px;vertical-align:top;font-weight:bold;">{{$data_asesmen->FJ_RENCANA_TINDAK_LANJUT['KonsulKeText']}}</span>

                </div>
            </li>
            <li class="d-flex">
                <div class="m-r-1" style="margin-left:30px;">
                    <input type="checkbox" name="cRtlRujukKe"
                        {{$data_asesmen->FJ_RENCANA_TINDAK_LANJUT['RujukKe'] == 'on' ? 'checked':''}}>
                    <span style="font-size:12px;vertical-align:top;" class="align-top">Rujuk Ke : </span>
                    <span
                        style="font-size:12px;vertical-align:top;font-weight:bold;">{{$data_asesmen->FJ_RENCANA_TINDAK_LANJUT['RujukKeText']}}</span>

                </div>
            </li>
            <li class="d-flex">
                <div class="m-r-1" style="margin-left:30px;">
                    <input type="checkbox" name="cRtlRawatInap"
                        {{$data_asesmen->FJ_RENCANA_TINDAK_LANJUT['RawatInap'] == 'on' ? 'checked':''}}>
                    <span style="font-size:12px;vertical-align:top;" class="align-top">Rawat Inap , Ruangan : </span>
                    <span
                        style="font-size:12px;vertical-align:top;font-weight:bold;">{{$data_asesmen->FJ_RENCANA_TINDAK_LANJUT['RawatInapText']}}</span>
                </div>
            </li>
        </ul>



    </div>


</body>

</html>
