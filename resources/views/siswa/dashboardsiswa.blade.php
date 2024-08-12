@extends('layouts.layoutsiswa')

@section('content')
    {{-- <div class="rekappresence mt-4">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="presencecontent">
                            <div class="iconpresence primary">
                                <ion-icon name="log-in"></ion-icon>
                            </div>
                            <div class="presencedetail">
                                <h4 class="rekappresencetitle">Hadir</h4>
                                <span class="rekappresencedetail">0 Hari</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="presencecontent">
                            <div class="iconpresence green">
                                <ion-icon name="document-text"></ion-icon>
                            </div>
                            <div class="presencedetail">
                                <h4 class="rekappresencetitle">Izin</h4>
                                <span class="rekappresencedetail">0 Hari</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="presencecontent">
                            <div class="iconpresence warning">
                                <ion-icon name="sad"></ion-icon>
                            </div>
                            <div class="presencedetail">
                                <h4 class="rekappresencetitle">Sakit</h4>
                                <span class="rekappresencedetail">0 Hari</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="presencecontent">
                            <div class="iconpresence danger">
                                <ion-icon name="alarm"></ion-icon>
                            </div>
                            <div class="presencedetail">
                                <h4 class="rekappresencetitle">Terlambat</h4>
                                <span class="rekappresencedetail">0 Hari</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    {{-- <div class="presencetab mt-2">
        <div class="tab-pane fade show active" id="pilled" role="tabpanel">
            <ul class="nav nav-tabs style1" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#home" role="tab">
                        Bulan Ini
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#profile" role="tab">
                        Leaderboard
                    </a>
                </li>
            </ul>
        </div>
        <div class="tab-content mt-2" style="margin-bottom:100px;">
            <div class="tab-pane fade show active" id="home" role="tabpanel">
                <ul class="listview image-listview">
                    <li>
                        <div class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="image-outline" role="img" class="md hydrated"
                                    aria-label="image outline"></ion-icon>
                            </div>
                            <div class="in">
                                <div>Photos</div>
                                <span class="badge badge-danger">10</span>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item">
                            <div class="icon-box bg-secondary">
                                <ion-icon name="videocam-outline" role="img" class="md hydrated"
                                    aria-label="videocam outline"></ion-icon>
                            </div>
                            <div class="in">
                                <div>Videos</div>
                                <span class="text-muted">None</span>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item">
                            <div class="icon-box bg-danger">
                                <ion-icon name="musical-notes-outline" role="img" class="md hydrated"
                                    aria-label="musical notes outline"></ion-icon>
                            </div>
                            <div class="in">
                                <div>Music</div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item">
                            <div class="icon-box bg-danger">
                                <ion-icon name="musical-notes-outline" role="img" class="md hydrated"
                                    aria-label="musical notes outline"></ion-icon>
                            </div>
                            <div class="in">
                                <div>Music</div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item">
                            <div class="icon-box bg-danger">
                                <ion-icon name="musical-notes-outline" role="img" class="md hydrated"
                                    aria-label="musical notes outline"></ion-icon>
                            </div>
                            <div class="in">
                                <div>Music</div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item">
                            <div class="icon-box bg-danger">
                                <ion-icon name="musical-notes-outline" role="img" class="md hydrated"
                                    aria-label="musical notes outline"></ion-icon>
                            </div>
                            <div class="in">
                                <div>Music</div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item">
                            <div class="icon-box bg-danger">
                                <ion-icon name="musical-notes-outline" role="img" class="md hydrated"
                                    aria-label="musical notes outline"></ion-icon>
                            </div>
                            <div class="in">
                                <div>Music</div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item">
                            <div class="icon-box bg-danger">
                                <ion-icon name="musical-notes-outline" role="img" class="md hydrated"
                                    aria-label="musical notes outline"></ion-icon>
                            </div>
                            <div class="in">
                                <div>Music</div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item">
                            <div class="icon-box bg-danger">
                                <ion-icon name="musical-notes-outline" role="img" class="md hydrated"
                                    aria-label="musical notes outline"></ion-icon>
                            </div>
                            <div class="in">
                                <div>Music</div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item">
                            <div class="icon-box bg-danger">
                                <ion-icon name="musical-notes-outline" role="img" class="md hydrated"
                                    aria-label="musical notes outline"></ion-icon>
                            </div>
                            <div class="in">
                                <div>Music</div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel">
                <ul class="listview image-listview">
                    <li>
                        <div class="item">
                            <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                            <div class="in">
                                <div>Edward Lindgren</div>
                                <span class="text-muted">Designer</span>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item">
                            <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                            <div class="in">
                                <div>Emelda Scandroot</div>
                                <span class="badge badge-primary">3</span>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item">
                            <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                            <div class="in">
                                <div>Henry Bove</div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item">
                            <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                            <div class="in">
                                <div>Henry Bove</div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="item">
                            <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                            <div class="in">
                                <div>Henry Bove</div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div> --}}


    <div class="section mt-2" id="menu-section">
        <div class="todaypresence">
            {{-- INFORMASI ABSEN --}}
            <div class="row mb-4">
                <div class="col-3">
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
                <div class="col-3">
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
                <div class="col-3">
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
                <div class="col-3">
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
                                        <h4>Jam Sekarang</h4>
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
                                        <h4>Jam Sekarang</h4>
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
                                        <h4>Jam Sekarang</h4>
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
                                        <h4>Jam Sekarang</h4>
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
                <div class="col-6">
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
                <div class="col-6">
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
            <div class="row mt-2">
                <div class="col-6">
                    <div class="card gradasiyellow">
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
                    </div>
                </div>
                <div class="col-6">
                    <div class="card gradasired">
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
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12">
                    <div class="card gradasiblue">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-6 d-flex justify-content-end">
                                    <ion-icon class="iconbuttonabsen" name="camera-outline"></ion-icon>
                                </div>
                                <div class="col-6 d-flex align-items-center">
                                    <h4 style="color: white; margin: 0;">ABSEN</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
