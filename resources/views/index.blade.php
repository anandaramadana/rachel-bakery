@extends('layouts.app')
@section('content')
    <div class="header">
        <div class="alert-login">
            @if (session()->has('tambah_user'))
                <div class="alert alert-info alert-dismissible fade show mt-5" role="alert">
                    {{ session('tambah_user') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session()->has('loginError'))
            <div class="alert alert-danger alert-dismissible fade show mt-5" role="alert">
                {{ session('loginError') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
        </div>

        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('assets/img/slide1.png') }}" class="d-block w-100 h-100" alt="...">
                </div>
                @foreach ($slider as $item)
                    <div class="carousel-item">
                        <img src="{{ asset('assets/img/'. $item->gambar) }}" class="d-block w-100" alt="...">
                    </div>
                @endforeach
                    <div class="carousel-text">
                        <p class="section-subheader fw-bold text-center">PENYEDIA</p>
                        <h1 class="text-center">Kue Rumahan<br /> Terbaik</h1>
                        <button class="carousel-btn"><a href="/menu">Pesan Sekarang</a></button>
                    </div>
                <!-- <div class="carousel-item">
                    <img src="{{ asset('assets/img/cake-carousel.jpg') }}" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/img/carousel-kue.jpeg') }}" class="d-block w-100" alt="...">
                </div> -->
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <div class="packaging">
        <p class="section-subheader text-center mb-0 text-secondary fw-bold">VARIASI</p>
        <h2 class="section-header text-center fw-bold text-dark">Pilihan Jenis Kue</h2>
        <div class="paket-grid">
            @foreach ($kategori as $item)
                <div class="paket-card">
                    <img src="{{ asset('assets/img/'. $item->gambar) }}" class="card-img-top" alt="...">
                    <div class="paket-description">
                        <div>
                            <h5>{{ $item->nama_kategori }}</h5>
                            <p>{{ $item->deskripsi }}</p>
                            <a href="/menu" class="btn btn-info text-white" style="border-radius: 2;">Selengkapnya</a>
                        </div>
                        <!-- <h4>Rp1000<span>/buah</span></h4> -->
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="feature">
        <div class="section-container fitur-container" id="fitur">
            <p class="section-subheader text-center mb-0 text-secondary fw-bold">MENYAJIKAN</p>
            <h2 class="section-header text-center fw-bold text-dark">Layanan Terbaik</h2>
            <div class="feature-grid">
                <div class="feature-card">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-hand-thumbs-up-fill" viewBox="0 0 16 16">
                            <path d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.066c.463.116.874.456 1.012.965.22.816.533 2.511.062 4.51a10 10 0 0 1 .443-.051c.713-.065 1.669-.072 2.516.21.518.173.994.681 1.2 1.273.184.532.16 1.162-.234 1.733q.086.18.138.363c.077.27.113.567.113.856s-.036.586-.113.856c-.039.135-.09.273-.16.404.169.387.107.819-.003 1.148a3.2 3.2 0 0 1-.488.901c.054.152.076.312.076.465 0 .305-.089.625-.253.912C13.1 15.522 12.437 16 11.5 16H8c-.605 0-1.07-.081-1.466-.218a4.8 4.8 0 0 1-.97-.484l-.048-.03c-.504-.307-.999-.609-2.068-.722C2.682 14.464 2 13.846 2 13V9c0-.85.685-1.432 1.357-1.615.849-.232 1.574-.787 2.132-1.41.56-.627.914-1.28 1.039-1.639.199-.575.356-1.539.428-2.59z"/>
                        </svg>
                    </span>
                    <h4>Kualitas Terbaik</h4>
                    <p>
                        Kami selalu menjaga kualitas produksi. Mulai dari bahan olahan kue, alat pembuatan kue, hingga kue tersebut selesai agar tetap terjaga
                        kualitas estetika dan kandungan kue.
                    </p>
                </div>
                <div class="feature-card">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-cake2-fill" viewBox="0 0 16 16">
                            <path d="m2.899.804.595-.792.598.79A.747.747 0 0 1 4 1.806v4.886q-.532-.09-1-.201V1.813a.747.747 0 0 1-.1-1.01ZM13 1.806v4.685a15 15 0 0 1-1 .201v-4.88a.747.747 0 0 1-.1-1.007l.595-.792.598.79A.746.746 0 0 1 13 1.806m-3 0a.746.746 0 0 0 .092-1.004l-.598-.79-.595.792A.747.747 0 0 0 9 1.813v5.17q.512-.02 1-.055zm-3 0v5.176q-.512-.018-1-.054V1.813a.747.747 0 0 1-.1-1.01l.595-.79.598.789A.747.747 0 0 1 7 1.806"/>
                            <path d="M4.5 6.988V4.226a23 23 0 0 1 1-.114V7.16c0 .131.101.24.232.25l.231.017q.498.037 1.02.055l.258.01a.25.25 0 0 0 .26-.25V4.003a29 29 0 0 1 1 0V7.24a.25.25 0 0 0 .258.25l.259-.009q.52-.018 1.019-.055l.231-.017a.25.25 0 0 0 .232-.25V4.112q.518.047 1 .114v2.762a.25.25 0 0 0 .292.246l.291-.049q.547-.091 1.033-.208l.192-.046a.25.25 0 0 0 .192-.243V4.621c.672.184 1.251.409 1.677.678.415.261.823.655.823 1.2V13.5c0 .546-.408.94-.823 1.201-.44.278-1.043.51-1.745.696-1.41.376-3.33.603-5.432.603s-4.022-.227-5.432-.603c-.702-.187-1.305-.418-1.745-.696C.408 14.44 0 14.046 0 13.5v-7c0-.546.408-.94.823-1.201.426-.269 1.005-.494 1.677-.678v2.067c0 .116.08.216.192.243l.192.046q.486.116 1.033.208l.292.05a.25.25 0 0 0 .291-.247M1 8.82v1.659a1.935 1.935 0 0 0 2.298.43.935.935 0 0 1 1.08.175l.348.349a2 2 0 0 0 2.615.185l.059-.044a1 1 0 0 1 1.2 0l.06.044a2 2 0 0 0 2.613-.185l.348-.348a.94.94 0 0 1 1.082-.175c.781.39 1.718.208 2.297-.426V8.833l-.68.907a.94.94 0 0 1-1.17.276 1.94 1.94 0 0 0-2.236.363l-.348.348a1 1 0 0 1-1.307.092l-.06-.044a2 2 0 0 0-2.399 0l-.06.044a1 1 0 0 1-1.306-.092l-.35-.35a1.935 1.935 0 0 0-2.233-.362.935.935 0 0 1-1.168-.277z"/>
                        </svg>
                    </span>
                    <h4>Menu Bervariasi</h4>
                    <p>
                        Kami menyediakan bermacam - macam menu pilihan kue. Terdapat beberapa jenis kue kering dan kue basah. Kami juga menyediakan
                        pilihan paket kue.
                    </p>
                </div>
                <div class="feature-card">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                            <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6"/>
                        </svg>
                    </span>
                    <h4>Lokasi Strategis</h4>
                    <p>
                        Kami bertempat pada alamat yang strategis yaitu di daerah pusat kota, sehingga memudahkan teman - teman apabila
                        ingin mampir ke outlet kami.
                    </p>
                </div>
                <div class="feature-card">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-tag-fill" viewBox="0 0 16 16">
                            <path d="M2 1a1 1 0 0 0-1 1v4.586a1 1 0 0 0 .293.707l7 7a1 1 0 0 0 1.414 0l4.586-4.586a1 1 0 0 0 0-1.414l-7-7A1 1 0 0 0 6.586 1zm4 3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
                        </svg>
                    </span>
                    <h4>Harga Terjangkau</h4>
                    <p>
                        Kami menyediakan daftar harga dari menu setiap kue menjadi terjangkau. Selain itu, walaupun adanya pilihan paket,
                        kami tetap menyediakan harga terbaik untuk teman - teman.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
