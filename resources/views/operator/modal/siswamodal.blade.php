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
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="edit_nis" style="color: black">NIS</label>
                            <input type="text" name="nis" id="edit_nis" class="form-control" value="{{ $s->nis }}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="edit_nama" style="color: black">Nama</label>
                            <input type="text" name="name" id="edit_nama" class="form-control" value="{{ $s->user->name }}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="edit_jenis_kelamin" style="color: black">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="edit_jenis_kelamin" class="form-control" required>
                                <option value="laki laki" {{ $s->jenis_kelamin == 'laki laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="perempuan" {{ $s->jenis_kelamin == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="edit_email" style="color: black">Email</label>
                            <input type="email" name="email" id="edit_email" class="form-control" value="{{ $s->user->email }}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="edit_nisn" style="color: black">NISN</label>
                            <input type="text" name="nisn" id="edit_nisn" class="form-control" value="{{ $s->nisn }}" required>
                            <input type="hidden" name="id_kelas" value="{{ $s->id_kelas }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="edit_password" style="color: black">Password</label>
                            <input type="password" name="password" id="edit_password" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nik" style="color: black">NIK</label>
                            <select class="form-control" id="edit_nik" name="nik" required>
                                <option value="">Pilih NIK</option>
                                @foreach ($walisiswa as $wali)
                                    <option value="{{ $wali->nik }}">{{ $wali->nik }} - {{ $wali->user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password</small>
                        </div>


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

{{-- MODAL TAMBAH SISWA --}}
<div class="modal fade" id="addSiswaModal" tabindex="-1" role="dialog" aria-labelledby="addSiswaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSiswaModalLabel">Tambah Data Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('tambahsiswa') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nis" style="color: black">NIS</label>
                            <input type="text" class="form-control" id="nis" name="nis" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nama" style="color: black">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="jenis_kelamin" style="color: black">Jenis Kelamin</label>
                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="laki-laki">Laki-laki</option>
                                <option value="perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email" style="color: black">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nisn" style="color: black">NISN</label>
                            <input type="text" class="form-control" id="nisn" name="nisn" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password" style="color: black">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nik" style="color: black">NIK</label>
                            <select class="form-control" id="nik" name="nik" required>
                                <option value="">Pilih NIK</option>
                                @foreach ($walisiswa as $wali)
                                    <option value="{{ $wali->nik }}">{{ $wali->nik }} - {{ $wali->user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="id_kelas" value="{{ $id_kelas }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
