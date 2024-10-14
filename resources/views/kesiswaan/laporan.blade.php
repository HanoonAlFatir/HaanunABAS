@extends('layouts.layoutkesiswaan')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Hi, Kesiswaan!</h4>
                        <p class="mb-0">Kehadiran Siswa/i SMKN 11 Bandung</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)"></a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Laporan</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-2">Rekap Kehadiran</h4>
                            <form action="{{ route('laporan') }}" method="GET">
                                <div class="row mb-0 mt-2">
                                    <!-- Filter Tanggal -->
                                    <div class="col">
                                        <div class="form-row align-items-center">
                                            <div class="col-auto d-flex align-items-center mb-3">
                                                <label for="from-date" class="mb-0 mr-2">From</label>
                                                <input type="date" id="from-date" name="start_date" class="form-control"
                                                    style="width: 150px;">
                                            </div>
                                            <div class="col-auto d-flex align-items-center mb-3">
                                                <label for="to-date" class="mb-0 mr-2">To</label>
                                                <input type="date" id="to-date" name="end_date" class="form-control"
                                                    style="width: 150px;">
                                            </div>
                                            <div class="col-auto mb-3">
                                                <button class="btn btn-primary" type="submit">Cari</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="card-body">
                            <!-- Persentase Kehadiran Seluruh Siswa -->
                            <div class="mb-4">
                                <h5 class="card-title">Persentase Kehadiran Seluruh Siswa Bulan Ini</h5>
                                <div class="progress mb-3" style="height: 30px;">
                                    <div class="progress-bar bg-success" role="progressbar"
                                        style="width: {{ $averagePercentageHadir }}%;"
                                        aria-valuenow="{{ number_format($averagePercentageHadir) }}" aria-valuemin="0"
                                        aria-valuemax="100">
                                        {{ number_format($averagePercentageHadir) }}%
                                    </div>
                                </div>
                            </div>

                            <!-- Persentase Kehadiran Per Kelas -->
                            <div class="mb-4">
                                <h5 class="card-title">Persentase Kehadiran Per Kelas</h5>
                                @foreach ($kelasData as $k)
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div style="flex: 1; color:black;">{{ $k['kelas'] }}</div> <!-- Nama kelas akan mendapatkan ruang yang cukup -->
                                    <div class="progress flex-grow-1 mx-3" style="height: 25px; width: 70%;"> <!-- Flex-grow ditambahkan agar lebih fluid -->
                                        <div class="progress-bar bg-info" role="progressbar" style="width: {{ number_format($k['percentageHadir']) }}%;"
                                            aria-valuenow="{{ number_format($k['percentageHadir']) }}" aria-valuemin="0" aria-valuemax="100">
                                            {{ number_format($k['percentageHadir']) }}%
                                        </div>
                                    </div>
                                    <!-- Button for Details -->
                                    <div>
                                        <a href="{{ route('kesiswaan.daftarsiswa', ['kelas_id' => $k['kelas_id']]) }}" class="btn btn-sm btn-outline-secondary">
                                            <i class="fa fa-ellipsis-h"></i>
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
