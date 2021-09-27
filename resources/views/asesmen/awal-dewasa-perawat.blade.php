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
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">{{$page_title}}</h5>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-lg-6">
                                <table class=" w-100">
                                    <tr>
                                        <td class="leftCol" width="40%">
                                            <label for="">Nomor MR</label>
                                            <span style="float:right;" class="float-right">:&nbsp;</span>
                                        </td>
                                        <td class="rightCol" width="60%">
                                            <input type="text" >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="leftCol" width="40%">
                                            <label for="">Nomor MR</label>
                                            <span style="float:right;" class="float-right">:&nbsp;</span>
                                        </td>
                                        <td class="rightCol" width="60%">
                                            <input type="text" class="form-control form-control-sm" value="0281"
                                                readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="leftCol" width="40%">
                                            <label for="">Nama Pasien</label>
                                            <span style="float:right;" class="float-right">:&nbsp;</span>
                                        </td>
                                        <td class="rightCol" width="60%">
                                            <input type="text" class="form-control form-control-sm" value="CARISA AQILA"
                                                readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="leftCol" width="40%">
                                            <label for="">Tanggal Lahir</label>
                                            <span style="float:right;" class="float-right">:&nbsp;</span>
                                        </td>
                                        <td class="rightCol" width="60%">
                                            <input type="date" class="form-control form-control-sm" value="2013-12-03"
                                                readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="leftCol" width="40%">
                                            <label for="">Jenis Kelamin</label>
                                            <span style="float:right;" class="float-right">:&nbsp;</span>
                                        </td>
                                        <td class="rightCol" width="60%">
                                            <input type="text" class="form-control form-control-sm" value="PEREMPUAN"
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
                                            <input type="text" class="form-control form-control-sm" value="0281"
                                                readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="leftCol">
                                            <label for="">Tanggal Jam Masuk</label>
                                            <span style="float:right;" class="float-right">:&nbsp;</span>
                                        </td>
                                        <td class="rightCol">
                                            <input type="text" class="form-control form-control-sm"
                                                value="01-23-2021 14:30:12" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="leftCol">
                                            <label for="">Dokter DPJP</label>
                                            <span style="float:right;" class="float-right">:&nbsp;</span>
                                        </td>
                                        <td class="rightCol">
                                            <input type="text" class="form-control form-control-sm" value="dr.Rahayu"
                                                readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="leftCol">
                                            <label for="">Jaminan/ Cara Bayar</label>
                                            <span style="float:right;" class="float-right">:&nbsp;</span>
                                        </td>
                                        <td class="rightCol">
                                            <input type="text" class="form-control form-control-sm" value="BniLife"
                                                readonly>
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
                                            <select class="form-select form-select-sm" id="">
                                                <option value="">-- Pilih Profesi</option>
                                                <option value="">Dokter</option>
                                                <option value="">Perawat</option>
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
                                            <select class="form-select form-select-sm" id="">
                                                <option value="">-- Pilih Layanan/Bagian</option>
                                                <option value="">Umum Poli</option>
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
                                    <label for="" style=""><span style="font-weight: 700;font-size: 24px;">S</span>ubjective :</label>
                                    <textarea name="" class="form-control" id="" cols="30" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for=""><span style="font-weight: 700;font-size: 24px;">O</span>bjective :</label>
                                    <textarea name="" class="form-control" id="" cols="30" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for=""><span style="font-weight: 700;font-size: 24px;">A</span>ssesmen :</label>
                                    <textarea name="" class="form-control" id="" cols="30" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for=""><span style="font-weight: 700;font-size: 24px;">P</span>lan :</label>
                                            <table class=" w-100">
                                                <tr>
                                                    <td style="vertical-align: top">1.</td>
                                                    <td>
                                                        <textarea rows="2" type="text" class="form-control form-control-sm"></textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align: top">2.</td>
                                                    <td>
                                                        <textarea rows="2" type="text" class="form-control form-control-sm"></textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align: top">3.</td>
                                                    <td>
                                                        <textarea rows="2" type="text" class="form-control form-control-sm"></textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align: top">4.</td>
                                                    <td>
                                                        <textarea rows="3" type="text" class="form-control form-control-sm"></textarea>
                                                    </td>
                                                </tr>
                                            </table>

                                        </div>
                                        <div class="col-lg-6">
                                            
                                            <label for="" style="">
                                                <span style="font-size:22px;font-weight:400;">I</span>nstruksi PPA (Termasuk Pasca Bedah)</label>

                                            <table class=" w-100">
                                                <tr>
                                                    <td style="vertical-align: top">1.a</td>
                                                    <td>
                                                        <input type="text" class="form-control form-control-sm">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align: top">1.b</td>
                                                    <td>
                                                        <input type="text" class="form-control form-control-sm">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align: top">2.a</td>
                                                    <td>
                                                        <input type="text" class="form-control form-control-sm">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align: top">2.b</td>
                                                    <td>
                                                        <input type="text" class="form-control form-control-sm">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align: top">3.a</td>
                                                    <td>
                                                        <input type="text" class="form-control form-control-sm">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align: top">3.b</td>
                                                    <td>
                                                        <input type="text" class="form-control form-control-sm">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align: top">3.c</td>
                                                    <td>
                                                        <input type="text" class="form-control form-control-sm">
                                                    </td>
                                                </tr>
                                                 
                                            </table>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="margin-top:20px;">
                            <button class="btn btn-success">
                                <i class="fa fa-save"></i>
                                SAVE
                            </button>
                            <button class="btn btn-warning">
                                <i class="fa fa-save"></i>
                                VOID
                            </button>
                            <button class="btn btn-danger">
                                <i class="fa fa-arrow-left"></i>
                                BACK
                            </button>
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
