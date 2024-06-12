@extends('layouts.app')
@section('content')
<section class="container-fluid" style="height: 500px;">
    <div class="container mx-auto mt-4 py-5 mb-0">
        <h4 class="fw-bold mb-4">Informasi Metode Pembayaran</h4>
        <div class="container p-0">
            <div class="row g-0">
                <div class="col-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="#ffffff" class="bi bi-coin bg-success rounded-circle p-2" viewBox="0 0 16 16">
                        <path d="M5.5 9.511c.076.954.83 1.697 2.182 1.785V12h.6v-.709c1.4-.098 2.218-.846 2.218-1.932 0-.987-.626-1.496-1.745-1.76l-.473-.112V5.57c.6.068.982.396 1.074.85h1.052c-.076-.919-.864-1.638-2.126-1.716V4h-.6v.719c-1.195.117-2.01.836-2.01 1.853 0 .9.606 1.472 1.613 1.707l.397.098v2.034c-.615-.093-1.022-.43-1.114-.9H5.5zm2.177-2.166c-.59-.137-.91-.416-.91-.836 0-.47.345-.822.915-.925v1.76h-.005zm.692 1.193c.717.166 1.048.435 1.048.91 0 .542-.412.914-1.135.982V8.518z"/>
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                        <path d="M8 13.5a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11m0 .5A6 6 0 1 0 8 2a6 6 0 0 0 0 12"/>
                    </svg>
                </div>
                <div class="col-11">
                    <div class="container">
                        <p class="fw-bold mt-0" style="font-size: 20px;">Pembayaran</p>
                        <p class="mt-4">Untuk pembayaran pemesanan Rachel Bakery, melalui via transfer bank. Berikut data rekening kami:</p>
                        <p class="mt-4">No. Rekening : <b>Bank BRI 626262626262</b></p>
                        <p class="mt-4">An. Rekening : <b>Rachel Bakery</b></p>
                        <p class="mt-4">No. Rekening : <b>Bank BRI 626262626262</b></p>
                        <p class="mt-4">An. Rekening : <b>Rachel Bakery</b></p>
                        <p class="mt-4">atau bisa membayar secara langsung di tempat kami. Berikut alamat kami :</p>
                        <p class="mt-4 fw-mediu">
                            <a href="https://maps.app.goo.gl/4pstwiTRFvEssR3G6" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="##1C211C" class="bi bi-geo-alt" viewBox="0 0 16 16">
                                    <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10"/>
                                    <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                                </svg>
                                Pangeranan
                                Bangkalan, Madura
                            </a>
                        </p>
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
