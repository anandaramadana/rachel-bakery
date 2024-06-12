@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <h3 class="mb-2 mt-5 text-dark font-weight-bold">Pengaturan Akun Customer</h3>
    <div class="card shadow mb-4">
        @if (session()->has('delete_akun'))
            <div class="card-header py-3">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('delete_akun') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button>
                </div>
            </div>
        @endif

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th>Kontak</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th>Kontak</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </tfoot>
                    @php
                        $counter = 1;
                    @endphp
                    @foreach ($customer as $item)
                    @if ($item->role == 'customer')
                        <tbody>
                            <tr>
                                <td>{{ $counter++ }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td>{{ $item->no_hp }}</td>
                                <td class="project-actions text-center">
                                <a class="btn btn-danger btn-sm" href="/akun/{{ $item->id }}/delete" onclick="return confirm('Apakah yakin ingin menghapus?')" title="Hapus Akun">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                            </tr>
                        </tbody>
                    @endif
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
