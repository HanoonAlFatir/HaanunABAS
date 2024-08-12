@extends('layouts.dashboardoperator')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Hi, Operator!</h4>
                        <p class="mb-0">Daftar Wali Kelas SMKN 11 Bandung</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)"></a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Daftar Wali Kelas</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Daftar Wali Kelas</h4>
                            <div class="text-right">
                                <button type="button" class="btn btn-rounded btn-primary" data-toggle="modal"
                                    data-target="#addWaliKelasModal">
                                    <span class="btn-icon-left text-primary"><i
                                            class="fa fa-plus color-primary"></i></span>Tambah
                                </button>
                                <a href="#">
                                    <button type="button" class="btn btn-rounded btn-warning">
                                        <span class="btn-icon-left text-warning"><i
                                                class="fa fa-download color-warning"></i></span>Import
                                    </button>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive data-text">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                colspan="1" aria-label="Position: activate to sort column ascending"
                                                style="width: 275.184px;">NUPTK</th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                colspan="1" aria-label="Office: activate to sort column ascending"
                                                style="width: 100.55px;">ID User</th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1"
                                                colspan="1" aria-sort="ascending"
                                                aria-label="Name: activate to sort column descending"
                                                style="width: 178.8px;">Nama</th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                colspan="1" aria-label="Age: activate to sort column ascending"
                                                style="width: 180.092px;">Jenis Kelamin</th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                colspan="1" aria-label="Start date: activate to sort column ascending"
                                                style="width: 118.068px;">NIP</th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                colspan="1" aria-label="Salary: activate to sort column ascending"
                                                style="width: 109.68px;">Action</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        @foreach ($wali as $w)
                                            <tr>
                                                <td>{{ $w->nuptk }}</td>
                                                <td>{{ $w->user->id }}</td>
                                                <td>{{ $w->user->name }}</td>
                                                <td>{{ $w->jenis_kelamin }}</td>
                                                <td>{{ $w->nip }}</td>
                                                <td class="row">
                                                    <button type="button" class="btn btn-success mr-2 edit-wali-kelas"
                                                        data-toggle="modal"
                                                        data-target="#editWaliKelasModal{{ $w->id_user }}">
                                                        <i class="ti-pencil"></i>
                                                    </button>
                                                    <form action="{{ route('operator.destroy', $w->nuptk) }}" method="POST"
                                                        style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('Apakah Anda yakin?')">
                                                            <i class="ti-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="editWaliKelasModal{{ $w->id_user }}"
                                                tabindex="-1" role="dialog" aria-labelledby="editWaliKelasModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editWaliKelasModalLabel">Edit Data
                                                                Wali Kelas</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form method="POST"
                                                            action="{{ route('walikelas.update', ['id' => $w->id_user]) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="edit_nuptk"
                                                                        style="color: black">NUPTK</label>
                                                                    <input type="text" name="nuptk" id="edit_nuptk"
                                                                        class="form-control" value="{{ $w->nuptk }}"
                                                                        required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="edit_id_user" style="color: black">ID
                                                                        User</label>
                                                                    <input type="text" name="id_user"
                                                                        id="edit_id_user" value="{{ $w->id_user }}"
                                                                        class="form-control" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="edit_nama"
                                                                        style="color: black">Nama</label>
                                                                    <input type="text" name="nama" id="edit_nama"
                                                                        class="form-control" value="{{ $w->name }}"
                                                                        required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="edit_jenis_kelamin"
                                                                        style="color: black">Jenis Kelamin</label>
                                                                    <select name="jenis_kelamin" id="edit_jenis_kelamin"
                                                                        class="form-control" required>
                                                                        <option value="laki laki">Laki-laki</option>
                                                                        <option value="perempuan">Perempuan</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="edit_nip" style="color: black">NIP</label>
                                                                    <input type="text" name="nip" id="edit_nip"
                                                                        class="form-control" value="{{ $w->nip }}"
                                                                        required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="edit_email"
                                                                        style="color: black">Email</label>
                                                                    <input type="email" name="email" id="edit_email"
                                                                        class="form-control"
                                                                        value="{{ $w->user->email }}" required>
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

                {{-- Modal Tambah Wali Kelas --}}
                <div class="modal fade" id="addWaliKelasModal" tabindex="-1" role="dialog"
                    aria-labelledby="addWaliKelasModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addWaliKelasModalLabel">Tambah Wali Kelas</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('tambahwalikelas') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="nuptk" style="color: black">NUPTK</label>
                                        <input type="text" name="nuptk" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="id_user" style="color: black">ID User</label>
                                        <input type="text" name="id_user" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama" style="color: black">Nama</label>
                                        <input type="text" name="nama" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email" style="color: black">Email</label>
                                        <input type="email" name="email" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" style="color: black">Password</label>
                                        <input type="password" name="password" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="jenis_kelamin" style="color: black">Jenis Kelamin</label>
                                        <select name="jenis_kelamin" class="form-control" required>
                                            <option value="laki Laki">Laki-Laki</option>
                                            <option value="perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="nip" style="color: black">NIP</label>
                                        <input type="text" name="nip" class="form-control" required>
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
            </div>
        </div>
    </div>
@endsection
