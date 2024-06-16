@extends('layouts.app')
@section('content')

<section class="container-fluid" style="margin-bottom: 400px">
    @if (session()->has('tambah_pemesanan'))
        <div class="alert alert-info alert-dismissible fade show mt-5" role="alert">
            {{ session('tambah_pemesanan') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session()->has('delete_pemesanan'))
        <div class="alert alert-danger alert-dismissible fade show mt-5" role="alert">
            {{ session('delete_pemesanan') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session()->has('tambah_bukti'))
        <div class="alert alert-info alert-dismissible fade show mt-5" role="alert">
            {{ session('tambah_bukti') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session()->has('tenggat'))
        <div class="alert alert-danger alert-dismissible fade show mt-5" role="alert">
            {{ session('tenggat') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <h5 class="fw-bold p-3 ms-5 mt-5">Riwayat Pesanan</h5>
    <div class="container ms-8">
        <div class="table-responsive-xxl">
            <table class="table">
                <thead class="table-secondary table-responsive">
                    <tr>
                        <th class="align-middle">Nama</th>
                        <th class="align-middle">Waktu Pemesanan</th>
                        <th class="align-middle">Tanggal Ambil</th>
                        <th class="align-middle">Jam Ambil</th>
                        <th class="align-middle">Total Harga</th>
                        <th class="align-middle">Payment</th>
                        <th class="align-middle">Bukti Pembayaran</th>
                        <th class="align-middle">Status</th>
                        <th class="align-middle">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pesan as $index => $item)
                        @if($item->user_id == auth()->user()->id)
                            <tr>
                                <td>{{ $item->user->nama }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->tanggal_ambil }}</td>
                                <td>{{ $item->jam_ambil }}</td>
                                <td>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                <td>
                                    @if ($item->pembayaran->nama_metode !== 'Bayar Langsung')
                                    {{ $item->pembayaran['nama_metode']}}<br>
                                    ({{ $item->pembayaran['no_rek']}})
                                    @else
                                    {{ $item->pembayaran['nama_metode']}}<br>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->bukti_pembayaran)
                                        <p>
                                            <a href="#" class="link-offset-2 link-underline link-underline-opacity-0" data-bs-toggle="modal" data-bs-target="#lihat-gambar-{{ $item->id }}">
                                                Bukti
                                            </a>
                                        </p>
                                        <!-- Modal -->
                                        <div class="modal fade" id="lihat-gambar-{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content" style="background-color: transparent; border:0;">
                                                    <div class="modal-header" style="border-bottom:0;">
                                                        <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>

                                                    </div>
                                                    <div class="modal-body p-0 d-flex justify-content-center">
                                                        <img src="{{ asset('assets/img/'.$item->bukti_pembayaran)}}" alt="{{ $item->bukti_pembayaran }}" class="img-fluid">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->status == 'Belum Terverifikasi')
                                        <p class="mb-0 col-5"><span class="badge text-bg-danger fs-6">{{ $item->status }}</span></p>
                                    @endif
                                    @if ($item->status == 'Lunas')
                                        <p class="mb-0 col-5"><span class="badge text-bg-success fs-6">{{ $item->status }}</span></p>
                                    @endif
                                    @if ($item->status == 'Bayar DP')
                                        <p class="mb-0 col-5"><span class="badge text-bg-info fs-6">{{ $item->status }}</span></p>
                                    @endif
                                    @if (!$item->bukti_pembayaran)
                                        @if ($item->pembayaran->nama_metode !== 'Bayar Langsung' or $item->status !== 'Lunas')
                                            <div class="waktu-pemesanan" data-waktu-pemesanan="{{ $item->created_at }}" data-waktu-expired="{{ $item->waktu_expired }}">
                                                {{ $item->waktu_expired ? now()->diffInHours($item->waktu_expired).' jam' : 'Belum ada durasi'}}
                                            </div>
                                        @endif
                                    @elseif ($item->status == 'Menunggu Konfirmasi')
                                        <p class="mb-0 col-5"><span class="badge text-bg-warning fs-6">{{ $item->status }}</span></p>
                                    @endif
                                </td>
                                <td>
                                    <div class="container d-flex flex-column">
                                        <a type="button" class="btn btn-warning mb-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Print invoice" href="{{ route('cetak_butki', ['id' => $item->id]) }}" target="_blank" title="Cetak PDF">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#ffffff" class="bi bi-printer-fill" viewBox="0 0 16 16">
                                                <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1"/>
                                                <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/>
                                            </svg>
                                        </a>
                                        <a type="button" class="btn btn-primary mb-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Lihat invoice" href="/invoice/{{ $item->id }}/" title="Invoice">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                                            </svg>
                                        </a>
                                        @if ($item->status !== 'Lunas')
                                            <a type="button" class="btn btn-danger mb-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Batal pesan" href="/riwayat/{{ $item->id }}/delete" onclick="return confirm('Apakah yakin menghapus reservasi Anda?')" title="Hapus Pesanan">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                                                </svg>
                                            </a>
                                        @endif
                                        @if ($item->pembayaran->nama_metode !== 'Bayar Langsung')
                                            @if (!$item->bukti_pembayaran)
                                            <button type="button" class="btn btn-success mb-1" data-bs-placement="top" data-bs-title="Upload bukti bayar" data-bs-toggle="modal" data-bs-target="#image-bukti-{{ $item->id }}" title="Upload Bukti Pembayaran">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-arrow-up-fill" viewBox="0 0 16 16">
                                                    <path d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2m2.354 5.146a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0z"/>
                                                </svg>
                                            </button>
                                            @endif
                                        @endif
                                    </div>
                                </td>
                            <tr>
                            <div class="modal fade" id="image-bukti-{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="{{ route('bukti', ['id' => $item->id]) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Update Image</h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <input type="file" name="bukti_pembayaran" class="form-control shadow-none" accept="image/*">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Kembali</button>
                                                <button href class="btn btn-success text-white shadow-none">Kirim</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const waktuPemesananElems = document.querySelectorAll('.waktu-pemesanan');

        function updateWaktu() {
            waktuPemesananElems.forEach((elem) => {
                const waktuPemesanan = new Date(elem.getAttribute('data-waktu-pemesanan')).getTime();
                const waktuExpired = new Date(elem.getAttribute('data-waktu-expired')).getTime();
                console.log('waktuPemesanan:', waktuPemesanan, 'waktuExpired:', waktuExpired);

                const sekarang = Date.now();
                const sisaWaktu = waktuExpired - sekarang;

                if (sisaWaktu > 0) {
                    const jam = Math.floor(sisaWaktu / (1000 * 60 * 60));
                    const menit = Math.floor((sisaWaktu % (1000 * 60 * 60)) / (1000 * 60));
                    const detik = Math.floor((sisaWaktu % (1000 * 60)) / 1000);

                    const jamStr = jam < 10 ? '0' + jam : jam;
                    const menitStr = menit < 10 ? '0' + menit : menit;
                    const detikStr = detik < 10 ? '0' + detik : detik;

                    elem.innerHTML = jamStr + ':' + menitStr + ':' + detikStr;
                } else {
                    elem.innerHTML = 'Kadaluarsa';
                }
            });
        }

        setInterval(updateWaktu, 1000);
        updateWaktu();
    });
</script>
@endsection
