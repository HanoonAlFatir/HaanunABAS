@extends('layouts.dashboardoperator')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Hi, Operator!</h4>
                    <p class="mb-0">Daftar Kelas SMKN 11 Bandung</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)"></a>Kelas</li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Daftar Siswa</a></li>

                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Daftar Siswa Kelas {{ $kelas->tingkat }} {{ $kelas->jurusan->nama_jurusan }}</h4>
                        <div class="text-right">
                            <button type="button" class="btn btn-rounded btn-primary" data-toggle="modal"
                                data-target="#addKelasModal">
                                <span class="btn-icon-left text-primary"><i
                                        class="fa fa-plus color-primary"></i></span>Tambah Siswa
                            </button>
                        </div>
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
                                            style="width: 220.092px;">Nama</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                            colspan="1" aria-label="Start date: activate to sort column ascending"
                                            style="width: 118.068px;">Jenis Kelamin</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                            colspan="1" aria-label="Salary: activate to sort column ascending"
                                            style="width: 109.68px;">NIK</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                            colspan="1" aria-label="Salary: activate to sort column ascending"
                                            style="width: 109.68px;">NISN</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                            colspan="1" aria-label="Salary: activate to sort column ascending"
                                            style="width: 109.68px;">Aksi</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    @foreach ($siswa as $s)
                                        <tr>
                                            <td>{{ $s->nis }}</td>
                                            <td>{{ $s->nama }}</td>
                                            <td>{{ $s->jenis_kelamin }}</td>
                                            <td>{{ $s->nik}}</td>
                                            <td>{{ $s->nisn}}</td>
                                            <td class="row">
                                                <button class="btn btn-success mr-2 edit-siswa" data-toggle="modal" data-target="#editSiswaModal{{ $s->nis }}">
                                                    <i class="ti-pencil"></i>
                                                </button>
                                                <form action="" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin?')">
                                                        <i class="ti-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="editSiswaModal{{ $s->nis }}" tabindex="-1" role="dialog" aria-labelledby="editSiswaModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editSiswaModalLabel">Edit Data Siswa</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form method="POST" action="{{ route('editsiswa', ['nis' => $s->nis]) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="edit_nis" style="color: black">NIS</label>
                                                                <input type="text" name="nis" id="edit_nis" class="form-control" value="{{ $s->nis }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="edit_nama" style="color: black">Nama</label>
                                                                <input type="text" name="nama" id="edit_nama" class="form-control" value="{{ $s->nama }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="edit_jenis_kelamin" style="color: black">Jenis Kelamin</label>
                                                                <select name="jenis_kelamin" id="edit_jenis_kelamin" class="form-control" required>
                                                                    <option value="laki laki">Laki-laki</option>
                                                                    <option value="perempuan">Perempuan</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="edit_nik" style="color: black">NIK</label>
                                                                <input type="text" name="nik" id="edit_nik" class="form-control" value="{{ $s->nik }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="edit_nisn" style="color: black">NISN</label>
                                                                <input type="text" name="nisn" id="edit_nisn" class="form-control" value="{{ $s->nisn }}" required>
                                                                <input type="hidden" name="id_kelas" value="{{ $s->id_kelas }}">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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
