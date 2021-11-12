@extends('main')

@push('styles')

    <link rel="stylesheet" href="{{asset('assets/libs/datatable-downloads/buttons.dataTables.min.css')}}">
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
            width: 100%;
            font-size: 12px;
        }
        .tabel-riwayat thead tr {
            font-weight: bold;
            background: #B4C6E7;
            color: black;
                /* border-bottom: 2px solid black; */
        }
        .tabel-riwayat tbody tr:hover {
            background-color: #fdc18080;
        }

        .tabel-riwayat td {
            padding: 3px;
            border: 1px solid #EBEBEB;
        }
        .tabel-riwayat thead tr td {
                padding: 13px 2px;
            text-align: center;
        }


        /* ---------------------------------- */

        .tabel-riwayat-detail {
            border-collapse: collapse;
            width: 100%;
            font-size: 12px;
        }
        .tabel-riwayat-detail thead tr {
            font-weight: bold;
            background: #c5c5c5;
            color: #EBEBEB;
        }

        .tabel-riwayat-detail thead tr td {
            padding: 3px;
            border: 1px solid #EBEBEB;
            text-align: center;
        }

        .tabel-riwayat-detail tbody tr td {
            padding: 3px;
            border: 1px solid #ebebeb;
            /* text-align: center; */
        }
        .tabel-riwayat-detail tbody tr:first-child td {
            background: #FDC180;
            color: #000000;
        }

        .bg-tbl-detail-blue{
            background: #C1FEFF ;
        }


         .vertical-menu{
            display: none !important;
        }

        #page-topbar{
            display: none;
            /* margin-left: 0px !important; */
        }
        .main-content{
            margin-left: 0px !important;
        }
        .page-content{
            padding-top: 20px !important;
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
                            <h5 class="card-title text-white">{{ $page_title }}</h5>
                        </div>
                        <div class="card-body">
                            <form action="" method="get">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group row">
                                                <label for="">MEDICAL RECORD</label>
                                                <input  class="form-control form-control-sm" name="mr" type="text"  value="{{$header_resep_dokter[0]->fs_mr ?? ''}}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <table style="width: 100%;">
                                            <tr>
                                                <td style="color: #AA0909;font-weight:bold;">Pasien</td>
                                                <td><input type="text" class="form-control form-control-sm" value="{{$header_resep_dokter[0]->fs_kd_reg ?? ''}}" readonly></td>
                                                <td><input type="text" class="form-control form-control-sm" value="{{$header_resep_dokter[0]->fs_nm_pasien ?? ''}}" readonly></td>
                                            </tr>
                                            <tr>
                                                <td style="color: #AA0909;font-weight:bold;">Dokter</td>
                                                <td><input type="text" class="form-control form-control-sm" value="{{$header_resep_dokter[0]->fs_kd_peg ?? ''}}" readonly></td>
                                                <td><input type="text" class="form-control form-control-sm" value="{{$header_resep_dokter[0]->fs_nm_peg ?? ''}}" readonly></td>
                                            </tr>
                                            <tr>
                                                <td style="color: #AA0909;font-weight:bold;">Jaminan</td>
                                                <td><input type="text" class="form-control form-control-sm" value="{{$header_resep_dokter[0]->fs_kd_jaminan ?? ''}}" readonly></td>
                                                <td><input type="text" class="form-control form-control-sm" value="{{$header_resep_dokter[0]->fs_nm_jaminan ?? ''}}" readonly></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <button type="submit" class="d-none"></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">

                <div class="col-4">
                    <div class="box-header">
                        <h5 class="text-riwayat">Riwayat Resep Dokter</h5>
                    </div>
                    <div class="card" style="">
                        <div class="card-body">
                            <div class="box" style="border:0px solid black;min-height: 200px">
                                <div class="box-body">
                                    <div class="table-responsive">
                                        <table class="tabel-riwayat table-striped">
                                            <thead>
                                                <tr>
                                                    <td>NO RESEP</td>
                                                    <td>TGL</td>
                                                    <td>DOKTER</td>
                                                    <td>LAYANAN</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($riwayat_resep_dokter as $rrd)
                                                    <tr onclick="window.location='{{Request::url()}}?mr={{$no_mr}}&resep={{$rrd->fs_kd_resep}}';" style="cursor:pointer;{{$fs_kd_resep == $rrd->fs_kd_resep ? 'background:#FDC180' : '' }}">
                                                        <td>{{$rrd->fs_kd_resep}}</td>
                                                        <td>{{$rrd->fd_tgl_resep}}</td>
                                                        <td>{{$rrd->fs_nm_peg}}</td>
                                                        <td>{{$rrd->fs_nm_layanan}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <a href="{{route('riwayat.resep-dokter.index',['mr'=>$no_mr])}}" class="btn btn-outline-primary w-100" style="margin-bottom: 10px"><i class="icon " data-feather="refresh-ccw"></i>  Refresh</a>
                            {{-- <button class="btn btn-outline-success w-100"><i class="icon " data-feather="printer"></i> Cetak</button> --}}
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <div class="box-header">
                        <h5 class="text-riwayat">Detail</h5>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="box" style="border:0px solid black;">

                                <div class="box-body">
                                    <pre style="font-weight: 700;width:100%;background: #D6FEEA;border:1px solid black;border-radius:10px;padding:10px;height:400px;overflow:auto;font-family: monospace;"  name="" id="" >
{{$rumah_sakit[0]->fs_nm_rs ?? ''}}
{{$rumah_sakit[0]->fs_alm_rs ?? ''}}
Tlp : {{$rumah_sakit[0]->fs_tlp_rs ?? ''}}
{{-- {{$rumah_sakit[0]->FS_FAX_RS ?? ''}} --}}

                            R E S E P ({{$header_resep_dokter[0]->fs_kd_resep ?? ''}})

DOKTER          : {{$header_resep_dokter[0]->fs_nm_peg ?? ''}}
DARI            : {{$header_resep_dokter[0]->fs_nm_layanan ?? ''}}
Reg/M.R.        : {{$header_resep_dokter[0]->fs_mr ?? ''}} ({{$header_resep_dokter[0]->fs_kd_reg ?? ''}})
Tanggal         : {{date('d-m-Y',strtotime($header_resep_dokter[0]->fd_tgl_resep ?? '')) ?? ''}} / {{$header_resep_dokter[0]->fs_jam_resep ?? ''}}
--------------------------------------------------------------------------------------------------------------------
@foreach ($detail_resep as $dr)
R/ {{$dr->fs_nm_barang}}
S. {{$dr->fs_nm_aturan_pakai}}
                                                    No . {{$_self->numberToRomanRepresentation($dr->FN_QTY_ASLI)}}
--------------------------------------------------------------------------------------------------------------------
@endforeach


Pro             : {{$header_resep_dokter[0]->fs_nm_pasien ??''}}
Umur            : {{$header_resep_dokter[0]->fn_umur ??''}} Th {{$header_resep_dokter[0]->fn_umur_bulan ?? ''}} Bl
                                    </pre>

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
<script src="{{asset('assets/libs/datatable-downloads/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/libs/datatable-downloads/pdfmake.min.js')}}"></script>
<script src="{{asset('assets/libs/datatable-downloads/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/libs/datatable-downloads/buttons.print.min.js')}}"></script>

<script src="{{asset('assets/libs/datatable-downloads/jszip.min.js')}}"></script>
<script src="{{asset('assets/libs/datatable-downloads/vfs_fonts.js')}}"></script>
   <script src="{{asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>

    <script>

        let jumlah = @json($header_resep_dokter);
        jumlah = jumlah.length;

        if(jumlah < 1){
            Swal.fire({
                title: "Information !",
                text: "Data Not Found !",
                icon: "warning",
                // showCancelButton: !0,
                timer: 3000

                // confirmButtonColor: "#038edc",
                // cancelButtonColor: "#f34e4e"
            })
            setTimeout(() => {
                window.open('','_self').close()

            }, 1500);

        }


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
