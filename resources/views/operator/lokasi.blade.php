@extends('layouts.dashboardoperator')

@section('content')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Hi, Operator!</h4>
                        <p class="mb-0">Daftar Jurusan SMKN 11 Bandung</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)"></a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Daftar Jurusan</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header">
                            <h3>Setting Waktu</h3>
                        </div>
                        <div class="card-body">
                            <form class="forms-sample" action="{{ route('updatewaktu') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="form-group form-gp col-sm-6 ">
                                        <label for="exampleInputUsername1">Jam Masuk</label>
                                        <input type="time" class="form-control form" id="jam_masuk" name="jam_masuk"
                                            value="{{ $waktu->jam_masuk }}">
                                    </div>
                                    <div class="form-group form-gp col-sm-6">
                                        <label for="exampleInputEmail1">Jam Pulang</label>
                                        <input type="time" class="form-control form" id="jam_pulang" name="jam_pulang"
                                            value="{{ $waktu->jam_pulang }}">
                                    </div>
                                    <div class="form-group form-gp col-sm-6">
                                        <label for="exampleInputPassword1">Batas Absen Masuk</label>
                                        <input type="time" class="form-control form" id="batas_jam_masuk"
                                            name="batas_jam_masuk" value="{{ $waktu->batas_jam_masuk }}">
                                    </div>
                                    <div class="form-group form-gp col-sm-6">
                                        <label for="exampleInputConfirmPassword1">Batas Absen Pulang</label>
                                        <input type="time" class="form-control form" id="batas_jam_pulang"
                                            name="batas_jam_pulang" value="{{ $waktu->batas_jam_pulang }}">
                                    </div>
                                </div>
                                
                                <button type="submit" class="btn btn-primary mr-2 ">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
                <div class="col-md-6">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div id="map" style="height: 180px"></div>
                                </div>
                            </div>
                            <form class="forms-sample" action="{{ route('updatelokasi') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Koordinat</label>
                                    <div class="input-group">
                                        <span class="input-group-prepend">
                                            <label class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg"
                                                    width="16" height="16" fill="currentColor"
                                                    class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6" />
                                                </svg></i></label>
                                        </span>
                                        <input type="text" class="form-control" id="titik_koordinat"
                                            name="titik_koordinat" value="{{ $lok_sekolah->titik_koordinat }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputConfirmPassword1">Radius</label>
                                    <div class="input-group">
                                        <span class="input-group-prepend">
                                            <label class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg"
                                                    width="16" height="16" fill="currentColor"
                                                    class="bi bi-broadcast" viewBox="0 0 16 16">
                                                    <path
                                                        d="M3.05 3.05a7 7 0 0 0 0 9.9.5.5 0 0 1-.707.707 8 8 0 0 1 0-11.314.5.5 0 0 1 .707.707m2.122 2.122a4 4 0 0 0 0 5.656.5.5 0 1 1-.708.708 5 5 0 0 1 0-7.072.5.5 0 0 1 .708.708m5.656-.708a.5.5 0 0 1 .708 0 5 5 0 0 1 0 7.072.5.5 0 1 1-.708-.708 4 4 0 0 0 0-5.656.5.5 0 0 1 0-.708m2.122-2.12a.5.5 0 0 1 .707 0 8 8 0 0 1 0 11.313.5.5 0 0 1-.707-.707 7 7 0 0 0 0-9.9.5.5 0 0 1 0-.707zM10 8a2 2 0 1 1-4 0 2 2 0 0 1 4 0" />
                                                </svg></i></label>
                                        </span>
                                        <input type="text" class="form-control" id="jarak" name="jarak"
                                            value="{{ $lok_sekolah->jarak }}">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mr-2">Update</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <script>

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
        }
        function successCallback(position) {
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
