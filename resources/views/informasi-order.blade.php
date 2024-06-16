@extends('layouts.app')
@section('content')
<section class="container-fluid">
    <div class="container mx-auto mt-4 py-5 mb-0">
        <h4 class="fw-bold mb-4">Informasi Cara Order</h4>
        <div class="container p-0">
            <div class="row g-0 mb-5">
                <div class="col-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="dark" class="bi bi-person-plus" viewBox="0 0 16 16">
                        <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                        <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5"/>
                    </svg>
                </div>
                <div class="col-11">
                    <div class="container">
                        <p class="fw-bold mt-0" style="font-size: 20px;">Mendaftarkan Akun</p>
                        <p class="mt-4">Untuk melakukan pemesanan kue pada Rachel Bakery, anda harus membuat akun terlebih dahulu agar terdaftar sebagai customer kami</p>
                        <a class="btn btn-info rounded px-3 text-white" data-bs-toggle="modal" data-bs-target="#exampleModal2" href="#">Daftar</a>
                    </div>
                </div>
            </div>
            <div class="row g-0 mb-5">
                <div class="col-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="dark" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z"/>
                        <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                    </svg>
                </div>
                <div class="col-11">
                    <div class="container">
                        <p class="fw-bold mt-0" style="font-size: 20px;">Login Sebagai Customer</p>
                        <p class="mt-4">
                            Setelah mendaftar dan memiliki akun, untuk dapat melakukan pemesanan anda harus masuk ke dalam akun yang anda buat terlebih dahulu.
                            Klik menu login dibagian menu diatas atau klik tombol dibawah ini</p>
                        <a class="btn btn-info rounded px-3 text-white" data-bs-toggle="modal" data-bs-target="#exampleModal1" href="#">Login</a>
                    </div>
                </div>
            </div>
            <div class="row g-0 mb-5">
                <div class="col-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="dark" class="bi bi-clipboard2" viewBox="0 0 16 16">
                        <path d="M3.5 2a.5.5 0 0 0-.5.5v12a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-12a.5.5 0 0 0-.5-.5H12a.5.5 0 0 1 0-1h.5A1.5 1.5 0 0 1 14 2.5v12a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-12A1.5 1.5 0 0 1 3.5 1H4a.5.5 0 0 1 0 1z"/>
                        <path d="M10 .5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5.5.5 0 0 1-.5.5.5.5 0 0 0-.5.5V2a.5.5 0 0 0 .5.5h5A.5.5 0 0 0 11 2v-.5a.5.5 0 0 0-.5-.5.5.5 0 0 1-.5-.5"/>
                    </svg>
                </div>
                <div class="col-11">
                    <div class="container">
                        <p class="fw-bold mt-0" style="font-size: 20px;">Memilih Varian Menu Yang Diinginkan!</p>
                        <p class="mt-4">
                            Anda dapat melihat daftar varian menu yang kami sediakan berdasarkan kategori jenis dari kue tersebut. Setelah itu anda dapat melakukan pemesanan atau menambahkan
                            menu ke dalam keranjang terlebih dahulu sebelum melakukan pemesanan
                        </p>
                        <a class="btn btn-info rounded px-3 text-white"  href="/menu">Pesan</a>
                    </div>
                </div>
            </div>
            <div class="row g-0 mb-5">
                <div class="col-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="dark" class="bi bi-bag-check" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0"/>
                        <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
                    </svg>
                </div>
                <div class="col-11">
                    <div class="container">
                        <p class="fw-bold mt-0" style="font-size: 20px;">Lakukan Pemesanan Dengan Mengisi Form!</p>
                        <p class="mt-4">Ketika ingin melakukan pemesanan, anda akan diarahkan untuk mengisi form pemesanan yang berisi rincian pesanan anda.</p>
                    </div>
                </div>
            </div>
            <div class="row g-0 mb-5">
                <div class="col-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="dark" class="bi bi-credit-card-2-back" viewBox="0 0 16 16">
                        <path d="M11 5.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5z"/>
                        <path d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zm13 2v5H1V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1m-1 9H2a1 1 0 0 1-1-1v-1h14v1a1 1 0 0 1-1 1"/>
                    </svg>
                </div>
                <div class="col-11">
                    <div class="container">
                        <p class="fw-bold mt-0" style="font-size: 20px;">Melakukan Pembayaran!</p>
                        <p class="mt-4">Ketika telah melakukan pemesanan, anda dapat melakukan pembayaran menggunakan metode pembayaran yang kami sediakan seperti secara transfer dan secara tunai.</p>
                        <p class="mt-4 text-danger">note: Setelah melakukan pemesanan, wajib melakukan pembayaran sebelum 24 jam, lebih dari itu dibatalkan.</p>
                        <a class="btn btn-info rounded px-3 text-white"  href="/informasi-pembayaran">Pembayaran</a>
                    </div>
                </div>
            </div>
            <div class="row g-0 mb-5">
                <div class="col-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="dark" class="bi bi-cloud-arrow-up" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M7.646 5.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708z"/>
                        <path d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383m.653.757c-.757.653-1.153 1.44-1.153 2.056v.448l-.445.049C2.064 6.805 1 7.952 1 9.318 1 10.785 2.23 12 3.781 12h8.906C13.98 12 15 10.988 15 9.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 4.825 10.328 3 8 3a4.53 4.53 0 0 0-2.941 1.1z"/>
                    </svg>
                </div>
                <div class="col-11">
                    <div class="container">
                        <p class="fw-bold mt-0" style="font-size: 20px;">Upload Bukti Pembayaran!</p>
                        <p class="mt-4">Setelah melakukan transfer, jangan lupa Screenshot dan Upload bukti pembayaran pada halaman data pemesanan yang Anda pesan tadinya.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <a href="/" class="btn btn-secondary px-4">Kembali</a>
        </div>
    </div>
</section>
@endsection
