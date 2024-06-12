<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-nav d-flex align-items-center">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="/">
            <img src="{{ asset('assets/img/logo-tulisan.png') }}" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/menu">Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/layanan">Layanan</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Informasi
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/informasi-order">Order</a></li>
                        <li><a class="dropdown-item" href="/informasi-pembayaran">Pembayaran</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                @if (!Auth::user())
                <li class="nav-item">
                    <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal1" href="#">Masuk</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#exampleModal2" href="#">Daftar</a>
                </li>
                @endif
                @if (Auth::user())
                    <li class="nav-item dropdown">
                        <div class="d-flex align-items-center">
                            <a class="nav-link fw-medium dropdown-toggle d-flex align-items-center ms-2" href="#" style="font-size: 1rem" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ asset('assets/img/'.auth()->user()->gambar) }}" alt="Logo" width="34" height="34"
                                    class="d-inline-block align-text-top bg-white rounded-circle">
                                {{ auth()->user()->nama }}
                            </a>
                            <a href="/keranjang" class="cart ms-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-cart-fill" viewBox="0 0 16 16">
                                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                                </svg>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/profile/{{ auth()->user()->id }}/edit">Profile</a></li>
                                <li><a class="dropdown-item" href="{{ route('riwayat') }}">Riwayat Order</a></li>
                                <!-- <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ubah-password" href="#" >Ubah Password</a></li> -->
                                @if ( auth()->user()->role == 'admin')
                                <li><a class="dropdown-item" href="#">Tampilan Admin</a></li>
                                @endif
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item mt-1 ms-3">
                        <a class="btn btn-danger" href="{{ route('logout') }}">Keluar</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<!-- Modal  Login-->
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header" data-bs-theme="dark">
        <h1 class="modal-title fs-4 fw-bold text-white" id="exampleModalLabel">
            <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" width="50" height="40"
                class="d-inline-block align-text-top">
                Login
            </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('login') }}" method="POST">
            <div class="modal-body">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="nama@gmail.com" value="">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success rounded">Masuk</button>
            </div>
        </form>
    </div>
    </div>
</div>

<!-- Modal  Daftar-->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header" data-bs-theme="dark">
        <h1 class="modal-title fs-4 fw-bold text-white" id="exampleModalLabel">
            <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" width="50" height="40"
                class="d-inline-block align-text-top">
                Daftar
            </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('tambah_user') }}" method="post">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Isi nama anda">
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Isi alamat anda">
                </div>
                <div class="mb-3">
                    <label for="no_hp" class="form-label">No HP</label>
                    <input type="tel" class="form-control" name="no_hp" id="no_hp" placeholder="08xxxxxxxxxx">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="exampleFormControlInput1" placeholder="nama@gmail.com">
                </div>
                <div class="mb-3">
                    <label for="inputPassword" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="inputPassword">
                </div>
                    <input type="text" class="form-control" name="role" id="role" value="customer" hidden>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-info rounded">Daftar</button>
            </div>
        </form>
    </div>
    </div>
</div>
