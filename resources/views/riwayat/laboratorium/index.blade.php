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
                        background: #B4C6E7;

            color: black;

        }

        .tabel-riwayat-detail thead tr td {
            border: 1px solid #EBEBEB;

             padding: 13px 2px;
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

        .footer{
            display: none !important;
        }
        .case-0::before {
        /* content: "Read this -"; */
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
                            <div class="row">
                                {{-- <div class="col-4">
                                    <form action="" method="get">
                                        <div class="form-group row">
                                            <div class="col-2">
                                                <label for="" style="color: #AA0909;">MR :</label>
                                            </div>
                                            <div class="col-6 ">
                                                <input class="form-control form-control-sm" name="mr" value="{{$fs_mr}}" type="text" placeholder="">
                                            </div>
                                            <div class="col-4">
                                                <button class="btn btn-sm btn-success">Cari Pasien (MR)</button>
                                            </div>
                                        </div>
                                    </form>
                                </div> --}}
                                <div class="col-6">
                                    <table class="w-100">
                                        <tr>
                                            <td align="left"><label for="">No. Lab : </label></td>
                                            <td><input class="form-control form-control-sm" type="text" placeholder="" value="{{$header[0]->fs_kd_hasil ?? ''}}"
                                                    readonly></td>
                                        </tr>
                                        <tr>
                                            <td align="left"> <label for="">Nama Pasien : </label></td>
                                            <td><input class="form-control form-control-sm" type="text"
                                                    placeholder="" value="{{$header[0]->fs_nm_pasien ?? ''}}" readonly></td>
                                        </tr>
                                        <tr>
                                            <td align="left"> <label for="">J.Kel / Umur: </label></td>
                                            <td>
                                                @if (isset($header[0]))
                                                <input class="form-control form-control-sm" type="text" placeholder="" value="{{($header[0]->fb_jns_kelamin   == 1) ? 'Perempuan' : 'Laki - Laki' }} / {{$_self->hitungUmur($header[0]->fd_tgl_lahir)}}" readonly>
                                                @else
                                                <input class="form-control form-control-sm" type="text" placeholder="" value="" readonly>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-6">
                                    <table class="w-100">
                                        <tr>
                                            <td align="left">
                                                <label for="">REG : </label>

                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <span class="fw-thin"
                                                        style="margin-right:10px;margin-left:10px;color:black">
                                                        {{$header[0]->fs_kd_reg ?? ''}}</span>
                                                    <label for="">MR : </label>
                                                    <span class="fw-thin"
                                                        style="margin-right:10px;margin-left:10px;color:black">
                                                        {{$header[0]->fs_mr ?? ''}}</span>
                                                    <label for="">LAHIR : </label>

                                                    <span class="fw-thin" style="margin-left:10px;color:black">
                                                      {{date('d-m-Y',strtotime($header[0]->fd_tgl_lahir ?? '')) ?? ''}}</span>

                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="left"> <label for="">Dr. Pengirim : </label></td>
                                            <td><input class="form-control form-control-sm"  value="{{$header[0]->fs_dokter_pengirim ?? ''}}" type="text" placeholder="" readonly></td>
                                        </tr>
                                        <tr>
                                            <td align="left"> <label for="">Dr. Pemeriksa : </label></td>
                                            <td><input class="form-control form-control-sm"  value="{{$header[0]->fs_nm_peg ?? ''}}" type="text" placeholder="" readonly></td>
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
                                        <table class="tabel-riwayat table-striped">
                                            <thead>
                                                <tr>
                                                    <td>TANGGAL</td>
                                                    <td>REG</td>
                                                    <td>NO LAB</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($riwayat as $rw)

                                                <tr onclick="window.location='{{Request::url()}}?mr={{$rw->fs_mr}}&lab={{$rw->fs_kd_hasil}}';" style="cursor:pointer;{{$fs_kd_hasil == $rw->fs_kd_hasil ? 'background:#FDC180' : '' }}" >
                                                    <td>{{date('d-m-Y',strtotime($rw->fd_tgl_sample))}}</td>
                                                    <td>{{$rw->fs_kd_reg}}</td>
                                                    <td>{{$rw->fs_kd_hasil}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <a href="{{route('riwayat.laboratorium.index',['mr'=>$header[0]->fs_mr ?? ''])}}" class="btn btn-outline-primary w-100" style="margin-bottom: 10px"><i class="icon " data-feather="refresh-ccw"></i>  Refresh</a>

                            {{-- <button class="btn btn-outline-success w-100"><i class="icon " data-feather="printer"></i> Cetak</button> --}}
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

                                                @foreach ($detail as $dtl)
                                                @switch($dtl->fn_tab)
                                                    @case(0)
                                                        <tr style="background: white;color:blue;">
                                                            <td>
                                                                <span class="fw-bold font-italic case-0"><em>{{$dtl->fs_nm_periksa}}</em></span>
                                                            </td>
                                                              <td class="bg-tbl-detail-blue"></td>
                                                            <td></td>
                                                            <td class="bg-tbl-detail-blue"></td>
                                                            <td></td>
                                                        </tr>
                                                        @break
                                                    @case(1)
                                                        <tr style="">
                                                            <td>
                                                                <span class="fw-bold font-italic text-riwayat"
                                                                    style="margin-left: 20px;"><em>{{$dtl->fs_nm_periksa}}</em></span>
                                                            </td>
                                                            <td class="bg-tbl-detail-blue"></td>
                                                            <td></td>
                                                            <td class="bg-tbl-detail-blue"></td>
                                                            <td></td>
                                                        </tr>
                                                        @break
                                                    @case(2)
                                                        <tr style="">
                                                            <td>
                                                                <span class=" font-italic "
                                                                    style="margin-left: 40px;">{{$dtl->fs_nm_periksa}}</span>
                                                            </td>
                                                            <td class="bg-tbl-detail-blue">{{$dtl->fs_ket_hasil}}</td>
                                                            <td>{{$dtl->fs_nm_satuan}}</td>
                                                            <td class="bg-tbl-detail-blue text-center">
                                                                @if ($dtl->fs_normal_kualitatif != ' ')
                                                                    {{$dtl->fs_normal_kualitatif}}
                                                                @else
                                                                    {{($dtl->fn_batas_bawah < 1 ) ? number_format($dtl->fn_batas_bawah,1) : number_format($dtl->fn_batas_bawah,0)}} - {{($dtl->fn_batas_bawah < 1 ) ? number_format($dtl->fn_batas_atas,1) : number_format($dtl->fn_batas_atas,0)}}
                                                                @endif
                                                            </td>
                                                            <td>{{$dtl->fs_catatan}}</td>
                                                        </tr>
                                                        @break
                                                    @default

                                                @endswitch



                                                @endforeach

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
    <script src="{{asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>

    <script>

        let jumlah = @json($header);
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
