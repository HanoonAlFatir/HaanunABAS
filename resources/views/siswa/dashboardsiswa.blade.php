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
                                    style=" background-color: #593BDB; color: white; @if ($isAbsenMasukDisabled || $isAbsenPulang || $isIzin) background-color: #593BDB; color: white; @endif"
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
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card p-3">
                        <ul class="nav nav-tabs nav-fill" id="rekapTabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="bulan-ini-tab" data-toggle="tab" href="#bulan-ini" role="tab" aria-controls="bulan-ini" aria-selected="true">Rekap Bulan Ini</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="bulan-sebelumnya-tab" data-toggle="tab" href="#bulan-sebelumnya" role="tab" aria-controls="bulan-sebelumnya" aria-selected="false">Rekap Bulan Sebelumnya</a>
                            </li>
                        </ul>
                        <div class="tab-content mt-3" id="rekapTabsContent">
                            <div class="tab-pane fade show active" id="bulan-ini" role="tabpanel" aria-labelledby="bulan-ini-tab">
                                <div class="row mb-2">
                                    <div class="col-12">
                                        <div class="progress mb-1" style="position: relative; height: 30px;">
                                    <div class="progress-bar bg-success" role="progressbar"
                                        style="width: {{ $persentaseHadirBulanIni }}%; height: 30px;"
                                        aria-valuenow="{{ $persentaseHadirBulanIni }}" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                    <span
                                        style="position: absolute; width: 100%; text-align: center; line-height: 30px; color: black;">
                                        {{ $persentaseHadirBulanIni }}%
                                    </span>
                                </div>
                                    </div>
                                </div>
                                <div class="row d-flex justify-content-between">
                                    <div class="col-4 col-md-2 mb-3">
                                        <div class="card gradasigreen">
                                            <button class="buttonform" disabled>
                                                <div class="card-body">
                                                    <div class="absencontent">
                                                        <div class="absendetail">
                                                            <h4 class="presencetitle rekapadjust">Jumlah Hadir</h4>
                                                            <span class="rekapcontent">{{ $dataBulanIni['Hadir'] ?? 0 }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-4 col-md-2 mb-3">
                                        <div class="card gradasidarkyellow">
                                            <button class="buttonform" disabled>
                                                <div class="card-body">
                                                    <div class="absencontent">
                                                        <div class="absendetail">
                                                            <h4 class="presencetitle rekapadjust">Jumlah Sakit</h4>
                                                            <span class="rekapcontent">{{ $dataBulanIni['Sakit'] ?? 0 }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-4 col-md-2 mb-3">
                                        <div class="card gradasiblue">
                                            <button class="buttonform" disabled>
                                                <div class="card-body">
                                                    <div class="absencontent">
                                                        <div class="absendetail">
                                                            <h4 class="presencetitle rekapadjust">Jumlah Izin</h4>
                                                            <span class="rekapcontent">{{ $dataBulanIni['Izin'] ?? 0 }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-4 col-md-2 mb-3">
                                        <div class="card gradasired">
                                            <button class="buttonform" disabled>
                                                <div class="card-body">
                                                    <div class="absencontent">
                                                        <div class="absendetail">
                                                            <h4 class="presencetitle rekapadjust">Jumlah Alfa</h4>
                                                            <span class="rekapcontent">{{ $dataBulanIni['Alfa'] ?? 0 }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-4 col-md-2 mb-3">
                                        <div class="card gradasigray">
                                            <button class="buttonform" disabled>
                                                <div class="card-body">
                                                    <div class="absencontent">
                                                        <div class="absendetail">
                                                            <h4 class="presencetitle rekapadjust">Jumlah Terlambat</h4>
                                                            <span class="rekapcontent">{{ $dataBulanIni['Terlambat'] ?? 0 }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-4 col-md-2 mb-3">
                                        <div class="card gradasisoftblue">
                                            <button class="buttonform" disabled>
                                                <div class="card-body">
                                                    <div class="absencontent">
                                                        <div class="absendetail">
                                                            <h4 class="presencetitle rekapadjust">Jumlah TAP</h4>
                                                            <span class="rekapcontent">{{ $dataBulanIni['TAP'] ?? 0 }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="bulan-sebelumnya" role="tabpanel" aria-labelledby="bulan-sebelumnya-tab">
                                <div class="row mb-2">
                                    <div class="col-12">
                                        <div class="progress mb-3" style="position: relative; height: 30px;">
                                    <div class="progress-bar bg-success" role="progressbar"
                                        style="width: {{ $persentaseHadirBulanSebelumnya }}%; height: 30px;"
                                        aria-valuenow="{{ $persentaseHadirBulanSebelumnya }}" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                    <span
                                        style="position: absolute; width: 100%; text-align: center; line-height: 30px; color: black;">
                                        {{ $persentaseHadirBulanSebelumnya }}%
                                    </span>
                                </div>
                                <div class="row d-flex justify-content-between">
                                    <div class="col-4 col-md-2 mb-3">
                                        <div class="card gradasigreen">
                                            <button class="buttonform" disabled>
                                                <div class="card-body">
                                                    <div class="absencontent">
                                                        <div class="absendetail">
                                                            <h4 class="presencetitle rekapadjust">Jumlah Hadir</h4>
                                                            <span class="rekapcontent">{{ $dataBulanSebelumnya['Hadir'] ?? 0 }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-4 col-md-2 mb-3">
                                        <div class="card gradasidarkyellow">
                                            <button class="buttonform" disabled>
                                                <div class="card-body">
                                                    <div class="absencontent">
                                                        <div class="absendetail">
                                                            <h4 class="presencetitle rekapadjust">Jumlah Sakit</h4>
                                                            <span class="rekapcontent">{{ $dataBulanSebelumnya['Sakit'] ?? 0 }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-4 col-md-2 mb-3">
                                        <div class="card gradasiblue">
                                            <button class="buttonform" disabled>
                                                <div class="card-body">
                                                    <div class="absencontent">
                                                        <div class="absendetail">
                                                            <h4 class="presencetitle rekapadjust">Jumlah Izin</h4>
                                                            <span class="rekapcontent">{{ $dataBulanSebelumnya['Izin'] ?? 0 }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-4 col-md-2 mb-3">
                                        <div class="card gradasired">
                                            <button class="buttonform" disabled>
                                                <div class="card-body">
                                                    <div class="absencontent">
                                                        <div class="absendetail">
                                                            <h4 class="presencetitle rekapadjust">Jumlah Alfa</h4>
                                                            <span class="rekapcontent">{{ $dataBulanSebelumnya['Alfa'] ?? 0 }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-4 col-md-2 mb-3">
                                        <div class="card gradasigray">
                                            <button class="buttonform" disabled>
                                                <div class="card-body">
                                                    <div class="absencontent">
                                                        <div class="absendetail">
                                                            <h4 class="presencetitle rekapadjust">Jumlah Terlambat</h4>
                                                            <span class="rekapcontent">{{ $dataBulanSebelumnya['Terlambat'] ?? 0 }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-4 col-md-2 mb-3">
                                        <div class="card gradasisoftblue">
                                            <button class="buttonform" disabled>
                                                <div class="card-body">
                                                    <div class="absencontent">
                                                        <div class="absendetail">
                                                            <h4 class="presencetitle rekapadjust">Jumlah TAP</h4>
                                                            <span class="rekapcontent">{{ $dataBulanSebelumnya['TAP'] ?? 0 }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </button>
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
    <script src="{{ asset('assets/siswa/js/timedate.js') }} "></script>
    <script src="{{ asset('assets/siswa/js/jarak.js') }} "></script>
@endsection
