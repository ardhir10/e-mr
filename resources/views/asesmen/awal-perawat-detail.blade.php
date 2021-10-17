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
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">{{$page_title}} ({{$type}})</h5>
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
                                                    <option {{ $data_asesmen->FS_PROFESI == 'Dokter' ? 'selected=selected' :'' }}
                                                        value="Dokter">Dokter</option>
                                                    <option {{ $data_asesmen->FS_PROFESI == 'Perawat' ? 'selected=selected' :'' }}
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
                                                        {{$data_asesmen->FS_KD_LAYANAN == $lb->FS_KD_LAYANAN ? 'selected=selected' :'' }}
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
                                                                rows="2">{{$data_asesmen->FS_ALASAN_KUNJUNGAN}}</textarea>
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
                                                                    <input type="number" step="0.1" name="cTd" value="{{$data_asesmen->FN_PF_TD}}" class="form-control form-control-sm">
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
                                                                    <input type="number" step="0.1" name="cTb" value="{{$data_asesmen->FN_PF_TB}}"
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
                                                                    <input type="number" step="0.1" name="cNadi" value="{{$data_asesmen->FN_PF_NADI}}"
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
                                                                    <input type="number" step="0.1" name="cBb" value="{{$data_asesmen->FN_PF_BB}}"
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
                                                                    <input type="number" step="0.1" name="cRespirasi" value="{{$data_asesmen->FN_PF_RESPIRASI}}"
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
                                                                    <input type="number" step="0.1" name="cSuhu"  value="{{$data_asesmen->FN_PF_SUHU}}"
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
                                                            <li>a. Riwayat Penyakit Dahulu                                                                 <ul>
                                                                    <li class="">
                                                                        <table class="w-100 ">
                                                                            <tr>
                                                                                <td width="15%" class="p-0">
                                                                                    Pernah dirawat : </td>
                                                                                <td class="d-flex p-0">
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;">
                                                                                        <input type="checkbox"
                                                                                            {{$data_asesmen->FJ_RKU_RPD_PDRWT['Tidak'] == 'on' ? 'checked':''}}
                                                                                            name="cRkuPernahDirawatTidak">
                                                                                        Tidak
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;">
                                                                                        <input type="checkbox"
                                                                                        {{$data_asesmen->FJ_RKU_RPD_PDRWT['Ya'] == 'on' ? 'checked':''}}
                                                                                            name="cRkuPernahDirawatYa">
                                                                                        Ya
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;">
                                                                                        <span
                                                                                            class="align-top">Diagnosa</span>
                                                                                        <input type="text" name="cRkuPernahDirawatDiagnosa" value="{{$data_asesmen->FJ_RKU_RPD_PDRWT['Diagnosa']}}">
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;">
                                                                                        <span
                                                                                            class="align-top">Kapan</span>
                                                                                        <input type="text" name="cRkuPernahDirawatKapan" value="{{$data_asesmen->FJ_RKU_RPD_PDRWT['Kapan']}}">
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
                                                                                        <input type="checkbox"
                                                                                        {{$data_asesmen->FJ_RKU_RPD_PDOPR['Tidak'] == 'on' ?'checked':''}}
                                                                                        name="cRkuPernahDioperasiTidak">
                                                                                        Tidak
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;">
                                                                                        <input type="checkbox"
                                                                                        {{$data_asesmen->FJ_RKU_RPD_PDOPR['Ya'] == 'on' ?'checked':''}}
                                                                                        name="cRkuPernahDioperasiYa">
                                                                                        Ya
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;">
                                                                                        <span class="align-top">Jenis
                                                                                            Operasi</span>
                                                                                        <input type="text" value="{{$data_asesmen->FJ_RKU_RPD_PDOPR['Diagnosa']}}" name="cRkuPernahDioperasiJenis">
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;">
                                                                                        <span
                                                                                            class="align-top">Kapan</span>
                                                                                        <input type="text" value="{{$data_asesmen->FJ_RKU_RPD_PDOPR['Kapan']}}" name="cRkuPernahDioperasiKapan">
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
                                                                                        <input type="checkbox"
                                                                                        {{$data_asesmen->FJ_RKU_RPD_MSDPO['Tidak'] == 'on' ?'checked':''}}
                                                                                         name="cRkuMsdpoTidak" >
                                                                                        Tidak
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;">
                                                                                        <input type="checkbox"
                                                                                        {{$data_asesmen->FJ_RKU_RPD_MSDPO['Ya'] == 'on' ?'checked':''}}
                                                                                        name="cRkuMsdpoYa" >
                                                                                        Ya
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;">
                                                                                        <span class="align-top">Obat
                                                                                        </span>
                                                                                        <input type="text" name="cRkuMsdpoObat" value="{{$data_asesmen->FJ_RKU_RPD_MSDPO['Obat']}}">
                                                                                    </div>

                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                            <li>b. Riwayat Penyakit Keluarga
                                                                <ul>
                                                                    <li class="null"><input
                                                                        {{$data_asesmen->FJ_RPK['Tidak'] == 'on' ?'checked':''}}
                                                                        type="checkbox" name="cRkuRpkTidak" >
                                                                        Tidak</li>
                                                                    <li class="null">
                                                                        <div class="d-flex align-top">
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px">
                                                                                <input type="checkbox"
                                                                                {{$data_asesmen->FJ_RPK['Ya'] == 'on' ?'checked':''}}

                                                                                name="cRkuRpkYa" > <span
                                                                                    class="align-top"> Ya</span>
                                                                                &nbsp;&nbsp;:
                                                                            </div>
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px">
                                                                                <input type="checkbox"
                                                                                {{$data_asesmen->FJ_RPK['Hipertensi'] == 'on' ?'checked':''}}

                                                                                name="cRkuRpkHipertensi" > <span
                                                                                    class="align-top">
                                                                                    Hipertensi</span> &nbsp;:
                                                                            </div>
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px">
                                                                                <input type="checkbox"
                                                                                {{$data_asesmen->FJ_RPK['Jantung'] == 'on' ?'checked':''}}

                                                                                name="cRkuRpkJantung" > <span
                                                                                    class="align-top">
                                                                                    Jantung</span> &nbsp;:
                                                                            </div>
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px">
                                                                                <input type="checkbox"
                                                                                {{$data_asesmen->FJ_RPK['DM'] == 'on' ?'checked':''}}

                                                                                name="cRkuRpkDM" > <span
                                                                                    class="align-top"> DM</span>
                                                                                &nbsp;:
                                                                            </div>
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px">
                                                                                <input type="checkbox"
                                                                                {{$data_asesmen->FJ_RPK['Paru'] == 'on' ?'checked':''}}

                                                                                name="cRkuRpkParu" > <span
                                                                                    class="align-top">
                                                                                    Paru</span> &nbsp;:
                                                                            </div>
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px">
                                                                                <input type="checkbox"
                                                                                {{$data_asesmen->FJ_RPK['Hepatitis'] == 'on' ?'checked':''}}

                                                                                name="cRkuRpkHepatitis" > <span
                                                                                    class="align-top">
                                                                                    Hepatitis</span> &nbsp;:
                                                                            </div>
                                                                            Lainnya&nbsp; <input type="text" name="cRkuRpkLainnya" value="{{$data_asesmen->FJ_RPK['Lainnya']}}
">
                                                                        </div>
                                                                    </li>

                                                                </ul>
                                                            </li>
                                                            <li>c. Ketergantungan
                                                                <ul>
                                                                    <li class="null"><input type="checkbox" {{$data_asesmen->FJ_KETERGANTUNGAN['Tidak'] == 'on' ?'checked':''}} name="cRkuKetTidak" >
                                                                        Tidak</li>
                                                                    <li class="null">
                                                                        <div class="d-flex align-top">
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px">
                                                                                <input type="checkbox" {{$data_asesmen->FJ_KETERGANTUNGAN['Ya'] == 'on' ?'checked':''}} name="cRkuKetYa" > <span
                                                                                    class="align-top"> Ya</span>
                                                                                &nbsp;&nbsp;:
                                                                            </div>
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px">
                                                                                <input type="checkbox" {{$data_asesmen->FJ_KETERGANTUNGAN['Obat'] == 'on' ?'checked':''}} name="cRkuKetObat" > <span
                                                                                    class="align-top">
                                                                                    Obat-obatan</span> &nbsp;:
                                                                            </div>
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px">
                                                                                <input type="checkbox" {{$data_asesmen->FJ_KETERGANTUNGAN['Alkohol'] == 'on' ?'checked':''}} name="cRkuKetAlkohol" > <span
                                                                                    class="align-top">
                                                                                    Alkohol</span> &nbsp;:
                                                                            </div>
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px">
                                                                                <input type="checkbox" {{$data_asesmen->FJ_KETERGANTUNGAN['Rokok'] == 'on' ?'checked':''}} name="cRkuKetRokok" > <span
                                                                                    class="align-top">
                                                                                    Rokok</span> &nbsp;:
                                                                            </div>
                                                                            Lainnya&nbsp; <input type="text" name="cRkuKetLainnya" value="{{$data_asesmen->FJ_KETERGANTUNGAN['Lainnya']}}">
                                                                        </div>
                                                                    </li>

                                                                </ul>
                                                            </li>
                                                            <li>
                                                                <div class="d-flex">
                                                                    d. Riwayat Alergi :
                                                                    <div style="margin-left:30px;">
                                                                        <input type="checkbox" {{$data_asesmen->FJ_RIWAYAT_ALERGI['Tidak'] == 'on' ?'checked':''}} name="cRkuRaTidak" > Tidak
                                                                    </div>
                                                                    <div style="margin-left:30px;">
                                                                        <input type="checkbox" {{$data_asesmen->FJ_RIWAYAT_ALERGI['Ya'] == 'on' ?'checked':''}} name="cRkuRaYa" > Ya , sebutkan
                                                                    </div>
                                                                    <input style="margin-left:10px;" type="text" name="cRkuRaLainnya" value="{{$data_asesmen->FJ_RIWAYAT_ALERGI['Lainnya']}}">
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
                                                                                <input type="checkbox" {{$data_asesmen->FJ_RP_SPSI['Tenang'] == 'on' ?'checked':''}} name="cRpSpsiTenang" > <span
                                                                                    class="align-top">
                                                                                    Tenang</span> &nbsp;&nbsp;:
                                                                            </div>
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px">
                                                                                <input type="checkbox" {{$data_asesmen->FJ_RP_SPSI['Cemas'] == 'on' ?'checked':''}} name="cRpSpsiCemas" > <span
                                                                                    class="align-top" >
                                                                                    Cemas</span> &nbsp;:
                                                                            </div>
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px">
                                                                                <input type="checkbox" {{$data_asesmen->FJ_RP_SPSI['Takut'] == 'on' ?'checked':''}} name="cRpSpsiTakut" > <span
                                                                                    class="align-top">
                                                                                    Takut</span> &nbsp;:
                                                                            </div>
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px">
                                                                                <input type="checkbox" {{$data_asesmen->FJ_RP_SPSI['Marah'] == 'on' ?'checked':''}} name="cRpSpsiMarah" > <span
                                                                                    class="align-top" >
                                                                                    Marah</span> &nbsp;:
                                                                            </div>
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px">
                                                                                <input type="checkbox" {{$data_asesmen->FJ_RP_SPSI['Sedih'] == 'on' ?'checked':''}} name="cRpSpsiSedih" > <span
                                                                                    class="align-top" >
                                                                                    Sedih</span> &nbsp;:
                                                                            </div>
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px">
                                                                                <input type="checkbox" {{$data_asesmen->FJ_RP_SPSI['BunuhDiri'] == 'on' ?'checked':''}} name="cRpSpsiBunuhDiri" > <span
                                                                                    class="align-top">
                                                                                    Kecenderungan Bunuh
                                                                                    Diri</span> &nbsp;:
                                                                            </div>
                                                                            lapor ke&nbsp; <input type="text" name="cRpSpsilaporKe" value="{{$data_asesmen->FJ_RP_SPSI['laporKe']}}">
                                                                        </div>
                                                                    </li>
                                                                    <li class="null">
                                                                        <div class="d-flex align-top">
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px">
                                                                                <span class="align-top"> Lain
                                                                                    lain,sebutkan </span> &nbsp;
                                                                                <textarea cols="100" name="cRpSpsiLainnya"
                                                                                    rows="1">{{$data_asesmen->FJ_RP_SPSI['lainnya']}}</textarea>:
                                                                            </div>
                                                                        </div>
                                                                    </li>


                                                                </ul>
                                                            </li>
                                                            <li>2 . <strong> Status Mental</strong>
                                                                <ul>
                                                                    <li class="null d-flex">
                                                                        <div class="m-r-1" style="margin-right:30px">
                                                                            <input type="checkbox" {{$data_asesmen->FJ_RP_SMEN['Sadar'] == 'on' ?'checked':''}} name="cRpSmenSadar"> <span
                                                                                class="align-top"> Sadar dan orientasi
                                                                                baik</span>
                                                                            &nbsp;&nbsp;
                                                                        </div>
                                                                        <div class="m-r-1" style="margin-right:30px">
                                                                            <input type="checkbox" {{$data_asesmen->FJ_RP_SMEN['MasalahPrilaku'] == 'on' ?'checked':''}} name="cRpSmenMasalahPrilaku"> <span
                                                                                class="align-top"> Ada masalah prilaku,
                                                                                sebutkan</span>
                                                                            &nbsp;&nbsp; <input type="text" name="cRpSmenMasalahPrilakuSebutkan" value="{{$data_asesmen->FJ_RP_SMEN['MasalahPrilakuSebutkan']}}">
                                                                        </div>

                                                                    </li>
                                                                    <li class="null d-flex">
                                                                        <div class="m-r-1" style="margin-right:30px">
                                                                            <input type="checkbox" {{$data_asesmen->FJ_RP_SMEN['PrilakuKekerasaSebelumnya'] == 'on' ?'checked':''}} name="cRpSmenPrilakuKekerasaSebelumnya"> <span
                                                                                class="align-top"> Prilaku kekerasan
                                                                                yang dialami pasien sebelumnya</span>
                                                                            &nbsp;&nbsp;<input type="text" name="cRpSmenPrilakuKekerasaSebelumnyaSebutkan" value="{{$data_asesmen->FJ_RP_SMEN['PrilakuKekerasaSebelumnyaSebutkan']}}">
                                                                        </div>
                                                                        <div class="m-r-1" style="margin-right:30px">
                                                                            <input type="checkbox" {{$data_asesmen->FJ_RP_SMEN['TidakDinilai'] == 'on' ?'checked':''}} name="cRpSmenTidakDinilai"> <span
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
                                                                            <input type="checkbox" {{$data_asesmen->FJ_RP_SSOS_HPDAK['Baik'] == 'on' ?'checked':''}} name="cRpSsosHpdakBaik"> <span
                                                                                class="align-top"> Baik</span>
                                                                            &nbsp;&nbsp;
                                                                        </div>
                                                                        <div class="m-r-1" style="margin-right:30px">
                                                                            <input type="checkbox" {{$data_asesmen->FJ_RP_SSOS_HPDAK['TidakBaik'] == 'on' ?'checked':''}} name="cRpSsosHpdakTidakBaik"> <span
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
                                                                            &nbsp;&nbsp; <input type="text" name="cRpSsosKtyddNama" value="{{$data_asesmen->FJ_RP_SSOS_KTYDD['Nama']}}">
                                                                        </div>
                                                                        <div class="m-r-1" style="margin-right:30px">
                                                                            <span class="align-top"> Hubungan </span>
                                                                            &nbsp;&nbsp; <input type="text" name="cRpSsosKtyddHubungan" value="{{$data_asesmen->FJ_RP_SSOS_KTYDD['Hubungan']}}">
                                                                        </div>
                                                                        <div class="m-r-1" style="margin-right:30px">
                                                                            <span class="align-top"> Telepon </span>
                                                                            &nbsp;&nbsp; <input type="text" name="cRpSsosKtyddTelepon" value="{{$data_asesmen->FJ_RP_SSOS_KTYDD['Telepon']}}">
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
                                                                                <input type="checkbox" {{$data_asesmen->FJ_RP_SEKO['PNS'] == 'on' ?'checked':''}}  name="cRpSekoPNS"> <span
                                                                                    class="align-top">
                                                                                    PNS</span> &nbsp;
                                                                            </div>
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px;width:10%">
                                                                                <input type="checkbox" {{$data_asesmen->FJ_RP_SEKO['Swasta'] == 'on' ?'checked':''}} name="cRpSekoSwasta"> <span
                                                                                    class="align-top">
                                                                                    Swsasta</span> &nbsp;
                                                                            </div>
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px;width:10%">
                                                                                <input type="checkbox" {{$data_asesmen->FJ_RP_SEKO['Wiraswasta'] == 'on' ?'checked':''}}  name="cRpSekoWiraswasta"> <span
                                                                                    class="align-top">
                                                                                    Wiraswasta</span> &nbsp;
                                                                            </div>
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px;width:10%">
                                                                                <input type="checkbox" {{$data_asesmen->FJ_RP_SEKO['Petani'] == 'on' ?'checked':''}}  name="cRpSekoPetani"> <span
                                                                                    class="align-top">
                                                                                    Petani</span> &nbsp;
                                                                            </div>
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px">
                                                                                <input type="checkbox" {{$data_asesmen->FJ_RP_SEKO['PekerjaanLainnya'] == 'on' ?'checked':''}}  name="cRpSekoPekerjaanLainnya" > <span
                                                                                    class="align-top">
                                                                                    Lainnya</span> &nbsp;:
                                                                            </div>
                                                                            &nbsp; <input type="text" name="cRpSekoPekerjaanLainnyaText" value="{{$data_asesmen->FJ_RP_SEKO['PekerjaanLainnyaText']}}">
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
                                                                                <input type="checkbox" {{$data_asesmen->FJ_RP_SEKO['JKN'] == 'on' ?'checked':''}}  name="cRpSekoJKN"> <span
                                                                                    class="align-top">
                                                                                    JKN</span> &nbsp;
                                                                            </div>
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px;width:10%;width:10%">
                                                                                <input type="checkbox" {{$data_asesmen->FJ_RP_SEKO['Jamkesda'] == 'on' ?'checked':''}} name="cRpSekoJamkesda"> <span
                                                                                    class="align-top">
                                                                                    Jamkesda</span> &nbsp;
                                                                            </div>
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px;width:10%">
                                                                                <input type="checkbox" {{$data_asesmen->FJ_RP_SEKO['Asuransi'] == 'on' ?'checked':''}}  name="cRpSekoAsuransi"> <span
                                                                                    class="align-top">
                                                                                    Asuransi</span> &nbsp;
                                                                            </div>
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px;width:10%">
                                                                                <input type="checkbox" {{$data_asesmen->FJ_RP_SEKO['Pribadi'] == 'on' ?'checked':''}} name="cRpSekoPribadi"> <span
                                                                                    class="align-top">
                                                                                    Pribadi</span> &nbsp;
                                                                            </div>
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px">
                                                                                <input type="checkbox" {{$data_asesmen->FJ_RP_SEKO['AsuransiLainnya'] == 'on' ?'checked':''}}  name="cRpSekoAsuransiLainnya"> <span
                                                                                    class="align-top">
                                                                                    Lainnya</span> &nbsp;:
                                                                            </div>
                                                                            &nbsp; <input type="text" value="{{$data_asesmen->FJ_RP_SEKO['AsuransiLainnyaText']}} " name="cRpSekoAsuransiLainnyaText">
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
                                                                                <input type="checkbox" {{$data_asesmen->FJ_RP_AGAMA['Islam'] == 'on' ?'checked':''}} name="cRpAgamaIslam"> <span
                                                                                    class="align-top">
                                                                                    Islam</span> &nbsp;
                                                                            </div>
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px;width:10%">
                                                                                <input type="checkbox" {{$data_asesmen->FJ_RP_AGAMA['Kristen'] == 'on' ?'checked':''}} name="cRpAgamaKristen"> <span
                                                                                    class="align-top">
                                                                                    Kristen</span> &nbsp;
                                                                            </div>
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px;width:10%">
                                                                                <input type="checkbox" {{$data_asesmen->FJ_RP_AGAMA['Katolik'] == 'on' ?'checked':''}} name="cRpAgamaKatolik"> <span
                                                                                    class="align-top">
                                                                                    Katolik</span> &nbsp;
                                                                            </div>
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px;width:10%">
                                                                                <input type="checkbox" {{$data_asesmen->FJ_RP_AGAMA['Hindu'] == 'on' ?'checked':''}} name="cRpAgamaHindu"> <span
                                                                                    class="align-top">
                                                                                    Hindu</span> &nbsp;
                                                                            </div>
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px;width:10%">
                                                                                <input type="checkbox" {{$data_asesmen->FJ_RP_AGAMA['Budha'] == 'on' ?'checked':''}} name="cRpAgamaBudha"> <span
                                                                                    class="align-top">
                                                                                    Budha</span> &nbsp;
                                                                            </div>
                                                                            <div class="m-r-1"
                                                                                style="margin-right:30px">
                                                                                <input type="checkbox" {{$data_asesmen->FJ_RP_AGAMA['KepercayaanLain'] == 'on' ?'checked':''}} name="cRpAgamaKepercayaanLain"> <span
                                                                                    class="align-top">
                                                                                    Kepercayaan lain</span> &nbsp;:
                                                                            </div>
                                                                            &nbsp; <input type="text" name="cRpAgamaKepercayaanLainText" value="{{$data_asesmen->FJ_RP_AGAMA['KepercayaanLainText']}} ">
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
                                                                <input type="checkbox"> <span class="align-top">
                                                                    Tidak</span>
                                                                &nbsp;&nbsp;
                                                            </div>
                                                            <div class="m-r-1" style="margin-right:30px">
                                                                <input type="checkbox"> <span class="align-top">
                                                                    Ya</span>
                                                                &nbsp;&nbsp;
                                                            </div>
                                                        </li>
                                                        <li class="d-flex">
                                                            <div class="m-r-1" style="margin-right:30px">
                                                                <span class="align-top"> Skala nyeri</span>
                                                                <input type="text">
                                                                &nbsp;&nbsp;
                                                            </div>
                                                            <div class="m-r-1"
                                                                style="margin-left:30px;margin-right:30px">
                                                                <span class="align-top"> Lokasi</span>
                                                                <input type="text">
                                                                &nbsp;&nbsp;
                                                            </div>
                                                        </li>
                                                        <li class="null">
                                                            <div class="d-flex">
                                                                <div class="m-r-1" style="margin-right:30px;width:35%">
                                                                    <span class="align-top"> Durasi</span> &nbsp;&nbsp;
                                                                    <input type="text">
                                                                    &nbsp;&nbsp;
                                                                </div>
                                                                <div class="m-r-1"
                                                                    style="margin-left:30px;margin-right:30px;">
                                                                    <span class="align-top"> Frekuensi</span>
                                                                    <input type="text">
                                                                    &nbsp;&nbsp;
                                                                </div>
                                                            </div>

                                                        </li>
                                                        <li class="d-flex" style="margin-top: 10px;">
                                                            Nyeri hilang ,bila :
                                                        </li>
                                                        <li class="d-flex">
                                                            <div class="m-r-1" style="margin-right:30px;width:25%">
                                                                <input type="checkbox">
                                                                <span class="align-top"> Minum Obat</span>
                                                                &nbsp;&nbsp;
                                                            </div>
                                                            <div class="m-r-1" style="margin-right:30px;width:25%">
                                                                <input type="checkbox">
                                                                <span class="align-top"> Mendengarkan Musik</span>
                                                                &nbsp;&nbsp;
                                                            </div>

                                                        </li>
                                                        <li class="d-flex">
                                                            <div class="m-r-1" style="margin-right:30px;width:25%">
                                                                <input type="checkbox">
                                                                <span class="align-top"> Istirahat</span>
                                                                &nbsp;&nbsp;
                                                            </div>
                                                            <div class="m-r-1" style="margin-right:30px;width:25%">
                                                                <input type="checkbox">
                                                                <span class="align-top"> Berubah Posisi/ Tidur </span>
                                                                &nbsp;&nbsp;
                                                            </div>

                                                        </li>
                                                        <li class="d-flex">
                                                            <div class="m-r-1" style="margin-right:30px">
                                                                <input type="checkbox">
                                                                <span class="align-top"> Lain-lain</span>
                                                                <input type="text">
                                                                &nbsp;&nbsp;
                                                            </div>
                                                        </li>

                                                        <li class="d-flex" style="margin-top: 10px;">
                                                            Diberitahukan ke dokter :
                                                        </li>
                                                        <li class="d-flex">
                                                            <div class="m-r-1" style="margin-right:30px;width:50%">
                                                                <input type="checkbox">
                                                                <span class="align-top"> Ya, pukul </span>
                                                                <input type="text">
                                                                &nbsp;&nbsp;
                                                            </div>
                                                            <div class="m-r-1" style="margin-right:30px;width:50%">
                                                                <input type="checkbox">
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
                                                                <input type="checkbox"> <span class="align-top">
                                                                    0</span>
                                                                &nbsp;&nbsp;
                                                            </div>
                                                            <div class="m-r-1" style="margin-right:30px;width:50%">
                                                                <span class="align-top">Tidak merasa nyeri sama sekali</span>
                                                                &nbsp;&nbsp;
                                                            </div>
                                                        </li>


                                                        <li class="d-flex">
                                                            <div class="m-r-1"
                                                                style="margin-right:30px;width:30%">
                                                                <input type="checkbox"> <span class="align-top">
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
                                                                <input type="checkbox"> <span class="align-top">
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
                                                                <input type="checkbox"> <span class="align-top">
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
                                                                <input type="checkbox"> <span class="align-top">
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
                                {{-- <button type="submit" class="btn btn-success">
                                    <i class="fa fa-save"></i>
                                    SAVE
                                </button> --}}

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
