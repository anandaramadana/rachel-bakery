@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <h3 class="mb-2 mt-5 text-gray-800 font-weight-bold">Pengaturan Order</h3>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            @if (session()->has('update_pesan'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    {{ session('update_pesan') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button>
                </div>
            @endif
            @if (session()->has('delete_pesan'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('delete_pesan') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button>
                </div>
            @endif
        </div>

        @if(count($order))
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Customer</th>
                                <th>Kategori</th>
                                <th>Nama</th>
                                <th>Waktu Pesan</th>
                                <th>Harga</th>
                                <th>Bukti</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Customer</th>
                                <th>Kategori</th>
                                <th>Nama Kue</th>
                                <th>Waktu Pesan</th>
                                <th>Harga</th>
                                <th>Bukti</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </tfoot>
                        @php
                            $counter = 1;
                        @endphp
                        <tbody>
                            @foreach ($order as $item)
                                <tr>
                                    <td>{{ $counter++ }}</td>
                                    <td>{{ $item->user['nama'] }}</td>
                                    <td>{{ $item->menu->kategori['nama_kategori'] }}</td>
                                    <td>{{ $item->menu['nama_kue'] }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ 'Rp '. number_format($item->total_harga, 0, ',', '.') }}</td>
                                    <td>
                                    @if ($item->bukti_pembayaran)
                                        <p>
                                            <a href="#" class="link-offset-2 link-underline link-underline-opacity-0" data-toggle="modal" data-target="#lihat-gambar-{{ $item->id }}">
                                                Bukti
                                            </a>
                                        </p>

                                        <!-- Modal -->
                                        <div class="modal fade" id="lihat-gambar-{{ $item->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content" style="background-color: transparent; border:0;">
                                                    <div class="modal-header" style="border-bottom:0;">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
                                                    </div>
                                                    <div class="modal-body p-0 d-flex justify-content-center">
                                                        <img src="{{ asset('assets/img/'.$item->bukti_pembayaran)}}" alt="{{ $item->bukti_pembayaran }}" class="img-fluid">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                    <div class="waktu-pemesanan" data-waktu-pemesanan="{{ $item->created_at }}" data-waktu-expired="{{ $item->waktu_expired }}">
                                        {{ $item->waktu_expired ? now()->diffInHours($item->waktu_expired).' jam' : 'Belum ada durasi'}}
                                    </div>
                                    @endif
                                </td>
                                <td class="project-state">
                                    {{-- <span class="badge badge-danger">{{ $item->status }}</span> --}}
                                    @if ($item->status == 'Belum terverifikasi')
                                        <p class="mb-0 col-5"><span class="badge text-bg-danger fs-7">{{ $item->status }}</span></p>
                                    @endif
                                    @if ($item->status == 'Menunggu Konfirmasi')
                                        <p class="mb-0 col-5"><span class="badge text-bg-warning fs-7">{{ $item->status }}</span></p>
                                    @endif
                                    @if ($item->status == 'Bayar DP')
                                        <p class="mb-0 col-5"><span class="badge text-bg-info fs-7">{{ $item->status }}</span></p>
                                    @endif
                                </td>
                                <td class="project-actions text-right">
                                    <a class="btn btn-success btn-sm" href="/orderedit/ {{ $item->id  }} "onclick="return confirm('Apakah benar Reservasi telah dibayar Lunas?')" title="Bayar Lunas">
                                        <i class="fas fa-check">
                                        </i>
                                    </a>
                                    <a class="btn btn-primary btn-sm" href="/orderdp/ {{ $item->id  }}" onclick="return confirm('Apakah benar Reservasi telah dibayar DP?')" title="Bayar DP">
                                        <i class="fas fa-money-bill">
                                        </i>
                                    </a>
                                    <a class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#detail-{{ $item->id }}" title="Invoice">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @method('delete')
                                    @csrf
                                    <a class="btn btn-danger btn-sm" href="/orderbatal/ {{ $item->id  }}" onclick="return confirm('Apakah Anda yakin mengahapus Reservasi ini?')" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</div>

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
