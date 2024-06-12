@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <h3 class="mb-2 mt-5 text-gray-800 font-weight-bold">Pengaturan Akun Admin</h3>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            @if (session()->has('tambah_akun'))
            <div class="alert alert-info alert-dismissible" role="alert">
                {{ session('tambah_akun') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button>
            </div>
            @endif
            @if (session()->has('delete_akun'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('delete_akun') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button>
            </div>
            @endif

            <div class="card-tools">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambah_admin">
                        <i class="fas fa-plus"></i> Tambah Admin
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal Tambah Akun Admin -->
        <div class="modal fade" id="tambah_admin" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form action="/tambah_akun" id="rooms-setting" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Admin</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" min="1" name="nama" id="site_title_inp" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Alamat</label>
                                <input type="text" min="1" name="alamat" id="site_title_inp" class="form-control shadow-none">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">No Telpon</label>
                                <input type="text" min="1" name="no_hp" id="site_title_inp" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" min="1" name="email" id="site_title_inp" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" min="1" name="password" id="site_title_inp" class="form-control shadow-none" required>
                            </div>
                            <input type="text" class="form-control" name="role" id="role" value="admin" hidden>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn text-secondary shadow-none" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-success text-white shadow-none">Daftar</button>
                    </div>
                    </div>
                </form>
            </div>
        </div>

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
                    @foreach ($admin as $item)
                    @if ($item->role == 'admin')
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
