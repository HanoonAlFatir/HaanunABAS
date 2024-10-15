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
                        <li class="breadcrumb-item"><a href="{{ route('laporan') }}">Laporan</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Daftar Siswa</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-2">Rekap Kehadiran {{ $kelas->tingkat }}
                                {{ $kelas->jurusan->id_jurusan }} {{ $kelas->nomor_kelas }}</h4>
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
                            <div class="table-responsive data-text">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                colspan="1" aria-label="Position: activate to sort column ascending"
                                                style="width: 100.184px;">NIS</th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                colspan="1" aria-label="Age: activate to sort column ascending"
                                                style="width: 200.092px;">Nama</th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                colspan="1" aria-label="Start date: activate to sort column ascending"
                                                style="width: 118.068px;">Jenis Kelamin</th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                colspan="1" aria-label="Salary: activate to sort column ascending"
                                                style="width: 120.68px;">Persentase Kehadiran</th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                colspan="1" aria-label="Salary: activate to sort column ascending"
                                                style="width: 10.68px;">Aksi</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        @foreach ($studentsData as $s)
                                            <tr>
                                                <td>{{ $s['nis'] }}</td>
                                                <td>{{ $s['name'] }}</td>
                                                <td>{{ $s['jenis_kelamin'] }}</td>
                                                <td>
                                                    @php
                                                        $hadir = $s['attendancePercentages']['Hadir'];
                                                        $badgeClass = '';

                                                        if ($hadir > 90) {
                                                            $badgeClass = 'badge bg-success';  // jika > 90%
                                                        } elseif ($hadir >= 60 && $hadir <= 90) {
                                                            $badgeClass = 'badge bg-warning';  // jika 60% - 90%
                                                        } else {
                                                            $badgeClass = 'badge bg-danger';  // jika < 60%
                                                        }
                                                    @endphp
                                                    <span class="{{ $badgeClass }} rounded-pill" style="font-weight: bold; padding: 4px 8px; color: white; width: 100%;">
                                                        {{ number_format($hadir) }}%
                                                    </span>
                                                </td>
                                                <td class="row">
                                                    <a href="#" class="btn btn-sm btn-outline-secondary">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            {{-- @include('operator.modal.siswamodal') --}}
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
