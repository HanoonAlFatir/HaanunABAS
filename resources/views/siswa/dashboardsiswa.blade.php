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
                                    <div class="detailfont">
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
                                    <div class="detailfont">
                                        <span id="distance"></span>
                                    </div>
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
                                    <p class="tanggal">
                                    @php
                                        setlocale(LC_ALL, 'IND');
                                        echo strftime('%A, %e %B %G');
                                    @endphp
                                    </p>
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
                                        <div class="detailfont">
                                            <span>{{ $statusAbsen }}</span>
                                        </div>
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
                                        <div class="detailfont">
                                            <span>{{ $statusAbsen }}</span>
                                        </div>
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
                                        <div class="detailfont">
                                            <span>{{ $statusAbsen }}</span>
                                        </div>
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
                                        <div class="detailfont">
                                            <span>{{ $statusAbsen }}</span>
                                        </div>
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
                                        <div class="detailfont">
                                            <span>{{ $statusAbsen }}</span>
                                        </div>
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
                                        <div class="detailfont">
                                            <span>{{ $statusAbsen }}</span>
                                        </div>
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
                        <button class="buttonform" disabled>
                            <div class="card-body">
                                <div class="absencontent">
                                    <div class="iconabsen">
                                        <ion-icon name="alarm-outline"></ion-icon>
                                    </div>
                                    <div class="absendetail">
                                        <h4 class="presencetitle">Absen Masuk</h4>
                                        <span>{{ $jam_absen }} - {{ $waktu->batas_jam_masuk }} WIB</span>
                                    </div>
                                </div>
                            </div>
                        </button>
                    </div>
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <div class="card gradasilightblue">
                        <button class="buttonform" disabled>
                            <div class="card-body">
                                <div class="absencontent">
                                    <div class="iconabsen">
                                        <ion-icon name="alarm-outline"></ion-icon>
                                    </div>
                                    <div class="absendetail">
                                        <h4 class="presencetitle">Batas Pulang</h4>
                                        <span>{{ $waktu->jam_pulang }} - {{ $waktu->batas_jam_pulang }} WIB</span>
                                    </div>
                                </div>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
            @php
                $isAbsenMasukDisabled = $jam < $jam_absen || $jam >= $batas_absen_pulang;
                $isAbsenPulang = $statusAbsen === 'Sudah Pulang';
                $isIzin = $statusAbsen === 'Izin' || $statusAbsen === 'Sakit';
            @endphp
            <div class="row">
                <div class="col-12 col-md-6 mb-3">
                    <div class="card gradasiyellow">
                        <a href="{{ route('form.sakit') }}">
                            @if ($cek > 0)
                                <button class="buttonform" type="button"
                                    style="background-color: gray; border-radius: 6px;" disabled>
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
                            @else
                                <button class="buttonform" type="button"
                                    style="background-color: #b80d2d; border-radius: 6px;">
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
                            @endif
                        </a>
                    </div>
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <div class="card gradasiyellow">
                        <a href="{{ route('form.izin') }}">
                            @if ($cek > 0)
                                <button class="buttonform" type="button" style="background-color: gray; border-radius: 6px;" disabled>
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
                            @else
                                <button class="buttonform" type="button" style="background-color: #FFC107; border-radius: 6px;">
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
                            @endif
                        </a>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12">
                    <div class="card">
                        <a href="{{ route('siswa.absen') }}">
                            @if ($cek > 0)
                                <button class="buttonabsen"
                                    style="@if ($isAbsenMasukDisabled || $isAbsenPulang || $isIzin) background-color: #593BDB; color: white; @endif"
                                    @if ($isAbsenMasukDisabled || $isAbsenPulang || $isIzin) disabled @endif type="button">
                                    <div class="absencontent">
                                        <div class="absendetail">
                                            <div class="iconabsen">
                                                <ion-icon class="iconbuttonabsen" name="camera-outline"></ion-icon>
                                            </div>
                                            <div class="absendetail">
                                                <h4 style="color: white; margin: 0;" class="presencetitle">ABSEN PULANG
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </button>
                            @else
                                <button class="buttonabsen"
                                    style="background-color: #593BDB; color: white; @if ($isAbsenMasukDisabled) background-color: gray; @endif"
                                    @if ($isAbsenMasukDisabled) disabled @endif type="button">
                                    <div class="absencontent">
                                        <div class="absendetail">
                                            <div class="iconabsen">
                                                <ion-icon class="iconbuttonabsen" name="camera-outline"></ion-icon>
                                            </div>
                                            <div class="absendetail">
                                                <h4 style="color: white; margin: 0;" class="presencetitle">ABSEN MASUK
                                                </h4>
                                            </div>
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
