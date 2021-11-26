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

    </style>
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" > --}}

</head>

<body style="font-family:sans-serif ;">
    <div class="">
        <div style="font-size:14px;">
            <span style="float: right;font-weight:bolder;">FORM ASESMEN PERAWAT</span>
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
                                : {{date('d-m-Y',strtotime($rekam_medis->FD_TGL_LAHIR))}}
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
                        <div class="row" style="">
                            <div class="column">
                                <strong style=""> ALASAN KUNJUNGAN (Keluhan
                                    Pertama
                                    saat masuk RS) : </strong>
                            </div>
                            <div class="column">
                                <span style="">{{$data_asesmen->FS_ALASAN_KUNJUNGAN}}</span>
                                {{-- <textarea class="form-control form-control-sm" name="cAlasanKunjungan" id=""
                                    style="max-height:50px;border-radius:5px; "></textarea> --}}
                            </div>

                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="" style="margin-bottom: 5px;">
                            <label for=""><strong> PEMERIKSAAN FISIK </strong>
                            </label>
                        </div>
                        <div class="row">
                            <div class="" style="vertical-align: top;width:15%;float: left;">
                                TD :
                                <span style="font-weight: bold;font-size:12px;">{{$data_asesmen->FN_PF_TD}}</span>
                                mmHG
                            </div>
                            <div class="" style="vertical-align: top;width:15%;float: left;">
                                Nadi :
                                <span style="font-weight: bold;font-size:12px;">{{$data_asesmen->FN_PF_NADI}}</span>

                                x/menit
                            </div>
                            <div class="" style="vertical-align: top;width:20%;float: left;">
                                Respirasi :
                                <span
                                    style="font-weight: bold;font-size:12px;">{{$data_asesmen->FN_PF_RESPIRASI}}</span>
                                x/menit
                            </div>
                            <div class="" style="vertical-align: top;width:15%;float: left;">
                                Suhu :
                                <span style="font-weight: bold;font-size:12px;">{{$data_asesmen->FN_PF_SUHU}}</span>
                                c
                            </div>
                            <div class="" style="vertical-align: top;width:15%;float: left;">
                                TB :
                                <span style="font-weight: bold;font-size:12px;">{{$data_asesmen->FN_PF_TB}}</span>
                                c
                            </div>
                            <div class="" style="vertical-align: top;width:15%;float: left;">
                                BB :
                                <span style="font-weight: bold;font-size:12px;">{{$data_asesmen->FN_PF_BB}}</span>
                                kg
                            </div>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="">
                            <label for=""><strong> RIWAYAT KELUHAN UTAMA </strong>
                            </label>
                        </div>

                        {{-- A --}}
                        <div class="row">
                            <div class="" style="vertical-align: top;width:50%;float: left;">
                                a. Riwayat Penyakit Dahulu
                            </div>
                        </div>
                        <div class="row">
                            <div class="row" style="vertical-align: top;width:100%;">
                                <span style="vertical-align: top;width:50px;">
                                    &nbsp;&nbsp;&nbsp;&nbsp;Pernah
                                    dirawat&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    :
                                </span>
                                <input type="checkbox"
                                    {{$data_asesmen->FJ_RKU_RPD_PDRWT['Tidak'] == 'on' ? 'checked':''}}
                                    name="cRkuPernahDirawatTidak">Tidak&nbsp;
                                <input type="checkbox" style=""
                                    {{$data_asesmen->FJ_RKU_RPD_PDRWT['Ya'] == 'on' ? 'checked':''}}
                                    name="cRkuPernahDirawatYa">Ya&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                Diagnosa: <span
                                    style="vertical-align: top;font-weight:bold;margin-right:100px;">{{$data_asesmen->FJ_RKU_RPD_PDRWT['Diagnosa']}}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                Kapan: <span
                                    style="vertical-align: top;font-weight:bold">{{$data_asesmen->FJ_RKU_RPD_PDRWT['Kapan']}}</span>&nbsp;&nbsp;
                            </div>

                            <div class="row" style="vertical-align: top;width:100%;">
                                &nbsp;&nbsp;&nbsp;&nbsp;Pernah
                                Dioperasi&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                :
                                <input type="checkbox"
                                    {{$data_asesmen->FJ_RKU_RPD_PDOPR['Tidak'] == 'on' ? 'checked':''}}
                                    name="cRkuPernahDirawatTidak">Tidak&nbsp;
                                <input type="checkbox" style=""
                                    {{$data_asesmen->FJ_RKU_RPD_PDOPR['Ya'] == 'on' ? 'checked':''}}
                                    name="cRkuPernahDirawatYa">Ya&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                Diagnosa: <span
                                    style="vertical-align: top;font-weight:bold;margin-right:100px;">{{$data_asesmen->FJ_RKU_RPD_PDOPR['Diagnosa']}}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                Kapan: <span
                                    style="vertical-align: top;font-weight:bold">{{$data_asesmen->FJ_RKU_RPD_PDOPR['Kapan']}}</span>&nbsp;&nbsp;
                            </div>

                            <div class="row" style="vertical-align: top;width:100%;">
                                &nbsp;&nbsp;&nbsp;&nbsp;Masih dalam pengobatan :
                                <input type="checkbox"
                                    {{$data_asesmen->FJ_RKU_RPD_MSDPO['Tidak'] == 'on' ? 'checked':''}}
                                    name="cRkuPernahDirawatTidak">Tidak&nbsp;
                                <input type="checkbox" style=""
                                    {{$data_asesmen->FJ_RKU_RPD_MSDPO['Ya'] == 'on' ? 'checked':''}}
                                    name="cRkuPernahDirawatYa">Ya&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                Obat: <span
                                    style="vertical-align: top;font-weight:bold;margin-right:100px;">{{$data_asesmen->FJ_RKU_RPD_MSDPO['Obat']}}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </div>
                        </div>


                        {{-- B --}}
                        <div class="row">
                            <div class="" style="vertical-align: top;width:50%;float: left;">
                                b. Riwayat Penyakit Keluarga
                            </div>
                        </div>
                        <div class="row">
                            <div class="row" style="vertical-align: top;width:100%;">
                                &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"
                                    {{$data_asesmen->FJ_RPK['Tidak'] == 'on' ? 'checked':''}}
                                    name="cRkuPernahDirawatTidak">Tidak&nbsp;
                            </div>

                            <div class="row" style="vertical-align: top;width:100%;">
                                &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"
                                    {{$data_asesmen->FJ_RPK['Ya'] == 'on' ? 'checked':''}}>Ya&nbsp;
                                <input type="checkbox" style=""
                                    {{$data_asesmen->FJ_RPK['Hipertensi'] == 'on' ? 'checked':''}}>Hipertensi&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="checkbox" style=""
                                    {{$data_asesmen->FJ_RPK['Jantung'] == 'on' ? 'checked':''}}>Jantung&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="checkbox" style=""
                                    {{$data_asesmen->FJ_RPK['DM'] == 'on' ? 'checked':''}}>DM&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="checkbox" style=""
                                    {{$data_asesmen->FJ_RPK['Paru'] == 'on' ? 'checked':''}}>Paru&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="checkbox" style=""
                                    {{$data_asesmen->FJ_RPK['Hepatitis'] == 'on' ? 'checked':''}}>Hepatitis&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                Lainnya: <span
                                    style="vertical-align: top;font-weight:bold">{{$data_asesmen->FJ_RPK['Lainnya']}}</span>&nbsp;&nbsp;
                            </div>
                        </div>

                        {{-- C --}}
                        <div class="row">
                            <div class="" style="vertical-align: top;width:50%;float: left;">
                                c. Ketergantungan
                            </div>
                        </div>
                        <div class="row">
                            <div class="row" style="vertical-align: top;width:100%;">
                                &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"
                                    {{$data_asesmen->FJ_KETERGANTUNGAN['Tidak'] == 'on' ? 'checked':''}}
                                    name="cRkuPernahDirawatTidak">Tidak&nbsp;
                            </div>

                            <div class="row" style="vertical-align: top;width:100%;">
                                &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"
                                    {{$data_asesmen->FJ_KETERGANTUNGAN['Ya'] == 'on' ? 'checked':''}}>Ya&nbsp;
                                <input type="checkbox" style=""
                                    {{$data_asesmen->FJ_KETERGANTUNGAN['Obat'] == 'on' ? 'checked':''}}>Obat&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="checkbox" style=""
                                    {{$data_asesmen->FJ_KETERGANTUNGAN['Alkohol'] == 'on' ? 'checked':''}}>Alkohol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="checkbox" style=""
                                    {{$data_asesmen->FJ_KETERGANTUNGAN['Rokok'] == 'on' ? 'checked':''}}>Rokok&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                Lainnya: <span
                                    style="vertical-align: top;font-weight:bold">{{$data_asesmen->FJ_KETERGANTUNGAN['Lainnya']}}</span>&nbsp;&nbsp;
                            </div>
                        </div>

                        {{-- D --}}
                        <div class="row">
                            <div class="" style="vertical-align: top;width:50%;float: left;">
                                c. Riwayat Alergi :
                                &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"
                                    {{$data_asesmen->FJ_RIWAYAT_ALERGI['Tidak'] == 'on' ? 'checked':''}}>Tidak
                                &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"
                                    {{$data_asesmen->FJ_RIWAYAT_ALERGI['Ya'] == 'on' ? 'checked':''}}>Ya &nbsp;
                                , sebutkan : <strong
                                    style="vertical-align: top">{{$data_asesmen->FJ_RIWAYAT_ALERGI['Lainnya'] }}</strong>&nbsp;
                            </div>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="">
                            <label for=""><strong> RIWAYAT PSIKOSOSIAL </strong>
                            </label>
                        </div>

                        {{-- 1 --}}
                        <div class="row">
                            <div class="" style="vertical-align: top;width:50%;float: left;">
                                1. Status Psikologis
                            </div>
                        </div>
                        <div class="row">
                            <div class="row" style="vertical-align: top;width:100%;">
                                &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"
                                    {{$data_asesmen->FJ_RP_SPSI['Tenang'] == 'on' ? 'checked':''}}>Tenang&nbsp;
                                <input type="checkbox" style=""
                                    {{$data_asesmen->FJ_RP_SPSI['Cemas'] == 'on' ? 'checked':''}}>Cemas&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="checkbox" style=""
                                    {{$data_asesmen->FJ_RP_SPSI['Takut'] == 'on' ? 'checked':''}}>Takut&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="checkbox" style=""
                                    {{$data_asesmen->FJ_RP_SPSI['Marah'] == 'on' ? 'checked':''}}>Marah&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="checkbox" style=""
                                    {{$data_asesmen->FJ_RP_SPSI['Sedih'] == 'on' ? 'checked':''}}>Sedih&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="checkbox" style=""
                                    {{$data_asesmen->FJ_RP_SPSI['BunuhDiri'] == 'on' ? 'checked':''}}>Kecenderungan
                                Bunuh Diri&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                Lapor ke: <span
                                    style="vertical-align: top;font-weight:bold">{{$data_asesmen->FJ_RP_SPSI['laporKe']}}</span>&nbsp;&nbsp;
                            </div>
                            <div class="row" style="vertical-align: top;width:100%;">
                                &nbsp;&nbsp;&nbsp;&nbsp;Lain lain,sebutkan : <span
                                    style="vertical-align: top;font-weight:bold">{{$data_asesmen->FJ_RP_SPSI['lainnya']}}</span>&nbsp;&nbsp;
                            </div>
                        </div>

                        {{-- 2 --}}
                        <div class="row">
                            <div class="" style="vertical-align: top;width:50%;float: left;">
                                2. Status Mental
                            </div>
                        </div>
                        <div class="row">
                            <div class="row" style="vertical-align: top;width:100%;">
                                &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"
                                    {{$data_asesmen->FJ_RP_SMEN['Sadar'] == 'on' ? 'checked':''}}>Sadar dan orientasi
                                baik&nbsp;
                                <input type="checkbox" style=""
                                    {{$data_asesmen->FJ_RP_SMEN['MasalahPrilaku'] == 'on' ? 'checked':''}}>Ada masalah
                                prilaku,&nbsp;
                                sebutkan : <span
                                    style="vertical-align: top;font-weight:bold">{{$data_asesmen->FJ_RP_SMEN['MasalahPrilakuSebutkan']}}</span>&nbsp;&nbsp;
                            </div>
                            <div class="row" style="vertical-align: top;width:100%;">
                                &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"
                                    {{$data_asesmen->FJ_RP_SMEN['PrilakuKekerasaSebelumnya'] == 'on' ? 'checked':''}}>Prilaku
                                kekerasan yang dialami pasien sebelumnya&nbsp;&nbsp;
                                <span
                                    style="vertical-align: top;font-weight:bold">{{$data_asesmen->FJ_RP_SMEN['PrilakuKekerasaSebelumnyaSebutkan']}}</span>&nbsp;&nbsp;
                                <input type="checkbox" style=""
                                    {{$data_asesmen->FJ_RP_SMEN['TidakDinilai'] == 'on' ? 'checked':''}}>Tidak dapat
                                dinilai&nbsp;

                            </div>
                        </div>

                        {{-- 3 --}}
                        <div class="row">
                            <div class="" style="vertical-align: top;width:50%;float: left;">
                                3. Status Sosial
                            </div>
                        </div>
                        <div class="row">
                            <div class="row" style="vertical-align: top;width:100%;">
                                &nbsp;&nbsp;&nbsp;&nbsp;a. Hubungan pasien dengan anggota keluarga
                                <input type="checkbox"
                                    {{$data_asesmen->FJ_RP_SSOS_HPDAK['Baik'] == 'on' ? 'checked':''}}>Baik&nbsp;
                                <input type="checkbox"
                                    {{$data_asesmen->FJ_RP_SSOS_HPDAK['TidakBaik'] == 'on' ? 'checked':''}}>TIdak
                                Baik&nbsp;
                            </div>
                            <div class="row" style="vertical-align: top;width:100%;">
                                &nbsp;&nbsp;&nbsp;&nbsp;b. Kerabat terdekat yang dapat dihubungi &nbsp;&nbsp;
                                Nama :
                                <span
                                    style="vertical-align: top;font-weight:bold">{{$data_asesmen->FJ_RP_SSOS_KTYDD['Nama']}}</span>&nbsp;&nbsp;&nbsp;&nbsp;


                                Hubungan :
                                <span
                                    style="vertical-align: top;font-weight:bold">{{$data_asesmen->FJ_RP_SSOS_KTYDD['Hubungan']}}</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                Telepon :
                                <span
                                    style="vertical-align: top;font-weight:bold">{{$data_asesmen->FJ_RP_SSOS_KTYDD['Telepon']}}</span>&nbsp;&nbsp;&nbsp;&nbsp;

                            </div>
                        </div>

                        {{-- 4 --}}
                        <div class="row">
                            <div class="" style="vertical-align: top;width:50%;float: left;">
                                4. Status Ekonomi
                            </div>
                        </div>
                        <div class="row">
                            <div class="row" style="vertical-align: top;width:100%;">
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <span style="vertical-align: top;width:50px;">Pekerjaan
                                </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                                <input type="checkbox"
                                    {{$data_asesmen->FJ_RP_SEKO['PNS'] == 'on' ? 'checked':''}}>PNS&nbsp;
                                <input type="checkbox"
                                    {{$data_asesmen->FJ_RP_SEKO['Swasta'] == 'on' ? 'checked':''}}>Swasta&nbsp;
                                <input type="checkbox"
                                    {{$data_asesmen->FJ_RP_SEKO['Wiraswasta'] == 'on' ? 'checked':''}}>Wiraswasta&nbsp;
                                <input type="checkbox"
                                    {{$data_asesmen->FJ_RP_SEKO['Petani'] == 'on' ? 'checked':''}}>Petani&nbsp;
                                <input type="checkbox"
                                    {{$data_asesmen->FJ_RP_SEKO['PekerjaanLainnya'] == 'on' ? 'checked':''}}>Lainnya
                                :&nbsp;
                                <span
                                    style="vertical-align: top;width:50px;font-weight:bold">{{$data_asesmen->FJ_RP_SEKO['PekerjaanLainnyaText']}}</span>
                            </div>

                            <div class="row" style="vertical-align: top;width:100%;">
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <span style="vertical-align: top;width:50px;">Jaminan Kesehatan : </span>
                                <input type="checkbox"
                                    {{$data_asesmen->FJ_RP_SEKO['JKN'] == 'on' ? 'checked':''}}>JKN&nbsp;
                                <input type="checkbox"
                                    {{$data_asesmen->FJ_RP_SEKO['Jamkesda'] == 'on' ? 'checked':''}}>Jamkesda&nbsp;
                                <input type="checkbox"
                                    {{$data_asesmen->FJ_RP_SEKO['Asuransi'] == 'on' ? 'checked':''}}>Asuransi&nbsp;
                                <input type="checkbox"
                                    {{$data_asesmen->FJ_RP_SEKO['Pribadi'] == 'on' ? 'checked':''}}>Pribadi&nbsp;
                                <input type="checkbox"
                                    {{$data_asesmen->FJ_RP_SEKO['AsuransiLainnya'] == 'on' ? 'checked':''}}>Lainnya
                                :&nbsp;
                                <span
                                    style="vertical-align: top;width:50px;font-weight:bold">{{$data_asesmen->FJ_RP_SEKO['AsuransiLainnyaText']}}</span>
                            </div>
                        </div>

                        {{-- 5 --}}
                        <div class="row">
                            <div class="" style="vertical-align: top;width:50%;float: left;">
                                5. Agama
                            </div>
                        </div>
                        <div class="row">
                            <div class="row" style="vertical-align: top;width:100%;">
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="checkbox"
                                    {{$data_asesmen->FJ_RP_AGAMA['Islam'] == 'on' ? 'checked':''}}>Islam&nbsp;
                                <input type="checkbox"
                                    {{$data_asesmen->FJ_RP_AGAMA['Kristen'] == 'on' ? 'checked':''}}>Kristen&nbsp;
                                <input type="checkbox"
                                    {{$data_asesmen->FJ_RP_AGAMA['Katolik'] == 'on' ? 'checked':''}}>Katolik&nbsp;
                                <input type="checkbox"
                                    {{$data_asesmen->FJ_RP_AGAMA['Hindu'] == 'on' ? 'checked':''}}>Hindu&nbsp;
                                <input type="checkbox"
                                    {{$data_asesmen->FJ_RP_AGAMA['Budha'] == 'on' ? 'checked':''}}>Budha&nbsp;

                                <input type="checkbox"
                                    {{$data_asesmen->FJ_RP_AGAMA['KepercayaanLain'] == 'on' ? 'checked':''}}>Lainnya
                                :&nbsp;
                                <span
                                    style="vertical-align: top;width:50px;font-weight:bold">{{$data_asesmen->FJ_RP_AGAMA['KepercayaanLainText']}}</span>
                            </div>


                        </div>



                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="" style="margin-bottom: 5px;">
                            <label for=""><strong> SKALA NYERI </strong>
                            </label>
                        </div>
                        <div class="row">
                            <div style="width: 40%;float:left;" class="">
                                <img style="width: 100%;" src="{{asset('assets/images/nyeri.png')}}" alt="">
                                <div class="row" style="vertical-align: top;width:100%;">
                                    <input type="checkbox" style=""
                                        {{$data_asesmen->FJ_SN_RATE['0'] == 'on' ? 'checked':''}}>0 Tidak merasa nyeri
                                    sama sekali
                                </div>
                                <div class="row" style="vertical-align: top;width:100%;">
                                    <input type="checkbox" style=""
                                        {{$data_asesmen->FJ_SN_RATE['1'] == 'on' ? 'checked':''}}>1-3 Nyeri Ringan
                                </div>
                                <div class="row" style="vertical-align: top;width:100%;">
                                    <input type="checkbox" style=""
                                        {{$data_asesmen->FJ_SN_RATE['2'] == 'on' ? 'checked':''}}>4-6 Nyeri Sedang
                                </div>
                                <div class="row" style="vertical-align: top;width:100%;">
                                    <input type="checkbox" style=""
                                        {{$data_asesmen->FJ_SN_RATE['3'] == 'on' ? 'checked':''}}>7-9 Nyeri Berat
                                </div>
                                <div class="row" style="vertical-align: top;width:100%;">
                                    <input type="checkbox" style=""
                                        {{$data_asesmen->FJ_SN_RATE['4'] == 'on' ? 'checked':''}}>10 Nyeri amat sangat
                                    Berat
                                </div>
                            </div>
                            <div class="row">
                                <div style="width: 50%;float:left;margin-left:10px;vertical-align: top;" class="">
                                    <div class="row" style="vertical-align: top;width:100%;">
                                        Apakah ada nyeri
                                        <input type="checkbox" style="" {{$data_asesmen->FJ_SN_NYERI['Tidak'] == 'on' ? 'checked':''}}>Tidak&nbsp;
                                        <input type="checkbox" style="" {{$data_asesmen->FJ_SN_NYERI['Ya'] == 'on' ? 'checked':''}}>Ya
                                        <br>
                                        <span style="" class="row">
                                            Skala Nyeri : <span style="vertical-align: top;font-weight:bold;">{{$data_asesmen->FJ_SN_RATE['text'] ?? ''}}</span>
                                            Lokasi : <span style="vertical-align: top;font-weight:bold;">{{$data_asesmen->FS_SN_LOKASI ?? ''}}</span> &nbsp;
                                        </span>
                                        <span style="" class="row">
                                            Durasi : <span style="vertical-align: top;font-weight:bold;">{{$data_asesmen->FS_SN_DURASI ?? ''}}</span>
                                            Frekuensi : <span style="vertical-align: top;font-weight:bold;">{{$data_asesmen->FS_SN_FREKUENSI ?? ''}}</span> &nbsp;
                                        </span>
                                        <br>
                                        Nyeri Hilang Jika :
                                         <input type="checkbox" style="" {{$data_asesmen->FJ_SN_NHB['MinumObat'] == 'on' ? 'checked':''}}>MinumObat&nbsp;&nbsp;&nbsp;&nbsp;
                                         <br>
                                         <input type="checkbox" style="" {{$data_asesmen->FJ_SN_NHB['MendengarkanMusik'] == 'on' ? 'checked':''}}>Mendengarkan Musik&nbsp;&nbsp;&nbsp;
                                         <input type="checkbox" style="" {{$data_asesmen->FJ_SN_NHB['Istirahat'] == 'on' ? 'checked':''}}>Istirahat&nbsp;&nbsp;&nbsp;
                                         <br>
                                         <input type="checkbox" style="" {{$data_asesmen->FJ_SN_NHB['BerubahPosisiTidur'] == 'on' ? 'checked':''}}>Berubah Posisi/ Tidur&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                         <br>
                                         <input type="checkbox" style="" {{$data_asesmen->FJ_SN_NHB['Lainnya'] == 'on' ? 'checked':''}}>Lain-lain {{$data_asesmen->FJ_SN_NHB['LainnyaText']}}&nbsp;&nbsp;&nbsp;
                                        <br>
                                        Diberitahukan ke Dokter :
                                         <input type="checkbox" style="" {{$data_asesmen->FJ_SN_DKD['Ya'] == 'on' ? 'checked':''}}>

                                        <span class="align-top" style="vertical-align:top;"> Ya, pukul </span>
                                                                <span style="font-weight: bold;vertical-align:top;">
                                                                    {{$data_asesmen->FJ_SN_DKD['Pukul']}}
                                                                </span>
                                                                &nbsp;&nbsp;&nbsp;
                                                                <input type="checkbox" name="cSnDkdTidak" {{$data_asesmen->FJ_SN_DKD['Tidak'] == 'on' ?'checked':''}}>
                                                                <span style="font-weight: bold;vertical-align:top;"  class="align-top"> Tidak</span>
                                    </div>





                                </div>
                            </div>
                        </div>

                    </td>
                </tr>
            </table>

        </div>



    </div>


</body>

</html>
