<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rachel Bakery</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>
    <div class="container-fluid">
        <div class="container mt-5 mb-5 p-5 bg-white shadow-lg d-flex flex-column gap-5" style="width: 894px; height:auto">
            <div class="container m-0 p-0 d-flex justify-content-evenly">
                <img src="{{ asset('assets/img/logo-tulisan.png') }}" class="img-fluid mb-2" alt="..." width="300" height="150">
            </div>
            <hr class="border border-secondary border-3 opacity-100 p-0 m-0 ">
            <div class="container align-items-center">
                <div class="row">
                    <div class="d-flex flex-column p-0 col-md-6">
                        <p class="m-0 fw-semibold" style="font-size: 16px">Pemesan :</p>
                        <p class="m-0 " style="font-size: 16px">Nama: {{ auth()->user()->nama }}</p>
                        <p class="m-0 " style="font-size: 16px">No Hp: {{ auth()->user()->no_hp }}</p>
                        <p class="m-0 " style="font-size: 16px">Email: {{ auth()->user()->email }}</p>
                        <p class="m-0 " style="font-size: 16px">Email: {{ auth()->user()->alamat }}</p>
                    </div>
                    <div class="d-flex flex-column p-0 col-sm-6">
                        <p class="m-0 fw-semibold" style="font-size: 16px">Pesanan :</p>
                        <p class="m-0 " style="font-size: 16px">ID Pemesanan: {{ $invoice->id }}</p>
                        <p class="m-0 " style="font-size: 16px">Tgl Pesan: {{ $invoice->created_at->format('Y-m-d') }}</p>
                        <p class="m-0 " style="font-size: 16px">Tgl Ambil: {{ $invoice->tanggal_ambil}}</p>
                        <p class="m-0 " style="font-size: 16px">Jam Ambil: {{ $invoice->jam_ambil }}</p>
                    </div>
                </div>
            </div>
            <div class="container m-0 p-0">
                <table class="table table-bordered bg-dark">
                    <thead>
                        <tr>
                            <th>Jumlah</th>
                            <th>Kategori</th>
                            <th>Menu</th>
                            <th>Harga Satuan</th>
                            <th>Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $invoice->qty }}</td>
                            <td>{{ $invoice->menu->kategori->nama_kategori }}</td>
                            <td>{{ $invoice->menu->nama_kue }} </td>
                            <td>{{ 'Rp ' . number_format($invoice->menu->harga, 0, ',', '.') }}</td>
                            <td>{{ 'Rp ' . number_format($invoice->total_harga, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="container m-0 p-0">
                <h5 class="fw-semibold pb-2">Metode Pembayaran Transfer</h5>
                <div class="container m-0 p-0 d-flex justify-content-between align-items-start">
                    @if ($invoice->pembayaran->nama_metode !== 'Bayar Langsung')
                    <img src="{{ asset('assets/img/'.$invoice->pembayaran->gambar) }}" alt="..." width="120" height="100">
                    <div class="container m-0 ps-2">
                        <p class="m-0 " style="font-size: 16px">No Rek {{$invoice->pembayaran->no_rek}}</p>
                        <p class="m-0 " style="font-size: 16px">AN. {{$invoice->pembayaran->atas_nama}}</p>
                    </div>
                    @else
                    <div class="container m-0 ps-2">
                        <p class="m-0 " style="font-size: 16px">{{$invoice->pembayaran->nama_metode}}</p>
                        <p class="m-0 " style="font-size: 16px">Silahkan Lakukan Pembayaran Ke tempat</p>
                    </div>
                    @endif
                    <div class="container m-0 row g-0">
                        <div class="col-md-12 p-0">
                            <div class="row g-0">
                                <p class="mb-0 col-6 fw-semibold" style="font-size: 16px;">Total Harga</p>
                                <p class="mb-0 col-1" style="font-size: 16px;">:</p>
                                <p class="mb-0 col-5" style="font-size: 16px;">
                                    {{ 'Rp ' . number_format($invoice->total_harga, 0, ',', '.') }}
                                </p>
                            </div>
                            <div class="row g-0">
                                <p class="mb-0 col-6 fw-semibold" style="font-size: 16px;">Status</p>
                                <p class="mb-0 col-1" style="font-size: 16px;">:</p>
                                @if ($invoice->status == 'Belum terverifikasi')
                                    <p class="mb-0 col-5"><span class="fw-semibold text-danger fs-6">{{ $invoice->status }}</span></p>
                                @endif
                                @if ($invoice->status == 'Lunas')
                                    <p class="mb-0 col-5"><span class="text-success fs-6">{{ $invoice->status }}</span></p>
                                @endif
                                @if ($invoice->status == 'Bayar DP')
                                    <p class="mb-0 col-5"><span class="text-info fs-6">{{ $invoice->status }}</span></p>
                                @endif
                                @if ($invoice->status == 'Menunggu Konfirmasi')
                                    <p class="mb-0 col-5"><span class="fw-semibold text-warning fs-6">{{ $invoice->status }}</span></p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('cetak_butki', ['id' => $invoice->id]) }}" target="_blank" class="btn btn-success mt-5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                        <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/>
                        <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1"/>
                    </svg>
                    Cetak Bukti
                </a>
                <a href="{{ route('riwayat') }}" class="btn btn-secondary mt-5">
                    Kembali
                </a>
            </div>
        </div>
    </div>
</body>

<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="{{ asset('plugins/popper.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>

<script type="text/javascript">
    window.print();
</script>

</html>
