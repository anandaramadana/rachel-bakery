@extends('admin.layouts.app')
@section('content')
<style>
    img {
        /* border: 2px solid;  */
        border-radius: 20%;
        margin-right: auto;
        margin-left: auto
    }
    .conten {
        position: relative;
        margin-right: auto;
        margin-left: auto;
        width: 50%;
    }
    .image {
        opacity: 1;
        display: block;
        width: 20% ;
        height: auto;
        transition: .5s ease;
        backface-visibility: hidden;
    }
    .middle {
        transition: .5s ease;
        opacity: 0;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%)
    }
    .conten:hover .image {
        opacity: 0.3;
    }
    .conten:hover .middle {
        opacity: 1;
    }
</style>

<div class="container-fluid">
    <h3 class="mt-5 text-gray-800 font-weight-bold">Profil Admin</h3>
    <div class="container mx-auto mt-2">
        <div class="p-3">
            <div class="row g-0 p-3 align-items-center">
                @if (session()->has('edit_admin'))
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        {{ session('edit_admin') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button>
                    </div>
                @endif
                @if (session()->has('edit_gambar_admin'))
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        {{ session('edit_gambar_admin') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button>
                    </div>
                @endif
            </div>
            <div class="card mb-4 shadow">
                <div class="conten mt-3">
                    <img id="profileImage" src="{{ asset('assets/img/'.auth()->user()->gambar) }}" alt="foto" class="image" width="100">
                    <div class="middle">
                        <div class="text">
                            <button type="button" class="btn btn-outline-dark w-10 shadow-none" data-bs-toggle="modal" data-bs-target="#image-profil">
                                Update
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row g-0 p-5 ms-3 align-items-center">
                    <form action="/update_admin" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-body">
                                @foreach ($user as $item)
                                @if($item->id == auth()->user()->id)
                                <div class="row">
                                    <input type="hidden" name="id" value="{{$item->id}}">
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label fw-bold" for="nama"> Nama </label>
                                        <input type="text" id="nama" name="nama" class="form-control shadow-none" value="{{ $item->nama }}" required>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label fw-bold" for="email"> E-mail </label>
                                        <input type="text" id="email" name="email" class="form-control shadow-none" value="{{ $item->email }}" required>
                                        <span id="error_email" style="color: red;"></span>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label fw-bold"> Telepon </label>
                                        <input type="text" id="no_hp" name="no_hp" class="form-control shadow-none" value="{{ $item->no_hp }}" required>
                                        <span id="error_no_hp" style="color: red;"></span>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label fw-bold"> Alamat </label>
                                        <input type="text" id="alamat" name="alamat" class="form-control shadow-none" value="{{ $item->alamat }}" required>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        <div class="modal-footer gap-2">
                            <button id="submitButton" name="kirim" class="btn btn-outline-dark w-175 shadow-none =">Simpan</button>
                            <a type="button" class="btn btn-secondary w-175" href="/admin">Kembali</a>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="image-profil" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('edit_gambar', ['id' => auth()->user()->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Gambar</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <input type="file" name="gambar" class="form-control shadow-none" accept="image/*">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-success text-white shadow-none" name="submit">Kirim</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
