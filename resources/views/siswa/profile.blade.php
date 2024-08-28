@extends('layouts.layoutsiswa')

@section('content')
    <div class="section mt-2" id="menu-section">
        <div class="todaypresence">
            <div class="container">
                <form action="{{ route('profile.submit') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value={{ $user->id }}>
                    <div class="row mb-2">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">
                                        Profil
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-md-4 d-flex justify-content-center mb-3 mb-md-0">
                                            <img src="{{ asset('storage/user_avatar/' . $user->foto) }}" alt="" class="d-block rounded" height="200" width="200">
                                        </div>
                                        <div class="col-12 col-md-8 d-flex flex-column justify-content-center">
                                            <div class="button-wrapper">
                                                <div class="custom-file-upload">
                                                    <input type="file" id="upload" name="foto" accept="image/png, image/jpeg, image/jpg">
                                                    <label for="upload">
                                                        <span>
                                                            <i class="icon">+</i>
                                                            <strong>Upload new photo</strong>
                                                        </span>
                                                    </label>
                                                </div>
                                                <p class="text-muted mb-0 mt-2">Pastikan file foto yang anda pilih berupa file PNG, JPG atau JPEG.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="mb-3 col-12 col-md-6">
                                            <label for="Nama" class="form-label">Nama Panjang</label>
                                            <input class="form-control" type="text" id="Nama" value="{{ $user->name }}" disabled>
                                        </div>

                                        <div class="mb-3 col-12 col-md-6">
                                            <label for="NIS" class="form-label">NIS</label>
                                            <input class="form-control" type="text" id="NIS" value="{{ $user->siswa->nis }}" disabled>
                                            <input type="hidden" name="nis" value="{{ $user->siswa->nis }}">
                                        </div>

                                        <div class="mb-3 col-12 col-md-6">
                                            <label for="Email" class="form-label">Email</label>
                                            <input class="form-control" type="email" id="Email" name="email" value="{{ $user->email }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-12 col-md-6">
                                            <label for="password" class="form-label">Ganti Password</label>
                                            <input class="form-control" type="password" id="password" name="password" placeholder="Masukkan password baru">
                                        </div>

                                        <div class="mb-3 col-12 col-md-6">
                                            <label for="kpassword" class="form-label">Konfirmasi Password</label>
                                            <input class="form-control" type="password" id="kpassword" name="kPassword" placeholder="Masukkan password baru">
                                        </div>
                                    </div>
                                    <div class="mt-2 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
