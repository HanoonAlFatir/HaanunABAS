@extends('layouts.layoutsiswa')

@section('content')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <div class="section mt-2" id="menu-section">
        <div class="todaypresence">
            <div class="col-md-12">
                <div class="container-fluid" style="margin-bottom: 100px">
                    <div class="card">
                        <div class="card-header">
                            Presensi
                        </div>
                        <input type="hidden" id="lokasi">
                        <div class="card-body">
                            <div class="row">
                                <!-- Webcam Section -->
                                <div class="col-12 col-lg-6 mb-3">
                                    <div class="webcam-container">
                                        <div class="webcam-capture" id="webcamCapture"></div>
                                        <img id="result" class="foto">
                                        <canvas id="faceCanvas" style="position: absolute; top: 0; left: 0;">
                                        </canvas>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="button-group mt-3 mb-3">
                                                <button class="btn btn-primary w-100" id="takeSnapshot"><ion-icon
                                                        name="camera-outline"></ion-icon> Ambil Foto</button>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="button-group mt-3 mb-3">
                                                <button class="btn btn-primary w-100" id="resetCamera"><ion-icon
                                                        name="camera-reverse-outline"></ion-icon> Foto Ulang</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            @if ($cek > 0)
                                                <div class="button-group mb-3">
                                                    <button class="btn btn-primary w-100" type="button" id="absen"><ion-icon
                                                            name="cloud-upload-outline"></ion-icon> Absen Pulang</button>
                                                </div>
                                            @else
                                                <div class="button-group mb-3">
                                                    <button class="btn btn-primary w-100" type="button" id="absen"><ion-icon
                                                            name="cloud-upload-outline"></ion-icon> Absen Masuk</button>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- Map Section -->
                                <div class="col-12 col-lg-6">
                                    <div id="map" style="height: 300px;"></div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="button-group mt-3 mb-3">
                                                <small class="form-text text-muted">Pastikan anda sudah berada di dalam radius agar bisa melakukan Absen.</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var lokasi = document.getElementById('lokasi');
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
        }

        function successCallback(position) {
            lokasi.value = position.coords.latitude + "," + position.coords.longitude;
            var lokasi_sekolah = "{{ $lok_sekolah->titik_koordinat }}";
            var lok = lokasi_sekolah.split(",");
            var lat_sekolah = lok[0];
            var long_sekolah = lok[1];
            var map = L.map('map').setView([lat_sekolah, long_sekolah], 17);
            var radius = "{{ $lok_sekolah->jarak }}"
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);
            var marker = L.marker([lat_sekolah, long_sekolah]).addTo(map);
            var circle = L.circle([lat_sekolah, long_sekolah], {
                color: 'red',
                fillColor: '#f03',
                fillOpacity: 0.5,
                radius: radius
            }).addTo(map);
        }

        function errorCallback(params) {

        }

    </script>
@endsection
