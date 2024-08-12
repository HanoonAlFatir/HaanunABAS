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
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Daftar Kesiswaans</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Daftar Kesiswaan</h4>
                            <div class="text-right">
                                <button type="button" class="btn btn-rounded btn-primary" data-toggle="modal"
                                    data-target="#tambahKesiswaanModal">
                                    <span class="btn-icon-left text-primary"><i
                                            class="fa fa-plus color-primary"></i></span>Tambah
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
                                                style="width: 150.55px;">Nama</th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                colspan="1" aria-label="Office: activate to sort column ascending"
                                                style="width: 150.55px;">Email</th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                colspan="1" aria-label="Salary: activate to sort column ascending"
                                                style="width: 50.68px;">Action</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        @foreach ($kesiswaan as $k)
                                            <tr>
                                                <td>{{ $k->name }}</td>
                                                <td>{{ $k->email }}</td>
                                                <td class="row">
                                                    <button type="button" class="btn btn-success mr-2 edit-wali-kelas"
                                                        data-toggle="modal" data-target="#editKesiswaanModal{{ $k->id }}">
                                                        <i class="ti-pencil"></i>
                                                    </button>
                                                    <form action="{{ route('hapuskesiswaan', ['id' => $k->id]) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('Apakah Anda yakin?')">
                                                            <i class="ti-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="editKesiswaanModal{{ $k->id }}" tabindex="-1" role="dialog" aria-labelledby="editKesiswaanModalLabel{{ $k->id }}" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editKesiswaanModalLabel{{ $k->id }}">Edit Data Kesiswaan</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form method="POST" action="{{ route('editkesiswaan', ['id' => $k->id]) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="edit_name_{{ $k->id }}" style="color: black">Nama</label>
                                                                    <input type="text" name="name" id="edit_name_{{ $k->id }}" class="form-control" value="{{ $k->name }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="edit_email_{{ $k->id }}" style="color: black">Email</label>
                                                                    <input type="email" name="email" id="edit_email_{{ $k->id }}" class="form-control" value="{{ $k->email }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="edit_password_{{ $k->id }}" style="color: black">Password</label>
                                                                    <input type="password" name="password" id="edit_password_{{ $k->id }}" class="form-control">
                                                                    <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password</small>
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

                        {{-- MODAL TAMBAH KESISWAAN --}}
                        <div class="modal fade" id="tambahKesiswaanModal" tabindex="-1" role="dialog" aria-labelledby="tambahKesiswaanModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="tambahKesiswaanModalLabel">Tambah Kesiswaan</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('kesiswaan.store') }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="name" style="color: black">Nama</label>
                                                <input type="text" class="form-control" id="name" name="name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="email" style="color: black">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="password" style="color: black">Password</label>
                                                <input type="password" class="form-control" id="password" name="password" required>
                                            </div>
                                            <input type="hidden" name="role" value="kesiswaan">
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
        </div>
    </div>
@endsection
