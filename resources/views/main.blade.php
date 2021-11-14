<!doctype html>
<html lang="en">


<head>

    <meta charset="utf-8" />
    <title>Solvus | E- MR</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('/assets')}}/images/logo-solvus-small.jpeg">

    <!-- plugin css -->
    <link href="{{asset('/assets')}}/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="{{asset('/assets')}}/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('/assets')}}/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('/assets')}}/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    <link href="{{asset('/assets')}}/libs/datatables.net-dt/css/jquery.dataTables.min.css" id="app-style"
        rel="stylesheet" type="text/css" />
    <link href="{{asset('/assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />


    <!-- alertifyjs Css -->
    <link href="{{asset('/assets')}}/libs/alertifyjs/build/css/alertify.min.css" rel="stylesheet" type="text/css" />
    <!-- alertifyjs default themes  Css -->
    <link href="{{asset('/assets')}}/libs/alertifyjs/build/css/themes/default.min.css" rel="stylesheet" type="text/css" />

    @stack('styles')
    <style>
        .breadcrumb-item+.breadcrumb-item::before {
            float: left;
            padding-right: .5rem;
            color: #74788d;
            content: '/' !important;
        }

        element.style {}

        .form-control {
            border-color:#a5a5a5 !important;
        }
        .form-select {
            border-color:#a5a5a5 !important;
        }

        .table-striped tr:nth-child(even) {
          background-color: #b5d3e754;
    }


    #sidebar-menu ul li a {
        color: white;
    }
    #sidebar-menu ul li a:hover {
        color: #bdbdbd;
    }

    #sidebar-menu ul li a .nav-icon{
        color: white;
    }
    #sidebar-menu ul li a:hover .nav-icon{
        color: #bdbdbd;
    }
    .menu-title {
        color: white;
    }


    </style>

</head>


<body style="background: #e7e7e7;" data-sidebar-size="lg" class="sidebar-enable">

    <!-- <body data-layout="horizontal"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">
        @include('layouts.partials.header')
        <!-- ========== Left Sidebar Start ========== -->
        @include('layouts.partials.menu')
        <!-- Left Sidebar End -->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content" >
            @yield('content')
            <!-- End Page-content -->

            <footer class="footer" style="left: 210px;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>document.write(new Date().getFullYear())</script> &copy; SKT
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Copyright by Solvus
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Right Sidebar -->
    @include('layouts.partials.right-bar')
    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <!-- JAVASCRIPT -->
    <script src="{{asset('/assets')}}/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('/assets')}}/libs/metismenujs/metismenujs.min.js"></script>
    <script src="{{asset('/assets')}}/libs/simplebar/simplebar.min.js"></script>
    <script src="{{asset('/assets')}}/libs/feather-icons/feather.min.js"></script>

    <!-- apexcharts -->
    <script src="{{asset('/assets')}}/libs/apexcharts/apexcharts.min.js"></script>

    <!-- Vector map-->
    <script src="{{asset('/assets')}}/libs/jsvectormap/js/jsvectormap.min.js"></script>
    <script src="{{asset('/assets')}}/libs/jsvectormap/maps/world-merc.js"></script>

    {{-- <script src="{{asset('/assets')}}/js/pages/dashboard-sales.init.js"></script> --}}
    <script>
        var baseUrl = @json(asset('/assets'));
         document.body.setAttribute('data-sidebar-size', 'lg')
    </script>
    <script src="{{asset('/assets')}}/js/app.js"></script>
    <script src="{{asset('/assets')}}/libs/datatables/jquery.dataTables.min.js"></script>
    <script src="{{asset('/assets')}}/libs/alertifyjs/build/alertify.min.js"></script>
    <script src="{{asset('assets/js/jspdf.min.js')}}">
    <script src="{{asset('assets/js/html2canvas.js')}}">

    </script>
    @stack('scripts')
    <script>
        $('.ada').val();




        // --- FUNCTION DELETE
        function confirmDelete(urlDelete){
            alertify.confirm("Yakin Hapus ingin menghapus data ?", function () {
                window.location = urlDelete;
            }, function () {
                alertify.error("Cancel")
            }).set({title:"Delete"})
        }

        function resizeChart(divId) {
            var chart = echarts.init(document.getElementById(divId));
            new ResizeSensor(jQuery('#' + divId), function () {
                chart.resize();
            })
        }
    </script>

</body>


</html>
