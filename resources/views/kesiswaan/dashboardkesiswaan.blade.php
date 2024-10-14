@extends('layouts.layoutkesiswaan')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Hi, Kesiswaan!</h4>
                        <p class="mb-0">Dashboard Kesiswaan Aplikasi Absensi SMKN 11 Bandung</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)"></a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Dashboard</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="stat-widget-one card-body">
                            <div class="stat-icon d-inline-block">
                                <i class="ti-money text-success border-success"></i>
                            </div>
                            <div class="stat-content d-inline-block">
                                <div class="stat-text">Hadir</div>
                                <div class="stat-digit">{{ number_format($percentageHadir) }}% </div>
                            </div>
                            <!-- Progress bar -->
                            <div class="progress mt-3">
                                <div class="progress-bar bg-success" role="progressbar"
                                    style="width: {{ number_format($percentageHadir) }}%;" aria-valuenow="70"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="stat-widget-one card-body">
                            <div class="stat-icon d-inline-block">
                                <i class="ti-user text-primary border-primary"></i>
                            </div>
                            <div class="stat-content d-inline-block">
                                <div class="stat-text">Sakit/Izin</div>
                                <div class="stat-digit">{{ number_format($percentageSakitIzin) }}%</div>
                            </div>
                            <!-- Progress bar -->
                            <div class="progress mt-3">
                                <div class="progress-bar bg-primary" role="progressbar"
                                    style="width: {{ number_format($percentageSakitIzin) }}%;" aria-valuenow="80"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="stat-widget-one card-body">
                            <div class="stat-icon d-inline-block">
                                <i class="ti-layout-grid2 text-pink border-pink"></i>
                            </div>
                            <div class="stat-content d-inline-block">
                                <div class="stat-text">Alfa</div>
                                <div class="stat-digit">{{ number_format($percentageAlfa) }}%</div>
                            </div>
                            <!-- Progress bar -->
                            <div class="progress mt-3">
                                <div class="progress-bar bg-pink" role="progressbar"
                                    style="width: {{ number_format($percentageAlfa) }}%;" aria-valuenow="60"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="stat-widget-one card-body">
                            <div class="stat-icon d-inline-block">
                                <i class="ti-link text-danger border-danger"></i>
                            </div>
                            <div class="stat-content d-inline-block">
                                <div class="stat-text">Terlambat</div>
                                <div class="stat-digit">{{ number_format($percentageTerlambat) }}%</div>
                            </div>
                            <!-- Progress bar -->
                            <div class="progress mt-3">
                                <div class="progress-bar bg-danger" role="progressbar"
                                    style="width: {{ number_format($percentageTerlambat) }}%;" aria-valuenow="90"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Statistik</h4>
                            <form action="{{ route('kesiswaan') }}" method="GET">
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
                            <canvas id="statusChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById('statusChart').getContext('2d');
            var statusChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Hadir', 'Sakit/Izin', 'Alfa'],
                    datasets: [{
                        label: 'Statistik Kehadiran',
                        data: [
                            {{ $countHadir }},
                            {{ $countSakitIzin }},
                            {{ $countAlfa }},
                        ],
                        backgroundColor: [
                            '#0e9f6e', // Warna untuk Hadir
                            '#ffb020', // Warna untuk Sakit/Izin
                            '#c81e1e' // Warna untuk Alfa
                        ],
                        borderColor: [
                            '#0e9f6e',
                            '#ffb020',
                            '#c81e1e'
                        ],
                        borderWidth: 2,
                        borderRadius: 5,
                        hoverBackgroundColor: [
                            '#0c865b',
                            '#e59a18',
                            '#b51a1a'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                display: false // Menyembunyikan angka di sumbu Y
                            },
                            grid: {
                                color: '#e0e0e0',
                                borderDash: [5, 5]
                            },
                            // Meningkatkan suggestedMax untuk memberikan ruang di atas bar
                            suggestedMax: Math.ceil(Math.max({{ $countHadir }}, {{ $countSakitIzin }},
                                {{ $countAlfa }}) * 1.2) // Mengalikan 1.2 untuk memberikan ruang
                        },
                        x: {
                            ticks: {
                                font: {
                                    size: 14
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            labels: {
                                font: {
                                    size: 16
                                },
                                color: '#333'
                            }
                        },
                        tooltip: {
                            backgroundColor: '#fff',
                            borderColor: '#ccc',
                            borderWidth: 1,
                            titleColor: '#333',
                            bodyColor: '#333',
                            bodyFont: {
                                size: 14
                            }
                        }
                    },
                    animation: {
                        duration: 1500,
                        easing: 'easeOutBounce'
                    }
                }
            });
        });
    </script>
@endsection
