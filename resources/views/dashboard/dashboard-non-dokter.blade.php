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


            <div class="row ">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="">Selamat Datang , {{ Auth::user()->name }}</h5>
                                    <form action="">
                                        <div class="d-flex">
                                            <label>Tanggal : &nbsp;</label>
                                            <input type="date" name="date_from" class="" value="{{$request->date_from ?? date('Y-m-d')}}">
                                            &nbsp;
                                            <input type="date" name="date_to" class="" value="{{$request->date_to ?? date('Y-m-d')}}">
                                            <button>Filter</button>
                                        </div>
                                    </form>
                                    <br>
                                </div>
                                <div class="col-xl-4 col-sm-6">
                                    <!-- Card -->
                                    <div class="card"
                                        style="background: #8EAADC;color:black !important;border:1px solid black">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <h6 class="font-size-xs ">Jml Pasien R.Jalan & IGD</h6>
                                                    <h5 class="mt-2 font-weight-bold mb-2 d-flex align-items-center"
                                                        style="    font-size: 40px;font-weight: 500;">
                                                        {{ number_format(count($jml_pasien_rj), 0, ',', '.') }}
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-sm-6">
                                    <!-- Card -->
                                    <div class="card"
                                        style="background: #315496;color:#ffffff !important;border:1px solid black">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <h6 class="font-size-xs " style="color:#ffffff !important;">Pasien R.Inap Masuk Baru</h6>
                                                    <h5 class="mt-2 font-weight-bold mb-2 d-flex align-items-center"
                                                        style="    font-size: 40px;font-weight: 500;color:#ffffff !important;">
                                                        -
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-sm-6">
                                    <!-- Card -->
                                    <div class="card"
                                        style="background: #FFE699;color:#000000 !important;border:1px solid black">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <h6 class="font-size-xs " style="color:#000000 !important;">Pasien
                                                        R.Inap Terkini</h6>
                                                    <h5 class="mt-2 font-weight-bold mb-2 d-flex align-items-center"
                                                        style="    font-size: 40px;font-weight: 500;color:#000000 !important;">
                                                        {{ number_format(count($jml_pasien_ri), 0, ',', '.') }}
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                            <span class="fw-bold font-size-xs card-title text-uppercase">Grafik Bulanan Pasian Rawat Jalan & IGD</span>
                             <select id="chartBulanan" onchange="getData()" style=" float: right;" name="year" >
                                {{ $last= date('Y')-120 }}
                                {{ $now = date('Y') }}
                                @for ($i = $now; $i >= $last; $i--)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                            <span class="badge bg-info d-none" id="getDataLoading" style=" float: right; margin-right: 15px;">Processing ...</span>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div id="" style="padding:20px;height: 450px;width:100%;border-radius:30px">
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
     <script src="{{ asset('/assets') }}/libs/echart/echarts.min.js"></script>
    <script src="{{ asset('/assets') }}/libs/axios/axios.min.js"></script>


    <script>
        getData();
        async function getData(){
            let tahun = $('#chartBulanan').val();
            $('#getDataLoading').removeClass('d-none');
            let data = await axios.post("{{route('api.dashboard-rawat-jalan-non-dokter')}}",
                {
                    "tahun" : tahun
                }
            );
            $('#getDataLoading').addClass('d-none');
            generateChart(data.data);
            console.log(data);
        }


        function generateChart(data){
            var barColors = [
            ['rgba(176,196,222, 0.3)', 'rgba(176,196,222, 1)'],
            ['rgba(220,20,60, 0.3)', 'rgba(220,20,60, 1)'],
            ['rgba(189,183,107, 0.3)', 'rgba(189,183,107, 1)'],
            ['rgba(47,79,79, 0.3)', 'rgba(47,79,79, 1)'],
            ['rgba(30,144,255, 0.3)', 'rgba(30,144,255, 1)'],
            ['rgba(112,128,144, 0.3)', 'rgba(112,128,144, 1)'],
            ];
            var chartDom = document.getElementById('dashboard-statistic');
            var myChart = echarts.init(chartDom);
            var option;
            var graphic = echarts.graphic;

            option = {
                xAxis: {
                    type: 'category',
                    boundaryGap: false,
                    data: data['months']
                },
                yAxis: {
                    type: 'value'
                },
                tooltip: {
                    trigger: 'axis',
                    axisPointer: {
                        type: 'cross',
                        label: {
                            backgroundColor: '#6a7985'
                        }
                    }
                },
                grid: {
                    left: '3%',
                    right: '4%',
                    bottom: '3%',
                    containLabel: true
                },

                series: [{

                    label: {
                        show: true,
                        position: "inside",
                        distance: 6.5,
                        offset: [0, 2],
                        color: "#ffffff",
                        fontWeight: "normal",
                        backgroundColor: "#267EDC",
                        // borderColor: "rgba(0, 255, 55, 1)",
                        // borderWidth: 1.5,
                        // borderDashOffset: 5,
                        borderType: "solid",
                        padding: [3, 3, 3, 3]
                    },
                    data: data['vals'],
                    type: 'line',
                    itemStyle:{
                        color:'#267EDC'
                    },
                    areaStyle: {
                        color: new graphic.LinearGradient(0, 0, 0, 1, [{
                            offset: 0,
                            color: '#A2D0FF'
                        },
                        {
                            offset: 1,
                            color: '#D9EEFF'
                        }
                        ]),
                    }
                }]
            };

            option && myChart.setOption(option);
        }
    </script>
@endpush
