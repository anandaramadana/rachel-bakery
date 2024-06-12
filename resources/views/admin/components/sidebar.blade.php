<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #D28468;">

<!-- Sidebar - Brand -->
@if (Auth::user())
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/profile-admin/{{ auth()->user()->id }}/edit">
        <div class="sidebar-brand-icon">
            <img class="bg-white rounded-circle" width="34" height="34" src="{{ asset('assets/img/'.auth()->user()->gambar) }}">
        </div>
        <div class="sidebar-brand-text mx-3">{{ auth()->user()->nama }}</div>
    </a>
@endif

<!-- Divider -->
<hr class="sidebar-divider my-0">
<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="/admin">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">
<!-- Heading -->
<div class="sidebar-heading">
    Bisnis
</div>
<!-- Nav Item - Pages Produk -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#nav-pemesanan"
        aria-expanded="true" aria-controls="nav-pemesanan">
        <i class="fas fa-fw fa-list"></i>
        <span>Produk</span>
    </a>
    <div id="nav-pemesanan" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Pengaturan Produk :</h6>
            <a class="collapse-item" href="{{ route('kategori') }}">Kategori</a>
            <a class="collapse-item" href="{{ route('list-menu') }}">Menu</a>
        </div>
    </div>
</li>

<!-- Nav Item - Pages Pemesanan -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#nav-produk"
        aria-expanded="true" aria-controls="nav-produk">
        <i class="fas fa-fw fa-clipboard"></i>
        <span>Pemesanan</span>
    </a>
    <div id="nav-produk" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Pengaturan Pemesanan :</h6>
            <a class="collapse-item" href="{{ route('order') }}">Order</a>
            <a class="collapse-item" href="{{ route('laporan') }}">Laporan</a>
        </div>
    </div>
</li>

<!-- Nav Item - Pages Pembayaran -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('pembayaran') }}">
        <i class="fas fa-fw fa-credit-card"></i>
        <span>Pembayaran</span>
    </a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Sistem
</div>

<!-- Nav Item - Pages Akun -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#nav-akun"
    aria-expanded="true" aria-controls="nav-akun">
        <i class="fas fa-fw fa-user"></i>
        <span>Akun</span>
    </a>
    <div id="nav-akun" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Pengaturan Akun :</h6>
            <a class="collapse-item" href="{{ route('akun-admin') }}">Admin</a>
            <a class="collapse-item" href="{{ route('akun-customer') }}">Customer</a>
        </div>
    </div>
</li>

<!-- Nav Item - Pages Slider -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('slider') }}">
        <i class="fas fa-fw fa-image"></i>
        <span>Slider</span>
    </a>
</li>

<!-- Nav Item - Logout -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('logout') }}">
        <i class="fas fa-fw fa-ban"></i>
        <span>Logout</span>
    </a>
</li>


<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->
