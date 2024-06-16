@extends('layouts.app')
@section('content')
<div class="container mx-auto mt-2 py-1">
    <div class="card-header py-1 mt-5">
        @if (session()->has('tambah_keranjang'))
        <div class="alert alert-info alert-dismissible" role="alert">
            {{ session('tambah_keranjang') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if (session()->has('delete_keranjang'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('delete_keranjang') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
    </div>

    <h4 class="fw-bold mb-4 mt-4">Keranjang</h4>
    <form action="/checkout" method="post">
        @csrf
        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
        <div class="container p-0">
            @foreach ($keranjang as $item)
                <div class="card mb-3 rounded-0 bg-light">
                    <div class="row g-0">
                        <div class="d-flex gambar-keranjang col-md-5 p-3 gap-2">
                            <img src="{{ asset('assets/img/' . $item->menu->gambar) }}" class="img-fluid" alt="{{ $item->menu->nama_kue }}">
                            <div class="form-check" style="margin-top: 110px; margin-left: 5px;">
                                <input class="form-check-input bg-dark" type="checkbox" value="{{ $item->id }}" name="selected_items[]"> Pilih
                            </div>
                        </div>
                        <div class="col-md-6 p-3">
                            <div class="card-body px-0 d-flex flex-column">
                                <div class="row g-0">
                                    <p class="mb-0 col-4" style="font-size: 18px;">Nama Kue</p>
                                    <p class="mb-0 col-1" style="font-size: 18px;">:</p>
                                    <p class="mb-0 col-3" style="font-size: 18px;">{{ $item->menu->nama_kue }}</p>
                                </div>
                                <div class="row g-0">
                                    <p class="mb-0 col-4" style="font-size: 18px;">Harga</p>
                                    <p class="mb-0 col-1" style="font-size: 18px;">:</p>
                                    <p class="mb-0 col-7" style="font-size: 18px;">Rp <span id="item-price-{{ $item->id }}">{{ number_format($item->menu->harga, 0, ',', '.') }}</span></p>
                                </div>
                                <div class="row g-0">
                                    <p class="mb-0 col-4" style="font-size: 18px;">Jumlah</p>
                                    <p class="mb-0 col-1" style="font-size: 18px;">:</p>
                                    <p class="mb-0 col-2">
                                        <input type="number" name="quantities[{{ $item->id }}]" value="1" min="1" class="form-control" id="quantity-{{ $item->id }}" onchange="updateTotalPrice()">
                                    </p>
                                </div>
                                <div class="d-flex align-items-center mt-5 justify-content-end">
                                    <a type="button" class="btn btn-danger text-white ms-3" href="/keranjang/{{ $item->id }}/delete" onclick="return confirm('Apakah yakin ingin menghapus?')" title="Hapus Keranjang">
                                        <i class="fas fa-fw fa-trash"></i> Hapus
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="mt-4 text-end">
                <h4>Total Harga: Rp. <span id="total-price">0</span></h4>
            </div>
            <div class="d-flex justify-content-end gap-2">
                <button type="submit" class="btn btn-warning p-2 text-white">Checkout</button>
                <a type="button" class="btn btn-secondary p-2" href="/menu">Kembali</a>
            </div>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        function updateTotalPrice() {
            let totalPrice = 0;
            document.querySelectorAll('input[name^="selected_items"]:checked').forEach((checkbox) => {
                const itemId = checkbox.value;
                const quantity = document.getElementById(`quantity-${itemId}`).value;
                const price = parseFloat(document.getElementById(`item-price-${itemId}`).textContent.replace(/\./g, '').replace(',', '.'));
                totalPrice += quantity * price;
            });
            document.getElementById('total-price').textContent = totalPrice.toLocaleString('id-ID');
        }

        document.querySelectorAll('input[name^="selected_items"]').forEach((checkbox) => {
            checkbox.addEventListener('change', updateTotalPrice);
        });

        document.querySelectorAll('input[name^="quantities"]').forEach((input) => {
            input.addEventListener('input', updateTotalPrice);
        });

        updateTotalPrice();
    });
</script>


@endsection
