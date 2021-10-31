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
            border: 1px solid #B0B3BC;
            width: 100%;
            font-size: 12px;
        }

        .table  tbody tr:first-child {
               background: #FDC180 !important;
            color: #000000;
        }
        .tabel-riwayat thead tr {
            font-weight: bold;
            background: #c5c5c5;
            color: black;
        }


        .bg-tbl-detail-blue{
            background: #C1FEFF ;
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
                                    <div class="col-6">
                                        <div class="form-group row">
                                            <div class="col-1">
                                                <label for="">MR</label>
                                            </div>
                                            <div class="col-8">
                                                <input  class="form-control form-control-sm" name="mr" type="text"  value="{{$fs_mr}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group row">
                                            <div class="col-3">
                                                <label for="">NAMA PASIEN</label>
                                            </div>
                                            <div class="col-8">
                                                <input  class="form-control form-control-sm" type="text" name="nama_pasien"  value="{{$riwayat_singkat[0]->FS_NM_PASIEN ?? ''}}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="d-none"></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="">
                            <table class="table table-striped tabel-riwayat">
                                <thead>
                                    <tr>
                                        <th>REGISTER</th>
                                        <th>IN</th>
                                        <th>JAM</th>
                                        <th>OUT</th>
                                        <th>LAYANAN</th>
                                        <th>DOKTER</th>
                                        <th>ICD</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach ($riwayat_singkat as $rs)
                                    <tr>
                                        <td>{{$rs->fs_kd_reg}}</td>
                                        <td>{{date('d-m-Y',strtotime($rs->fd_tgl_masuk))}}</td>
                                        <td>{{$rs->fs_jam_masuk}}</td>
                                        <td>{{date('d-m-Y',strtotime($rs->fd_tgl_keluar))}}</td>
                                        <td>{{$rs->fs_nm_layanan}}</td>
                                        <td>{{$rs->fs_nm_peg}}</td>
                                        <td>{{$rs->fs_kd_diagnosa}}</td>
                                    </tr>
                                   @endforeach
                                </tbody>
                            </table>

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
    <script>

        $('.tabel-riwayat').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        } );
        // $('.tabel-riwayat').DataTable({
        //     "pageLength": 100,
        //  dom: 'Bfrtip',
        //     buttons: [
        //         'copy', 'csv', 'excel', 'pdf', 'print'
        //     ]});
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
