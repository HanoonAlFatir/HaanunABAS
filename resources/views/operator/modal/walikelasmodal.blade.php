{{-- Modal edit --}}
<div class="modal fade" id="editWaliKelasModal{{ $w->id_user }}" tabindex="-1" role="dialog"
    aria-labelledby="editWaliKelasModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editWaliKelasModalLabel">Edit Data
                    Wali Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('walikelas.update', ['id' => $w->id_user]) }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_nuptk" style="color: black">NUPTK</label>
                        <input type="text" name="nuptk" id="edit_nuptk" class="form-control"
                            value="{{ $w->nuptk }}" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_id_user" style="color: black">ID
                            User</label>
                        <input type="text" name="id_user" id="edit_id_user" value="{{ $w->id_user }}"
                            class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_nama" style="color: black">Nama</label>
                        <input type="text" name="nama" id="edit_nama" class="form-control"
                            value="{{ $w->user->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_jenis_kelamin" style="color: black">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="edit_jenis_kelamin" class="form-control" required>
                            <option value="laki laki">Laki-laki</option>
                            <option value="perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_nip" style="color: black">NIP</label>
                        <input type="text" name="nip" id="edit_nip" class="form-control"
                            value="{{ $w->nip }}" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_email" style="color: black">Email</label>
                        <input type="email" name="email" id="edit_email" class="form-control"
                            value="{{ $w->user->email }}" required>
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

{{-- Modal Tambah Wali Kelas --}}
<div class="modal fade" id="addWaliKelasModal" tabindex="-1" role="dialog" aria-labelledby="addWaliKelasModalLabel"
    aria-hidden="true">
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

{{-- Modal Import Wali Kelas --}}
<div class="modal fade" id="importWaliKelasModal" tabindex="-1" role="dialog"
    aria-labelledby="importWaliKelasModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importWaliKelasModalLabel">Import Data Wali Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('import-walikelas') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="import_file">
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
