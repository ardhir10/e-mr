 <div class="vertical-menu" style="background: #4A4A55">

            <!-- LOGO -->
            <div class="navbar-brand-box" style="    box-shadow: -2px 6px 3px rgb(52 58 64 / 8%);">
                <a href="{{route('dashboard')}}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{asset('assets/')}}/images/logo-solvus-small.jpeg" alt="" height="35">
                    </span>
                    <span class="logo-lg">
                        <img src="{{asset('assets/')}}/images/logo-solvus.jpeg" alt="" height="35">
                    </span>

                    {{-- <span>E-MR</span> --}}
                </a>

                {{-- <a href="index.html" class="logo logo-light">
                    <span class="logo-lg">
                        <img src="{{asset('assets/')}}/images/logo-light.png" alt="" height="22">
                    </span>
                    <span class="logo-sm">
                        <img src="{{asset('assets/')}}/images/logo-sm-light.png" alt="" height="22">
                    </span>
                </a> --}}
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>

            <div data-simplebar class="sidebar-menu-scroll">

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <li class="menu-title" data-key="t-dashboards">HOME</li>

                        @if(auth()->user()->can('menu-dashboard'))
                            <li>
                                <a href="{{route('dashboard')}}">
                                    {{-- <i class="icon nav-icon" data-feather="search"></i> --}}
                                    {{-- <i class="fas fa-search" ></i> --}}
                                    <i class="icon nav-icon" data-feather="trello"></i>


                                    <span class="menu-item" data-key="t-sales">Dashboard</span>
                                </a>
                            </li>
                        @endif


                        @if(auth()->user()->can('menu-rekam-medis'))
                            <li>
                                <a href="{{route('rekam-medis.index')}}">
                                    {{-- <i class="icon nav-icon" data-feather="search"></i> --}}
                                    {{-- <i class="fas fa-search" ></i> --}}
                                    <i class="icon nav-icon" data-feather="search"></i>


                                    <span class="menu-item" data-key="t-sales">Cari Rekam Medis</span>
                                </a>
                            </li>
                        @endif

                        @if(auth()->user()->can('menu-rawat-jalan'))
                            <li>
                                <a href="{{route('rawat-jalan.index')}}">
                                    {{-- <i class="fas fa-hospital-user" ></i> --}}
                                    <i class="icon nav-icon" data-feather="user"></i>

                                    <span class="menu-item" data-key="t-sales">Pasien Rawat Jalan</span>
                                </a>
                            </li>
                        @endif
                        @if(auth()->user()->can('menu-rawat-inap'))
                            <li>
                                <a href="{{route('rawat-inap.index')}}">
                                    {{-- <i class="fas fa-hospital" ></i> --}}
                                    <i class="icon nav-icon" data-feather="user-check"></i>

                                    <span class="menu-item" data-key="t-sales">Pasien Rawat Inap</span>
                                </a>
                            </li>
                        @endif





                        <li class="menu-title" data-key="t-applications">DATA MASTER</li>
                        @if(auth()->user()->can('menu-setup-user'))
                        <li>
                            <a href="{{route('user.index')}}">
                                <i class="icon nav-icon" data-feather="users"></i>
                                <span class="menu-item" data-key="t-calendar">Setup User</span>
                            </a>
                        </li>
                        @endif

                        @if(auth()->user()->can('menu-setup-role'))
                        <li>
                            <a href="{{route('role.index')}}">
                                <i class="icon nav-icon" data-feather="sliders"></i>
                                <span class="menu-item" data-key="t-calendar">Setup Role User</span>
                            </a>
                        </li>
                        @endif


                        @if(auth()->user()->can('menu-satuan-tugas-medis'))
                        <li>
                            <a href="{{route('satuan-tugas-medis.index')}}">
                                <i class="icon nav-icon" data-feather="slack"></i>
                                <span class="menu-item" data-key="t-calendar">Satuan Tugas Medis</span>
                            </a>
                        </li>
                        @endif

                        @if(auth()->user()->can('menu-layanan-bagian'))
                        <li>
                            <a href="{{route('layanan.index')}}">
                                <i class="icon nav-icon" data-feather="settings"></i>
                                <span class="menu-item" data-key="t-calendar">Layanan/Bagian</span>
                            </a>
                        </li>
                        @endif

                        @if(auth()->user()->can('menu-list-dokter'))
                        <li>
                            <a href="{{route('dokter.index')}}">
                                <i class="icon nav-icon" data-feather="user-check"></i>
                                <span class="menu-item" data-key="t-calendar">List Dokter</span>
                            </a>
                        </li>
                         @endif


                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>
