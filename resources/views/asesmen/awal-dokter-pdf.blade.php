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

        #pemeriksaanFisik tr td {
            padding: 2px;
            border: 0.5px solid black;
            border-collapse: collapse;

        }

    </style>
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" > --}}

</head>

<body style="font-family:sans-serif ;">
    <div class="">
        <div style="font-size:14px;">
            <span style="float: right;font-weight:bolder;">FORM ASESMEN DOKTER</span>
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
                                : {{$rekam_medis->FD_TGL_LAHIR}}
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
                            <label for=""><strong> PENGKAJIAN (DIISI OLEH DOKTER)</strong>
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

                            <div class="" style="vertical-align: top;width:20%;float:left;">
                                <u style="display: block">Riwayat Operasi</u>
                                <i>History of Operation</i>
                            </div>
                            <div class="" style="vertical-align: top;width:30%;float:left;">
                                <span
                                    style="vertical-align:top;font-weight: bold;font-size:12px;">{{$data_asesmen->FS_RO}}</span>
                            </div>
                        </div>
                        <br>


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
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TD :
                            <span
                                style="vertical-align:top;font-weight: bold;font-size:12px;">{{$data_asesmen->FJ_DO['TD']}}</span>
                            mmHg
                            &nbsp;&nbsp;&nbsp;&nbsp;Nadi :
                            <span
                                style="vertical-align:top;font-weight: bold;font-size:12px;">{{$data_asesmen->FJ_DO['Nadi']}}</span>
                            x/menit

                            &nbsp;&nbsp;&nbsp;&nbsp;Respirasi :
                            <span
                                style="vertical-align:top;font-weight: bold;font-size:12px;">{{$data_asesmen->FJ_DO['Respirasi']}}</span>
                            x/menit

                            &nbsp;&nbsp;&nbsp;&nbsp;Suhu :
                            <span style="vertical-align:top;font-weight: bold;font-size:12px;">{{$data_asesmen->FJ_DO['Suhu']}}</span>
                            c
                        </div>

                    </td>
                </tr>
                <tr>
                    <td>
                        <table id="pemeriksaanFisik" style="width: 100%"  class="detail-asesmen w-100 table-bordered">
                            <tr>
                                <td class="fw-bold p-1" style="width:10%;font-size:10px;">PEMERIKSAAN FISIK</td>
                                <td class="fw-bold p-1" style="width:20%;font-size:10px;" >ORGAN TUBUH</td>
                                <td class="fw-bold p-1" style="width:30%;font-size:10px;" >NORMAL</td>
                                <td class="fw-bold p-1" style="width:40%;font-size:10px;" >JIKA TIDAK NORMAL / KELAINAN</td>
                            </tr>
                            <tr>
                                <td rowspan="8" style="vertical-align: middle;text-align:center;">
                                    <img height="170px"   src="{{asset('assets/images/pemeriksaan-fisik-dokter.png')}}" class="w-100p" alt="">
                                </td>
                                <td>Kepala / <span class="fst-italic">Head</span></td>
                                <td>
                                    <span style="vertical-align:top;font-weight: bold;font-size:12px;">{{$data_asesmen->FJ_PEMERIKSAAN_FISIK['KepalaNormal']}}</span>
                                </td>
                                <td>
                                    <span style="vertical-align:top;font-weight: bold;font-size:12px;">{{$data_asesmen->FJ_PEMERIKSAAN_FISIK['KepalaTidakNormal']}}</span>
                                </td>
                            </tr>
                            {{-- <tr>
                                <td>Kepala / <span class="fst-italic">Head</span></td>
                                <td>
                                    <span style="vertical-align:top;font-weight: bold;font-size:12px;">{{$data_asesmen->FJ_PEMERIKSAAN_FISIK['KepalaNormal']}}</span>
                                </td>
                                <td>
                                    <span style="vertical-align:top;font-weight: bold;font-size:12px;">{{$data_asesmen->FJ_PEMERIKSAAN_FISIK['KepalaTidakNormal']}}</span>
                                </td>
                            </tr> --}}
                            <tr>
                                <td>Mulut / <span class="fst-italic">Mouth</span></td>
                                <td>
                                    <span style="vertical-align:top;font-weight: bold;font-size:12px;">{{$data_asesmen->FJ_PEMERIKSAAN_FISIK['MulutNormal']}}</span>
                                </td>
                                <td>
                                    <span style="vertical-align:top;font-weight: bold;font-size:12px;">{{$data_asesmen->FJ_PEMERIKSAAN_FISIK['MulutTidakNormal']}}</span>

                                </td>
                            </tr>
                            <tr>
                                <td>Leher / <span class="fst-italic">Neck</span></td>
                                <td>
                                    <span style="vertical-align:top;font-weight: bold;font-size:12px;">{{$data_asesmen->FJ_PEMERIKSAAN_FISIK['LeherNormal']}}</span>
                                </td>
                                <td>
                                    <span style="vertical-align:top;font-weight: bold;font-size:12px;">{{$data_asesmen->FJ_PEMERIKSAAN_FISIK['LeherTidakNormal']}}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>Jantung / <span class="fst-italic">Cor</span></td>
                                <td>
                                    <span style="vertical-align:top;font-weight: bold;font-size:12px;">{{$data_asesmen->FJ_PEMERIKSAAN_FISIK['JantungNormal']}}</span>
                                </td>
                                <td>
                                    <span style="vertical-align:top;font-weight: bold;font-size:12px;">{{$data_asesmen->FJ_PEMERIKSAAN_FISIK['JantungTidakNormal']}}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>Paru-paru / <span class="fst-italic">Pulmo</span></td>
                                <td>
                                    <span style="vertical-align:top;font-weight: bold;font-size:12px;">{{$data_asesmen->FJ_PEMERIKSAAN_FISIK['ParuParuNormal']}}</span>


                                </td>
                                <td>
                                    <span style="vertical-align:top;font-weight: bold;font-size:12px;">{{$data_asesmen->FJ_PEMERIKSAAN_FISIK['ParuParuTidakNormal']}}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>Perut / <span class="fst-italic">Abdomen</span></td>
                                <td>
                                    <span style="vertical-align:top;font-weight: bold;font-size:12px;">{{$data_asesmen->FJ_PEMERIKSAAN_FISIK['PerutNormal']}}</span>
                                </td>
                                <td>
                                    <span style="vertical-align:top;font-weight: bold;font-size:12px;">{{$data_asesmen->FJ_PEMERIKSAAN_FISIK['PerutTidakNormal']}}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>Alat Gerak / <span class="fst-italic">Extremities</span></td>
                                <td>
                                    <span style="vertical-align:top;font-weight: bold;font-size:12px;">{{$data_asesmen->FJ_PEMERIKSAAN_FISIK['AlatGerakNormal']}}</span>
                                </td>
                                <td>
                                    <span style="vertical-align:top;font-weight: bold;font-size:12px;">{{$data_asesmen->FJ_PEMERIKSAAN_FISIK['AlatGerakTidakNormal']}}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>Anus & Genitalia </td>
                                <td>
                                    <span style="vertical-align:top;font-weight: bold;font-size:12px;">{{$data_asesmen->FJ_PEMERIKSAAN_FISIK['AnusGenitaliaNormal']}}</span>
                                </td>
                                <td>
                                    <span style="vertical-align:top;font-weight: bold;font-size:12px;">{{$data_asesmen->FJ_PEMERIKSAAN_FISIK['AnusGenitaliaTidakNormal']}}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="fw-bold d-block">Pemeriksaan Penunjang : </span>
                                    <span style="vertical-align:top;font-weight: bold;font-size:12px;">{{$data_asesmen->FS_PEMERIKSAAN_PENUNJANG}}</span>
                                </td>
                                <td colspan="3">
                                    <span class="fw-bold d-block">TINDAKAN & TERAPI : </span>
                                    <span style="vertical-align:top;font-weight: bold;font-size:12px;">{{$data_asesmen->FS_TINDAKAN_TERAPI}}</span>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top">
                                    <span class="fw-bold d-block">Diagnosa Utama : (kode ICD 10) </span>

                                    <span style="vertical-align:top;font-weight: bold;font-size:12px;">({{optional(optional($data_asesmen)->getIcd())->FS_KD_ICD}}) {{optional(optional($data_asesmen)->getIcd())->FS_NM_ICD}}</span>

                                    {{-- <textarea name="" id="" style="width: 100%" rows="4"></textarea> --}}
                                    <hr>
                                    <span class="fw-bold d-block">Diagnosa Sekunder : </span>
                                    <ul>
                                        <li>1.
                                            <span style="vertical-align:top;font-weight: bold;font-size:12px;">{{$data_asesmen->FJ_DIAGNOSA_SEKUNDER[1]}}</span>

                                            <li>2.
                                            <span style="vertical-align:top;font-weight: bold;font-size:12px;">{{$data_asesmen->FJ_DIAGNOSA_SEKUNDER[2]}}</span>
                                    </ul>
                                </td>
                                <td colspan="3" style="vertical-align: top">
                                    <span class="fw-bold d-block"></span>
                                            <span style="vertical-align:top;font-weight: bold;font-size:12px;">{{$data_asesmen->FS_DETAIL_DIAGNOSIS}}</span>
                                </td>
                            </tr>

                        </table>
                    </td>
                </tr>


            </table>

        </div>


        <label style="font-size:12px;" for=""><strong> RENCANA TINDAK LANJUT</strong></label>
        <ul>
            <li class="d-flex">
                <div class="m-r-1" style="margin-left:30px;">
                    <input type="checkbox" name="cRtlPulang" {{$data_asesmen->FJ_RENCANA_TINDAK_LANJUT['Pulang'] == 'on' ? 'checked':''}}>
                    <span style="font-size:12px;vertical-align:top;font-weight:bold;" class="align-top">Pulang</span>
                </div>
            </li>
            <li class="d-flex">
                <div class="m-r-1" style="margin-left:30px;">
                    <input type="checkbox" name="cRtlKontrolTanggal" {{$data_asesmen->FJ_RENCANA_TINDAK_LANJUT['KontrolTanggal'] == 'on' ? 'checked':''}}>
                    <span style="font-size:12px;vertical-align:top;" class="align-top">Kontrol Tanggal : </span>
                    <span style="font-size:12px;vertical-align:top;font-weight:bold;" >{{$data_asesmen->FJ_RENCANA_TINDAK_LANJUT['KontrolTanggalText']}}</span>
                </div>
            </li>
            <li class="d-flex">
                <div class="m-r-1" style="margin-left:30px;">
                    <input type="checkbox" name="cRtlKonsulKe" {{$data_asesmen->FJ_RENCANA_TINDAK_LANJUT['KonsulKe'] == 'on' ? 'checked':''}}>
                    <span style="font-size:12px;vertical-align:top;" class="align-top">Konsul Ke : </span>
                    <span style="font-size:12px;vertical-align:top;font-weight:bold;" >{{$data_asesmen->FJ_RENCANA_TINDAK_LANJUT['KonsulKeText']}}</span>

                </div>
            </li>
            <li class="d-flex">
                <div class="m-r-1" style="margin-left:30px;">
                    <input type="checkbox" name="cRtlRujukKe" {{$data_asesmen->FJ_RENCANA_TINDAK_LANJUT['RujukKe'] == 'on' ? 'checked':''}}>
                    <span style="font-size:12px;vertical-align:top;" class="align-top">Rujuk Ke : </span>
                    <span style="font-size:12px;vertical-align:top;font-weight:bold;" >{{$data_asesmen->FJ_RENCANA_TINDAK_LANJUT['RujukKeText']}}</span>

                </div>
            </li>
            <li class="d-flex">
                <div class="m-r-1" style="margin-left:30px;">
                    <input type="checkbox" name="cRtlRawatInap" {{$data_asesmen->FJ_RENCANA_TINDAK_LANJUT['RawatInap'] == 'on' ? 'checked':''}}>
                    <span style="font-size:12px;vertical-align:top;" class="align-top">Rawat Inap , Ruangan : </span>
                    <span style="font-size:12px;vertical-align:top;font-weight:bold;" >{{$data_asesmen->FJ_RENCANA_TINDAK_LANJUT['RawatInapText']}}</span>
                </div>
            </li>
        </ul>



    </div>


</body>

</html>
