@extends('main')

@push('styles')
<style>
    .detail-asesmen
    td {
        padding: 8px;
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
                    <form action="{{route('asesmen-awal-perawat.store')}}" method="POST">
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
                                                <input type="text" class="form-control form-control-sm" name="cRegister" value="{{$rekam_medis->FS_KD_REG}}" readonly>
                                                {{-- @if ($kd_reg != '')
                                                    <input type="text" class="form-control form-control-sm" name="cRegister" value="{{$rekam_medis->FS_KD_REG}}" readonly>
                                                @else
                                                    <input type="text" class="form-control form-control-sm" name="cRegister" value="" readonly>
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
                                                <select class="form-select form-select-sm" id="" name="cProfesi" required>
                                                    <option value="">-- Pilih Profesi</option>
                                                    <option
                                                        value="Dokter">Dokter</option>
                                                    <option selected=selected
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
                                                <select class="form-select form-select-sm" id="" name="cLayanan" required>
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
                                            <h4 class="card-title">Assesmen Awal Terintegrasi Pasien {{$type}} Rawat Jalan
                                            </h4>
                                        </div><!-- end card header -->
                                        <table class="detail-asesmen w-100 table-bordered">
                                            <tr>
                                                <td>
                                                    <div class="form-group row">
                                                        <div class="col-6">
                                                            <label for=""><strong> ALASAN KUNJUNGAN (Keluhan
                                                                    Pertama
                                                                    saat masuk RS) : </strong></label>
                                                        </div>
                                                        <div class="col-6">
                                                            <textarea class="form-control form-control-sm" name="cAlasanKunjungan" id=""
                                                                rows="2"></textarea>
                                                        </div>

                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-group row">
                                                        <div class="col-5">
                                                            <label for=""><strong> PEMERIKSAAN FISIK </strong>
                                                            </label>
                                                        </div>
                                                        <div class="col-7">

                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <div class="form-group row">
                                                                <div class="col-3 text-align-right">
                                                                    <label for="">TD :</label>
                                                                </div>
                                                                <div class="col-5">
                                                                    <input type="text"  name="cTd" class="form-control form-control-sm" max="120">
                                                                </div>
                                                                <div class="col-4">
                                                                    mmHG
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-3 text-align-right">
                                                                    <label for="">TB :</label>
                                                                </div>
                                                                <div class="col-5">
                                                                    <input type="number" step="0.1" name="cTb"
                                                                        class="form-control form-control-sm">
                                                                </div>
                                                                <div class="col-4">
                                                                    cm
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group row">
                                                                <div class="col-3 text-align-right">
                                                                    <label for="">Nadi :</label>
                                                                </div>
                                                                <div class="col-5">
                                                                    <input type="number" step="0.1" name="cNadi"
                                                                        class="form-control form-control-sm">
                                                                </div>
                                                                <div class="col-4">
                                                                    x/menit
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-3 text-align-right">
                                                                    <label for="">BB :</label>
                                                                </div>
                                                                <div class="col-5">
                                                                    <input type="number" step="0.1" name="cBb"
                                                                        class="form-control form-control-sm">
                                                                </div>
                                                                <div class="col-4">
                                                                    kg
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group row">
                                                                <div class="col-5 text-align-right">
                                                                    <label for=""> Respirasi :</label>
                                                                </div>
                                                                <div class="col-3">
                                                                    <input type="number" step="0.1" name="cRespirasi"
                                                                        class="form-control form-control-sm">
                                                                </div>
                                                                <div class="col-4">
                                                                    x/menit
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group row">
                                                                <div class="col-3 text-align-right">
                                                                    <label for="">Suhu :</label>
                                                                </div>
                                                                <div class="col-5">
                                                                    <input type="number" step="0.1" name="cSuhu"
                                                                        class="form-control form-control-sm">
                                                                </div>
                                                                <div class="col-4">
                                                                    c
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>

                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <div class="form-group row">
                                                        <div class="col-5">
                                                            <label for=""><strong> RIWAYAT KELUHAN UTAMA
                                                                </strong></label>
                                                        </div>
                                                        <div class="col-7">

                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <ul class="list-unstyled mb-0">
                                                            <li>a. Riwayat Penyakit Dahulu
                                                                <ul>
                                                                    <li class="">
                                                                        <table class="w-100 ">
                                                                            <tr>
                                                                                <td width="15%" class="p-0">
                                                                                    Pernah dirawat :</td>
                                                                                <td class="d-flex p-0">
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;">
                                                                                        <input type="checkbox"

                                                                                            name="cRkuPernahDirawatTidak">
                                                                                        Tidak
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;">
                                                                                        <input type="checkbox"

                                                                                            name="cRkuPernahDirawatYa">
                                                                                        Ya
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;">
                                                                                        <span
                                                                                            class="align-top">Diagnosa</span>
                                                                                        <input type="text" name="cRkuPernahDirawatDiagnosa" value="">
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;">
                                                                                        <span
                                                                                            class="align-top">Kapan</span>
                                                                                        <input type="text" name="cRkuPernahDirawatKapan" value="">
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        </table>


                                                                    </li>
                                                                    <li class="">
                                                                        <table class="w-100 standard-table">
                                                                            <tr>
                                                                                <td width="15%" class="p-0">
                                                                                    Pernah dioperasi :</td>
                                                                                <td class="d-flex p-0">
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;">
                                                                                        <input type="checkbox"  name="cRkuPernahDioperasiTidak">
                                                                                        Tidak
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;">
                                                                                        <input type="checkbox"  name="cRkuPernahDioperasiYa">
                                                                                        Ya
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;">
                                                                                        <span class="align-top">Jenis
                                                                                            Operasi</span>
                                                                                        <input type="text" value="" name="cRkuPernahDioperasiJenis">
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;">
                                                                                        <span
                                                                                            class="align-top">Kapan</span>
                                                                                        <input type="text" value="" name="cRkuPernahDioperasiKapan">
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </li>
                                                                    <li class="">
                                                                        <table class="w-100 standard-table">
                                                                            <tr>
                                                                                <td width="15%" class="p-0">
                                                                                    Masih dalam pengobatan :
                                                                                </td>
                                                                                <td class="d-flex p-0">
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;">
                                                                                        <input type="checkbox" name="cRkuMsdpoTidak" >
                                                                                        Tidak
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;">
                                                                                        <input type="checkbox" name="cRkuMsdpoYa" >
                                                                                        Ya
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;">
                                                                                        <span class="align-top">Obat
                                                                                        </span>
                                                                                        <input type="text" name="cRkuMsdpoObat" value="">
                                                                                    </div>

                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                            <li>b. Riwayat Penyakit Keluarga
                                                                <ul>
                                                                    <li class="null"><input type="checkbox" name="cRkuRpkTidak" >
                                                                        Tidak</li>
                                                                    <li class="null">
                                                                        <div class="d-flex align-top">
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px">
                                                                                <input type="checkbox" name="cRkuRpkYa" > <span
                                                                                    class="align-top"> Ya</span>
                                                                                &nbsp;&nbsp;:
                                                                            </div>
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px">
                                                                                <input type="checkbox" name="cRkuRpkHipertensi" > <span
                                                                                    class="align-top">
                                                                                    Hipertensi</span> &nbsp;:
                                                                            </div>
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px">
                                                                                <input type="checkbox" name="cRkuRpkJantung" > <span
                                                                                    class="align-top">
                                                                                    Jantung</span> &nbsp;:
                                                                            </div>
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px">
                                                                                <input type="checkbox" name="cRkuRpkDM" > <span
                                                                                    class="align-top"> DM</span>
                                                                                &nbsp;:
                                                                            </div>
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px">
                                                                                <input type="checkbox" name="cRkuRpkParu" > <span
                                                                                    class="align-top">
                                                                                    Paru</span> &nbsp;:
                                                                            </div>
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px">
                                                                                <input type="checkbox" name="cRkuRpkHepatitis" > <span
                                                                                    class="align-top">
                                                                                    Hepatitis</span> &nbsp;:
                                                                            </div>
                                                                            Lainnya&nbsp; <input type="text" name="cRkuRpkLainnya" value="">
                                                                        </div>
                                                                    </li>

                                                                </ul>
                                                            </li>
                                                            <li>c. Ketergantungan
                                                                <ul>
                                                                    <li class="null"><input type="checkbox" name="cRkuKetTidak" >
                                                                        Tidak</li>
                                                                    <li class="null">
                                                                        <div class="d-flex align-top">
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px">
                                                                                <input type="checkbox" name="cRkuKetYa" > <span
                                                                                    class="align-top"> Ya</span>
                                                                                &nbsp;&nbsp;:
                                                                            </div>
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px">
                                                                                <input type="checkbox" name="cRkuKetObat" > <span
                                                                                    class="align-top">
                                                                                    Obat-obatan</span> &nbsp;:
                                                                            </div>
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px">
                                                                                <input type="checkbox" name="cRkuKetAlkohol" > <span
                                                                                    class="align-top">
                                                                                    Alkohol</span> &nbsp;:
                                                                            </div>
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px">
                                                                                <input type="checkbox" name="cRkuKetRokok" > <span
                                                                                    class="align-top">
                                                                                    Rokok</span> &nbsp;:
                                                                            </div>
                                                                            Lainnya&nbsp; <input type="text" name="cRkuKetLainnya" value="">
                                                                        </div>
                                                                    </li>

                                                                </ul>
                                                            </li>
                                                            <li>
                                                                <div class="d-flex">
                                                                    d. Riwayat Alergi :
                                                                    <div style="margin-left:30px;">
                                                                        <input type="checkbox" name="cRkuRaTidak" > Tidak
                                                                    </div>
                                                                    <div style="margin-left:30px;">
                                                                        <input type="checkbox" name="cRkuRaYa" > Ya , sebutkan
                                                                    </div>
                                                                    <input style="margin-left:10px;" type="text" name="cRkuRaLainnya" value="">
                                                                </div>
                                                            </li>
                                                        </ul>

                                                    </div>

                                                </td>
                                            </tr>
                                        </table>

                                        <table class="detail-asesmen w-100 table-bordered">
                                            <tr>
                                                <td>
                                                    <div class="form-group row">
                                                        <div class="col-6">
                                                            <label for=""><strong> RIWAYAT PSIKOSOSIAL
                                                                </strong></label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="row">
                                                        <ul class="list-unstyled mb-0">
                                                            <li>1 . <strong> Status Psikologis</strong>
                                                                <ul>
                                                                    <li class="null">
                                                                        <div class="d-flex align-top">
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px">
                                                                                <input type="checkbox" name="cRpSpsiTenang" > <span
                                                                                    class="align-top">
                                                                                    Tenang</span> &nbsp;&nbsp;:
                                                                            </div>
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px">
                                                                                <input type="checkbox" name="cRpSpsiCemas" > <span
                                                                                    class="align-top" >
                                                                                    Cemas</span> &nbsp;:
                                                                            </div>
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px">
                                                                                <input type="checkbox" name="cRpSpsiTakut" > <span
                                                                                    class="align-top">
                                                                                    Takut</span> &nbsp;:
                                                                            </div>
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px">
                                                                                <input type="checkbox" name="cRpSpsiMarah" > <span
                                                                                    class="align-top" >
                                                                                    Marah</span> &nbsp;:
                                                                            </div>
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px">
                                                                                <input type="checkbox" name="cRpSpsiSedih" > <span
                                                                                    class="align-top" >
                                                                                    Sedih</span> &nbsp;:
                                                                            </div>
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px">
                                                                                <input type="checkbox" name="cRpSpsiBunuhDiri" > <span
                                                                                    class="align-top">
                                                                                    Kecenderungan Bunuh
                                                                                    Diri</span> &nbsp;:
                                                                            </div>
                                                                            lapor ke&nbsp; <input type="text" name="cRpSpsilaporKe" value="">
                                                                        </div>
                                                                    </li>
                                                                    <li class="null">
                                                                        <div class="d-flex align-top">
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px">
                                                                                <span class="align-top"> Lain
                                                                                    lain,sebutkan </span> &nbsp;
                                                                                <textarea cols="100" name="cRpSpsiLainnya"
                                                                                    rows="1"></textarea>:
                                                                            </div>
                                                                        </div>
                                                                    </li>


                                                                </ul>
                                                            </li>
                                                            <li>2 . <strong> Status Mental</strong>
                                                                <ul>
                                                                    <li class="null d-flex">
                                                                        <div class="m-r-1" style="margin-right:30px">
                                                                            <input type="checkbox" name="cRpSmenSadar"> <span
                                                                                class="align-top"> Sadar dan orientasi
                                                                                baik</span>
                                                                            &nbsp;&nbsp;
                                                                        </div>
                                                                        <div class="m-r-1" style="margin-right:30px">
                                                                            <input type="checkbox" name="cRpSmenMasalahPrilaku"> <span
                                                                                class="align-top"> Ada masalah prilaku,
                                                                                sebutkan</span>
                                                                            &nbsp;&nbsp; <input type="text" name="cRpSmenMasalahPrilakuSebutkan" value="">
                                                                        </div>

                                                                    </li>
                                                                    <li class="null d-flex">
                                                                        <div class="m-r-1" style="margin-right:30px">
                                                                            <input type="checkbox" name="cRpSmenPrilakuKekerasaSebelumnya"> <span
                                                                                class="align-top"> Prilaku kekerasan
                                                                                yang dialami pasien sebelumnya</span>
                                                                            &nbsp;&nbsp;<input type="text" name="cRpSmenPrilakuKekerasaSebelumnyaSebutkan" value="">
                                                                        </div>
                                                                        <div class="m-r-1" style="margin-right:30px">
                                                                            <input type="checkbox" name="cRpSmenTidakDinilai"> <span
                                                                                class="align-top"> Tidak dapat
                                                                                dinilai</span>
                                                                            &nbsp;&nbsp;
                                                                        </div>

                                                                    </li>

                                                                </ul>
                                                            </li>
                                                            <li>3 . <strong> Status Sosial</strong>
                                                                <ul>
                                                                    <li class="null d-flex">
                                                                        <div class="m-r-1" style="margin-right:30px">
                                                                            <span class="align-top">a. Hubungan pasien
                                                                                dengan anggota keluarga </span>
                                                                            &nbsp;&nbsp;
                                                                        </div>
                                                                        <div class="m-r-1" style="margin-right:30px">
                                                                            <input type="checkbox" name="cRpSsosHpdakBaik"> <span
                                                                                class="align-top"> Baik</span>
                                                                            &nbsp;&nbsp;
                                                                        </div>
                                                                        <div class="m-r-1" style="margin-right:30px">
                                                                            <input type="checkbox" name="cRpSsosHpdakTidakBaik"> <span
                                                                                class="align-top"> Tidak Baik</span>
                                                                            &nbsp;&nbsp;
                                                                        </div>

                                                                    </li>
                                                                    <li class="null d-flex">
                                                                        <div class="m-r-1" style="margin-right:30px">
                                                                            <span class="align-top">b. Kerabat terdekat
                                                                                yang dapat dihubungi </span>
                                                                            &nbsp;&nbsp;
                                                                        </div>

                                                                    </li>
                                                                    <li class="null d-flex">

                                                                        <div class="m-r-1" style="margin-right:30px">
                                                                            <span class="align-top"> Nama </span>
                                                                            &nbsp;&nbsp; <input type="text" name="cRpSsosKtyddNama">
                                                                        </div>
                                                                        <div class="m-r-1" style="margin-right:30px">
                                                                            <span class="align-top"> Hubungan </span>
                                                                            &nbsp;&nbsp; <input type="text" name="cRpSsosKtyddHubungan">
                                                                        </div>
                                                                        <div class="m-r-1" style="margin-right:30px">
                                                                            <span class="align-top"> Telepon </span>
                                                                            &nbsp;&nbsp; <input type="text" name="cRpSsosKtyddTelepon">
                                                                        </div>

                                                                    </li>


                                                                </ul>
                                                            </li>
                                                            <li>4 . <strong> Status Ekonomi</strong>
                                                                <ul>
                                                                    <li class="null">
                                                                        <div class="d-flex align-top">
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px;width:20%">
                                                                                <span class="align-top">
                                                                                    Pekerjaan </span> &nbsp;&nbsp;:
                                                                            </div>
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px;width:10%">
                                                                                <input type="checkbox" name="cRpSekoPNS"> <span
                                                                                    class="align-top">
                                                                                    PNS</span> &nbsp;
                                                                            </div>
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px;width:10%">
                                                                                <input type="checkbox" name="cRpSekoSwasta"> <span
                                                                                    class="align-top">
                                                                                    Swasta</span> &nbsp;
                                                                            </div>
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px;width:10%">
                                                                                <input type="checkbox" name="cRpSekoWiraswasta"> <span
                                                                                    class="align-top">
                                                                                    Wiraswasta</span> &nbsp;
                                                                            </div>
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px;width:10%">
                                                                                <input type="checkbox" name="cRpSekoPetani"> <span
                                                                                    class="align-top">
                                                                                    Petani</span> &nbsp;
                                                                            </div>
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px">
                                                                                <input type="checkbox" name="cRpSekoPekerjaanLainnya" > <span
                                                                                    class="align-top">
                                                                                    Lainnya</span> &nbsp;:
                                                                            </div>
                                                                            &nbsp; <input type="text" name="cRpSekoPekerjaanLainnyaText">
                                                                        </div>
                                                                    </li>

                                                                    <li class="null">
                                                                        <div class="d-flex align-top">
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px ;width:20%">
                                                                                <span class="align-top">
                                                                                    Jaminan Kesehatan </span>
                                                                                &nbsp;&nbsp;:
                                                                            </div>
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px;width:10%">
                                                                                <input type="checkbox" name="cRpSekoJKN"> <span
                                                                                    class="align-top">
                                                                                    JKN</span> &nbsp;
                                                                            </div>
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px;width:10%;width:10%">
                                                                                <input type="checkbox" name="cRpSekoJamkesda"> <span
                                                                                    class="align-top">
                                                                                    Jamkesda</span> &nbsp;
                                                                            </div>
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px;width:10%">
                                                                                <input type="checkbox" name="cRpSekoAsuransi"> <span
                                                                                    class="align-top">
                                                                                    Asuransi</span> &nbsp;
                                                                            </div>
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px;width:10%">
                                                                                <input type="checkbox" name="cRpSekoPribadi"> <span
                                                                                    class="align-top">
                                                                                    Pribadi</span> &nbsp;
                                                                            </div>
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px">
                                                                                <input type="checkbox" name="cRpSekoAsuransiLainnya"> <span
                                                                                    class="align-top">
                                                                                    Lainnya</span> &nbsp;:
                                                                            </div>
                                                                            &nbsp; <input type="text" name="cRpSekoAsuransiLainnyaText">
                                                                        </div>
                                                                    </li>



                                                                </ul>
                                                            </li>
                                                            <li>5. <strong> Agama</strong>
                                                                <ul>
                                                                    <li class="null">
                                                                        <div class="d-flex align-top">

                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px;width:10%">
                                                                                <input type="checkbox" name="cRpAgamaIslam"> <span
                                                                                    class="align-top">
                                                                                    Islam</span> &nbsp;
                                                                            </div>
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px;width:10%">
                                                                                <input type="checkbox" name="cRpAgamaKristen"> <span
                                                                                    class="align-top">
                                                                                    Kristen</span> &nbsp;
                                                                            </div>
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px;width:10%">
                                                                                <input type="checkbox" name="cRpAgamaKatolik"> <span
                                                                                    class="align-top">
                                                                                    Katolik</span> &nbsp;
                                                                            </div>
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px;width:10%">
                                                                                <input type="checkbox" name="cRpAgamaHindu"> <span
                                                                                    class="align-top">
                                                                                    Hindu</span> &nbsp;
                                                                            </div>
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px;width:10%">
                                                                                <input type="checkbox" name="cRpAgamaBudha"> <span
                                                                                    class="align-top">
                                                                                    Budha</span> &nbsp;
                                                                            </div>
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px">
                                                                                <input type="checkbox" name="cRpAgamaKepercayaanLain"> <span
                                                                                    class="align-top">
                                                                                    Kepercayaan lain</span> &nbsp;:
                                                                            </div>
                                                                            &nbsp; <input type="text" name="cRpAgamaKepercayaanLainText">
                                                                        </div>
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
                                                <td colspan="2">
                                                    <div class="form-group row">
                                                        <div class="col-6">
                                                            <label for=""><strong> SKALA NYERI
                                                                </strong></label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="40%">
                                                    <img src="{{asset('assets/images/nyeri.png')}}" alt="">
                                                </td>
                                                <td width="60%" rowspan="2">
                                                    <ul class="list-unstyled mb-0">
                                                        <li class="d-flex">
                                                            Apakah ada nyeri
                                                            <div class="m-r-1"
                                                                style="margin-left:30px;margin-right:30px">
                                                                <input type="checkbox" name="cSnNyeriTidak"> <span class="align-top">
                                                                    Tidak</span>
                                                                &nbsp;&nbsp;
                                                            </div>
                                                            <div class="m-r-1" style="margin-right:30px">
                                                                <input type="checkbox" name="cSnNyeriYa"> <span class="align-top">
                                                                    Ya</span>
                                                                &nbsp;&nbsp;
                                                            </div>
                                                        </li>
                                                        <li class="d-flex">
                                                            <div class="m-r-1" style="margin-right:30px">
                                                                <span class="align-top"> Skala nyeri</span>
                                                                <input type="text" name="cSnText">
                                                                &nbsp;&nbsp;
                                                            </div>
                                                            <div class="m-r-1"
                                                                style="margin-left:30px;margin-right:30px">
                                                                <span class="align-top"> Lokasi</span>
                                                                <input type="text" name="cSnLokasi">
                                                                &nbsp;&nbsp;
                                                            </div>
                                                        </li>
                                                        <li class="null">
                                                            <div class="d-flex">
                                                                <div class="m-r-1" style="margin-right:30px;width:35%">
                                                                    <span class="align-top"> Durasi</span> &nbsp;&nbsp;
                                                                    <input type="text" name="cSnDurasi">
                                                                    &nbsp;&nbsp;
                                                                </div>
                                                                <div class="m-r-1"
                                                                    style="margin-left:30px;margin-right:30px;">
                                                                    <span class="align-top"> Frekuensi</span>
                                                                    <input type="text" name="cSnFrekuensi">
                                                                    &nbsp;&nbsp;
                                                                </div>
                                                            </div>

                                                        </li>
                                                        <li class="d-flex" style="margin-top: 10px;">
                                                            Nyeri hilang ,bila :
                                                        </li>
                                                        <li class="d-flex">
                                                            <div class="m-r-1" style="margin-right:30px;width:25%">
                                                                <input type="checkbox" name="cSnNhbMinumObat">
                                                                <span class="align-top"> Minum Obat</span>
                                                                &nbsp;&nbsp;
                                                            </div>
                                                            <div class="m-r-1" style="margin-right:30px;width:30%">
                                                                <input type="checkbox" name="cSnNhbMendengarkanMusik">
                                                                <span class="align-top" > Mendengarkan Musik</span>
                                                                &nbsp;&nbsp;
                                                            </div>

                                                        </li>
                                                        <li class="d-flex">
                                                            <div class="m-r-1" style="margin-right:30px;width:25%">
                                                                <input type="checkbox" name="cSnNhbIstirahat">
                                                                <span class="align-top"> Istirahat</span>
                                                                &nbsp;&nbsp;
                                                            </div>
                                                            <div class="m-r-1" style="margin-right:30px;width:25%">
                                                                <input type="checkbox" name="cSnNhbBerubahPosisiTidur">
                                                                <span class="align-top"> Berubah Posisi/ Tidur </span>
                                                                &nbsp;&nbsp;
                                                            </div>

                                                        </li>
                                                        <li class="d-flex">
                                                            <div class="m-r-1" style="margin-right:30px">
                                                                <input type="checkbox" name="cSnNhbLainnya">
                                                                <span class="align-top"> Lain-lain</span>
                                                                <input type="text" name="cSnNhbLainnyaText">
                                                                &nbsp;&nbsp;
                                                            </div>
                                                        </li>

                                                        <li class="d-flex" style="margin-top: 10px;">
                                                            Diberitahukan ke dokter :
                                                        </li>
                                                        <li class="d-flex">
                                                            <div class="m-r-1" style="margin-right:30px;width:50%">
                                                                <input type="checkbox" name="cSnDkdYa">
                                                                <span class="align-top"> Ya, pukul </span>
                                                                <input type="text" name="cSnDkdPukul">
                                                                &nbsp;&nbsp;
                                                            </div>
                                                            <div class="m-r-1" style="margin-right:30px;width:50%">
                                                                <input type="checkbox" name="cSnDkdTidak">
                                                                <span class="align-top"> Tidak</span>
                                                                &nbsp;&nbsp;
                                                            </div>

                                                        </li>

                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                     <ul class="list-unstyled mb-0">
                                                        <li class="d-flex">
                                                            <div class="m-r-1"
                                                                style="margin-right:30px;width:30%">
                                                                <input type="checkbox" name="cSnRate0"> <span class="align-top">
                                                                    0</span>
                                                                &nbsp;&nbsp;
                                                            </div>
                                                            <div class="m-r-1" style="margin-right:30px;width:50%">
                                                                <span class="align-top">Tidak merasa nyeri sama sekali</span>
                                                            </div>
                                                        </li>


                                                        <li class="d-flex">
                                                            <div class="m-r-1"
                                                                style="margin-right:30px;width:30%">
                                                                <input type="checkbox" name="cSnRate1"> <span class="align-top">
                                                                    1-3</span>
                                                                &nbsp;&nbsp;
                                                            </div>
                                                            <div class="m-r-1" style="margin-right:30px;width:50%">
                                                                <span class="align-top">Nyeri Ringan</span>
                                                                &nbsp;&nbsp;
                                                            </div>
                                                        </li>


                                                        <li class="d-flex">
                                                            <div class="m-r-1"
                                                                style="margin-right:30px;width:30%">
                                                                <input type="checkbox" name="cSnRate2"> <span class="align-top">
                                                                    4-6</span>
                                                                &nbsp;&nbsp;
                                                            </div>
                                                            <div class="m-r-1" style="margin-right:30px;width:50%">
                                                                <span class="align-top">Nyeri Sedang</span>
                                                                &nbsp;&nbsp;
                                                            </div>
                                                        </li>
                                                        <li class="d-flex">
                                                            <div class="m-r-1"
                                                                style="margin-right:30px;width:30%">
                                                                <input type="checkbox" name="cSnRate3"> <span class="align-top">
                                                                    7-9</span>
                                                                &nbsp;&nbsp;
                                                            </div>
                                                            <div class="m-r-1" style="margin-right:20px;width:50%">
                                                                <span class="align-top">Nyeri Berat</span>
                                                                &nbsp;&nbsp;
                                                            </div>
                                                        </li>
                                                         <li class="d-flex">
                                                            <div class="m-r-1"
                                                                style="margin-right:30px;width:30%">
                                                                <input type="checkbox" name="cSnRate4"> <span class="align-top">
                                                                    10</span>
                                                                &nbsp;&nbsp;
                                                            </div>
                                                            <div class="m-r-1" style="margin-right:30px;width:50%">
                                                                <span class="align-top">Nyeri amat sangat Berat</span>
                                                                &nbsp;&nbsp;
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>

                                        </table>


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
<script>
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
