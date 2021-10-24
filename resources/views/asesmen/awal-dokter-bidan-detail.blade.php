@extends('main')

@push('styles')
<link rel="stylesheet" href="{{asset('assets/libs/select2/select2.min.css')}}">

<style>
    .detail-asesmen td {
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
                    <form action="{{route('asesmen-awal-dokter-bidan.update',$data_asesmen->FN_ID)}}" method="POST">
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
                                                <select class="form-select form-select-sm" id="" name="cLayanan"
                                                    required>
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
                                            <h4 class="card-title">Assesmen Awal Terintegrasi Pasien {{$type}} Rawat
                                                Jalan
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
                                                                                        style="">Subjective Data </span>
                                                                                </td>
                                                                                <td class="d-flex p-0">
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;">
                                                                                        <input type="checkbox" {{$data_asesmen->FJ_DS['Auto'] == 'on' ? 'checked':''}}
                                                                                            name="cDsAuto">
                                                                                        Auto
                                                                                    </div>

                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;">
                                                                                        <input type="checkbox"
                                                                                            name="cDsAllo" {{$data_asesmen->FJ_DS['Allo'] == 'on' ? 'checked':''}}>
                                                                                        <span class="align-top">Allo
                                                                                            :</span>
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;width: 510px;">
                                                                                        <textarea name="cDsText" id=""
                                                                                            cols="30" rows="5"
                                                                                            style="width:100%">{{$data_asesmen->FJ_DS['Text']}}</textarea>
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
                                                                                            rows="5">{{$data_asesmen->FS_RPD}}</textarea>
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
                                                                                            name="cRkGravida" value="{{$data_asesmen->FJ_RK['Gravida']}}">
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;">
                                                                                        Aterm :
                                                                                        <input type="text" class=""
                                                                                            name="cRkAterm" value="{{$data_asesmen->FJ_RK['Aterm']}}">
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;">
                                                                                        Prematur :
                                                                                        <input type="text" class=""
                                                                                            name="cRkPrematur" value="{{$data_asesmen->FJ_RK['Prematur']}}">
                                                                                    </div>
                                                                                </td>

                                                                            </tr>
                                                                            <tr>
                                                                                <td class="d-flex">
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:10px;">
                                                                                        Abortus :
                                                                                        <input type="text" class=""
                                                                                            name="cRkAbortus" value="{{$data_asesmen->FJ_RK['Abortus']}}">
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;">
                                                                                        Anak Hidup :
                                                                                        <input type="text" class=""
                                                                                            name="cRkAnakHidup" value="{{$data_asesmen->FJ_RK['AnakHidup']}}">
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;">
                                                                                        SC :
                                                                                        <input type="text" class=""
                                                                                            name="cRkSC" value="{{$data_asesmen->FJ_RK['SC']}}">
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
                                                                                        name="cRpMenikah" {{($data_asesmen->FJ_RP['Menikah'] =='on')?'checked':''}}>
                                                                                        Menikah
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;">
                                                                                        <input type="checkbox" class=""
                                                                                        name="cRpBelumMenikah" {{($data_asesmen->FJ_RP['BelumMenikah'] =='on')?'checked':''}}>
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
                                                                                            name="cRhHaidPertamaUsia" value="{{$data_asesmen->FJ_RH['HaidPertamaUsia']}}"> Tahun
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:10px;width:50%">
                                                                                        Siklus Haid :
                                                                                        <input type="text" class=""
                                                                                            name="cRhSiklusHaid" value="{{$data_asesmen->FJ_RH['SiklusHaid']}}"> Hari
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
                                                                                            name="cRhHaidTeraturYa" {{($data_asesmen->FJ_RH['HaidTeraturYa'] =='on')?'checked':''}}>Ya

                                                                                            &nbsp;
                                                                                            &nbsp;
                                                                                            &nbsp;
                                                                                        <input type="checkbox" class=""
                                                                                            name="cRhHaidTeraturTidak" {{($data_asesmen->FJ_RH['HaidTeraturTidak'] =='on')?'checked':''}}>Tidak
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:10px;width:50%">
                                                                                        Haid Pertama Haid Terakhir :
                                                                                        <input type="text" class=""
                                                                                            name="cRhHaidHariPertamaTerakhir" value="{{$data_asesmen->FJ_RH['HaidPertamaTerakhir']}}">
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
                                                                                            name="cRhNyeriHaidYa" {{($data_asesmen->FJ_RH['NyeriHaidYa'] =='on')?'checked':''}}>Ya

                                                                                            &nbsp;
                                                                                            &nbsp;
                                                                                            &nbsp;
                                                                                        <input type="checkbox" class=""
                                                                                            name="cRhNyeriHaidTidak" {{($data_asesmen->FJ_RH['NyeriHaidTidak'] =='on')?'checked':''}}>Tidak
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:10px;width:50%">
                                                                                        Taksiran Persalinan :
                                                                                        <input type="text" class=""
                                                                                            name="cRhTaksiranPersalinan" value="{{$data_asesmen->FJ_RH['TaksiranPersalinan']}}">
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="d-flex">
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:10px;width:50%">

                                                                                        Lama Haid :
                                                                                        <input type="text" class=""
                                                                                            name="cRhLamaHaid" value="{{$data_asesmen->FJ_RH['LamaHaid']}}"> hari
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
                                                                                            @if ($data_asesmen->FJ_RPSL != '')
                                                                                                        @for ($i = 0; $i < 5; $i++)
                                                                                                            <tr>
                                                                                                                <td><input type="number" name="cRpsl[{{$i}}][PersalinanKe]" value="{{$data_asesmen->FJ_RPSL[$i]['PersalinanKe']}}"></td>
                                                                                                                <td>
                                                                                                                    <select name="cRpsl[{{$i}}][Tahun]" id="">
                                                                                                                    <?php
                                                                                                                    for ($year = (int)date('Y'); 1900 <= $year; $year--): ?>
                                                                                                                        <option {{$data_asesmen->FJ_RPSL[$i]['Tahun'] == $year ? 'selected=selected' : ''}} value="<?=$year;?>"><?=$year;?></option>
                                                                                                                    <?php endfor; ?>
                                                                                                                    </select>
                                                                                                                </td>
                                                                                                                <td><input type="text" name="cRpsl[{{$i}}][JenisPersalinan]" value="{{$data_asesmen->FJ_RPSL[$i]['JenisPersalinan']}}"></td>
                                                                                                                <td><input type="text" name="cRpsl[{{$i}}][Sex]" value="{{$data_asesmen->FJ_RPSL[$i]['Sex']}}"></td>
                                                                                                                <td><input type="number" name="cRpsl[{{$i}}][BeratLahir]" value="{{$data_asesmen->FJ_RPSL[$i]['BeratLahir']}}" step="0.01"></td>
                                                                                                                <td><input type="text" name="cRpsl[{{$i}}][Keadaan]" value="{{$data_asesmen->FJ_RPSL[$i]['Keadaan']}}"></td>
                                                                                                            </tr>
                                                                                                        @endfor
                                                                                                        {{-- <tr>
                                                                                                            <td align="center">{{$item['PersalinanKe']}}</td>
                                                                                                            <td align="center">{{$item['Tahun']}}</td>
                                                                                                            <td align="center">{{$item['JenisPersalinan']}}</td>
                                                                                                            <td align="center">{{$item['Sex']}}</td>
                                                                                                            <td align="center">{{$item['BeratLahir']}}</td>
                                                                                                            <td align="center">{{$item['Keadaan']}}</td>
                                                                                                        </tr> --}}
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
                                                                                        style="margin-left:30px;width:10%">
                                                                                        Keadaan Umum :

                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;">
                                                                                        <input type="text" class="" value="{{$data_asesmen->FJ_DO['KeadaanUmum']}}"
                                                                                            name="cDoKeadaanUmum">

                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="d-flex ">
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;width:10%">
                                                                                        Kesadaran :

                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;">
                                                                                        <input type="text" class="" value="{{$data_asesmen->FJ_DO['Kesadaran']}}"
                                                                                            name="cDoKesadaran">

                                                                                    </div>

                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;">
                                                                                        GCS :

                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;">E
                                                                                        <input type="text" class="" value="{{$data_asesmen->FJ_DO['GCSE']}}"
                                                                                            name="cDoGCSE">

                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;">V
                                                                                        <input type="text" class="" value="{{$data_asesmen->FJ_DO['GCSV']}}"
                                                                                            name="cDoGCSV">

                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;">M
                                                                                        <input type="text" class="" value="{{$data_asesmen->FJ_DO['GCSM']}}"
                                                                                            name="cDoGCSM">

                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="d-flex ">
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;">
                                                                                        TD :
                                                                                        <input type="text" class="" value="{{$data_asesmen->FJ_DO['TD']}}"
                                                                                            name="cDoTD">
                                                                                        mmHg
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;">
                                                                                        Nadi :
                                                                                        <input type="text" class="" value="{{$data_asesmen->FJ_DO['Nadi']}}"
                                                                                            name="cDoNadi">
                                                                                        x/menit
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;">
                                                                                        Respirasi :
                                                                                        <input type="text" class="" value="{{$data_asesmen->FJ_DO['Respirasi']}}"
                                                                                            name="cDoRespirasi">
                                                                                        x/menit
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;">
                                                                                        Suhu :
                                                                                        <input type="text" class="" value="{{$data_asesmen->FJ_DO['Suhu']}}"
                                                                                            name="cDoSuhu">
                                                                                        C
                                                                                    </div>

                                                                                </td>

                                                                            </tr>

                                                                             <tr>
                                                                                <td class="d-flex ">
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;">
                                                                                        TFU :
                                                                                        <input type="text" class=""
                                                                                            name="cDoTFU" value="{{$data_asesmen->FJ_DO['TFU']}}">
                                                                                        cm
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;">
                                                                                        DJJ :
                                                                                        <input type="text" class=""
                                                                                            name="cDoDJJ" value="{{$data_asesmen->FJ_DO['DJJ']}}">
                                                                                        x/menit
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;">
                                                                                        His :
                                                                                        <input type="text" class=""
                                                                                            name="cDoHis" value="{{$data_asesmen->FJ_DO['His']}}">
                                                                                        x/menit
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;">
                                                                                        TBJ :
                                                                                        <input type="text" class=""
                                                                                            name="cDoTBJ" value="{{$data_asesmen->FJ_DO['TBJ']}}">
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
                                                    <textarea  name="cPemeriksaanFisikTambahan" id="" style="width: 100%" rows="10">{{$data_asesmen->FS_PEMERIKSAAN_FISIK_TAMBAHAN}}</textarea>
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
                                                <td style="vertical-align: top"
                                                >
                                                     <span class="fw-bold d-block">Diagnosa Utama : (kode ICD 10) </span>
                                                    {{-- <select name="cKodeDiagnosis" class="form-control" id="">
                                                        <option {{$data_asesmen->FS_KODE_DIAGNOSIS == '' ? 'selected=selected' : ''}} value="">---PILIH KODE DIAGNOSIS</option>
                                                        <option {{$data_asesmen->FS_KODE_DIAGNOSIS == 'DUMMYCODE' ? 'selected=selected' : ''}} value="DUMMYCODE">DUMMYCODE</option>
                                                    </select> --}}
                                                    <input style="margin-bottom:5px" type="text" class="form-control" readonly value="({{$data_asesmen->getIcd()->FS_KD_ICD}}) {{$data_asesmen->getIcd()->FS_NM_ICD}}">
                                                    <small>Search ICD</small>
                                                    <select name="cKodeDiagnosis" class="form-control  select2"  id="icd"></select>
                                                    {{-- <textarea name="" id="" style="width: 100%" rows="4"></textarea> --}}
                                                    <hr>
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
                                        <label for=""><strong> RENCANA TINDAK LANJUT</strong></label>
                                        <ul>
                                            <li class="d-flex">
                                                <div class="m-r-1" style="margin-left:30px;">
                                                    <input type="checkbox" name="cRtlPulang" {{$data_asesmen->FJ_RENCANA_TINDAK_LANJUT['Pulang'] == 'on' ? 'checked':''}}>
                                                    <span class="align-top">Pulang</span>
                                                </div>
                                            </li>
                                            <li class="d-flex">
                                                <div class="m-r-1" style="margin-left:30px;">
                                                    <input type="checkbox" name="cRtlKontrolTanggal" {{$data_asesmen->FJ_RENCANA_TINDAK_LANJUT['KontrolTanggal'] == 'on' ? 'checked':''}}>
                                                    <span class="align-top">Kontrol Tanggal : </span>
                                                    <input type="date" name="cRtlKontrolTanggalText" value="{{$data_asesmen->FJ_RENCANA_TINDAK_LANJUT['KontrolTanggalText']}}">
                                                </div>
                                            </li>
                                            <li class="d-flex">
                                                <div class="m-r-1" style="margin-left:30px;">
                                                    <input type="checkbox" name="cRtlKonsulKe" {{$data_asesmen->FJ_RENCANA_TINDAK_LANJUT['KonsulKe'] == 'on' ? 'checked':''}}>
                                                    <span class="align-top">Konsul Ke : </span>
                                                    <input type="text" name="cRtlKontulKeText" value="{{$data_asesmen->FJ_RENCANA_TINDAK_LANJUT['KonsulKeText']}}">
                                                </div>
                                            </li>
                                            <li class="d-flex">
                                                <div class="m-r-1" style="margin-left:30px;">
                                                    <input type="checkbox" name="cRtlRujukKe" {{$data_asesmen->FJ_RENCANA_TINDAK_LANJUT['RujukKe'] == 'on' ? 'checked':''}}>
                                                    <span class="align-top">Rujuk Ke : </span>
                                                    <input type="text" name="cRtlRujukKeText" value="{{$data_asesmen->FJ_RENCANA_TINDAK_LANJUT['RujukKeText']}}">
                                                </div>
                                            </li>
                                            <li class="d-flex">
                                                <div class="m-r-1" style="margin-left:30px;">
                                                    <input type="checkbox" name="cRtlRawatInap" {{$data_asesmen->FJ_RENCANA_TINDAK_LANJUT['RawatInap'] == 'on' ? 'checked':''}}>
                                                    <span class="align-top">Rawat Inap , Ruangan : </span>
                                                    <input type="text" name="cRtlRawatInapText" value="{{$data_asesmen->FJ_RENCANA_TINDAK_LANJUT['RawatInapText']}}">
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
        $("#icd").select2('data', { id:"B02.2+", text: "Hello!"});
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
