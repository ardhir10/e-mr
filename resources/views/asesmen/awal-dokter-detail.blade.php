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
                <div class="card" id="formData" style="box-shadow: -7px -1px 29px 5px rgba(0,0,0,0.27);
-webkit-box-shadow: -7px -1px 20px 0px rgb(0 0 0 / 27%);
-moz-box-shadow: -7px -1px 29px 5px rgba(0,0,0,0.27); border:0px !important;border-radius: 20px;">
                    <div class="card-header" style="background: cornflowerblue;border-top-left-radius:20px;border-top-right-radius:20px">
                        <h5 class="card-title text-white">{{$page_title}} ({{$type}})</h5>
                    </div>
                    <form action="{{route('asesmen-awal-dokter.update',$data_asesmen->FN_ID)}}" method="POST">
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
                                                                                <td width="15%" class="p-0"
                                                                                    style="vertical-align: top;">
                                                                                    <span
                                                                                        class="d-block fw-bold text-decoration-underline">Riwayat
                                                                                        Operasi</span>
                                                                                    <span class="d-block fst-italic"
                                                                                        style="">History of
                                                                                        Operation</span>
                                                                                </td>
                                                                                <td class="d-flex p-0">
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;">
                                                                                        :
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;width:;">
                                                                                        <textarea name="cRo" id=""
                                                                                            cols="30"
                                                                                            rows="5">{{$data_asesmen->FS_RO}}</textarea>
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
                                                                                        class="d-block fw-bold text-decoration-underline">Data
                                                                                        Obyektif</span>
                                                                                    <span class="d-block fst-italic"
                                                                                        style="">Objective Data</span>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="d-flex ">
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;width:15%">
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
                                                                                        style="margin-left:30px;width:10%;white-space:nowrap;">
                                                                                        Kesadaran :

                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;white-space:nowrap;">
                                                                                        <input type="text" class="" style="width: 150px;" value="{{$data_asesmen->FJ_DO['Kesadaran']}}"
                                                                                            name="cDoKesadaran">

                                                                                    </div>

                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;white-space:nowrap;">
                                                                                        GCS :

                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;white-space:nowrap;">E
                                                                                        <input type="text" class="" style="width: 150px;" value="{{$data_asesmen->FJ_DO['GCSE']}}"
                                                                                            name="cDoGCSE">

                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;white-space:nowrap;">V
                                                                                        <input type="text" class="" style="width: 150px;" value="{{$data_asesmen->FJ_DO['GCSV']}}"
                                                                                            name="cDoGCSV">

                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;white-space:nowrap;">M
                                                                                        <input type="text" class="" style="width: 150px;" value="{{$data_asesmen->FJ_DO['GCSM']}}"
                                                                                            name="cDoGCSM">

                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="d-flex ">
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;white-space:nowrap;">
                                                                                        TD :
                                                                                        <input type="text" class="" style="width: 100px;" value="{{$data_asesmen->FJ_DO['TD']}}"
                                                                                            name="cDoTD">
                                                                                        mmHg
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;white-space:nowrap;">
                                                                                        Nadi :
                                                                                        <input type="text" class="" style="width: 100px;" value="{{$data_asesmen->FJ_DO['Nadi']}}"
                                                                                            name="cDoNadi">
                                                                                        x/menit
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;white-space:nowrap;">
                                                                                        Respirasi :
                                                                                        <input type="text" class="" style="width: 100px;" value="{{$data_asesmen->FJ_DO['Respirasi']}}"
                                                                                            name="cDoRespirasi">
                                                                                        x/menit
                                                                                    </div>
                                                                                    <div class="m-r-1"
                                                                                        style="margin-left:30px;white-space:nowrap;">
                                                                                        Suhu :
                                                                                        <input type="text" class="" style="width: 100px;" value="{{$data_asesmen->FJ_DO['Suhu']}}"
                                                                                            name="cDoSuhu">
                                                                                        C
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
                                                <td class="fw-bold p-1">Pemeriksaan Fisik</td>
                                                <td class="fw-bold p-1">ORGAN TUBUH</td>
                                                <td class="fw-bold p-1">NORMAL</td>
                                                <td class="fw-bold p-1">JIKA TIDAK NORMAL / KELAINAN</td>
                                            </tr>
                                            <tr>
                                                <td rowspan="9">
                                                    <img src="{{asset('assets/images/pemeriksaan-fisik-dokter.png')}}"
                                                        class="w-100p" alt="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Kepala / <span class="fst-italic">Head</span></td>
                                                <td>
                                                    <input type="text" name="cPfKepalaNormal" style="width:100%;" value="{{$data_asesmen->FJ_PEMERIKSAAN_FISIK['KepalaNormal']}}">
                                                </td>
                                                <td>
                                                    <input type="text" name="cPfKepalaTidakNormal" style="width:100%;" value="{{$data_asesmen->FJ_PEMERIKSAAN_FISIK['KepalaTidakNormal']}}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Mulut / <span class="fst-italic">Mouth</span></td>
                                                <td>
                                                    <input type="text" name="cPfMulutNormal" style="width:100%;" value="{{$data_asesmen->FJ_PEMERIKSAAN_FISIK['MulutNormal']}}">
                                                </td>
                                                <td>
                                                    <input type="text" name="cPfMulutTidakNormal" style="width:100%;" value="{{$data_asesmen->FJ_PEMERIKSAAN_FISIK['MulutTidakNormal']}}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Leher / <span class="fst-italic">Neck</span></td>
                                                <td>
                                                    <input type="text" name="cPfLeherNormal" style="width:100%;" value="{{$data_asesmen->FJ_PEMERIKSAAN_FISIK['LeherNormal']}}">
                                                </td>
                                                <td>
                                                    <input type="text" name="cPfLeherTidakNormal" style="width:100%;" value="{{$data_asesmen->FJ_PEMERIKSAAN_FISIK['LeherTidakNormal']}}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Jantung / <span class="fst-italic">Cor</span></td>
                                                <td>
                                                    <input type="text" name="cPfJantungNormal" style="width:100%;" value="{{$data_asesmen->FJ_PEMERIKSAAN_FISIK['JantungNormal']}}">
                                                </td>
                                                <td>
                                                    <input type="text" name="cPfJantungTidakNormal" style="width:100%;" value="{{$data_asesmen->FJ_PEMERIKSAAN_FISIK['JantungTidakNormal']}}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Paru-paru / <span class="fst-italic">Pulmo</span></td>
                                                <td>
                                                    <input type="text" name="cPfParuParuNormal" style="width:100%;" value="{{$data_asesmen->FJ_PEMERIKSAAN_FISIK['ParuParuNormal']}}">
                                                </td>
                                                <td>
                                                    <input type="text" name="cPfParuParuTidakNormal" style="width:100%;" value="{{$data_asesmen->FJ_PEMERIKSAAN_FISIK['ParuParuTidakNormal']}}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Perut / <span class="fst-italic">Abdomen</span></td>
                                                <td>
                                                    <input type="text" name="cPfPerutNormal" style="width:100%;" value="{{$data_asesmen->FJ_PEMERIKSAAN_FISIK['PerutNormal']}}">
                                                </td>
                                                <td>
                                                    <input type="text" name="cPfPerutTidakNormal" style="width:100%;" value="{{$data_asesmen->FJ_PEMERIKSAAN_FISIK['PerutTidakNormal']}}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Alat Gerak / <span class="fst-italic">Extremities</span></td>
                                                <td>
                                                    <input type="text" name="cPfAlatGerakNormal" style="width:100%;" value="{{$data_asesmen->FJ_PEMERIKSAAN_FISIK['AlatGerakNormal']}}">
                                                </td>
                                                <td>
                                                    <input type="text" name="cPfAlatGerakTidakNormal" style="width:100%;" value="{{$data_asesmen->FJ_PEMERIKSAAN_FISIK['AlatGerakTidakNormal']}}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Anus & Genitalia <span class="fst-italic"></span></td>
                                                <td>
                                                    <input type="text" name="cPfAnusGenitaliaNormal" style="width:100%;" value="{{$data_asesmen->FJ_PEMERIKSAAN_FISIK['AnusGenitaliaNormal']}}">
                                                </td>
                                                <td>
                                                    <input type="text" name="cPfAnusGenitaliaTidakNormal" style="width:100%;" value="{{$data_asesmen->FJ_PEMERIKSAAN_FISIK['AnusGenitaliaTidakNormal']}}">
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
                                                    <input style="margin-bottom:5px" type="text" class="form-control" readonly value="({{optional(optional($data_asesmen)->getIcd())->FS_KD_ICD}}) {{optional(optional($data_asesmen)->getIcd())->FS_NM_ICD}}">
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


                            <div style="margin-top:20px;" class="hidden-temp">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-save"></i>
                                    SAVE
                                </button>

                                <a href="{{ redirect()->back()->getTargetUrl() }}" class="btn btn-danger">
                                    <i class="fa fa-arrow-left"></i>
                                    BACK {{$from}}
                                </a>
                                <a target="_blank" class="btn  btn-warning" href="{{route('asesmen-dokter.pdf',[$from,$id])}}">PRINT PDF</a>

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

    function PrintDiv(div) {
        $('.hidden-temp').hide();
        html2canvas(document.querySelector("#" + div)).then(canvas => {
            var doc = new jsPDF('p', 'mm', 'a3');
            console.log(doc);
            var width = doc.internal.pageSize.height;
            var height = doc.internal.pageSize.width;
            doc.addImage(canvas.toDataURL(), 'PNG', 5, 5, width - 135, height + 50);
            doc.save('ASESMEN-DOKTER.pdf');
            $('.hidden-temp').show();

        });
    }

    function downloadURI(uri, name) {
        var link = document.createElement("a");

        link.download = name;
        link.href = uri;
        document.body.appendChild(link);
        link.click();
        //after creating link you should delete dynamic link
        //clearDynamicLink(link);
    }

</script>
@endpush
