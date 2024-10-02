{{-- KESISWAAN MODAL --}}

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
