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
            <div class="col-xl-4 col-sm-6">
                <!-- Card -->
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="font-size-xs text-uppercase">Total Rekam Medis</h6>
                                <h5 class="mt-2 font-weight-bold mb-2 d-flex align-items-center"
                                    style="    font-size: 40px;font-weight: 500;color: #A1CB47;">
                                    {{number_format($total_rekam_medis->jrm,0,',','.')}}
                                </h5>
                                <a href="{{route('rekam-medis.index')}}" class="text-muted">Lihat Detail </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6">
                <!-- Card -->
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="font-size-xs text-uppercase">Total Rawat Jalan</h6>
                                <h5 class="mt-2 font-weight-bold mb-2 d-flex align-items-center"
                                    style="    font-size: 40px;font-weight: 500;color: #1965AA;">
                                    {{number_format(count($total_rawat_jalan),0,',','.')}}

                                </h5>
                                <a href="{{route('rawat-jalan.index')}}" class="text-muted">Lihat Detail </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6">
                <!-- Card -->
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="font-size-xs text-uppercase">Total Rawat Inap</h6>
                                <h5 class="mt-2 font-weight-bold mb-2 d-flex align-items-center"
                                    style="    font-size: 40px;font-weight: 500;color: #E76D19;">
                                    {{number_format(count($total_rawat_inap),0,',','.')}}
                                </h5>
                                <a href="{{route('rawat-inap.index')}}" class="text-muted">Lihat Detail </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>



        </div> <!-- end row-->
        <div class="row">
            <div class="col-xl-12 col-sm-12">
                <!-- Card -->
                <div class="card">
                    <div class="card-header">
                        <h6 class="font-size-xs card-title text-uppercase">Last Year Statistic</h6>

                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div id=""
                                style="padding:20px;height: 450px;width:100%;background:#100C2A;border-radius:30px">
                                <div id="dashboard-statistic" style="height: 100%"></div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>


        </div>



    </div>
    <!-- container-fluid -->
</div>
@endsection

@push('scripts')
<link rel="stylesheet" href="">
<script src="{{asset('/assets')}}/libs/echart/echarts.min.js"></script>


<script>
    generateChart();

    function generateChart() {

        var chartDom = document.getElementById('dashboard-statistic');
        var myChart = echarts.init(chartDom, 'dark');
        var option;

        option = {
            legend: {},
            xAxis: [{
                    type: 'category',
                    data: @json($chart['ts']['rm']),
                    position: 'bottom',
                },
                {
                    type: 'category',
                    data: @json($chart['ts']['rj']),
                    position: 'bottom',
                    offset: 20

                },
                {
                    type: 'category',
                    data: @json($chart['ts']['ri']),
                    position: 'bottom',
                    offset: 40

                },

            ],
            yAxis: {
                type: 'value'
            },
            grid: {
                top: "10%",
                left: "8%",
                bottom: "20%",
                right: "8%",
            },
            dataZoom: {
                type: "inside"
            },
            tooltip: {
                trigger: 'axis'
            },
            series: [{
                    name: "Rekam Medis",
                    data: @json($chart['series']['rm']),
                    type: 'line',
                    symbol: 'rect',
                    symbolSize: 6,

                    xAxisIndex: 0,
                    itemStyle: {
                        color: '#A1CB47'
                    },
                    lineStyle: {
                        width: 1
                    }
                },
                {
                    name: "Rawat Jalan",
                    data: @json($chart['series']['rj']),
                    type: 'line',
                    symbol: 'circle',
                    symbolSize: 6,

                    xAxisIndex: 1,
                    itemStyle: {
                        color: '#1965AA'
                    },
                    lineStyle: {
                        width: 1
                    }
                },
                {
                    name: "Rawat Inap",
                    data: @json($chart['series']['ri']),
                    type: 'line',
                    symbol: 'circle',
                    symbolSize: 6,
                    xAxisIndex: 2,
                    itemStyle: {
                        color: '#E76D19'
                    },
                    lineStyle: {
                        width: 1
                    }
                },

            ]
        };

        option && myChart.setOption(option);

    }

</script>
@endpush
