@extends('layouts.app')
@section('content')
<!-- <div class="container mt-5">
    <div class="row mb-4">
        <h4 class="fw-bold mb-4 mt-3">Daftar Menu</h4>
        <div class="col-md-12">
            <select id="categoryFilter" class="form-select">
                <option value="all">Semua Kategori</option>
                <option value="kategori1">Kategori 1</option>
                <option value="kategori2">Kategori 2</option>
                <option value="kategori3">Kategori 3</option>
            </select>
        </div>
    </div>
    <div class="row" id="productList">
    </div>
</div> -->

<div class="container mt-5">
    <div class="row mb-4">
        <h4 class="fw-bold mb-4 mt-3">Daftar Menu</h4>
        <div class="col-md-12">
            <select id="categoryFilter" class="form-select">
                <option value="all">Semua Kategori</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row" id="productList">
        @foreach($menus as $menu)
            <div class="col-md-3 mb-4" data-category="{{ $menu->kategori_id }}">
                <div class="card">
                    <a class="menu-detail" href="/menu-detail/{{ $menu->id }}">
                        <img src="{{ asset('assets/img/'. $menu->gambar) }}" class="card-img-top" alt="{{ $menu->nama_kue }}">
                    </a>
                    <div class="card-body d-flex flex-column justify-content-between">
                        <h5 class="card-title fw-bold">{{ $menu->nama_kue }}</h5>
                        <p class="card-text text-primary"><strong>Rp {{ $menu->harga }}</strong></p>
                        @if (Auth::user())
                            <div class="d-flex ms-auto align-items-center mt-auto gap-2">
                                <button type="button" class="btn btn-info">
                                    <a href="/keranjang/{{ $menu->id }}" class="text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
                                            <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9z"/>
                                            <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                                        </svg>
                                    </a>
                                </button>
                                <button type="button" class="btn btn-warning">
                                    <a href="/pemesanan/{{ $menu->id }}" class="text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-bag-check" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0"/>
                                        <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
                                    </svg>
                                    </a>
                                </button>
                            </div>
                        @endif
                        @if (!Auth::user())
                            <div class="d-flex mx-auto align-items-center mt-auto">
                                <p class="fw-semibold alert alert-danger" style="font-size: 16px;">Silahkan Login Lebih Dahulu!</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
