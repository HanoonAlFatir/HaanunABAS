@extends('layouts.layoutsiswa')

@section('content')
    <div class="section mt-2" id="menu-section">
        <div class="todaypresence">
            {{-- INFORMASI ABSEN --}}
            <div class="row mb-2">
                <div class="col-6 col-md-6 col-lg-3 mb-3">
                    <div class="card gradasiwhite">
                        <div class="card-body">
                            <div class="presencecontent">
                                <div class="iconpresence">
                                    <ion-icon name="time-outline"></ion-icon>
                                </div>
                                <div class="presencedetail">
                                    <h4>Jam Sekarang</h4>
                                    <span id="jam">00</span>
                                    <span>:</span>
                                    <span id="menit">00</span>
                                    <span>:</span>
                                    <span id="detik">00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-6 col-lg-3 mb-3">
                    <div class="card gradasiwhite">
                        <div class="card-body">
                            <div class="presencecontent">
                                <div class="iconpresence">
                                    <ion-icon name="location-outline"></ion-icon>
                                </div>
                                <div class="presencedetail">
                                    <input type="hidden" id="lokasi">
                                    <h4>Jarak dari Sekolah</h4>
                                    <span id="distance"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-6 col-lg-3 mb-3">
                    <div class="card gradasiwhite">
                        <div class="card-body">
                            <div class="presencecontent">
                                <div class="iconpresence">
                                    <ion-icon name="calendar-outline"></ion-icon>
                                </div>
                                <div class="presencedetail">
                                    <h4>Tanggal</h4>
                                    @php
                                        setlocale(LC_ALL, 'IND');
                                        echo strftime('%A, %e %B %G');
                                    @endphp
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-6 col-lg-3 mb-3">
                    @if ($statusAbsen == 'Belum Absen')
                        <div class="card gradasiwhite">
                            <div class="card-body">
                                <div class="presencecontent">
                                    <div class="iconpresence">
                                        <ion-icon name="watch-outline"></ion-icon>
                                    </div>
                                    <div class="presencedetail">
                                        <h4>Status Absen</h4>
                                        <span>{{ $statusAbsen }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif ($statusAbsen == 'Hadir')
                        <div class="card gradasiwhite">
                            <div class="card-body">
                                <div class="presencecontent">
                                    <div class="iconpresence">
                                        <ion-icon name="time-outline"></ion-icon>
                                    </div>
                                    <div class="presencedetail">
                                        <h4>Status Absen</h4>
                                        <span>{{ $statusAbsen }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif ($statusAbsen == 'Terlambat')
                        <div class="card gradasiwhite">
                            <div class="card-body">
                                <div class="presencecontent">
                                    <div class="iconpresence">
                                        <ion-icon name="time-outline"></ion-icon>
                                    </div>
                                    <div class="presencedetail">
                                        <h4>Status Absen</h4>
                                        <span>{{ $statusAbsen }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif($statusAbsen == 'Sakit')
                        <div class="card gradasiwhite">
                            <div class="card-body">
                                <div class="presencecontent">
                                    <div class="iconpresence">
                                        <ion-icon name="time-outline"></ion-icon>
                                    </div>
                                    <div class="presencedetail">
                                        <h4>Status Absen</h4>
                                        <span>{{ $statusAbsen }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif($statusAbsen == 'Tidak Hadir')
                        <div class="card gradasiwhite">
                            <div class="card-body">
                                <div class="presencecontent">
                                    <div class="iconpresence">
                                        <ion-icon name="time-outline"></ion-icon>
                                    </div>
                                    <div class="presencedetail">
                                        <h4>Status Absen</h4>
                                        <span>{{ $statusAbsen }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="card gradasiwhite">
                            <div class="card-body">
                                <div class="presencecontent">
                                    <div class="iconpresence">
                                        <ion-icon name="time-outline"></ion-icon>
                                    </div>
                                    <div class="presencedetail">
                                        <h4>Status Absen</h4>
                                        <span>{{ $statusAbsen }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- ABSEN --}}
            <div class="row">
                <div class="col-12 col-md-6 mb-3">
                    <div class="card gradasigreen">
                        <div class="card-body">
                            <div class="absencontent">
                                <div class="iconabsen">
                                    <ion-icon name="alarm-outline"></ion-icon>
                                </div>
                                <div class="absendetail">
                                    <h4 class="presencetitle">Absen Masuk</h4>
                                    <span>Jam Absen 06:10-07:00 WIB</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <div class="card gradasilightblue">
                        <div class="card-body">
                            <div class="absencontent">
                                <div class="iconabsen">
                                    <ion-icon name="alarm-outline"></ion-icon>
                                </div>
                                <div class="absendetail">
                                    <h4 class="presencetitle">Batas Pulang</h4>
                                    <span>Jam Pulang 15:00-15:30</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6 mb-3">
                    <div class="card gradasiyellow">
                        <button class="buttonform">
                            <div class="card-body">
                                <div class="absencontent">
                                    <div class="iconabsen">
                                        <ion-icon name="document-text-outline"></ion-icon>
                                    </div>
                                    <div class="absendetail">
                                        <h4 class="presencetitle">Sakit?</h4>
                                        <span>Isi form keterangan sakit</span>
                                    </div>
                                </div>
                            </div>
                        </button>
                    </div>
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <div class="card gradasired">
                        <button class="buttonform">
                            <div class="card-body">
                                <div class="absencontent">
                                    <div class="iconabsen">
                                        <ion-icon name="document-text-outline"></ion-icon>
                                    </div>
                                    <div class="absendetail">
                                        <h4 class="presencetitle">Izin?</h4>
                                        <span>Isi form keterangan izin</span>
                                    </div>
                                </div>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12">
                    <div class="card">
                        <a href="{{ route('siswa.absen') }}">
                            @if ($cek > 0)
                                <button class="buttonabsen" style="background-color: gray; color: white;" type="button">
                                    <div class="row align-items-center">
                                        <div class="col-6 d-flex justify-content-end">
                                            <ion-icon class="iconbuttonabsen" name="camera-outline"></ion-icon>
                                        </div>
                                        <div class="col-6 d-flex align-items-center">
                                            <h4 style="color: white; margin: 0;">ABSEN PULANG</h4>
                                        </div>
                                    </div>
                                </button>
                            @else
                                <button class="buttonabsen" style=" background-color: #593BDB; color: white;"
                                    type="button">
                                    <div class="row align-items-center">
                                        <div class="col-6 d-flex justify-content-end">
                                            <ion-icon class="iconbuttonabsen" name="camera-outline"></ion-icon>
                                        </div>
                                        <div class="col-6 d-flex align-items-center">
                                            <h4 style="color: white; margin: 0;">ABSEN MASUK</h4>
                                        </div>
                                    </div>
                                </button>
                            @endif
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/siswa/js/timedate.js') }} "></script>
    <script src="{{ asset('assets/siswa/js/jarak.js') }} "></script>
@endsection
