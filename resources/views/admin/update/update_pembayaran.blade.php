@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card shadow">
            <div class="card-header py-3">
                <p class="text-primary m-0 fw-bold">Edit Metode Pembayaran</p>
            </div>
            <div class="card-body">
                <form action="update_pembayaran" id="rooms-setting" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="mb-3">
                                <label class="form-label" for="nama"><strong>Nama Metode Pembayaran</strong></label>
                                <input class="form-control" type="text" id="nama_metode" value="{{$pembayaran->nama_metode}}" name="nama_metode">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="mb-3">
                                <label class="form-label" for="nama"><strong>No Rekening</strong></label>
                                <input class="form-control" type="text" id="no_rek" value="{{$pembayaran->no_rek}}" name="no_rek">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="mb-3">
                                <label class="form-label" for="nama"><strong>Atas Nama</strong></label>
                                <input class="form-control" type="text" id="atas_nama" value="{{$pembayaran->atas_nama}}" name="atas_nama">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="mb-3">
                                <label class="form-label" for="gambar"><strong>Gambar</strong></label>
                                <input class="form-control" type="file" id="gambar" name="gambar" value="{{$pembayaran->gambar}}">
                                <label>Foto Saat Ini</label>
                                <br>
                                <img src="{{ asset('assets/img/'.$pembayaran->gambar) }}" alt="gambar saat ini" width="100px">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="modal-footer">
                            <button id="submitButton" name="kirim" class="btn btn-outline-dark w-175 shadow-none">Simpan</button>
                            <a href="/pembayaran" class="btn btn-danger">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
