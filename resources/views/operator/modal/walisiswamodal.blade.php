{{-- Modal Tambah Wali Kelas --}}
<div class="modal fade" id="addWaliSiswaModal" tabindex="-1" role="dialog" aria-labelledby="addWaliSiswaModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addWaliKelasModalLabel">Tambah Wali Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('walisiswa.tambah') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="Nama" style="color: black">Nama</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password" style="color: black">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="NIK" style="color: black">NIK</label>
                        <input type="text" name="nik" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email" style="color: black">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="jenis_kelamin" style="color: black">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control" required>
                            <option selected hidden>Pilih</option>
                            <option value="laki Laki">Laki-Laki</option>
                            <option value="perempuan">Perempuan</option>
                        </select>
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
