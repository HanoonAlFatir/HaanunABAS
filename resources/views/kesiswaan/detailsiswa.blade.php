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
                        <form action="{{ route('detail') }}" method="GET">
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

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
