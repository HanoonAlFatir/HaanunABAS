@extends('layouts.layoutsiswa')

@section('content')
    <div class="section mt-2" id="menu-section">
        <div class="todaypresence">
            <div class="container mt-4">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('izin.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            {{-- LANKGAH MENGISI FORM --}}
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <h5>Tata Cara Mengisi Form Izin</h5>
                                        <ol class="list-group list-group-numbered">
                                            <!-- Step 1 -->
                                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                                <div class="ms-2 me-auto">
                                                    <div class="fw-bold">Langkah 1</div>
                                                    Pilih file foto bukti keperluan izin, seperti surat orang tua atau wali.
                                                </div>
                                                <ion-icon name="document-attach-outline" size="large"></ion-icon>
                                            </li>

                                            <!-- Step 2 -->
                                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                                <div class="ms-2 me-auto">
                                                    <div class="fw-bold">Langkah 2</div>
                                                    Isi keterangan keperluan izin secara jelas dan singkat.
                                                </div>
                                                <ion-icon name="create-outline" size="large"></ion-icon>
                                            </li>

                                            <!-- Step 3 -->
                                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                                <div class="ms-2 me-auto">
                                                    <div class="fw-bold">Langkah 3</div>
                                                    Klik tombol "Kirim" untuk menyelesaikan pengisian form izin.
                                                </div>
                                                <ion-icon name="send-outline" size="large"></ion-icon>
                                            </li>
                                        </ol>
                                    </div>
                                </div>

                            </div>

                            {{-- PENGISIAN FORM --}}
                            <div class="row">
                                <input type="hidden" id="lokasi" name="lokasi">
                                <div class="col-md-6 mb-3">
                                    {{-- <input type="file" id="avatar" name="photo_in" accept="image/png, image/jpeg"/> --}}
                                    <label class="form-label">Upload Foto</label>
                                    <div class="custom-file-upload">
                                        <input type="file" id="upload" name="photo_in" accept="image/png, image/jpeg, image/jpg">
                                        <label for="upload">
                                            <span>
                                                <i class="icon">+</i>
                                                <strong>Upload new photo</strong>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="keterangan" class="form-label">Keterangan</label>
                                        <textarea class="form-control" id="keterangan" name="keterangan" rows="5" placeholder="Isi keterangan"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-block">Kirim</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
