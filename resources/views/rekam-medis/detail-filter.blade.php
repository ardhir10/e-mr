@extends('main')

@push('styles')
<style>
    .leftCol {
        background-color: #428BCA !important;
        color: white;
        text-align: right;
        font-weight: 600;
        padding-right: 10px !important;

    }

    .rightCol {
        font-weight: 500;
        text-align: left;
        padding-left: 10px !important;

    }

    .table-bordered {
        border: 2px solid #D5D9DC !important;
    }

    .riwayat {
        font-weight: 500;
        font-size: 14px;
        padding: 8px;
        background-color: #8EA9DB;
        color: black;
        border-radius: 6px;
        text-align: center;
        margin-bottom: 11px;
        cursor: pointer;

    }

    .assesmen-section {}

    .assesmen-title {
        padding: 4px 31px 6px 11px;
        background-color: #A9D08E;
        margin-bottom: 16px;
        width: 100%;
    }

    .assesmen-body {
        padding: 16px;
        border: 1px solid #ebebeb;
        margin-bottom: 20px;
        background: #f1f1f1;
        border-radius: 20px;
    }

    .riwayat-kunjungan td {
        border: 1px solid black;
        padding: 2px 2px;
        font-size: 12px;
        text-align: left;
    }

    .riwayat-kunjungan th {
        border: 1px solid black;
        padding: 18px 2px;
        font-size: 12px;
        background: #B4C6E7;
        /* background: white; */
        position: sticky;
        top: 0;
        /* Don't forget this, required for the stickiness */
        box-shadow: 0 2px 2px -1px rgba(0, 0, 0, 0.4);
    }

    .table-catatan-perkembangan tr:nth-child(even) {
          background-color: #b5d3e754;
    }
    .detail-harp tr {
          background-color:transparent !important;
    }
    .table-catatan-perkembangan th {
        font-size: 11px !important;
        border: 1px solid #ebebeb;
    }

    .table-catatan-perkembangan td {
        font-size: 10px !important;
        border: 1px solid #ebebeb;
    }

    table.dataTable thead th,
    table.dataTable thead td {
        padding: 10px 18px;
        background: #B4C6E7;
        color: black;
        border-bottom: 1px solid #ebebeb !important;
    }

    table.dataTable.no-footer {
        border-bottom: 1px solid #ebebeb !important;
    }

    /*
    *  STYLE 3
    */

    .style-3::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        background-color: #F5F5F5;
    }

    .style-3::-webkit-scrollbar {
        width: 6px;
        background-color: #F5F5F5;
    }

    .style-3::-webkit-scrollbar-thumb {
        background-color: #000000;
    }

</style>

@endpush

@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">{{$page_title}}</h4>

                    {{-- <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Utility</a></li>
                            <li class="breadcrumb-item active">Starter Page</li>
                        </ol>
                    </div> --}}

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Detail Pasien</h5>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-lg-3">
                                <div class="row">

                                    <div class="col-lg-12">
                                        <div class="dropdown" style="width:100%">
                                            <button class="btn btn-secondary dropdown-toggle " style="width:100%"
                                                type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown"
                                                aria-expanded="true">
                                                {{-- <i class="fa fa-clipboard" data-feather="clipboard"></i> --}}
                                                LIST RIWAYAT <i data-feather="chevron-down"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-dark " style="width:100%"
                                                aria-labelledby="dropdownMenuButton2" data-popper-placement="top-start"
                                                style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate(3px, -34px);">
                                                <li>

                                                    <a class="dropdown-item" href="{{route('riwayat.laboratorium.index',['mr'=>$rekam_medis->FS_MR])}}">Riwayat Laboratorium</a></li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="{{route('riwayat.radiologi.index',['mr'=>$rekam_medis->FS_MR])}}">Riwayat Radiologi</a></li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li><a class="dropdown-item" href="{{route('riwayat.resep-dokter.index',['mr'=>$rekam_medis->FS_MR])}}">Riwayat Resep</a></li>

                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li><a class="dropdown-item" href="#">Riwayat Resume Medis</a></li>

                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li><a class="dropdown-item" href="#">Riwayat Resume Keperawatan</a>
                                                </li>

                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li><a class="dropdown-item" href="{{route('riwayat.singkat-kunjungan.index',['mr'=>$rekam_medis->FS_MR])}}">Riwayat Singkat Kunjungan</a></li>
                                            </ul>
                                        </div>
                                        <img src="{{asset('assets/images/no_avatar.png')}}" width="100%" height="auto"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <table class="table table-sm table-bordered">
                                    <tr>
                                        <td class="leftCol">
                                            Nomor MR
                                        </td>
                                        <td class="rightCol">
                                            {{$rekam_medis->FS_MR}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="leftCol">
                                            Nama Pasien
                                        </td>
                                        <td class="rightCol">
                                            {{$rekam_medis->FS_NM_PASIEN}}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="leftCol">
                                            Kabupaten
                                        </td>
                                        <td class="rightCol">
                                            {{$rekam_medis->fs_nm_kabupaten}}

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="leftCol">
                                            Kecamatan
                                        </td>
                                        <td class="rightCol">
                                            {{$rekam_medis->fs_nm_kecamatan}}

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="leftCol">
                                            Kelurahan
                                        </td>
                                        <td class="rightCol">
                                            {{$rekam_medis->fs_nm_kelurahan}}

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="leftCol">
                                            Tgl Lahir
                                        </td>
                                        <td class="rightCol">
                                            {{date('d-m-Y',strtotime($rekam_medis->FD_TGL_LAHIR))}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="leftCol">
                                            Jenis Kelamin
                                        </td>
                                        <td class="rightCol">
                                            @if ($rekam_medis->FB_JNS_KELAMIN)
                                            PEREMPUAN
                                            @else
                                            LAKI-LAKI
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="leftCol">
                                            Golongan Darah
                                        </td>
                                        <td class="rightCol">
                                            {{$rekam_medis->FS_GOL_DARAH}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="leftCol">
                                            Agama
                                        </td>
                                        <td class="rightCol">
                                            {{$rekam_medis->fs_nm_agama}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="leftCol">
                                            No Telp / HP
                                        </td>
                                        <td class="rightCol">
                                            {{$rekam_medis->FS_TLP_PASIEN}}
                                        </td>
                                    </tr>

                                </table>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-lg-12">
                <div class="card">

                    <div class="card-body">
                        <div class="assesmen-section row">
                            <div class="col-12">
                                @include('components.flash-message')
                            </div>
                            <div class="col-lg-3">
                                <div class="card border border-dark">
                                    <div class="card-header  border-dark"
                                        style="background-color: #A9D08E;padding:3px 18px;">
                                        <h6 class="my-0 text-dark">Assesmen Awal Pasien Dewasa</h6>
                                    </div>
                                    <div class="card-body" style="padding:10px">
                                        <div class="" style="">
                                            <div class="dropdown" style="width:100%">
                                                <button class="btn btn-secondary  dropdown-toggle " style="width:100%"
                                                    type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown"
                                                    aria-expanded="true">
                                                    FORM ASESMEN <i data-feather="chevron-down"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-dark " style="width:100%"
                                                    aria-labelledby="dropdownMenuButton2"
                                                    data-popper-placement="top-start"
                                                    style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate(3px, -34px);">
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{route('asesmen.awal-dewasa.perawat',[$from,'Dewasa',$rekam_medis->FS_MR,$kd_dokter,$kd_reg])}}">PERAWAT</a>
                                                    </li>
                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{route('asesmen.awal-dewasa.dokter',[$from,'Dewasa',$rekam_medis->FS_MR,$kd_dokter,$kd_reg])}}">DOKTER</a>
                                                    </li>
                                                </ul>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="card border border-dark">
                                    <div class="card-header  border-dark"
                                        style="background-color: #A9D08E;padding:3px 18px;">
                                        <h6 class="my-0 text-dark">Assesmen Pasien Anak</h6>
                                    </div>
                                    <div class="card-body" style="padding:10px">
                                        <div class="" style="">
                                            <div class="dropdown" style="width:100%">
                                                <button class="btn btn-secondary dropdown-toggle " style="width:100%"
                                                    type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown"
                                                    aria-expanded="true">
                                                    FORM ASESMEN <i data-feather="chevron-down"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-dark " style="width:100%"
                                                    aria-labelledby="dropdownMenuButton2"
                                                    data-popper-placement="top-start"
                                                    style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate(3px, -34px);">
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{route('asesmen.awal-dewasa.perawat',[$from,'Anak',$rekam_medis->FS_MR,$kd_dokter,$kd_reg])}}">PERAWAT</a>
                                                    </li>
                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{route('asesmen.awal-dewasa.dokter',[$from,'Anak',$rekam_medis->FS_MR,$kd_dokter,$kd_reg])}}">DOKTER</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="card border border-dark">
                                    <div class="card-header  border-dark"
                                        style="background-color: #A9D08E;padding:3px 18px;">
                                        <h6 class="my-0 text-dark">Assesmen Pasien Kebidanan</h6>
                                    </div>
                                    <div class="card-body" style="padding:10px">
                                        <div class="" style="">
                                            <div class="dropdown" style="width:100%">
                                                <button class="btn btn-secondary dropdown-toggle " style="width:100%"
                                                    type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown"
                                                    aria-expanded="true">
                                                    FORM ASESMEN <i data-feather="chevron-down"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-dark " style="width:100%"
                                                    aria-labelledby="dropdownMenuButton2"
                                                    data-popper-placement="top-start"
                                                    style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate(3px, -34px);">
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{route('asesmen.awal-dewasa.perawat',[$from,'Kebidanan',$rekam_medis->FS_MR,$kd_dokter,$kd_reg])}}">PERAWAT</a>
                                                    </li>
                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{route('asesmen.awal-bidan.dokter',[$from,'Kebidanan',$rekam_medis->FS_MR,$kd_dokter,$kd_reg])}}">DOKTER</a>

                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <a href="{{route('cppt.create',[$from,$rekam_medis->FS_MR,$kd_dokter,$kd_reg])}}"
                                    class="btn btn-success ">
                                    <i data-feather="folder-plus"></i>
                                    Tambah CPPT</a>
                                    <h1>{{ session()->get('hl')}}</h1>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-3">
                                <h6 style="font-style: italic;">RIWAYAT KUNJUNGAN PASIEN</h6>
                                <div style="" class="style-3 ">
                                {{-- <div style="max-height: 400px;overflow-y:auto;" class="style-3"> --}}
                                    <form action="" method="post">
                                        @csrf
                                        <table class="table table-striped table-catatan-perkembangan"
                                            style="border-collapse: collapse;width: 100%;" id="data-table2">
                                            <thead>
                                                <tr style="">
                                                    <th>Tanggal</th>
                                                    <th>Bagian
                                                        Layanan</th>
                                                    <th>Dokter</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($riwayat_kunjungan as $rk)
                                                <tr>
                                                    <td style="padding:2px ;">{{date('d-m-Y',strtotime($rk->fd_tgl_masuk))}}</td>
                                                    <td style="padding:2px ;">
                                                        {{$rk->fs_nm_layanan}}
                                                    </td>
                                                    <td style="padding:2px ;">{{$rk->fs_dokter}}</td>
                                                    <td style="padding:2px ;">
                                                        <input type="checkbox" class="filter-riwayat-kunjungan" value="{{$rk->fs_kd_reg}}" name="filter[]"
                                                        {{in_array($rk->fs_kd_reg,$filtered) == true ? 'checked' : '' }}
                                                        >
                                                        {{-- <i data-feather="check" style="height: 15px;color:#21A366"></i> --}}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <br>
                                        <button class="btn btn-sm btn-success">Apply Filter</button>
                                    </form>
                                </div>

                            </div>
                            <div class="col-lg-9">
                                <h6 style="font-style: italic;">CATATAN PERKEMBANGAN PASIEN TERINTEGRASI</h6>
                                <table class="cell-border table-catatan-perkembangan " id="data-table">
                                    <thead>
                                        <tr>
                                            <th width="2%">No</th>
                                            <th width="5%">Tanggal Jam</th>
                                            <th width="5%">*</th>
                                            <th width="5%">Profesi / Bagian</th>
                                            <th>Hasil Pemeriksaan/Assesmen, Analisis dan Rencana Penatalaksanaan</th>
                                            <th>Instruksi / Tindak Lanjut</th>
                                            <th>Verifikasi</th>
                                            <th>User</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($CPPT as $cppt)
                                        <tr>
                                            <td style="vertical-align:top;" style="vertical-align:top;">{{$loop->iteration}}</td>
                                            <td style="vertical-align:top;">
                                                <span
                                                    style="d-block">{{date('d-m-Y H:i:s',strtotime($cppt->FD_DATE))}}</span>
                                            </td>
                                            <td style="vertical-align:top;">
                                                @if ($cppt->TB_FROM == 'cppt')
                                                    <a href="{{route('cppt.detail',[$from,$cppt->FN_ID])}}">Lihat Detail</a>
                                                    <small>CPPT</small>
                                                @elseif ($cppt->TB_FROM == 'asesmen_dokter')
                                                    <a href="{{route('asesmen.detail.dokter',[$from,$cppt->FN_ID])}}">Lihat Detail</a>
                                                    <small>Asesmen Dokter</small>

                                                @elseif ($cppt->TB_FROM == 'asesmen_dokter_bidan')
                                                    <a href="{{route('asesmen.detail.dokterbidan',[$from,$cppt->FN_ID])}}">Lihat Detail</a>
                                                    <small>Asesmen Dokter Bidan</small>

                                                @else
                                                    <a href="{{route('asesmen.detail.perawat',[$from,$cppt->FN_ID])}}">Lihat Detail</a>
                                                    <small>Asesmen Perawat</small>

                                                @endif
                                            </td>
                                            <td style="vertical-align:top;">
                                                <span class="badge bg-primary d-block" style="font-size: 10px;margin-bottom:3px;">{{$cppt->FS_PROFESI}}</span>
                                                <span class="badge bg-secondary " style="font-size: 10px;    white-space: normal !important;">{{$cppt->FS_NM_LAYANAN}}</span>
                                            </td>
                                            <td style="vertical-align:top;">
                                                <div style=" height: 200px;overflow: auto;" class="style-3 detail-soap">
                                                    <table class="no-border detail-harp" >
                                                        {{-- SUBJECTIVE --}}
                                                        <tr>
                                                            <td style="border: 0px !important;vertical-align:top;">S:
                                                            </td>
                                                            @if ($cppt->TB_FROM == 'asesmen_dokter' || $cppt->TB_FROM == 'asesmen_dokter_bidan' )
                                                                <td style="border: 0px !important;">{{json_decode($cppt->FT_SUBJECTIVE)->Text}}</td>
                                                            @else
                                                                <td style="border: 0px !important;">{{$cppt->FT_SUBJECTIVE}}</td>
                                                            @endif
                                                        </tr>

                                                        {{-- OBJECTIVE --}}
                                                        <tr class="different">
                                                            <td style="border: 0px !important;vertical-align:top;">O:
                                                            </td>

                                                            @if ($cppt->TB_FROM == 'cppt')
                                                                <td style="border: 0px !important;">{{$cppt->FT_OBJECTIVE}}
                                                                </td>
                                                            @elseif ($cppt->TB_FROM == 'asesmen_dokter')
                                                            <td style="border: 0px !important;">
                                                                <ul>
                                                                    <li>Keadaan Umum : {{json_decode($cppt->FT_OBJECTIVE)->KeadaanUmum}}</li>
                                                                    <li>Kesadaran : {{json_decode($cppt->FT_OBJECTIVE)->Kesadaran}}</li>
                                                                    <li>TD : {{json_decode($cppt->FT_OBJECTIVE)->TD}} mmHg</li>
                                                                    <li>Nadi : {{json_decode($cppt->FT_OBJECTIVE)->Nadi}} x/menit</li>
                                                                    <li>Respirasi : {{json_decode($cppt->FT_OBJECTIVE)->Respirasi}} x/menit</li>
                                                                    <li>Suhu : {{json_decode($cppt->FT_OBJECTIVE)->Suhu}} C</li>
                                                                </ul>
                                                            </td>
                                                            @elseif ($cppt->TB_FROM == 'asesmen_dokter_bidan')
                                                            <td style="border: 0px !important;">
                                                                <ul>
                                                                    <li>Keadaan Umum : {{json_decode($cppt->FT_OBJECTIVE)->KeadaanUmum}}</li>
                                                                    <li>Kesadaran : {{json_decode($cppt->FT_OBJECTIVE)->Kesadaran}}</li>
                                                                    <li>TD : {{json_decode($cppt->FT_OBJECTIVE)->TD}} mmHg</li>
                                                                    <li>Nadi : {{json_decode($cppt->FT_OBJECTIVE)->Nadi}} x/menit</li>
                                                                    <li>Respirasi : {{json_decode($cppt->FT_OBJECTIVE)->Respirasi}} x/menit</li>
                                                                    <li>Suhu : {{json_decode($cppt->FT_OBJECTIVE)->Suhu}} C</li>
                                                                    <li>TFU : {{json_decode($cppt->FT_OBJECTIVE)->TFU}} cm</li>
                                                                    <li>DJJ : {{json_decode($cppt->FT_OBJECTIVE)->DJJ}} x/menit</li>
                                                                    <li>His : {{json_decode($cppt->FT_OBJECTIVE)->His}} x/10 menit</li>
                                                                    <li>TBJ : {{json_decode($cppt->FT_OBJECTIVE)->TBJ}} gram</li>
                                                                </ul>
                                                            </td>

                                                            @else
                                                                <td style="border: 0px !important;">
                                                                    <ul>
                                                                        <li>TD : {{$cppt->TD}} mmHG</li>
                                                                        <li>TB : {{$cppt->TB}} cm</li>
                                                                        <li>Nadi : {{$cppt->NADI}} x/menit</li>
                                                                        <li>BB : {{$cppt->BB}} kg</li>
                                                                        <li>Respirasi : {{$cppt->RESPIRASI}} x/menit</li>
                                                                        <li>Suhu : {{$cppt->SUHU}} c</li>
                                                                    </ul>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                        @if ($cppt->TB_FROM == 'cppt')
                                                            {{-- OBJECTIVE --}}
                                                            <tr>
                                                                <td style="border: 0px !important;vertical-align:top;">A:
                                                                </td>
                                                                <td style="border: 0px !important;">{{$cppt->FT_ASSESMENT}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="border: 0px !important;vertical-align:top;">P:
                                                                </td>
                                                                <td style="border: 0px !important;">
                                                                    <ul style="padding: 0px;">
                                                                        @if ($cppt->FS_PLAN1 != '')
                                                                        <li style="margin-bottom:10px;" class="testPosition">1 : {{$cppt->FS_PLAN1}}</li>
                                                                        @endif
                                                                        @if ($cppt->FS_PLAN2 != '')
                                                                        <li style="margin-bottom:10px;">2 : {{$cppt->FS_PLAN2}}</li>
                                                                        @endif
                                                                        @if ($cppt->FS_PLAN3 != '')
                                                                        <li style="margin-bottom:10px;">3 : {{$cppt->FS_PLAN3}}</li>
                                                                        @endif
                                                                        @if ($cppt->FS_PLAN4 != '')
                                                                        <li style="margin-bottom:10px;">4 : {{$cppt->FS_PLAN4}}</li>
                                                                        @endif
                                                                    </ul>
                                                                </td>
                                                            </tr>
                                                        @endif

                                                    </table>
                                                </div>
                                            </td>
                                            <td style="vertical-align:top;">-
                                                @if ($cppt->TB_FROM == 'cppt')
                                                <div style=" height: 200px;overflow: auto;" class="style-3">
                                                    <ul style="padding:13px">

                                                        @if ($cppt->FS_PLAN1 != '')
                                                            <li>{{$cppt->FS_PLAN1}}
                                                                <ul style="padding:0px;margin-left: 11px;">
                                                                    @if ($cppt->FS_IPPA1A != '')
                                                                    <li>{{$cppt->FS_IPPA1A}}</li>
                                                                    @endif
                                                                    @if ($cppt->FS_IPPA1B != '')
                                                                    <li>{{$cppt->FS_IPPA1B}}</li>
                                                                    @endif
                                                                    @if ($cppt->FS_IPPA1C != '')
                                                                    <li>{{$cppt->FS_IPPA1C}}</li>
                                                                    @endif
                                                                </ul>
                                                            </li>
                                                        @endif

                                                        @if ($cppt->FS_PLAN2 != '')
                                                            <li>{{$cppt->FS_PLAN2}}
                                                                <ul style="padding:0px;margin-left: 11px;">
                                                                    @if ($cppt->FS_IPPA2A != '')
                                                                    <li>{{$cppt->FS_IPPA2A}}</li>
                                                                    @endif
                                                                    @if ($cppt->FS_IPPA2B != '')
                                                                    <li>{{$cppt->FS_IPPA2B}}</li>
                                                                    @endif
                                                                    @if ($cppt->FS_IPPA2C != '')
                                                                    <li>{{$cppt->FS_IPPA2C}}</li>
                                                                    @endif
                                                                </ul>
                                                            </li>
                                                        @endif

                                                        @if ($cppt->FS_PLAN3 != '')
                                                            <li>{{$cppt->FS_PLAN3}}
                                                                <ul style="padding:0px;margin-left: 11px;">
                                                                    @if ($cppt->FS_IPPA3A != '')
                                                                    <li>{{$cppt->FS_IPPA3A}}</li>
                                                                    @endif
                                                                    @if ($cppt->FS_IPPA3B != '')
                                                                    <li>{{$cppt->FS_IPPA3B}}</li>
                                                                    @endif
                                                                    @if ($cppt->FS_IPPA3C != '')
                                                                    <li>{{$cppt->FS_IPPA3C}}</li>
                                                                    @endif
                                                                </ul>
                                                            </li>
                                                        @endif

                                                        @if ($cppt->FS_PLAN4 != '')
                                                            <li>{{$cppt->FS_PLAN4}}
                                                                <ul style="padding:0px;margin-left: 11px;">
                                                                    @if ($cppt->FS_IPPA4A != '')
                                                                    <li>{{$cppt->FS_IPPA4A}}</li>
                                                                    @endif
                                                                    @if ($cppt->FS_IPPA4B != '')
                                                                    <li>{{$cppt->FS_IPPA4B}}</li>
                                                                    @endif
                                                                    @if ($cppt->FS_IPPA4C != '')
                                                                    <li>{{$cppt->FS_IPPA4C}}</li>
                                                                    @endif
                                                                </ul>
                                                            </li>
                                                        @endif


                                                    </ul>
                                                </div>
                                                @endif

                                                @if ($cppt->TB_FROM == 'asesmen_dokter')
                                                    {{-- <ul>
                                                        <li>Pulang <input type="checkbox" disabled {{json_decode($cppt->FT_ASSESMENT)->Pulang == 'on' ? 'checked' : ''}}></li>
                                                        <li>Kontrol Tgl : {{json_decode($cppt->FT_ASSESMENT)->KontrolTanggalText}}</li>
                                                        <li>Konsul Ke : {{json_decode($cppt->FT_ASSESMENT)->KonsulKeText}}</li>
                                                        <li>Rujuk Ke : {{json_decode($cppt->FT_ASSESMENT)->RujukKeText}}</li>
                                                        <li>Ruang Rawat : {{json_decode($cppt->FT_ASSESMENT)->RawatInapText}}</li>
                                                    </ul> --}}
                                                    <span>{{$cppt->FT_ASSESMENT}}</span>
                                                @else

                                                @endif


                                            </td>
                                            <td style="vertical-align:top;">
                                                <span class="d-block">Verified By :</span>
                                                @if ($cppt->FS_KD_PEG == Auth::user()->fs_kd_peg)
                                                    @if ($cppt->TB_FROM == 'cppt')
                                                        @if ($cppt->FS_VERIFIED_BY)
                                                            <span class="d-block">{{$cppt->FS_DPJP}}</span>
                                                            <a href="{{route('cppt.unverified',$cppt->FN_ID)}}">
                                                                <button class="btn btn-sm btn-danger">Unverify</button>
                                                            </a>
                                                        @else
                                                            <a href="{{route('cppt.verified',$cppt->FN_ID)}}">
                                                                <button class="btn btn-sm btn-success">Verify</button>
                                                            </a>
                                                        @endif
                                                    @elseif ($cppt->TB_FROM == 'asesmen_dokter')
                                                        @if ($cppt->FS_VERIFIED_BY)
                                                            <span class="d-block">{{$cppt->FS_DPJP}}</span>
                                                            <a href="{{route('asesmen-dokter.unverified',$cppt->FN_ID)}}">
                                                                <button class="btn btn-sm btn-danger">Unverify</button>
                                                            </a>
                                                        @else
                                                            <a href="{{route('asesmen-dokter.verified',$cppt->FN_ID)}}">
                                                                <button class="btn btn-sm btn-success">Verify</button>
                                                            </a>
                                                        @endif
                                                    @elseif ($cppt->TB_FROM == 'asesmen_dokter_bidan')
                                                        @if ($cppt->FS_VERIFIED_BY)
                                                            <span class="d-block">{{$cppt->FS_DPJP}}</span>
                                                            <a href="{{route('asesmen-dokter-bidan.unverified',$cppt->FN_ID)}}">
                                                                <button class="btn btn-sm btn-danger">Unverify</button>
                                                            </a>
                                                        @else
                                                            <a href="{{route('asesmen-dokter-bidan.verified',$cppt->FN_ID)}}">
                                                                <button class="btn btn-sm btn-success">Verify</button>
                                                            </a>
                                                        @endif
                                                    @else
                                                        @if ($cppt->FS_VERIFIED_BY)
                                                                <span class="d-block">{{$cppt->FS_DPJP}}</span>
                                                                <a href="{{route('asesmen-perawat.unverified',$cppt->FN_ID)}}">
                                                                    <button class="btn btn-sm btn-danger">Unverify</button>
                                                                </a>
                                                            @else
                                                                <a href="{{route('asesmen-perawat.verified',$cppt->FN_ID)}}">
                                                                    <button class="btn btn-sm btn-success">Verify</button>
                                                                </a>
                                                            @endif
                                                    @endif
                                                @else
                                                    @if ($cppt->FS_VERIFIED_BY)
                                                        <span class="d-block">{{$cppt->FS_DPJP}}</span>

                                                    @else
                                                        <p style="font-size: 9.2px;    white-space: normal !important;" class="badge bg-danger">Not Allowed</p>
                                                    @endif
                                                @endif

                                            </td>
                                            <td style="vertical-align:top;">
                                                {{$cppt->FS_USER}}
                                            </td>
                                        </tr>
                                        @endforeach



                                    </tbody>

                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- end row -->

    </div> <!-- container-fluid -->
</div>
@endsection

@push('scripts')
<script>
    $('#data-table').DataTable({});
    $('#data-table2').DataTable({
        "bPaginate": false,
        "bLengthChange": false,
        "bFilter": true,
        "bInfo": false,
        "bAutoWidth": false,
        "order": [[ 0, "desc" ]],
        "columnDefs": [
            {
                "orderable": false,
                "targets": [3]
            },
            {
                "orderable": true,
                "targets": [[ 0, "desc" ], 1, 2]
            }
        ]
        //   "ordering": false
    });



$(".detail-soap").scroll(function() { //.box is the class of the div
    var p = $( ".testPosition" );
    var position = $(p).offset();
    // position = $(position).css(position)
    position['position'] = 'absolute';
    console.log('POSITION',position);
    $('.ngikut').css(position);
    console.log($('.testPosition').isInViewport());
});

$.fn.isInViewport = function() {
    var elementTop = $(this).offset().top;
    var elementBottom = elementTop + $(this).outerHeight();

    var viewportTop = $(window).scrollTop();
    var viewportBottom = viewportTop + $(window).height();

    return elementBottom > viewportTop && elementTop < viewportBottom;
};

// $('.filter-riwayat-kunjungan').on('click',function(){
//     alert(this.value);
// })
</script>
@endpush
