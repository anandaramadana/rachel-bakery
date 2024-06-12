@extends('layouts.app')
@section('content')
<!-- <div class="container">
    <h4 class="fw-bold mb-4 mt-5">Keranjang</h4>
    <div class="card mb-3">
        <div class="row no-gutters ms-3">
            <div class="col-md-3 p-3">
                <img src="{{ asset('assets/img/cake-carousel.jpg') }}" class="card-img" alt="Chocolate Cake">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">Nama Kue: Chocolate Cake</h5>
                    <p class="card-text">Harga: Rp. 50.000</p>
                    <div class="d-flex align-items-center">
                        <button class="btn btn-secondary btn-sm mr-2" onclick="decreaseQuantity('chocolate-cake', 50000)">-</button>
                        <input type="text" class="form-control form-control-sm text-center" id="chocolate-cake-quantity" value="1" style="width: 50px;" readonly>
                        <button class="btn btn-secondary btn-sm ml-2" onclick="increaseQuantity('chocolate-cake', 50000)">+</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <h4>Total Harga: Rp. <span id="total-price">150000</span></h4>
    </div>
</div> -->

<div class="container mx-auto mt-3 py-1">
    <h4 class="fw-bold mb-4 mt-5">Keranjang</h4>
    <div class="container p-0">
        @foreach ($keranjang as $item)
            <div class="card mb-3 rounded-0">
                <div class="row g-0">
                    <div class="gambar-keranjang col-md-5 p-3">
                        <img src="{{ asset('assets/img/'. $item->gambar) }}" class="img-fluid" alt="...">
                    </div>
                    <div class="col-md-5 p-3">
                        <div class="card-body px-0 d-flex flex-column justify-content-end">
                            <div class="row g-0">
                                <p class="mb-0 col-4" style="font-size: 18px;">Nama Kue</p>
                                <p class="mb-0 col-1" style="font-size: 18px;">:</p>
                                <p class="mb-0 col-7" style="font-size: 18px;">{{$item->nama_kue}}</p>
                            </div>
                            <div class="row g-0">
                                <p class="mb-0 col-4" style="font-size: 18px;">Harga</p>
                                <p class="mb-0 col-1" style="font-size: 18px;">:</p>
                                <!-- <p class="mb-0 col-7" style="font-size: 18px;">{{ 'Rp '. number_format($item->harga, 0, ',', '.') }}</p> -->
                                <p class="mb-0 col-7" style="font-size: 18px;">Rp <span id="item-price-{{$item->id}}">{{ number_format($item->harga, 0, ',', '.') }}</span></p>
                            </div>
                            <div class="d-flex align-items-center mt-3">
                                <button class="btn btn-secondary btn-sm mr-2" onclick="updateQuantity('{{$item->id}}', -1, '{{$item->harga}}')">-</button>
                            <input type="text" class="form-control form-control-sm text-center" id="quantity-{{$item->id}}" value="1" style="width: 50px;" readonly>
                                <button class="btn btn-secondary btn-sm ml-2" onclick="updateQuantity('{{$item->id}}', 1, '{{$item->harga}}')">+</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="mt-4 text-end">
            <h4>Total Harga: Rp. <span id="total-price">0</span></h4>
        </div>
    </div>
</div>

<script>
    const cartItems = <?php echo json_encode($keranjang) ?>

    function updateQuantity(id, change, price) {
        let quantityInput = document.getElementById('quantity-' + id);
        let currentQuantity = parseInt(quantityInput.value);

        if (currentQuantity + change >= 1) {
            quantityInput.value = currentQuantity + change;

            // Update the item price
            let newPrice = (currentQuantity + change) * price;
            document.getElementById('item-price-' + id).innerText = newPrice.toLocaleString('id-ID');

            updateTotalPrice();
        }
    }

    function updateTotalPrice() {
        let totalPrice = 0;

        cartItems.forEach(item => {
            let quantity = parseInt(document.getElementById('quantity-' + item.id).value);
            totalPrice += quantity * item.harga;
        });

        document.getElementById('total-price').innerText = totalPrice.toLocaleString('id-ID');
    }

    document.addEventListener('DOMContentLoaded', (event) => {
        updateTotalPrice();
    });
</script>
@endsection
