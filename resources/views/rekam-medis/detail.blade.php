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

    .table-catatan-perkembangan th {
        font-size: 12px !important;
        border: 1px solid #ebebeb;
    }

    .table-catatan-perkembangan td {
        font-size: 12px !important;
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

            <div class="col-lg-10">
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

                                                    <a class="dropdown-item" href="#">Riwayat Laboratorium</a></li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li><a class="dropdown-item" href="#">Riwayat Radiologi</a></li>

                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li><a class="dropdown-item" href="#">Riwayat Resep</a></li>

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
                                                <li><a class="dropdown-item" href="#">Riwayat Singkat Kunjungan</a></li>
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
                                                            href="{{route('asesmen.awal-dewasa.perawat')}}">PERAWAT</a>
                                                    </li>
                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>
                                                    <li><a class="dropdown-item" href="#">DOKTER</a></li>
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
                                                            href="{{route('asesmen.awal-dewasa.perawat')}}">PERAWAT</a>
                                                    </li>
                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>
                                                    <li><a class="dropdown-item" href="#">DOKTER</a></li>
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
                                                            href="{{route('asesmen.awal-dewasa.perawat')}}">PERAWAT</a>
                                                    </li>
                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>
                                                    <li><a class="dropdown-item" href="#">DOKTER</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <a href="{{route('cppt.create',$rekam_medis->FS_MR)}}" class="btn btn-success ">
                                    <i data-feather="folder-plus"></i>
                                    Tambah CPPT</a>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-3">
                                <h6 style="font-style: italic;">RIWAYAT KUNJUNGAN PASIEN</h6>
                                <div style="max-height: 400px;overflow:auto;margin-top:43px" class="style-3">
                                    <table class="riwayat-kunjungan" style="border-collapse: collapse;width: 100%;">
                                        <tr style="">
                                            <th>Tanggal</th>
                                            <th>Layanan</th>
                                            <th>Dokter</th>
                                            <th>RM</th>
                                        </tr>
                                        @foreach ($riwayat_kunjungan as $rk)
                                        <tr>
                                            <td>{{date('d-m-Y',strtotime($rk->fd_tgl_masuk))}}</td>
                                            <td>{{$rk->fs_nm_layanan}}</td>
                                            <td>{{$rk->fs_dokter}}</td>
                                            <td>
                                                <input type="checkbox">
                                                {{-- <i data-feather="check" style="height: 15px;color:#21A366"></i> --}}
                                            </td>
                                        </tr>
                                        @endforeach



                                    </table>
                                </div>

                            </div>
                            <div class="col-lg-9">
                                <h6 style="font-style: italic;">CATATAN PERKEMBANGAN PASIEN TERINTEGRASI</h6>
                                <table class="cell-border table-catatan-perkembangan" id="data-table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal Jam</th>
                                            <th>*</th>
                                            <th>Profesi / Bagian</th>
                                            <th>Hasil Pemeriksaan/Assesmen, Analisis dan Rencana Penatalaksanaan</th>
                                            <th>Instruksi / Tindak Lanjut</th>
                                            <th>Verifikasi</th>
                                            <th>User</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($CPPT as $cppt)
                                        <tr>
                                            <td style="vertical-align:top;" style="vertical-align:top;">1</td>
                                            <td style="vertical-align:top;">
                                                <span
                                                    style="d-block">{{date('d-m-Y H:i:s',strtotime($cppt->FD_DATE))}}</span>
                                            </td>
                                            <td style="vertical-align:top;">
                                                <a href="{{route('cppt.detail',$cppt->FN_ID)}}">Lihat Detail</a>
                                            </td>
                                            <td style="vertical-align:top;">{{$cppt->FS_PROFESI}}</td>
                                            <td style="vertical-align:top;">
                                                <div style=" height: 200px;overflow: auto;" class="style-3">
                                                    <table class="no-border">
                                                        <tr>
                                                            <td style="border: 0px !important;vertical-align:top;">S:
                                                            </td>
                                                            <td style="border: 0px !important;">{{$cppt->FT_SUBJECTIVE}}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="border: 0px !important;vertical-align:top;">O:
                                                            </td>
                                                            <td style="border: 0px !important;">{{$cppt->FT_OBJECTIVE}}
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td style="border: 0px !important;vertical-align:top;">A:
                                                            </td>
                                                            <td style="border: 0px !important;">{{$cppt->FT_ASSESMENT}}
                                                            </td>
                                                        </tr>

                                                    </table>
                                                </div>
                                            </td>
                                            <td style="vertical-align:top;">-
                                                <div style="height: 200px">

                                                </div>
                                                <table class="no-border">
                                                    <tr>
                                                        <td style="border: 0px !important;vertical-align:top;">P1:
                                                        </td>
                                                        <td style="border: 0px !important;">{{$cppt->FS_PLAN1}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="border: 0px !important;vertical-align:top;">P2:
                                                        </td>
                                                        <td style="border: 0px !important;">{{$cppt->FS_PLAN2}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="border: 0px !important;vertical-align:top;">P3:
                                                        </td>
                                                        <td style="border: 0px !important;">{{$cppt->FS_PLAN3}}</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td style="vertical-align:top;">
                                                <span class="d-block">Verified By :</span>
                                                <button class="btn btn-sm btn-success">Verified</button>
                                                {{-- <span class="d-block">{{$cppt->FS_DPJP}}</span> --}}
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

</script>
@endpush
