@extends('layouts.dashboardoperator')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Hi, Operator!</h4>
                        <p class="mb-0">Setting Koordinat dan Lokasi SMKN 11 Bandung</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)"></a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Setting Koordinat</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="basic-form">
                                <form action="{{ route('operator.update', $wali->nuptk) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" style="color: black">NUPTK</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="nuptk"
                                                value="{{ $wali->nuptk }}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" style="color: black">Nama</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="nama"
                                                value="{{ $wali->nama }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" style="color: black">Jenis Kelamin</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="jenis_kelamin">
                                                <option value="laki laki"
                                                    {{ $wali->jenis_kelamin == 'laki laki' ? 'selected' : '' }}>Laki laki
                                                </option>
                                                <option value="perempuan"
                                                    {{ $wali->jenis_kelamin == 'perempuan' ? 'selected' : '' }}>Perempuan
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" style="color: black">NIP</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="nip"
                                                value="{{ $wali->nip }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" style="color: black">NIK</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="nik"
                                                value="{{ $wali->nik }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-10 offset-sm-2 text-right">
                                            <button type="submit" class="btn btn-rounded btn-success">
                                                <span class="btn-icon-left text-success">
                                                    <i class="fa fa-upload color-success"></i>
                                                </span>Upload
                                            </button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
