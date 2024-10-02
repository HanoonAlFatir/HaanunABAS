<div class="modal fade" id="editJurusanModal{{ $j->id_jurusan }}" tabindex="-1"
    role="dialog" aria-labelledby="editJurusanModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editJurusanModalLabel">Edit Jurusan
                </h5>
                <button type="button" class="close" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form
                action="{{ route('editjurusan', ['id_jurusan' => $j->id_jurusan]) }}"
                method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_nama_jurusan" style="color: black">Nama
                            Jurusan</label>
                        <input type="text" name="nama_jurusan"
                            id="edit_nama_jurusan" class="form-control"
                            value="{{ $j->nama_jurusan }}" required>
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
