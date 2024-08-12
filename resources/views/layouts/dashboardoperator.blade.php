<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Dashboard Operator</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/kesiswaan/images/favicon.png') }}">
    <link href="{{ asset('assets/kesiswaan/vendor/pg-calendar/css/pignose.calendar.min.css') }} " rel="stylesheet">
    <link href="{{ asset('assets/kesiswaan/vendor/datatables/css/jquery.dataTables.min.css') }} " rel="stylesheet">
    <link href="{{ asset('assets/kesiswaan/vendor/chartist/css/chartist.min.css') }} " rel="stylesheet">
    <link href="{{ asset('assets/kesiswaan/css/style.css') }} " rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> --}}

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="dashboard-kesiswaan.html" class="brand-logo">
                <img class="logo-compact" src="{{ asset('assets/kesiswaan/images/logo-title.png') }} " alt="">
                <img class="logo-abbr" src="{{ asset('assets/kesiswaan/images/logo-abas.png') }} " alt="">
                <img class="brand-title" src="{{ asset('assets/kesiswaan/images/logo-title.png') }} " alt="">
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="search_bar dropdown">
                                <span class="search_icon p-3 c-pointer" data-toggle="dropdown">
                                    <i class="mdi mdi-magnify"></i>
                                </span>
                                <div class="dropdown-menu p-0 m-0">
                                    <form>
                                        <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                                    </form>
                                </div>
                            </div>
                        </div>

                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="mdi mdi-account"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="./app-profile.html" class="dropdown-item">
                                        <i class="icon-user"></i>
                                        <span class="ml-2">Profile </span>
                                    </a>
                                    <a href="{{ route('logout') }}" class="dropdown-item"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="icon-key"></i>
                                        <span class="ml-2">Logout </span>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="quixnav">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">

                    <li class="nav-label first">Data Kelas</li>
                    <li><a class="has-" href="{{ route('operator.index') }}" aria-expanded="false"><i
                        class="ti-id-badge"></i><span class="nav-text">Wali Kelas</span></a>
                    </li>
                    <li><a class="has-" href="{{ route('daftarkesiswaan') }}" aria-expanded="false"><i
                        class="ti-user"></i><span class="nav-text">Kesiswaan</span></a>
                    </li>
                    <li><a class="has-" href="{{ route('jurusan') }}" aria-expanded="false"><i
                        class="ti-files"></i><span class="nav-text">Jurusan</span></a>
                    </li>
                    <li><a class="has-" href="{{ route('kelas') }}" aria-expanded="false"><i
                        class="ti-home"></i><span class="nav-text">Kelas</span></a>
                    </li>
                    <li class="nav-label first">Presensi</li>
                    <li><a class="has-" href="{{ route('lokasi') }}" aria-expanded="false"><i
                        class="ti-location-pin"></i><span class="nav-text">Lokasi</span></a>
                        <!-- <ul aria-expanded="false">
                            <li><a href="./index.html">Dashboard 1</a></li>
                        </ul> -->
                    </li>

                    {{-- <li class="nav-label">Rekap</li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                        class="icon icon-app-store"></i><span class="nav-text">Data</span></a>
                        <ul aria-expanded="false">
                            <li><a href="./data-siswa.html">Siswa</a></li>
                            <!-- <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Email</a>
                                <ul aria-expanded="false">
                                    <li><a href="./email-compose.html">Compose</a></li>
                                    <li><a href="./email-inbox.html">Inbox</a></li>
                                    <li><a href="./email-read.html">Read</a></li>
                                </ul>
                            </li> -->
                            <li><a href="./data-guru.html">Guru</a></li>
                        </ul>
                    </li> --}}
                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        @yield('content')
        <!--**********************************
            Content body end
        ***********************************-->


        <!--**********************************
            Footer start
        ***********************************-->

        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{  asset('assets/kesiswaan/vendor/global/global.min.js')  }} "></script>
    <script src="{{  asset('assets/kesiswaan/js/quixnav-init.js')  }}"></script>
    <script src="{{  asset('assets/kesiswaan/js/custom.min.js')  }}"></script>

    <script src="{{  asset('assets/kesiswaan/vendor/chartist/js/chartist.min.js')  }}"></script>

    <script src="{{  asset('assets/kesiswaan/vendor/moment/moment.min.js')  }}"></script>
    <script src="{{  asset('assets/kesiswaan/vendor/pg-calendar/js/pignose.calendar.min.js')  }}"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script src="{{  asset('assets/kesiswaan/js/dashboard/dashboard-2.js')  }}"></script>
    <!-- Circle progress -->

    <script src="{{  asset('assets/kesiswaan/vendor/datatables/js/jquery.dataTables.min.js')  }}"></script>
    <script src="{{  asset('assets/kesiswaan/js/plugins-init/datatables.init.js')  }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <!-- Tambahkan di bagian bawah <body> -->
</body>


</html>
