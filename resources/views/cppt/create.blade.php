@extends('main')


@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">E-MR</a></li>
                            <li class="breadcrumb-item ">Rekam Medis</li>
                            <li class="breadcrumb-item active">Buat CPPT</li>
                        <li class="breadcrumb-item active">{{$from}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
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
                                    <input type="hidden" class="form-control form-control-sm" name="cFrom"
                                                    value="{{$from}}" readonly>
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
                                    <div class="form-group">
                                        <label for="" style=""><span
                                                style="font-weight: 700;font-size: 24px;">S</span>ubjective
                                        </label><span class="text-danger">*</span>:
                                        <textarea name="cSubjective" class="form-control" id="" cols="30"
                                            rows="3">{{old('cSubjective')}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for=""><span style="font-weight: 700;font-size: 24px;">O</span>bjective
                                        </label><span class="text-danger">*</span>:
                                        <textarea name="cObjective" class="form-control" id="" cols="30"
                                            rows="3">{{old('cObjective')}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for=""><span style="font-weight: 700;font-size: 24px;">A</span>ssesmen
                                        </label><span class="text-danger">*</span> :
                                        <textarea name="cAssesmen" class="form-control" id="" cols="30"
                                            rows="3">{{old('cAssesmen')}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <label for=""><span
                                                        style="font-weight: 700;font-size: 24px;">P</span>lan :</label>
                                                <br>
                                                <label for="" style="">
                                                    <span class=""
                                                        style="font-size:22px;font-weight:400;">I</span>nstruksi PPA
                                                    (Termasuk Pasca Bedah)</label>

                                                <table class=" w-100">
                                                    <tr>
                                                        <td style="vertical-align: top">1.</td>
                                                        <td>
                                                            <textarea rows="2" name="cPlan1" type="text"
                                                                class="form-control form-control-sm">{{old('cPlan1')}}</textarea>
                                                            <table style="width: 100%">
                                                                <tr>
                                                                    <td style="vertical-align: top">1.a</td>
                                                                    <td>
                                                                        <input type="text" name="cIppa1a"
                                                                            value="{{old('cIppa1a')}}"
                                                                            class="form-control form-control-sm">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="vertical-align: top">1.b</td>
                                                                    <td>
                                                                        <input type="text" name="cIppa1b"
                                                                            value="{{old('cIppa1b')}}"
                                                                            class="form-control form-control-sm">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="vertical-align: top">1.c</td>
                                                                    <td>
                                                                        <input type="text" name="cIppa1c"
                                                                            value="{{old('cIppa1c')}}"
                                                                            class="form-control form-control-sm">
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="vertical-align: top">2.</td>
                                                        <td>
                                                            <textarea rows="2" name="cPlan2" type="text"
                                                                class="form-control form-control-sm">{{old('cPlan2')}}</textarea>
                                                            <table style="width: 100%">
                                                                <tr>
                                                                    <td style="vertical-align: top">2.a</td>
                                                                    <td>
                                                                        <input type="text" name="cIpp2a"
                                                                            value="{{old('cIpp2a')}}"
                                                                            class="form-control form-control-sm">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="vertical-align: top">2.b</td>
                                                                    <td>
                                                                        <input type="text" name="cIppa2b"
                                                                            value="{{old('cIppa2b')}}"
                                                                            class="form-control form-control-sm">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="vertical-align: top">2.c</td>
                                                                    <td>
                                                                        <input type="text" name="cIppa2c"
                                                                            value="{{old('cIppa2c')}}"
                                                                            class="form-control form-control-sm">
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="vertical-align: top">3.</td>
                                                        <td>
                                                            <textarea rows="2" name="cPlan3" type="text"
                                                                class="form-control form-control-sm">{{old('cPlan3')}}</textarea>
                                                            <table style="width: 100%">

                                                                <tr>
                                                                    <td style="vertical-align: top">3.a</td>
                                                                    <td>
                                                                        <input type="text" name="cIppa3a"
                                                                            value="{{old('cIppa3a')}}"
                                                                            class="form-control form-control-sm">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="vertical-align: top">3.b</td>
                                                                    <td>
                                                                        <input type="text" name="cIppa3b"
                                                                            value="{{old('cIppa3b')}}"
                                                                            class="form-control form-control-sm">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="vertical-align: top">3.c</td>
                                                                    <td>
                                                                        <input type="text" name="cIppa3c"
                                                                            value="{{old('cIppa3b')}}"
                                                                            class="form-control form-control-sm">
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="vertical-align: top">4.</td>
                                                        <td>
                                                            <textarea rows="3" name="cPlan4" type="text"
                                                                class="form-control form-control-sm">{{old('cPlan4')}}</textarea>
                                                             <table style="width: 100%">

                                                                <tr>
                                                                    <td style="vertical-align: top">4.a</td>
                                                                    <td>
                                                                        <input type="text" name="cIppa4a"
                                                                            value="{{old('cIppa4a')}}"
                                                                            class="form-control form-control-sm">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="vertical-align: top">4.b</td>
                                                                    <td>
                                                                        <input type="text" name="cIppa4b"
                                                                            value="{{old('cIppa4b')}}"
                                                                            class="form-control form-control-sm">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="vertical-align: top">4.c</td>
                                                                    <td>
                                                                        <input type="text" name="cIppa4c"
                                                                            value="{{old('cIppa4c')}}"
                                                                            class="form-control form-control-sm">
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>

                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
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
<script>
    $('#data-table').DataTable({});

</script>
@endpush
