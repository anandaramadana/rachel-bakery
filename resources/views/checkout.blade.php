@extends('layouts.app')
@section('content')
<div class="container mx-auto mt-3 py-1 mt-5">
    <h4 class="fw-bold mb-4">Pemesanan Kue</h4>
    <div class="container p-0">
        <div class="row g-0">
            <div class="col-md-6">
                <p class="fw-medium" style="font-size: 20px;">Data Pemesan</p>
                <div class="container d-flex justify-content-start p-0">
                    <img src="{{ asset('assets/img/'.auth()->user()->gambar) }}" class="img-thumbnail m-0" alt="..." width="110" height="130">
                    <div class="container">
                        <p class="fw-medium mb-0" style="font-size: 20px;">{{ auth()->user()->nama }}</p>
                        <p class="mb-0">{{ auth()->user()->no_hp }}</p>
                        <p class="mb-0">{{ auth()->user()->email }}</p>
                        <p class="mb-0">{{ auth()->user()->alamat }}</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <p class="fw-medium" style="font-size: 20px;">Menu Yang Dipilih :</p>
                <div class="container mx-0 px-0">
                    @foreach ($keranjangs as $item)
                    <div class="card mb-3 rounded-0">
                        <div class="row g-0">
                            <div class="col-md-6 p-3">
                                <img src="{{ asset('assets/img/'.$item->menu->gambar) }}" class="img-fluid" alt="...">
                            </div>
                            <div class="col-md-6 p-3">
                                <div class="card-body p-0">
                                    <p class="m-0 fw-bold">{{ $item->menu->nama_kue }}</p>
                                    <p class="m-0">{{ $item->menu->deskripsi }}</p>
                                    <p class="m-0">Jumlah: {{ $quantities[$item->id] }}</p>
                                    <p class="mt-md-4 mb-md-0 fw-bold text-end">{{ 'Rp '. number_format($item->menu->harga, 0, ',', '.') }}</p>
                                    <input type="hidden" name="selected_items[]" value="{{ $item->id }}">
                                    <input type="hidden" name="quantities[{{ $item->id }}]" value="{{ $quantities[$item->id] }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<hr class="container mx-auto">
<div class="container scrollspy-example" data-bs-spy="scroll" data-bs-target="#simple-list-example" data-bs-offset="0" data-bs-smooth-scroll="true" tabindex="0">
    <form action="/tambah_pemesanan" method="post">
        @csrf
        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

        @foreach ($keranjangs as $item)
            <input type="hidden" name="selected_items[]" value="{{ $item->id }}">
            <input type="hidden" name="quantities[{{ $item->id }}]" value="{{ $quantities[$item->id] }}">
            <div class="card mb-3 rounded-0" hidden>
                <div class="row g-0">
                    <div class="col-md-6 p-3">
                        <img src="{{ asset('assets/img/' . $item->menu->gambar) }}" class="img-fluid" alt="...">
                    </div>
                    <div class="col-md-6 p-3">
                        <div class="card-body p-0">
                            <p class="m-0 fw-bold">{{ $item->menu->nama_kue }}</p>
                            <p class="m-0">{{ $item->menu->deskripsi }}</p>
                            <p class="mt-md-4 mb-md-0 fw-bold text-end">{{ 'Rp ' . number_format($item->menu->harga, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="row mb-3">
            <label for="tanggal_ambil" class="col-lg-2 col-form-label">Tanggal Ambil</label>
            <div class="col-lg-4">
                <input type="date" class="form-control" id="tanggal_ambil" name="tanggal_ambil" required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="jam_ambil" class="col-lg-2 col-form-label">Jam Ambil</label>
            <div class="col-lg-4">
                <input type="time" class="form-control" id="jam_ambil" name="jam_ambil" required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="pembayaran_id" class="col-lg-2 col-form-label">Pembayaran</label>
            <div class="col-lg-4">
                <select name="pembayaran_id" class="form-select form-select-lg mb-0" aria-label=".form-select-sm example" style="font-size: 16px" required>
                    <option selected hidden>Pilih Metode Pembayaran</option>
                    @foreach ($pembayaran as $p)
                        <option value="{{ $p->id }}">{{ $p->nama_metode }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <label for="keterangan" class="col-lg-2 col-form-label">Keterangan</label>
            <div class="col-lg-4">
                <textarea class="form-control" placeholder="Isi keterangan yang diinginkan" id="keterangan" name="keterangan" style="height: 100px"></textarea>
            </div>
        </div>
        <button type="submit" class="btn btn-success py-2" onclick="return confirm('Apakah benar dengan reservasi Anda?')">Kirim</button>
        <a href="/keranjang" class="btn btn-secondary py-2">Batal</a>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Harga awal produk, misalnya 50000. Bisa diambil dari server atau elemen lain
        const hargaAwal = parseFloat(document.getElementById('harga').value); // Sesuaikan dengan harga aktual produk

        // Fungsi untuk menghitung total harga
        function calculateTotal() {
            // Ambil jumlah produk dari input
            const qty = document.getElementById('qty').value;
            // Kalkulasi total harga
            const totalHarga = hargaAwal * qty;
            // Tampilkan hasil kalkulasi ke input total_harga
            document.getElementById('total_harga').value = totalHarga;
        }

        // Tambahkan event listener ke input qty
        document.getElementById('qty').addEventListener('input', calculateTotal);

        // Panggil fungsi calculateTotal() untuk menghitung harga awal saat halaman pertama kali dimuat
        calculateTotal();
    });
</script>
@endsection
