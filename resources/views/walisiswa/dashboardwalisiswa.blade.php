@extends('layouts.layoutwalisiswa')

@section('content')
    <div class="section mt-2" id="menu-section">
        <div class="todaypresence">
            <div class="row mb-2">
                @foreach ($siswas as $siswa)
                    <div class="col-12 col-md-6 mb-3">
                        <div class="card shadow-sm border-0 h-100">
                            <div class="card-body">
                                <!-- Display student name and class -->
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="mb-0">{{ $siswa->user->name }}</h5>
                                    <h5 class="mb-0">{{ $siswa->kelas->tingkat }} {{ $siswa->kelas->id_jurusan }}
                                        {{ $siswa->kelas->nomor_kelas }}</h5>
                                </div>

                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="bulan-ini-tab-{{ $siswa->nis }}"
                                            data-bs-toggle="tab" data-bs-target="#bulan_ini_{{ $siswa->nis }}"
                                            type="button" role="tab" aria-controls="bulan_ini_{{ $siswa->nis }}"
                                            aria-selected="true">
                                            Bulan Ini
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="bulan-sebelumnya-tab-{{ $siswa->nis }}"
                                            data-bs-toggle="tab" data-bs-target="#bulan_sebelumnya_{{ $siswa->nis }}"
                                            type="button" role="tab"
                                            aria-controls="bulan_sebelumnya_{{ $siswa->nis }}" aria-selected="false">
                                            Bulan Sebelumnya
                                        </button>
                                    </li>
                                </ul>

                                <!-- Tab content -->
                                <div class="tab-content mt-3" id="myTabContent">
                                    <div class="tab-pane fade show active" id="bulan_ini_{{ $siswa->nis }}"
                                        role="tabpanel" aria-labelledby="bulan-ini-tab-{{ $siswa->nis }}">
                                        <!-- Content for "Bulan Ini" -->
                                        <p>Data kehadiran bulan ini untuk {{ $siswa->user->name }}.</p>
                                        <div class="col-12">
                                            <!-- Jumlah Kehadiran -->
                                            <div class="pt-3">
                                                Jumlah Kehadiran:
                                                {{ $siswa->dataBulanIni['Hadir'] ?? 0 }}
                                            </div>
                                            <div class="progress mt-2" style="height: auto;">
                                                <div class="progress-bar bg-success" role="progressbar"
                                                    style="width: {{ $siswa->persentaseHadirBulanIni }}%;"
                                                    aria-valuenow="{{ $siswa->persentaseHadirBulanIni }}" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                    {{ $siswa->persentaseHadirBulanIni }}%
                                                </div>
                                            </div>

                                            <!-- Jumlah Sakit/Izin -->
                                            <div class="pt-3">
                                                Jumlah Sakit/Izin:
                                                {{ $siswa->dataBulanIni['Sakit/Izin'] ?? 0 }}
                                            </div>
                                            <div class="progress mt-2" style="height: auto;">
                                                <div class="progress-bar bg-info" role="progressbar"
                                                    style="width: {{ $siswa->persentaseSakitIzinBulanIni }}%;"
                                                    aria-valuenow="{{ $siswa->persentaseSakitIzinBulanIni }}"
                                                    aria-valuemin="0" aria-valuemax="100">
                                                    {{ $siswa->persentaseSakitIzinBulanIni }}%
                                                </div>
                                            </div>

                                            <!-- Jumlah Terlambat -->
                                            <div class="pt-3">
                                                Jumlah Terlambat:
                                                {{ $siswa->dataBulanIni['Terlambat'] ?? 0 }}
                                            </div>
                                            <div class="progress mt-2" style="height: auto;">
                                                <div class="progress-bar bg-secondary" role="progressbar"
                                                    style="width: {{ $siswa->persentaseTerlambatBulanIni }}%;"
                                                    aria-valuenow="{{ $siswa->persentaseTerlambatBulanIni }}"
                                                    aria-valuemin="0" aria-valuemax="100">
                                                    {{ $siswa->persentaseTerlambatBulanIni }}%
                                                </div>
                                            </div>

                                            <!-- Jumlah Alfa -->
                                            <div class="pt-3">
                                                Jumlah Alfa: {{ $siswa->dataBulanIni['Alfa'] ?? 0 }}
                                            </div>
                                            <div class="progress mt-2" style="height: auto;">
                                                <div class="progress-bar bg-danger" role="progressbar"
                                                    style="width: {{ $siswa->persentaseAlfaBulanIni }}%;"
                                                    aria-valuenow="{{ $siswa->persentaseAlfaBulanIni }}" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                    {{ $siswa->persentaseAlfaBulanIni }}%
                                                </div>
                                            </div>

                                            <!-- Jumlah TAP -->
                                            <div class="pt-3">
                                                Jumlah TAP: {{ $siswa->dataBulanIni['TAP'] ?? 0 }}
                                            </div>
                                            <div class="progress mt-2" style="height: auto;">
                                                <div class="progress-bar bg-danger" role="progressbar"
                                                    style="width: {{ $siswa->persentaseTAPBulanIni }}%;"
                                                    aria-valuenow="{{ $siswa->persentaseTAPBulanIni }}" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                    {{ $siswa->persentaseTAPBulanIni }}%
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="bulan_sebelumnya_{{ $siswa->nis }}" role="tabpanel"
                                        aria-labelledby="bulan-sebelumnya-tab-{{ $siswa->nis }}">
                                        <!-- Content for "Bulan Sebelumnya" -->
                                        <p>Data kehadiran bulan sebelumnya untuk {{ $siswa->user->name }}.</p>
                                        <div class="col-12">
                                            <!-- Jumlah Kehadiran -->
                                            <div class="pt-3">
                                                Jumlah Kehadiran:
                                                {{ $siswa->dataBulanSebelumnya['Hadir'] ?? 0 }}
                                            </div>
                                            <div class="progress mt-2" style="height: auto;">
                                                <div class="progress-bar bg-success" role="progressbar"
                                                    style="width: {{ $siswa->persentaseHadirBulanSebelumnya }}%;"
                                                    aria-valuenow="{{ $siswa->persentaseHadirBulanSebelumnya }}" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                    {{ $siswa->persentaseHadirBulanSebelumnya }}%
                                                </div>
                                            </div>

                                            <!-- Jumlah Sakit/Izin -->
                                            <div class="pt-3">
                                                Jumlah Sakit/Izin:
                                                {{ $siswa->dataBulanSebelumnya['Sakit/Izin'] ?? 0 }}
                                            </div>
                                            <div class="progress mt-2" style="height: auto;">
                                                <div class="progress-bar bg-info" role="progressbar"
                                                    style="width: {{ $siswa->persentaseSakitIzinBulanSebelumnya }}%;"
                                                    aria-valuenow="{{ $siswa->persentaseSakitIzinBulanSebelumnya }}"
                                                    aria-valuemin="0" aria-valuemax="100">
                                                    {{ $siswa->persentaseSakitIzinBulanSebelumnya }}%
                                                </div>
                                            </div>

                                            <!-- Jumlah Terlambat -->
                                            <div class="pt-3">
                                                Jumlah Terlambat:
                                                {{ $siswa->dataBulanSebelumnya['Terlambat'] ?? 0 }}
                                            </div>
                                            <div class="progress mt-2" style="height: auto;">
                                                <div class="progress-bar bg-secondary" role="progressbar"
                                                    style="width: {{ $siswa->persentaseTerlambatBulanSebelumnya }}%;"
                                                    aria-valuenow="{{ $siswa->persentaseTerlambatBulanSebelumnya }}"
                                                    aria-valuemin="0" aria-valuemax="100">
                                                    {{ $siswa->persentaseTerlambatBulanSebelumnya }}%
                                                </div>
                                            </div>

                                            <!-- Jumlah Alfa -->
                                            <div class="pt-3">
                                                Jumlah Alfa: {{ $siswa->dataBulanSebelumnya['Alfa'] ?? 0 }}
                                            </div>
                                            <div class="progress mt-2" style="height: auto;">
                                                <div class="progress-bar bg-danger" role="progressbar"
                                                    style="width: {{ $siswa->persentaseAlfaBulanSebelumnya }}%;"
                                                    aria-valuenow="{{ $siswa->persentaseAlfaBulanSebelumnya }}" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                    {{ $siswa->persentaseAlfaBulanSebelumnya }}%
                                                </div>
                                            </div>

                                            <!-- Jumlah TAP -->
                                            <div class="pt-3">
                                                Jumlah TAP: {{ $siswa->dataBulanSebelumnya['TAP'] ?? 0 }}
                                            </div>
                                            <div class="progress mt-2" style="height: auto;">
                                                <div class="progress-bar bg-danger" role="progressbar"
                                                    style="width: {{ $siswa->persentaseTAPBulanSebelumnya }}%;"
                                                    aria-valuenow="{{ $siswa->persentaseTAPBulanSebelumnya }}" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                    {{ $siswa->persentaseTAPBulanSebelumnya }}%
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
