@extends('main')


@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Dashboard</h4>

                    {{-- <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashonic</a></li>
                            <li class="breadcrumb-item active">Sales Analytics</li>
                        </ol>
                    </div> --}}

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-3 col-sm-6">
                <!-- Card -->
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="font-size-xs text-uppercase">Total Rekam Medis</h6>
                                <h4 class="mt-4 font-weight-bold mb-2 d-flex align-items-center" style="    font-size: 46px;
    font-weight: 500;
    color: #A1CB47;">
                                    {{number_format($total_rekam_medis->jrm,0,',','.')}}
                                </h4>
                                <a href="{{route('rekam-medis.index')}}" class="text-muted">Lihat Detail </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <!-- Card -->
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="font-size-xs text-uppercase">Total Rawat Jalan</h6>
                                <h4 class="mt-4 font-weight-bold mb-2 d-flex align-items-center" style="    font-size: 46px;
    font-weight: 500;
    color: #1965AA;">
                                    {{number_format(count($total_rawat_jalan),0,',','.')}}

                                </h4>
                                <a href="{{route('rawat-jalan.index')}}" class="text-muted">Lihat Detail </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <!-- Card -->
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="font-size-xs text-uppercase">Total Rawat Inap</h6>
                                 <h4 class="mt-4 font-weight-bold mb-2 d-flex align-items-center" style="    font-size: 46px;
    font-weight: 500;
    color: #E76D19;">
                                    {{number_format(count($total_rawat_inap),0,',','.')}}
                                </h4>
                                <a href="{{route('rawat-inap.index')}}" class="text-muted">Lihat Detail </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


        </div> <!-- end row-->



    </div>
    <!-- container-fluid -->
</div>
@endsection
