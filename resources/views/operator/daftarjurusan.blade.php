@extends('layouts.dashboardoperator')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Hi, Operator!</h4>
                        <p class="mb-0">Daftar Jurusan SMKN 11 Bandung</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)"></a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Daftar Jurusan</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Daftar Jurusan</h4>
                            <div class="text-right">
                            <button type="button" class="btn btn-rounded btn-primary" data-toggle="modal"
                                data-target="#addJurusanModal">
                                <span class="btn-icon-left text-primary"><i
                                        class="fa fa-plus color-primary"></i></span>Tambah Jurusan
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
                                                style="width: 80.184px;">ID Jurusan</th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                colspan="1" aria-label="Office: activate to sort column ascending"
                                                style="width: 275.55px;">Nama Jurusan</th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                colspan="1" aria-label="Salary: activate to sort column ascending"
                                                style="width: 50.68px;">Action</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        @foreach ($jurusan as $j)
                                            <tr>
                                                <td>{{ $j->id_jurusan }}</td>
                                                <td>{{ $j->nama_jurusan }}</td>
                                                <td class="row">
                                                    <button type="button" class="btn btn-success mr-2" data-toggle="modal"
                                                        data-target="#editJurusanModal{{ $j->id_jurusan }}"
                                                        data-id="{{ $j->id_jurusan }}"
                                                        data-nama="{{ $j->nama_jurusan }}">
                                                        <i class="ti-pencil"></i>
                                                    </button>
                                                    <form action="{{ route('hapusjurusan', $j->id_jurusan) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('Apakah Anda yakin?')">
                                                            <i class="ti-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="editJurusanModal{{ $j->id_jurusan }}" tabindex="-1" role="dialog"
                                            aria-labelledby="editJurusanModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editJurusanModalLabel">Edit Jurusan</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('editjurusan', ['id_jurusan' => $j->id_jurusan]) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="edit_nama_jurusan" style="color: black">Nama Jurusan</label>
                                                                <input type="text" name="nama_jurusan" id="edit_nama_jurusan"
                                                                    class="form-control" value="{{ $j->nama_jurusan }}" required>
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

                {{-- Modal Tambah Jurusan --}}
                <div class="modal fade" id="addJurusanModal" tabindex="-1" role="dialog"
                    aria-labelledby="addJurusanModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addJurusanModalLabel">Tambah Jurusan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('tambahjurusan') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="id_jurusan" style="color: black">ID Jurusan</label>
                                        <input type="text" name="id_jurusan" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_jurusan" style="color: black">Nama Jurusan</label>
                                        <input type="text" name="nama_jurusan" class="form-control" required>
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
            </div>
        </div>
    </div>
@endsection
