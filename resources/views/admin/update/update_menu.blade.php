@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card shadow">
            <div class="card-header py-3">
                <p class="text-primary m-0 fw-bold">Edit Menu</p>
            </div>
            <div class="card-body">
                <form action="update_menu" id="rooms-setting" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="mb-3">
                                <label class="form-label" for="nama"><strong>Nama Menu</strong></label>
                                <input class="form-control" type="text" id="nama_kue" value="{{$menu->nama_kue}}" name="nama_kue">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="mb-3">
                                <label for="kategori_id" class="form-label"><strong>Kategori</strong></label>
                                <select name="kategori_id" class="form-select form-control form-control-lg mb-0" aria-label=".form-select-sm example" style="font-size: 16px">
                                    <option selected hidden>Pilih Kategori</option>
                                    @foreach ($kategori as $p)
                                        <option value="{{ $p->id }}"{{ $p->id == $menu->kategori_id ? 'selected' : '' }}>{{ $p->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="mb-3">
                                <label class="form-label" for="deskripsi"><strong>Deskripsi</strong></label>
                                <input class="form-control" type="text" id="deskripsi" value="{{$menu->deskripsi}}" name="deskripsi">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="mb-3">
                                <label class="form-label" for="harga"><strong>Harga</strong></label>
                                <input class="form-control" type="text" id="harga" value="{{$menu->harga}}" name="harga">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="mb-3">
                                <label class="form-label" for="gambar"><strong>Gambar</strong></label>
                                <input class="form-control" type="file" id="gambar" name="gambar" value="{{$menu->gambar}}">
                                <label>Foto Saat Ini</label>
                                <br>
                                <img src="{{ asset('assets/img/'.$menu->gambar) }}" alt="gambar saat ini" width="100px">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="modal-footer">
                            <button id="submitButton" name="kirim" class="btn btn-outline-dark w-175 shadow-none">Simpan</button>
                            <a href="/list-menu" class="btn btn-danger">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
