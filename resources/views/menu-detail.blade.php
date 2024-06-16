@extends('layouts.app')
@section('content')
<div class="container mx-auto mt-3 py-1">
    <h4 class="fw-bold mb-4 mt-5">Detail Menu</h4>
    <div class="container p-0">
        <div class="card mb-3 rounded-0">
            <div class="row g-0">
                <div class="detail-gambar col-md-7 p-3">
                    <img src="{{ asset('assets/img/'. $detail->gambar) }}" class="img-fluid" alt="">
                </div>
                <div class="col-md-5 p-3">
                    <div class="card-body px-0 d-flex flex-column justify-content-end">
                        <div class="row g-0">
                            <p class="mb-0 col-4" style="font-size: 16px;">Nama Kue</p>
                            <p class="mb-0 col-1" style="font-size: 16px;">:</p>
                            <p class="mb-0 col-7" style="font-size: 16px;">{{$detail->nama_kue}}</p>
                        </div>
                        <div class="row g-0">
                            <p class="mb-0 col-4" style="font-size: 16px;">Deskripsi</p>
                            <p class="mb-0 col-1" style="font-size: 16px;">:</p>
                            <p class="mb-0 col-7" style="font-size: 16px;">{{$detail->deskripsi}}</p>
                        </div>
                        <div class="row g-0">
                            <p class="mb-0 col-4" style="font-size: 16px;">Harga</p>
                            <p class="mb-0 col-1" style="font-size: 16px;">:</p>
                            <p class="mb-0 col-7" style="font-size: 16px;">{{ 'Rp '. number_format($detail->harga, 0, ',', '.') }}</p>
                        </div>
                        <br>
                        @if (Auth::user())
                            @if (Auth::check() && Auth::user()->role == 'customer')
                                <div class="d-flex justify-content-end gap-2">
                                    <a type="button" class="btn btn-warning p-2 text-white" href="/pemesanan/{{ $detail->id }}">Pesan Sekarang</a>
                                    <form action="{{ route('tambah_keranjang') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                        <input type="hidden" name="menu_id" value="{{ $detail->id }}">
                                        <button type="submit" class="btn btn-info text-white">
                                            Tambah Keranjang
                                        </button>
                                    </form>
                                    <a type="button" class="btn btn-secondary p-2" href="/menu">Kembali</a>
                                </div>
                            @else
                                <div class="d-flex justify-content-end">
                                    <a type="button" class="btn btn-info p-2 fw-bold" href="/pemesanan_admin/{{ $detail->id }}">Pesan Sekarang</a>
                                </div>
                            @endif
                        @endif
                        @if (!Auth::user())
                            <div class="row g-0 mt-3">
                                <p class="fw-semibold alert alert-danger" style="font-size: 16px;">Silahkan login terlebih dahulu untuk pemesanan!</p>
                            </div>
                            <div class="d-flex justify-content-end gap-2">
                                <a type="button" class="btn btn-secondary p-2" href="/menu">Kembali</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
