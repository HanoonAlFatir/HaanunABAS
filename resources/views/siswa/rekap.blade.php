@extends('layouts.layoutsiswa')

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

@section('content')
    <div class="section mt-2" id="menu-section">
        <div class="todaypresence">
            <div class="row">
                <div class="col">
                    <div class="container bottomnavmargin">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-center">Laporan Absensi Anda</h5>
                                <!-- Tabel Rekapan Kehadiran -->
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">Tanggal</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Detail</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($absensi as $a)
                                                <tr>
                                                    <td>{{ $a->date }}</td>
                                                    <td>
                                                        @if ($a->status == 'Hadir')
                                                            <span>{{ $a->status }}</span>
                                                        @elseif ($a->status == 'Terlambat')
                                                            <span>{{ $a->status }}</span>
                                                        @elseif ($a->status == 'TAP')
                                                            <span>{{ $a->status }}</span>
                                                        @elseif ($a->status == 'Sakit')
                                                            <span>{{ $a->status }}</span>
                                                        @elseif ($a->status == 'Alfa')
                                                            <span>{{ $a->status }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-primary btn-sm btn-detail"
                                                            data-toggle="modal"
                                                            data-target="#detailModal{{ $a->id_absensi }}">
                                                            Detail
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @foreach ($absensi as $a)
                                        <!-- Modal Bootstrap -->
                                        <div class="modal fade" id="detailModal{{ $a->id_absensi }}" tabindex="-1"
                                            role="dialog" aria-labelledby="detailModalLabel{{ $a->id_absensi }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="detailModalLabel{{ $a->id_absensi }}">
                                                            Detail Absensi</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p><strong>Status:</strong> {{ $a->status }}</p>
                                                        <p><strong>Jam Masuk:</strong> {{ $a->jam_masuk }}</p>
                                                        <p><strong>Jam Pulang:</strong> {{ $a->jam_pulang }}</p>
                                                        <p><strong>Menit Keterlambatan:</strong>
                                                            {{ $a->menit_keterlambatan }}</p>
                                                        <p><strong>Keterangan:</strong> {{ $a->keterangan }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>

                                <!-- Pagination -->
                                <nav aria-label="Page navigation example" class="mt-4">
                                    {{ $absensi->links('pagination::bootstrap-4') }}
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="container bottomnavmargin">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-center">Rekap Anda</h5>
                                <form action="{{ route('siswa.rekap') }}" method="GET">
                                    <div class="d-flex align-items-center mb-2">
                                        <label for="from-date" class="mb-0 mr-2">From</label>
                                        <input type="date" id="from-date" name="start_date"
                                            class="form-control col-4 mr-2">
                                        <label for="to-date" class="mb-0 mr-2">To</label>
                                        <input type="date" id="to-date" name="end_date"
                                            class="form-control col-4 mr-2">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="zmdi zmdi-search"></i> Cari
                                        </button>
                                    </div>
                                </form>
                                <div class="progress mb-4">
                                    <div class="progress-bar bg-success" role="progressbar"
                                        style="width: {{ $persentaseHadir }}%;" aria-valuenow="{{ $persentaseHadir }}"
                                        aria-valuemin="0" aria-valuemax="100">
                                        Persentase Hadir : {{ $persentaseHadir }}%
                                    </div>
                                </div>
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span><strong>Jumlah Hadir</strong></span>
                                        <span class="badge bg-primary rounded-pill">{{ $jumlahHadir }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span><strong>Jumlah Izin</strong></span>
                                        <span class="badge bg-info rounded-pill">{{ $jumlahIzin }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span><strong>Jumlah Terlambat</strong></span>
                                        <span class="badge bg-warning rounded-pill">{{ $jumlahTerlambat }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span><strong>Jumlah Alfa</strong></span>
                                        <span class="badge bg-danger rounded-pill">{{ $jumlahAlfa }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span><strong>Jumlah TAP</strong></span>
                                        <span class="badge bg-secondary rounded-pill">{{ $jumlahTap }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span><strong>Keterlambatan (menit)</strong></span>
                                        <span class="badge bg-dark rounded-pill">{{ $totalKeterlambatan }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function() {
            // Set tanggal mulai dan akhir ke 29 hari yang lalu dan hari ini
            var start = $('#start').val() ? moment($('#start').val()) : moment().subtract(29, 'days').startOf(
                'day');
            var end = $('#end').val() ? moment($('#end').val()) : moment().endOf('day');

            // Fungsi callback untuk memperbarui teks di tombol dan input hidden
            function cb(start, end) {
                $('#reportrange span').html(start.format('MMMM D YYYY') + ' - ' + end.format('MMMM D YYYY'));
                // Update input hidden dengan format tanggal YYYY-MM-DD
                $('#start').val(start.format('YYYY-MM-DD'));
                $('#end').val(end.format('YYYY-MM-DD'));
            }

            // Inisialisasi daterangepicker
            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Hari Ini': [moment().startOf('day'), moment().endOf('day')],
                    'Kemarin': [moment().subtract(1, 'days').startOf('day'), moment().subtract(1, 'days')
                        .endOf('day')
                    ],
                    '7 Hari Terakhir': [moment().subtract(6, 'days').startOf('day'), moment().endOf('day')],
                    '30 Hari Terakhir': [moment().subtract(29, 'days').startOf('day'), moment().endOf(
                        'day')],
                    'Bulan Ini': [moment().startOf('month').startOf('day'), moment().endOf('month').endOf(
                        'day')],
                    'Bulan Sebelumnya': [moment().subtract(1, 'month').startOf('month').startOf('day'),
                        moment().subtract(1, 'month').endOf('month').endOf('day')
                    ]
                }
            }, cb);

            // Panggil callback untuk set teks default dan input hidden
            cb(start, end);
        });
    </script>
@endsection
