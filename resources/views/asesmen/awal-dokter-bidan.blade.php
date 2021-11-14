@extends('main')

@push('styles')
<link rel="stylesheet" href="{{asset('assets/libs/select2/select2.min.css')}}">

<style>
    .detail-asesmen td {
        padding: 3px 8px;
    }



    .detail-asesmen {
        border-color: black !important;
    }

    .text-align-right {
        text-align: right !important;
    }

</style>

@endpush

@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                 <div class="card" style="box-shadow: -7px -1px 29px 5px rgba(0,0,0,0.27);
-webkit-box-shadow: -7px -1px 20px 0px rgb(0 0 0 / 27%);
-moz-box-shadow: -7px -1px 29px 5px rgba(0,0,0,0.27); border:0px !important;border-radius: 20px;">
                    <div class="card-header" style="background: cornflowerblue;border-top-left-radius:20px;border-top-right-radius:20px">
                        <h5 class="card-title text-white">{{$page_title}} ({{$type}})</h5>
                    </div>
                    <form action="{{route('asesmen-awal-bidan-dokter.store')}}" method="POST">
                        @csrf
                        <div class="card-body">
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <div class="row">
                                <div class="col-lg-6">
                                    <table class=" w-100">
                                        <tr>
                                            <td class="leftCol" width="40%">
                                                <label for="">Nomor MR</label>
                                                <span style="float:right;" class="float-right">:&nbsp;</span>
                                            </td>
                                            <td class="rightCol" width="60%">
                                                <input type="text" class="form-control form-control-sm" name="cNomorMR"
                                                    value="{{$rekam_medis->FS_MR}}" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="leftCol" width="40%">
                                                <label for="">Nama Pasien</label>
                                                <span style="float:right;" class="float-right">:&nbsp;</span>
                                            </td>
                                            <td class="rightCol" width="60%">
                                                <input type="text" class="form-control form-control-sm"
                                                    value="{{$rekam_medis->FS_NM_PASIEN}}" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="leftCol" width="40%">
                                                <label for="">Tanggal Lahir</label>
                                                <span style="float:right;" class="float-right">:&nbsp;</span>
                                            </td>
                                            <td class="rightCol" width="60%">
                                                <input type="date" class="form-control form-control-sm"
                                                    value="{{$rekam_medis->FD_TGL_LAHIR}}" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="leftCol" width="40%">
                                                <label for="">Jenis Kelamin</label>
                                                <span style="float:right;" class="float-right">:&nbsp;</span>
                                            </td>
                                            <td class="rightCol" width="60%">
                                                <input type="text" class="form-control form-control-sm"
                                                    value="{{$rekam_medis->FB_JNS_KELAMIN == 0 ? 'LAKI - LAKI':'PEREMPUAN'}}"
                                                    readonly>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-lg-6">
                                    <input type="hidden" class="form-control form-control-sm" name="cFrom"
                                        value="{{$from}}" readonly>
                                    <input type="hidden" class="form-control form-control-sm" name="cType"
                                        value="{{$type}}" readonly>
                                    <table class="w-100">
                                        <tr>
                                            <td class="leftCol">
                                                <label for="">Register</label>
                                                <span style="float:right;" class="float-right">:&nbsp;</span>
                                            </td>
                                            <td class="rightCol">
                                                <input type="text" class="form-control form-control-sm" name="cRegister"
                                                    value="{{$rekam_medis->FS_KD_REG}}" readonly>
                                                {{-- @if ($kd_reg != '')
                                                    <input type="text" class="form-control form-control-sm" name="cRegister" value="{{$rekam_medis->FS_KD_REG}}"
                                                readonly>
                                                @else
                                                <input type="text" class="form-control form-control-sm" name="cRegister"
                                                    value="" readonly>
                                                @endif --}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="leftCol">
                                                <label for="">Tanggal Jam Masuk</label>
                                                <span style="float:right;" class="float-right">:&nbsp;</span>
                                            </td>
                                            <td class="rightCol">
                                                <input type="text" class="form-control form-control-sm"
                                                    value="{{date('d-m-Y',strtotime($rekam_medis->FD_TGL_MASUK))}} {{$rekam_medis->FS_JAM_MASUK}}"
                                                    readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="leftCol">
                                                <label for="">Dokter DPJP</label>
                                                <span style="float:right;" class="float-right">:&nbsp;</span>
                                            </td>
                                            <td class="rightCol">
                                                <input type="hidden" class="form-control form-control-sm" name="cKdpeg"
                                                    value="{{$rekam_medis->FS_KD_PEG}}" readonly>
                                                <input type="text" class="form-control form-control-sm" name="cDpjp"
                                                    value="{{$rekam_medis->FS_NM_PEG}}" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="leftCol">
                                                <label for="">Jaminan/ Cara Bayar</label>
                                                <span style="float:right;" class="float-right">:&nbsp;</span>
                                            </td>
                                            <td class="rightCol">
                                                <input type="text" class="form-control form-control-sm"
                                                    value="{{$rekam_medis->fs_nm_jaminan}}" readonly>
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-lg-6">
                                    <table class=" w-100">
                                        <tr>
                                            <td class="leftCol" width="40%">
                                                <label for="">Profesi</label>
                                                <span class="text-danger">*</span>
                                                <span style="float:right;" class="float-right">:&nbsp;</span>
                                            </td>
                                            <td class="rightCol" width="60%">
                                                <select class="form-select form-select-sm" id="" name="cProfesi"
                                                    required>
                                                    <option value="">-- Pilih Profesi</option>
                                                    <option selected=selected
                                                        value="Dokter">Dokter</option>
                                                    <option
                                                        value="Perawat">Perawat</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="leftCol">
                                                <label for="">Layanan / Bagian</label>
                                                <span class="text-danger">*</span>
                                                <span style="float:right;" class="float-right">:&nbsp;</span>
                                            </td>
                                            <td class="rightCol">
                                                <select class="form-select form-select-sm" id="" name="cLayanan"
                                                    required>
                                                    <option value="">-- Pilih Layanan/Bagian</option>
                                                    @foreach ($layanan_bagian as $lb)
                                                    <option
                                                        {{$rekam_medis->FS_KD_LAYANAN == $lb->FS_KD_LAYANAN ? 'selected=selected' :'' }}
                                                        value="{{$lb->FS_KD_LAYANAN}}">{{$lb->FS_NM_LAYANAN}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>

                                    </table>

                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">ASESMEN AWAL TERINTEGRASI PASIEN KEBIDANAN DAN
                                                KANDUNGAN RAWAT JALAN
                                            </h4>
                                            <span>(dilengkapi dalam waktu 2 jam pertama pasien masuk ruang rawat
                                                jalan)</span>
                                        </div><!-- end card header -->
                                        <table class="detail-asesmen w-100 table-bordered">
                                            <tr>
                                                <td>
                                                    <div class="form-group row">
                                                        <div class="col-5">
                                                            <label for=""><strong> PENGKAJIAN (DIISI OLEH DOKTER)
                                                                </strong></label>
                                                        </div>
                                                        <div class="col-7">

                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <ul class="list-unstyled mb-0">
                                                            <li>

                                                                <ul class="list-unstyled mb-0">
                                                                    <li class="">
                                                                        <table class="w-100 ">
                                                                            <tr>
                                                                                <td width="15%" class="p-0"
                                                                                    style="vertical-align: top;">
                                                                                    <span
                                                                                        class="d-block fw-bold text-decoration-underline">Data
                                                                                        Subyektif</span>
                                                                                    <span class="d-block fst-italic"
                                                                                        style="">Subjective Data</span>
                                                                                </td>
                                                                                <td class="d-flex p-0">
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;">
                                                                                        <input type="checkbox"
                                                                                            name="cDsAuto">
                                                                                        Auto
                                                                                    </div>

                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;">
                                                                                        <input type="checkbox"
                                                                                            name="cDsAllo">
                                                                                        <span class="align-top">Allo
                                                                                            :</span>
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;width: 510px;">
                                                                                        <textarea name="cDsText" id=""
                                                                                            cols="30" rows="5"
                                                                                            style="width:100%"></textarea>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </li>
                                                                    <li class="">
                                                                        <table class="w-100 ">
                                                                            <tr>
                                                                                <td width="15%" class="p-0"
                                                                                    style="vertical-align: top;">
                                                                                    <span
                                                                                        class="d-block fw-bold text-decoration-underline">Riwayat
                                                                                        Penyakit Dulu</span>
                                                                                    <span class="d-block fst-italic"
                                                                                        style="">Past Diagnosis
                                                                                        History</span>
                                                                                </td>
                                                                                <td class="d-flex p-0">
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;">
                                                                                        :
                                                                                    </div>


                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;width: ;">
                                                                                        <textarea name="cRpd" id=""
                                                                                            cols="30"
                                                                                            rows="2"></textarea>
                                                                                    </div>
                                                                                </td>

                                                                            </tr>
                                                                        </table>
                                                                    </li>

                                                                    <li class="">
                                                                        <table class="w-100 ">
                                                                            <tr>
                                                                                <td width="15%" class="p-0"
                                                                                    style="vertical-align: top;">
                                                                                    <span
                                                                                        class="d-block fw-bold ">Riwayat
                                                                                        Kehamilan</span>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="d-flex">
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:10px;">
                                                                                        Gravida :
                                                                                        <input type="text" class=""
                                                                                            name="cRkGravida">
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;">
                                                                                        Aterm :
                                                                                        <input type="text" class=""
                                                                                            name="cRkAterm">
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;">
                                                                                        Prematur :
                                                                                        <input type="text" class=""
                                                                                            name="cRkPrematur">
                                                                                    </div>
                                                                                </td>

                                                                            </tr>
                                                                            <tr>
                                                                                <td class="d-flex">
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:10px;">
                                                                                        Abortus :
                                                                                        <input type="text" class=""
                                                                                            name="cRkAbortus">
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;">
                                                                                        Anak Hidup :
                                                                                        <input type="text" class=""
                                                                                            name="cRkAnakHidup">
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;">
                                                                                        SC :
                                                                                        <input type="text" class=""
                                                                                            name="cRkSC">
                                                                                    </div>
                                                                                </td>

                                                                            </tr>

                                                                        </table>
                                                                    </li>

                                                                    <li class="">
                                                                        <table class="w-100 ">
                                                                            <tr>
                                                                                <td width="15%" class="p-0"
                                                                                    style="vertical-align: top;">
                                                                                    <span
                                                                                        class="d-block fw-bold ">Riwayat
                                                                                        Pernikahan</span>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="d-flex">
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:10px;">
                                                                                        <input type="checkbox" class=""
                                                                                        name="cRpMenikah">
                                                                                        Menikah
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;">
                                                                                        <input type="checkbox" class=""
                                                                                        name="cRpBelumMenikah">
                                                                                        Belum Menikah
                                                                                    </div>

                                                                                </td>

                                                                            </tr>

                                                                        </table>
                                                                    </li>

                                                                    <li class="">
                                                                        <table class="w-100 ">
                                                                            <tr>
                                                                                <td width="15%" class="p-0"
                                                                                    style="vertical-align: top;">
                                                                                    <span
                                                                                        class="d-block fw-bold ">Riwayat
                                                                                        Haid</span>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="d-flex">
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:10px;width:50%">
                                                                                        Haid Pertama Usia :
                                                                                        <input type="text" class=""
                                                                                            name="cRhHaidPertamaUsia"> Tahun
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:10px;width:50%">
                                                                                        Siklus Haid :
                                                                                        <input type="text" class=""
                                                                                            name="cRhSiklusHaid"> Hari
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="d-flex">
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:10px;width:50%">

                                                                                        Haid Teratur :
                                                                                        &nbsp;
                                                                                        <input type="checkbox" class=""
                                                                                            name="cRhHaidTeraturYa">Ya

                                                                                            &nbsp;
                                                                                            &nbsp;
                                                                                            &nbsp;
                                                                                        <input type="checkbox" class=""
                                                                                            name="cRhHaidTeraturTidak">Tidak
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:10px;width:50%">
                                                                                        Haid Pertama Haid Terakhir :
                                                                                        <input type="text" class=""
                                                                                            name="cRhHaidHariPertamaTerakhir">
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="d-flex">
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:10px;width:50%">

                                                                                        Nyeri Haid :
                                                                                        &nbsp;
                                                                                        <input type="checkbox" class=""
                                                                                            name="cRhNyeriHaidYa">Ya

                                                                                            &nbsp;
                                                                                            &nbsp;
                                                                                            &nbsp;
                                                                                        <input type="checkbox" class=""
                                                                                            name="cRhNyeriHaidTidak">Tidak
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:10px;width:50%">
                                                                                        Taksiran Persalinan :
                                                                                        <input type="text" class=""
                                                                                            name="cRhTaksiranPersalinan">
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="d-flex">
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:10px;width:50%">

                                                                                        Lama Haid :
                                                                                        <input type="text" class=""
                                                                                            name="cRhLamaHaid"> hari
                                                                                    </div>

                                                                                </td>
                                                                            </tr>

                                                                        </table>
                                                                    </li>

                                                                    <li class="">
                                                                        <table class="w-100">
                                                                            <tr>
                                                                                <td width="15%" class="p-0"
                                                                                    style="vertical-align: top;">
                                                                                    <span
                                                                                        class="d-block fw-bold ">RIWAYAT PERSALINAN</span>

                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <table class="detail-asesmen w-100 table-bordered" >
                                                                                        <thead>
                                                                                            <tr>
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


                                                                                        </tbody>

                                                                                    </table>
                                                                                </td>
                                                                            </tr>

                                                                        </table>
                                                                    </li>

                                                                    <li class="">
                                                                        <table class="w-100 ">
                                                                            <tr>
                                                                                <td width="15%" class="p-0"
                                                                                    style="vertical-align: top;">
                                                                                    <span
                                                                                        class="d-block fw-bold text-decoration-underline">Data
                                                                                        Obyektif</span>
                                                                                    <span class="d-block fst-italic"
                                                                                        style="">Objective Data</span>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="d-flex ">
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;width:10%;white-space:nowrap">
                                                                                        Keadaan Umum :

                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;white-space:nowrap">
                                                                                        <input type="text" class=""
                                                                                            name="cDoKeadaanUmum">

                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="d-flex ">
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;width:10%white-space:nowrap">
                                                                                        Kesadaran :

                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;white-space:nowrap">
                                                                                        <input type="text" class="" style="width: 150px;"
                                                                                            name="cDoKesadaran">

                                                                                    </div>

                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;white-space:nowrap">
                                                                                        GCS :

                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;white-space:nowrap">E
                                                                                        <input type="text" class="" style="width: 150px;"
                                                                                            name="cDoGCSE">

                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;white-space:nowrap">V
                                                                                        <input type="text" class="" style="width: 150px;"
                                                                                            name="cDoGCSV">

                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;white-space:nowrap">M
                                                                                        <input type="text" class="" style="width: 150px;"
                                                                                            name="cDoGCSM">

                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="d-flex ">
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;white-space:nowrap;">
                                                                                        TD :
                                                                                        <input type="text" class="" style="width: 100px;"
                                                                                            name="cDoTD" >
                                                                                        mmHg
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;white-space:nowrap;">
                                                                                        Nadi :
                                                                                        <input type="text" class="" style="width: 100px;"
                                                                                            name="cDoNadi">
                                                                                        x/menit
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;white-space:nowrap;">
                                                                                        Respirasi :
                                                                                        <input type="text" class="" style="width: 100px;"
                                                                                            name="cDoRespirasi">
                                                                                        x/menit
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;white-space:nowrap;">
                                                                                        Suhu :
                                                                                        <input type="text" class="" style="width: 100px;"
                                                                                            name="cDoSuhu">
                                                                                        C
                                                                                    </div>

                                                                                </td>

                                                                            </tr>

                                                                            <tr>
                                                                                <td class="d-flex ">
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;white-space:nowrap;">
                                                                                        TFU :
                                                                                        <input type="text" class="" style="width: 100px;"
                                                                                            name="cDoTFU">
                                                                                        cm
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;white-space:nowrap;">
                                                                                        DJJ :
                                                                                        <input type="text" class="" style="width: 100px;"
                                                                                            name="cDoDJJ">
                                                                                        x/menit
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;white-space:nowrap;">
                                                                                        His :
                                                                                        <input type="text" class="" style="width: 100px;"
                                                                                            name="cDoHis">
                                                                                        x/menit
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;white-space:nowrap;">
                                                                                        TBJ :
                                                                                        <input type="text" class="" style="width: 100px;"
                                                                                            name="cDoTBJ">
                                                                                        gram
                                                                                    </div>

                                                                                </td>

                                                                            </tr>
                                                                        </table>
                                                                    </li>

                                                                </ul>
                                                            </li>


                                                        </ul>

                                                    </div>

                                                </td>
                                            </tr>
                                        </table>


                                        <table class="detail-asesmen w-100 table-bordered">
                                            <tr>
                                                <td class="fw-bold p-1" colspan="4">Pemeriksaan Fisik Tambahan</td>

                                            </tr>
                                            <tr>
                                                <td width="25%">
                                                    <img src="{{asset('assets/images/pemeriksaan-dokter-bidan.PNG')}}"
                                                        class="" alt="">
                                                </td>
                                                <td width="75%" style="vertical-align: top">
                                                    <textarea  name="cPemeriksaanFisikTambahan" id="" style="width: 100%" rows="10"></textarea>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <span class="fw-bold d-block">Pemeriksaan Penunjang : </span>
                                                    <textarea name="cPemeriksaanPenunjang" id="" style="width: 100%"
                                                        rows="4"></textarea>
                                                </td>
                                                <td colspan="3">
                                                    <span class="fw-bold d-block">TINDAKAN & TERAPI : </span>
                                                    <textarea name="cTindakanTerapi" id="" style="width: 100%"
                                                        rows="4"></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="vertical-align: top">
                                                   <span class="fw-bold d-block">Diagnosa Utama : (kode ICD 10) </span>
                                                    <select name="cKodeDiagnosis" class="form-control  select2"  id="icd"></select>
                                                    {{-- <textarea name="" id="" style="width: 100%" rows="4"></textarea> --}}
                                                    <hr>
                                                    <span class="fw-bold d-block">Diagnosa Sekunder : </span>
                                                    <ul>
                                                        <li>1. <input type="text" name="cDiagnosaSekunder1"></li>
                                                        <li>2. <input type="text" name="cDiagnosaSekunder2"></li>
                                                        <li>3. <input type="text" name="cDiagnosaSekunder3"></li>
                                                    </ul>
                                                </td>
                                                <td colspan="3" style="vertical-align: top">
                                                    <span class="fw-bold d-block"></span>
                                                    <textarea name="cDetailDiagnosis" id="" style="width: 100%"
                                                        rows="10"></textarea>
                                                </td>
                                            </tr>

                                        </table>
                                        <label for=""><strong> RENCANA TINDAK LANJUT</strong></label>
                                        <ul>
                                            <li class="d-flex">
                                                <div class="m-r-1" style="margin-left:30px;">
                                                    <input type="checkbox" name="cRtlPulang">
                                                    <span class="align-top">Pulang</span>
                                                </div>
                                            </li>
                                            <li class="d-flex">
                                                <div class="m-r-1" style="margin-left:30px;">
                                                    <input type="checkbox" name="cRtlKontrolTanggal">
                                                    <span class="align-top">Kontrol Tanggal : </span>
                                                    <input type="date" name="cRtlKontrolTanggalText">
                                                </div>
                                            </li>
                                            <li class="d-flex">
                                                <div class="m-r-1" style="margin-left:30px;">
                                                    <input type="checkbox" name="cRtlKonsulKe">
                                                    <span class="align-top">Konsul Ke : </span>
                                                    <input type="text" name="cRtlKontulKeText">
                                                </div>
                                            </li>
                                            <li class="d-flex">
                                                <div class="m-r-1" style="margin-left:30px;">
                                                    <input type="checkbox" name="cRtlRujukKe">
                                                    <span class="align-top">Rujuk Ke : </span>
                                                    <input type="text" name="cRtlRujukKeText">
                                                </div>
                                            </li>
                                            <li class="d-flex">
                                                <div class="m-r-1" style="margin-left:30px;">
                                                    <input type="checkbox" name="cRtlRawatInap">
                                                    <span class="align-top">Rawat Inap , Ruangan : </span>
                                                    <input type="text" name="cRtlRawatInapText">
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div><!-- end col -->
                            </div><!-- end row -->


                            <div style="margin-top:20px;">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-save"></i>
                                    SAVE
                                </button>

                                <a href="{{ redirect()->back()->getTargetUrl() }}" class="btn btn-danger">
                                    <i class="fa fa-arrow-left"></i>
                                    BACK
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <!-- end row -->

    </div> <!-- container-fluid -->
</div>
@endsection

@push('scripts')
<!-- form wizard init -->
<script src="{{asset('/')}}assets/js/pages/form-wizard.init.js"></script>
<script src="{{asset('assets/libs/select2/select2.min.js')}}"></script>
<script>
   $(document).ready(function() {
        $('#icd').select2({
            // minimumInputLength: 3,
            dropdownAutoWidth : true,
            ajax: {
                url: '{{ route("api.icd.search")}}',
                dataType: 'json',
            },
        });
    });
    $('#data-table').DataTable({});
    // $("input:checkbox").on('click', function () {
    //     // in the handler, 'this' refers to the box clicked on
    //     var $box = $(this);
    //     if ($box.is(":checked")) {
    //         // the name of the box is retrieved using the .attr() method
    //         // as it is assumed and expected to be immutable
    //         var group = "input:checkbox[name='" + $box.attr("name") + "']";
    //         // the checked state of the group/box on the other hand will change
    //         // and the current value is retrieved using .prop() method
    //         $(group).prop("checked", false);
    //         $box.prop("checked", true);
    //     } else {
    //         $box.prop("checked", false);
    //     }
    // });

</script>
@endpush
