<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    <title>ABAS</title>
    <meta name="description" content="Mobilekit HTML Mobile UI Kit">
    <meta name="keywords" content="bootstrap 4, mobile template, cordova, phonegap, mobile, html" />
    <link rel="icon" type="image/png" href="{{ asset('assets/siswa/img/favicon.png') }}" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/siswa/img/icon/192x192.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/siswa/css/style.css') }}">
    <link rel="manifest" href="__manifest.json">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

</head>

<body style="background-color:#e9ecef;">

    <!-- loader -->
    <div id="loader">
        <div class="spinner-border text-primary" role="status"></div>
    </div>
    <!-- * loader -->



    <!-- App Capsule -->
    <div id="appCapsule">
        <div class="section" id="user-section">
            <div id="user-detail" class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <div class="avatar">
                        <img src="{{ asset('assets/siswa/img/sample/avatar/avatar1.jpg') }}" alt="avatar"
                            class="imaged w64 rounded">
                    </div>
                    <div id="user-info" class="ml-3">
                        <h2 id="user-name">Haanun Syauqoni Al-Fatir</h2>
                        <span id="user-role">XII RPL 1</span>
                    </div>
                </div>
                <div>
                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-link"
                            style="color: inherit; text-decoration: none; background-color: #ffffff; color: white; padding: 10px 20px; border-radius: 5px; border: none; transition: background-color 0.3s;">
                            <ion-icon name="log-out-outline"></ion-icon> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- <form action="{{route ('logout')}}" method="post">
            @csrf
            <button type="submit">logout</button>
        </form> --}}


        {{-- CONTENT --}}
        @yield('content')

    </div>
    <!-- * App Capsule -->


    <!-- App Bottom Menu -->
    <div class="appBottomMenu">
        <a href="#" class="item">
            <div class="col">
                <ion-icon name="file-tray-full-outline" role="img" class="md hydrated"
                    aria-label="file tray full outline"></ion-icon>
                <strong>Today</strong>
            </div>
        </a>
        <a href="#" class="item active">
            <div class="col">
                <ion-icon name="calendar-outline" role="img" class="md hydrated"
                    aria-label="calendar outline"></ion-icon>
                <strong>Calendar</strong>
            </div>
        </a>
        <a href="#" class="item">
            <div class="col">
                <ion-icon name="document-text-outline" role="img" class="md hydrated"
                    aria-label="document text outline"></ion-icon>
                <strong>Docs</strong>
            </div>
        </a>
        <a href="javascript:;" class="item">
            <div class="col">
                <ion-icon name="people-outline" role="img" class="md hydrated"
                    aria-label="people outline"></ion-icon>
                <strong>Profile</strong>
            </div>
        </a>
    </div>

    <!-- * App Bottom Menu -->




    <!-- ///////////// Js Files ////////////////////  -->
    <!-- Jquery -->
    <script src="{{ asset('assets/siswa/js/lib/jquery-3.4.1.min.js') }} "></script>
    <!-- Bootstrap-->
    <script src="{{ asset('assets/siswa/js/lib/popper.min.js') }} "></script>
    <script src="{{ asset('assets/siswa/js/lib/bootstrap.min.js') }} "></script>
    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- Owl Carousel -->
    <script src="{{ asset('assets/siswa/js/plugins/owl-carousel/owl.carousel.min.js') }} "></script>
    <!-- jQuery Circle Progress -->
    <script src="{{ asset('assets/siswa/js/plugins/jquery-circle-progress/circle-progress.min.js') }} "></script>
    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
    <!-- Base Js File -->
    <script src="{{ asset('assets/siswa/js/base.js') }} "></script>
    <script src="{{ asset('assets/siswa/js/timedate.js') }} "></script>
    <script src="{{ asset('assets/siswa/js/jarak.js') }} "></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        var lokasiSekolah = @json($lok_sekolah->titik_koordinat);
        var radiusSekolah = @json($lok_sekolah->jarak);
        am4core.ready(function() {

            // Themes begin
            am4core.useTheme(am4themes_animated);
            // Themes end

            var chart = am4core.create("chartdiv", am4charts.PieChart3D);
            chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

            chart.legend = new am4charts.Legend();

            chart.data = [{
                    country: "Hadir",
                    litres: 501.9
                },
                {
                    country: "Sakit",
                    litres: 301.9
                },
                {
                    country: "Izin",
                    litres: 201.1
                },
                {
                    country: "Terlambat",
                    litres: 165.8
                },
            ];



            var series = chart.series.push(new am4charts.PieSeries3D());
            series.dataFields.value = "litres";
            series.dataFields.category = "country";
            series.alignLabels = false;
            series.labels.template.text = "{value.percent.formatNumber('#.0')}%";
            series.labels.template.radius = am4core.percent(-40);
            series.labels.template.fill = am4core.color("white");
            series.colors.list = [
                am4core.color("#1171ba"),
                am4core.color("#fca903"),
                am4core.color("#37db63"),
                am4core.color("#ba113b"),
            ];
        }); // end am4core.ready()
    </script>

</body>

</html>
