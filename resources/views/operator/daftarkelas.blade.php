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
                        <li class="breadcrumb-item"><a href="javascript:void(0)"></a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Daftar Kelas</a></li>

                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Daftar Kelas</h4>
                            <div class="text-right">
                                <button type="button" class="btn btn-rounded btn-primary" data-toggle="modal"
                                    data-target="#addKelasModal">
                                    <span class="btn-icon-left text-primary"><i
                                            class="fa fa-plus color-primary"></i></span>Tambah Kelas
                                </button>
                                <button type="button" class="btn btn-rounded btn-warning" data-toggle="modal"
                                    data-target="#importKelasModal">
                                    <span class="btn-icon-left text-warning"><i
                                            class="fa fa-download color-warning"></i></span>Import
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
                                                style="width: 75.184px;">ID Kelas</th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                colspan="1" aria-label="Office: activate to sort column ascending"
                                                style="width: 80.55px;">ID Jurusan</th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1"
                                                colspan="1" aria-sort="ascending"
                                                aria-label="Name: activate to sort column descending"
                                                style="width: 178.8px;">nuptk</th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                colspan="1" aria-label="Age: activate to sort column ascending"
                                                style="width: 100.092px;">Nomor Kelas</th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                colspan="1" aria-label="Start date: activate to sort column ascending"
                                                style="width: 118.068px;">Tingkat</th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                colspan="1" aria-label="Salary: activate to sort column ascending"
                                                style="width: 109.68px;">Jumlah Siswa</th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                colspan="1" aria-label="Salary: activate to sort column ascending"
                                                style="width: 109.68px;">Action</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        @foreach ($kelas as $k)
                                            <tr>
                                                <td>{{ $k->id_kelas }}</td>
                                                <td>{{ $k->jurusan->id_jurusan }}</td>
                                                <td>{{ $k->walikelas->nuptk }}</td>
                                                <td>{{ $k->nomor_kelas }}</td>
                                                <td>{{ $k->tingkat }}</td>
                                                <td>{{ $k->jumlah_siswa }}</td>
                                                <td class="row d-flex align-items-center">
                                                    <button class="btn btn-success mr-2 edit-kelas" data-toggle="modal"
                                                        data-target="#editKelasModal{{ $k->id_kelas }}">
                                                        <i class="ti-pencil"></i>
                                                    </button>
                                                    <form action="{{ route('hapuskelas', $k->id_kelas) }}" method="POST"
                                                        style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('Apakah Anda yakin?')">
                                                            <i class="ti-trash"></i>
                                                        </button>
                                                    </form>
                                                    <a href="{{ route('daftarsiswa', ['id_kelas' => $k->id_kelas]) }}"
                                                        class="btn btn-info ml-2">
                                                        <i class="ti-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="editKelasModal{{ $k->id_kelas }}" tabindex="-1"
                                                role="dialog" aria-labelledby="editKelasModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editKelasModalLabel">Edit Kelas
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form
                                                            action="{{ route('editkelas', ['id_kelas' => $k->id_kelas]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label for="edit_id_jurusan"
                                                                            style="color: black">ID Jurusan</label>
                                                                        <select id="edit_id_jurusan" name="id_jurusan"
                                                                            class="form-control" required>
                                                                            <option value="" disabled selected>Pilih
                                                                                Jurusan</option>
                                                                            @foreach ($jurusan as $j)
                                                                                <option value="{{ $j->id_jurusan }}">
                                                                                    {{ $j->nama_jurusan }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="edit_nuptk"
                                                                            style="color: black">NUPTK</label>
                                                                        <select id="edit_nuptk" name="nuptk"
                                                                            class="form-control" required>
                                                                            <option value="" disabled selected>Pilih
                                                                                NUPTK</option>
                                                                            @foreach ($walikelas as $w)
                                                                                <option value="{{ $w->nuptk }}">
                                                                                    {{ $w->nuptk }} -
                                                                                    {{ $w->nama }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="edit_nomor_kelas"
                                                                            style="color: black">Nomor Kelas</label>
                                                                        <input type="text" id="edit_nomor_kelas"
                                                                            name="nomor_kelas" class="form-control"
                                                                            value="{{ $k->nomor_kelas }}" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="edit_tingkat"
                                                                            style="color: black">Tingkat</label>
                                                                        <select id="edit_tingkat" name="tingkat"
                                                                            class="form-control" required>
                                                                            <option value="" disabled selected>Pilih
                                                                                Tingkat</option>
                                                                            <option value="10">Kelas 10</option>
                                                                            <option value="11">Kelas 11</option>
                                                                            <option value="12">Kelas 12</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="edit_jumlah_siswa"
                                                                            style="color: black">Jumlah Siswa</label>
                                                                        <input type="text" id="edit_jumlah_siswa"
                                                                            name="jumlah_siswa" class="form-control"
                                                                            value="{{ $k->jumlah_siswa }}" required>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger"
                                                                        data-dismiss="modal">Tutup</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Simpan</button>
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
            {{-- Modal Tambah Kelas --}}
            <div class="modal fade" id="addKelasModal" tabindex="-1" role="dialog"
                aria-labelledby="addKelasModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addKelasModalLabel">Tambah Kelas</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('tambahkelas') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="id_jurusan" style="color: black">ID Jurusan</label>
                                    <select name="id_jurusan" class="form-control" required>
                                        @foreach ($jurusan as $j)
                                            <option value="{{ $j->id_jurusan }}">{{ $j->nama_jurusan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="nuptk" style="color: black">NUPTK</label>
                                    <select name="nuptk" class="form-control" required>
                                        @foreach ($walikelas as $w)
                                            <option value="{{ $w->nuptk }}">{{ $w->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="nomor_kelas" style="color: black">Nomor Kelas</label>
                                    <input type="text" name="nomor_kelas" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="tingkat" style="color: black">Tingkat</label>
                                    <input type="text" name="tingkat" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="jumlah_siswa" style="color: black">Jumlah Siswa</label>
                                    <input type="number" name="jumlah_siswa" class="form-control" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Modal Import Kelas --}}
            <div class="modal fade" id="importKelasModal" tabindex="-1" role="dialog"
                aria-labelledby="importKelasModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="importKelasModalLabel">Import Data Kelas</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="#" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input">
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Import</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
