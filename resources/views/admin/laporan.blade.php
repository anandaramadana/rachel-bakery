@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <h3 class="mb-2 mt-5 text-gray-800 font-weight-bold">Pengaturan Laporan</h3>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <div class="d-flex justify-content-end">
                        <a class="btn btn-danger btn-sm" style="margin-bottom: 20px;" href="{{ route('cetak_laporan') }}" target="_blank">
                            <i class="fas fa-fw fa-print"></i> Cetak PDF
                        </a>
                    </div>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Customer</th>
                            <th>Kategori</th>
                            <th>Nama</th>
                            <th>Waktu Pesan</th>
                            <th>Tanggal Ambil</th>
                            <th>Harga</th>
                            <th>Pembayaran</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Customer</th>
                            <th>Kategori</th>
                            <th>Nama Kue</th>
                            <th>Waktu Pesan</th>
                            <th>Tanggal Ambil</th>
                            <th>Harga</th>
                            <th>Pembayaran</th>
                        </tr>
                    </tfoot>
                    @php
                        $counter = 1;
                    @endphp
                    <tbody>
                        @foreach ($riwayat as $item)
                            <tr>
                                <td>{{ $counter++ }}</td>
                                <td>{{ $item->user['nama'] }}</td>
                                <td>{{ $item->menu->kategori['nama_kategori'] }}</td>
                                <td>{{ $item->menu['nama_kue'] }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->tanggal_ambil }}</td>
                                <td>{{ 'Rp '. number_format($item->total_harga, 0, ',', '.') }}</td>
                                <td>{{ $item->pembayaran['nama_metode'] }}<br>
                                    <img src="{{ asset('assets/img/'.$item->bukti_pembayaran)}}" alt="{{ $item->bukti_pembayaran }}" class="img-fluid" width="100px">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6" style="text-align:right"><strong>Total Seluruh Pemasukan:</strong></td>
                            <td id="totalPemasukan" colspan="2"><strong>{{ 'Rp '. number_format($total, 0, ',', '.') }}</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
@endsection
