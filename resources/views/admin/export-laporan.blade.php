<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Rachel Bakery - Admin</title>
    <!-- Custom fonts for this template-->
    <link href="{{ asset('assets/template-admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/template-admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/template-admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

</head>
<body>
    <div class="container-fluid">
        <div class="card shadow mb-4">
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
</body>

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

<script type="text/javascript">
    window.print();
</script>

</html>
