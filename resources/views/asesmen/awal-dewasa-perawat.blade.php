@extends('main')

@push('styles')
<style>
    .detail-asesmen ,td{
        padding: 8px;
    }



    .detail-asesmen  {
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
                        <h5 class="card-title">{{$page_title}}</h5>
                    </div>
                    <form action="{{route('cppt.store',$rekam_medis->FS_MR)}}" method="POST">
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
                                    <table class="w-100">
                                        <tr>
                                            <td class="leftCol">
                                                <label for="">Register</label>
                                                <span style="float:right;" class="float-right">:&nbsp;</span>
                                            </td>
                                            <td class="rightCol">
                                                <input type="text" class="form-control form-control-sm"
                                                    value="{{$rekam_medis->FS_KD_REG}}" readonly>
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
                                                <select class="form-select form-select-sm" id="" name="cProfesi">
                                                    <option value="">-- Pilih Profesi</option>
                                                    <option {{ old('cProfesi') == 'Dokter' ? 'selected=selected' :'' }}
                                                        value="Dokter">Dokter</option>
                                                    <option {{ old('cProfesi') == 'Perawat' ? 'selected=selected' :'' }}
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
                                                <select class="form-select form-select-sm" id="" name="cLayanan">
                                                    <option value="">-- Pilih Layanan/Bagian</option>
                                                    @foreach ($layanan_bagian as $lb)
                                                    <option
                                                        {{old('cLayanan') == $lb->FS_KD_LAYANAN ? 'selected=selected' :'' }}
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
                                            <h4 class="card-title">Assesmen Awal Terintegrasi Pasien Dewasa Rawat Jalan
                                            </h4>
                                        </div><!-- end card header -->
                                        <div class="card-body ">
                                            <ul class="wizard-nav mb-5">
                                                <li class="wizard-list-item">
                                                    <div class="list-item">
                                                        <div class="step-icon" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Halaman 1">
                                                            <i class="uil uil-list-ul"></i>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="wizard-list-item">
                                                    <div class="list-item">
                                                        <div class="step-icon" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Halaman 2">
                                                            <i class="uil uil-clipboard-notes"></i>
                                                        </div>
                                                    </div>
                                                </li>


                                            </ul>

                                            {{-- HALAMAN 1 --}}
                                            <div class="wizard-tab">
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
                                                                    <textarea class="form-control form-control-sm"
                                                                        name="" id="" rows="1"></textarea>
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
                                                                            <input type="text"
                                                                                class="form-control form-control-sm">
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
                                                                            <input type="text"
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
                                                                            <input type="text"
                                                                                class="form-control form-control-sm">
                                                                        </div>
                                                                        <div class="col-4">
                                                                            x/menit
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-3 text-align-right">
                                                                            <label for="">TB :</label>
                                                                        </div>
                                                                        <div class="col-5">
                                                                            <input type="text"
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
                                                                            <input type="text"
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
                                                                            <input type="text"
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
                                                                                <table class="w-100 " >
                                                                                    <tr>
                                                                                        <td width="15%" class="p-0"> Pernah dirawat :</td>
                                                                                        <td class="d-flex p-0">
                                                                                            <div class="m-r-1"
                                                                                                style="margin-left:30px;">
                                                                                                <input type="checkbox" value="Tidak" name="cPernahDirawat[1][]">
                                                                                                Tidak
                                                                                            </div>
                                                                                            <div class="m-r-1"
                                                                                                style="margin-left:30px;">
                                                                                                <input type="checkbox" value="Ya" name="cPernahDirawat[1][]">
                                                                                                Ya
                                                                                            </div>
                                                                                            <div class="m-r-1"
                                                                                                style="margin-left:30px;">
                                                                                                <span
                                                                                                    class="align-top">Diagnosa</span>
                                                                                                <input type="text">
                                                                                            </div>
                                                                                            <div class="m-r-1"
                                                                                                style="margin-left:30px;">
                                                                                                <span
                                                                                                    class="align-top">Kapan</span>
                                                                                                <input type="text">
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>


                                                                            </li>
                                                                            <li class="">
                                                                                <table class="w-100 standard-table" >
                                                                                    <tr>
                                                                                        <td width="15%" class="p-0">  Pernah dioperasi :</td>
                                                                                        <td class="d-flex p-0">
                                                                                            <div class="m-r-1"
                                                                                                style="margin-left:30px;">
                                                                                                <input type="checkbox">
                                                                                                Tidak
                                                                                            </div>
                                                                                            <div class="m-r-1"
                                                                                                style="margin-left:30px;">
                                                                                                <input type="checkbox">
                                                                                                Ya
                                                                                            </div>
                                                                                            <div class="m-r-1"
                                                                                                style="margin-left:30px;">
                                                                                                <span
                                                                                                    class="align-top">Jenis Operasi</span>
                                                                                                <input type="text">
                                                                                            </div>
                                                                                            <div class="m-r-1"
                                                                                                style="margin-left:30px;">
                                                                                                <span
                                                                                                    class="align-top">Kapan</span>
                                                                                                <input type="text">
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </li>
                                                                            <li class="">
                                                                                <table class="w-100 standard-table" >
                                                                                    <tr>
                                                                                        <td width="15%" class="p-0"> Masih dalam pengobatan :</td>
                                                                                        <td class="d-flex p-0">
                                                                                            <div class="m-r-1"
                                                                                                style="margin-left:30px;">
                                                                                                <input type="checkbox">
                                                                                                Tidak
                                                                                            </div>
                                                                                            <div class="m-r-1"
                                                                                                style="margin-left:30px;">
                                                                                                <input type="checkbox">
                                                                                                Ya
                                                                                            </div>
                                                                                            <div class="m-r-1"
                                                                                                style="margin-left:30px;">
                                                                                                <span
                                                                                                    class="align-top">Obat </span>
                                                                                                <input type="text">
                                                                                            </div>

                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </li>
                                                                        </ul>
                                                                    </li>
                                                                    <li>b. Riwayat Penyakit Keluarga
                                                                        <ul>
                                                                            <li class="null"><input type="checkbox"> Tidak</li>
                                                                            <li class="null">
                                                                                <div class="d-flex align-top">
                                                                                    <div class="m-r-1" style="margin-right:30px">
                                                                                        <input type="checkbox"> <span class="align-top"> Ya</span>  &nbsp;&nbsp;:
                                                                                    </div>
                                                                                    <div class="m-r-1" style="margin-right:30px">
                                                                                        <input type="checkbox"> <span class="align-top"> Hipertensi</span>  &nbsp;:
                                                                                    </div>
                                                                                    <div class="m-r-1" style="margin-right:30px">
                                                                                        <input type="checkbox"> <span class="align-top"> Jantung</span>  &nbsp;:
                                                                                    </div>
                                                                                    <div class="m-r-1" style="margin-right:30px">
                                                                                        <input type="checkbox"> <span class="align-top"> DM</span>  &nbsp;:
                                                                                    </div>
                                                                                    <div class="m-r-1" style="margin-right:30px">
                                                                                        <input type="checkbox"> <span class="align-top"> Paru</span>  &nbsp;:
                                                                                    </div>
                                                                                    <div class="m-r-1" style="margin-right:30px">
                                                                                        <input type="checkbox"> <span class="align-top"> Hepatitis</span>  &nbsp;:
                                                                                    </div>
                                                                                    Lainnya&nbsp; <input type="text">
                                                                                </div>
                                                                            </li>

                                                                        </ul>
                                                                    </li>
                                                                    <li>c. Ketergantungan
                                                                        <ul>
                                                                            <li class="null"><input type="checkbox"> Tidak</li>
                                                                            <li class="null">
                                                                                <div class="d-flex align-top">
                                                                                    <div class="m-r-1" style="margin-right:30px">
                                                                                        <input type="checkbox"> <span class="align-top"> Ya</span>  &nbsp;&nbsp;:
                                                                                    </div>
                                                                                    <div class="m-r-1" style="margin-right:30px">
                                                                                        <input type="checkbox"> <span class="align-top"> Obat-obatan</span>  &nbsp;:
                                                                                    </div>
                                                                                    <div class="m-r-1" style="margin-right:30px">
                                                                                        <input type="checkbox"> <span class="align-top"> Alkohol</span>  &nbsp;:
                                                                                    </div>
                                                                                    <div class="m-r-1" style="margin-right:30px">
                                                                                        <input type="checkbox"> <span class="align-top"> Rokok</span>  &nbsp;:
                                                                                    </div>
                                                                                    Lainnya&nbsp; <input type="text">
                                                                                </div>
                                                                            </li>

                                                                        </ul>
                                                                    </li>
                                                                    <li>
                                                                        <div class="d-flex">
                                                                        d. Riwayat Alergi :
                                                                        <div style="margin-left:30px;">
                                                                            <input type="checkbox"> Tidak
                                                                        </div>
                                                                        <div style="margin-left:30px;">
                                                                            <input type="checkbox"> Ya , sebutkan
                                                                        </div>
                                                                        <input style="margin-left:10px;" type="text">
                                                                        </div>
                                                                    </li>
                                                                </ul>

                                                            </div>

                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>

                                            {{-- HALAMAN 2 --}}
                                            <div class="wizard-tab">
                                                <table class="detail-asesmen w-100 table-bordered">
                                                    <tr>
                                                        <td>
                                                            <div class="form-group row">
                                                                <div class="col-6">
                                                                    <label for=""><strong> RIWAYAT PSIKOSOSIAL </strong></label>
                                                                </div>


                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>

                                                            <div class="row">
                                                                <ul class="list-unstyled mb-0">
                                                                    <li>1 . Status Psikologis
                                                                        <ul>
                                                                            <li class="">
                                                                                <table class="w-100 " >
                                                                                    <tr>
                                                                                        <td width="15%" class="p-0"> Pernah dirawat :</td>
                                                                                        <td class="d-flex p-0">
                                                                                            <div class="m-r-1"
                                                                                                style="margin-left:30px;">
                                                                                                <input type="checkbox" value="Tidak" name="cPernahDirawat[1][]">
                                                                                                Tidak
                                                                                            </div>
                                                                                            <div class="m-r-1"
                                                                                                style="margin-left:30px;">
                                                                                                <input type="checkbox" value="Ya" name="cPernahDirawat[1][]">
                                                                                                Ya
                                                                                            </div>
                                                                                            <div class="m-r-1"
                                                                                                style="margin-left:30px;">
                                                                                                <span
                                                                                                    class="align-top">Diagnosa</span>
                                                                                                <input type="text">
                                                                                            </div>
                                                                                            <div class="m-r-1"
                                                                                                style="margin-left:30px;">
                                                                                                <span
                                                                                                    class="align-top">Kapan</span>
                                                                                                <input type="text">
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>


                                                                            </li>
                                                                            <li class="">
                                                                                <table class="w-100 standard-table" >
                                                                                    <tr>
                                                                                        <td width="15%" class="p-0">  Pernah dioperasi :</td>
                                                                                        <td class="d-flex p-0">
                                                                                            <div class="m-r-1"
                                                                                                style="margin-left:30px;">
                                                                                                <input type="checkbox">
                                                                                                Tidak
                                                                                            </div>
                                                                                            <div class="m-r-1"
                                                                                                style="margin-left:30px;">
                                                                                                <input type="checkbox">
                                                                                                Ya
                                                                                            </div>
                                                                                            <div class="m-r-1"
                                                                                                style="margin-left:30px;">
                                                                                                <span
                                                                                                    class="align-top">Jenis Operasi</span>
                                                                                                <input type="text">
                                                                                            </div>
                                                                                            <div class="m-r-1"
                                                                                                style="margin-left:30px;">
                                                                                                <span
                                                                                                    class="align-top">Kapan</span>
                                                                                                <input type="text">
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </li>
                                                                            <li class="">
                                                                                <table class="w-100 standard-table" >
                                                                                    <tr>
                                                                                        <td width="15%" class="p-0"> Masih dalam pengobatan :</td>
                                                                                        <td class="d-flex p-0">
                                                                                            <div class="m-r-1"
                                                                                                style="margin-left:30px;">
                                                                                                <input type="checkbox">
                                                                                                Tidak
                                                                                            </div>
                                                                                            <div class="m-r-1"
                                                                                                style="margin-left:30px;">
                                                                                                <input type="checkbox">
                                                                                                Ya
                                                                                            </div>
                                                                                            <div class="m-r-1"
                                                                                                style="margin-left:30px;">
                                                                                                <span
                                                                                                    class="align-top">Obat </span>
                                                                                                <input type="text">
                                                                                            </div>

                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </li>
                                                                        </ul>
                                                                    </li>
                                                                    <li>b. Riwayat Penyakit Keluarga
                                                                        <ul>
                                                                            <li class="null"><input type="checkbox"> Tidak</li>
                                                                            <li class="null">
                                                                                <div class="d-flex align-top">
                                                                                    <div class="m-r-1" style="margin-right:30px">
                                                                                        <input type="checkbox"> <span class="align-top"> Ya</span>  &nbsp;&nbsp;:
                                                                                    </div>
                                                                                    <div class="m-r-1" style="margin-right:30px">
                                                                                        <input type="checkbox"> <span class="align-top"> Hipertensi</span>  &nbsp;:
                                                                                    </div>
                                                                                    <div class="m-r-1" style="margin-right:30px">
                                                                                        <input type="checkbox"> <span class="align-top"> Jantung</span>  &nbsp;:
                                                                                    </div>
                                                                                    <div class="m-r-1" style="margin-right:30px">
                                                                                        <input type="checkbox"> <span class="align-top"> DM</span>  &nbsp;:
                                                                                    </div>
                                                                                    <div class="m-r-1" style="margin-right:30px">
                                                                                        <input type="checkbox"> <span class="align-top"> Paru</span>  &nbsp;:
                                                                                    </div>
                                                                                    <div class="m-r-1" style="margin-right:30px">
                                                                                        <input type="checkbox"> <span class="align-top"> Hepatitis</span>  &nbsp;:
                                                                                    </div>
                                                                                    Lainnya&nbsp; <input type="text">
                                                                                </div>
                                                                            </li>

                                                                        </ul>
                                                                    </li>
                                                                    <li>c. Ketergantungan
                                                                        <ul>
                                                                            <li class="null"><input type="checkbox"> Tidak</li>
                                                                            <li class="null">
                                                                                <div class="d-flex align-top">
                                                                                    <div class="m-r-1" style="margin-right:30px">
                                                                                        <input type="checkbox"> <span class="align-top"> Ya</span>  &nbsp;&nbsp;:
                                                                                    </div>
                                                                                    <div class="m-r-1" style="margin-right:30px">
                                                                                        <input type="checkbox"> <span class="align-top"> Obat-obatan</span>  &nbsp;:
                                                                                    </div>
                                                                                    <div class="m-r-1" style="margin-right:30px">
                                                                                        <input type="checkbox"> <span class="align-top"> Alkohol</span>  &nbsp;:
                                                                                    </div>
                                                                                    <div class="m-r-1" style="margin-right:30px">
                                                                                        <input type="checkbox"> <span class="align-top"> Rokok</span>  &nbsp;:
                                                                                    </div>
                                                                                    Lainnya&nbsp; <input type="text">
                                                                                </div>
                                                                            </li>

                                                                        </ul>
                                                                    </li>
                                                                    <li>
                                                                        <div class="d-flex">
                                                                        d. Riwayat Alergi :
                                                                        <div style="margin-left:30px;">
                                                                            <input type="checkbox"> Tidak
                                                                        </div>
                                                                        <div style="margin-left:30px;">
                                                                            <input type="checkbox"> Ya , sebutkan
                                                                        </div>
                                                                        <input style="margin-left:10px;" type="text">
                                                                        </div>
                                                                    </li>
                                                                </ul>

                                                            </div>

                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>


                                            <div class="d-flex align-items-start gap-3 mt-4">
                                                <button type="button" class="btn btn-primary w-sm" id="prevBtn"
                                                    onclick="nextPrev(-1)">Previous</button>
                                                <button type="button" class="btn btn-primary w-sm ms-auto" id="nextBtn"
                                                    onclick="nextPrev(1)">Next</button>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end col -->
                            </div><!-- end row -->


                            <div style="margin-top:20px;">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-save"></i>
                                    SAVE
                                </button>

                                <a href="{{route('rekam-medis.detail',$rekam_medis->FS_MR)}}" class="btn btn-danger">
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
    $("input:checkbox").on('click', function() {
    // in the handler, 'this' refers to the box clicked on
    var $box = $(this);
    if ($box.is(":checked")) {
        // the name of the box is retrieved using the .attr() method
        // as it is assumed and expected to be immutable
        var group = "input:checkbox[name='" + $box.attr("name") + "']";
        // the checked state of the group/box on the other hand will change
        // and the current value is retrieved using .prop() method
        $(group).prop("checked", false);
        $box.prop("checked", true);
    } else {
        $box.prop("checked", false);
    }
    });
</script>
@endpush
