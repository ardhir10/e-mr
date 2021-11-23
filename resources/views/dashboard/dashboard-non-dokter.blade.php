@extends('main')


@push('styles')
<link
    rel="stylesheet"
    href="{{asset('assets/css/animate.min.css')}}"
  />
<style>
     .card-1 {
    --animate-duration: 0.5s;
    }
    .card-2 {
    --animate-duration: 0.8s;
    }
    .card-3 {
    --animate-duration: 1.1s;
    }
    .card-1{
        background-image: linear-gradient( 109.6deg,  rgba(45,116,213,1) 11.2%, rgba(121,137,212,1) 91.2% );
        min-height: 150px !important;
        color: white !important;
        border: 0px solid black !important;
        border-radius: 25px !important;
          box-shadow: 1px 3px 28px -7px rgb(0 0 0 / 71%);
    -webkit-box-shadow: 1px 3px 16px -7px rgb(0 0 0 / 71%);
    -moz-box-shadow: 1px 3px 28px -7px rgba(0,0,0,0.71);

    }
    .card-2{
background-image: linear-gradient( 99deg,  rgba(115,18,81,1) 10.6%, rgba(28,28,28,1) 118% );        min-height: 150px !important;
        color: white !important;
        border: 0px solid black !important;
        border-radius: 25px !important;
          box-shadow: 1px 3px 28px -7px rgb(0 0 0 / 71%);
    -webkit-box-shadow: 1px 3px 16px -7px rgb(0 0 0 / 71%);
    -moz-box-shadow: 1px 3px 28px -7px rgba(0,0,0,0.71);

    }
    .card-3{
        background-image: radial-gradient( circle farthest-corner at 10% 20%,  rgba(0,152,155,1) 0.1%, rgba(0,94,120,1) 94.2% );
        min-height: 150px !important;
        color: white !important;
        border: 0px solid black !important;
        border-radius: 25px !important;
          box-shadow: 1px 3px 28px -7px rgb(0 0 0 / 71%);
    -webkit-box-shadow: 1px 3px 16px -7px rgb(0 0 0 / 71%);
    -moz-box-shadow: 1px 3px 28px -7px rgba(0,0,0,0.71);

    }

    .text-card-d1{
            font-size: 20px;
            font-weight: 500;
            font-family: 'Roboto';
    }
    .text-card-d2{
            display: block;
    font-size: 57px !important;
    font-weight: 500;
    color: white;
    vertical-align: top;
    font-family: 'Roboto';
    }
</style>
@endpush

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
                    <div class="card" style="border-radius: 23px;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="">Selamat Datang , {{ Auth::user()->name }}</h5>
                                    <form action="">
                                        <div class="d-flex">
                                            <label>Tanggal : &nbsp;</label>
                                          <input type="text" name="date_from" class="form-control form-control-sm form-control flatpickr-input datepicker-basic" style="width: auto;"
                                            value="{{$request->date_from ?? date('d-m-Y')}}">
                                        &nbsp;
                                        <input type="text" name="date_to" class="form-control form-control-sm form-control flatpickr-input datepicker-basic" style="width: auto;"
                                            value="{{$request->date_to ?? date('d-m-Y')}}">
                                        <button class="btn btn-sm btn-primary" style="margin-left: 5px">Filter</button>
                                        </div>
                                    </form>
                                    <br>
                                </div>
                                <div class="col-xl-4 col-sm-6">
                                    <!-- Card -->
                                    <div class="card card-1 animate__animated  animate__fadeInUp"
                                        style="">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <div class="">
                                                    <span class="font-size-xs font-weight-bold text-card-d1">Pasien Rawat Jalan & IGD</span>
                                                    <h1 class="mt-1 font-weight-bold-flex align-items-center text-card-d2"
                                                            style="    font-size: 40px;font-weight: 500;">
                                                        {{ number_format($jml_pasien_rj, 0, ',', '.') }}
                                                    </h1>
                                                    <small style="font-weight: 500;font-style: italic;opacity: 0.5;">Jumlah pasien rawat jalan & IGD</small>
                                                </div>
                                                <img src="{{asset('assets/images/rawat-jalan-warna.png')}}" alt="" style="height:120px;width: auto;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-sm-6">
                                    <!-- Card -->
                                    <div class="card card-2 animate__animated  animate__fadeInUp"
                                        style="color:#ffffff !important;border:1px solid black">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <span class="font-size-xs text-card-d1">Pasien R.Inap Masuk Baru</span>
                                                    <h1 class="mt-1 font-weight-bold-flex align-items-center text-card-d2"
                                                            style="    font-size: 40px;font-weight: 500;">
                                                        {{ number_format(count($jml_pasien_terkini), 0, ',', '.') }}
                                                    </h1>
                                                    <small style="font-weight: 500;font-style: italic;opacity: 0.5;">Jumlah pasien rawat inap masuk baru</small>
                                                </div>
                                                <img src="{{asset('assets/images/ri2.png')}}" alt="" style="height:120px;width: auto;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-sm-6">
                                    <!-- Card -->
                                    <div class="card card-3 animate__animated  animate__fadeInUp"
                                        style="">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                               <div>
                                                    <span class="font-size-xs text-card-d1">Pasien R.Inap Terkini</span>
                                                    <h1 class="mt-1 font-weight-bold-flex align-items-center text-card-d2"
                                                            style="    font-size: 40px;font-weight: 500;">
                                                        {{ number_format(count($jml_pasien_ri), 0, ',', '.') }}
                                                    </h1>
                                                    <small style="font-weight: 500;font-style: italic;opacity: 0.5;">Jumlah pasien rawat inap terkini </small>
                                                </div>
                                                <img src="{{asset('assets/images/rawat-inap.png')}}" alt="" style="height:120px;width: auto;">
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
                <div class="card animate__animated animate__fadeInUpBig" style="border-radius: 23px;">
                        <div class="card-header">
                            <span class="fw-bold font-size-xs card-title text-uppercase">Grafik Bulanan Pasian Rawat Jalan & IGD</span>
                        <select id="chartBulanan" class="form-seelct form-control-sm"   onchange="getData()" style=" float: right;width: auto;" name="year">
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
                                <div id="" class="" style="padding:20px;height: 450px;width:100%;border-radius:30px">
                                    <div class="dashboard-statistic" id="dashboard-statistic" style="height: 100%"></div>

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
                    type: 'bar',
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
            resizeChart('dashboard-statistic');
        }
    </script>
@endpush
