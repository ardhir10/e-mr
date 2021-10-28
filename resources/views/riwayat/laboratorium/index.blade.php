@extends('main')

@push('styles')
<style>
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

    .text-riwayat {
        color: #AA0909 !important;
    }

    .tabel-riwayat {
        border-collapse: collapse;
        border: 1px solid black;
        width: 100%
    }

    .tabel-riwayat td {
        padding: 3px;
        border: 1px solid black;
        text-align: center;
    }

     .tabel-riwayat-detail{
                 border-collapse: collapse;
        width: 100%

     }
    .tabel-riwayat-detail thead tr td {
        padding: 3px;
        border: 1px solid black;
        text-align: center;
    }

    .tabel-riwayat-detail tbody tr td {
        padding: 3px;
        border: 1px solid #ebebeb;
        /* text-align: center; */
    }

</style>

@endpush

@section('content')
<div class="page-content">
    <div class="container-fluid">


        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header " style="background: #24B14C;padding:8px">
                        <h5 class="card-title text-white">{{$page_title}}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group row">
                                    <div class="col-2">
                                        <label for="" style="color: #AA0909;">MR :</label>
                                    </div>
                                    <div class="col-6 ">
                                        <input class="form-control form-control-sm" type="text" placeholder="">
                                    </div>
                                    <div class="col-4">
                                        <button class="btn btn-sm btn-success">Cari Pasien (MR)</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <table class="w-100">
                                    <tr>
                                        <td align="right"><label for="">No. Lab : </label></td>
                                        <td><input class="form-control form-control-sm" type="text" placeholder="123442"
                                                readonly></td>
                                    </tr>
                                    <tr>
                                        <td align="right"> <label for="">Nama Pasien : </label></td>
                                        <td><input class="form-control form-control-sm" type="text"
                                                placeholder="Ardhi Ramadhan" readonly></td>
                                    </tr>
                                    <tr>
                                        <td align="right"> <label for="">J.Kel / Umur: </label></td>
                                        <td><input class="form-control form-control-sm" type="text"
                                                placeholder="Laki - Laki / 23" readonly></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-5">
                                <table class="w-100">
                                    <tr>
                                        <td align="right">
                                            <label for="">REG : </label>

                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <span class="fw-thin"
                                                    style="margin-right:10px;margin-left:10px;color:black">
                                                    1912312</span>
                                                <label for="">MR : </label>
                                                <span class="fw-thin"
                                                    style="margin-right:10px;margin-left:10px;color:black">
                                                    00001232</span>
                                                <label for="">LAHIR : </label>
                                                <span class="fw-thin" style="margin-left:10px;color:black">
                                                    {{date('Y-m-d')}}</span>

                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right"> <label for="">Dr. Pengirim : </label></td>
                                        <td><input class="form-control form-control-sm" type="text" placeholder=""></td>
                                    </tr>
                                    <tr>
                                        <td align="right"> <label for="">Dr. Pemeriksa : </label></td>
                                        <td><input class="form-control form-control-sm" type="text" placeholder=""></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <div class="box-header">
            <h5 class="text-riwayat">Riwayat Pemeriksaan</h5>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="card" style="">
                    <div class="card-body">
                        <div class="box" style="border:0px solid black;min-height: 200px">
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="tabel-riwayat">
                                        <thead>
                                            <tr>
                                                <td>TANGGAL</td>
                                                <td>REG</td>
                                                <td>NO LAB</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr style="background: #FDC180">
                                                <td>20-01-2021</td>
                                                <td>00000023432</td>
                                                <td>LB87863478</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <button class="btn btn-outline-dark w-100" style="margin-bottom: 10px">Refresh</button>
                        <button class="btn btn-outline-dark w-100">Cetak</button>
                    </div>
                </div>
            </div>
            <div class="col-8">
                 <div class="card">
                    <div class="card-body">
                        <div class="box" style="border:0px solid black;">

                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="tabel-riwayat-detail">
                                        <thead>
                                            <tr>
                                                <td>JENIS PEMERIKSAAN</td>
                                                <td>HASIL</td>
                                                <td>SATUAN</td>
                                                <td>NILAI NORMAL</td>
                                                <td>CATATAN</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{--  --}}
                                            <tr style="background: #FDC180">
                                                <td>
                                                    <span class="fw-bold font-italic"><em>HEMATOLOGI</em></span>
                                                </td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr style="">
                                                <td>
                                                    <span class="fw-bold font-italic text-riwayat" style="margin-left: 20px;"><em>HEMATOLOGI LENGKAP</em></span>
                                                </td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
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
        "order": [
            [0, "desc"]
        ],
        "columnDefs": [{
                "orderable": false,
                "targets": [3]
            },
            {
                "orderable": true,
                "targets": [
                    [0, "desc"], 1, 2
                ]
            }
        ]
        //   "ordering": false
    });

</script>
@endpush
