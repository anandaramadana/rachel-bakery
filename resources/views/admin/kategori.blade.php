@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <h3 class="mb-2 mt-5 text-gray-800 font-weight-bold">Pengaturan Kategori</h3>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            @if (session()->has('tambah_kategori'))
            <div class="alert alert-info alert-dismissible" role="alert">
                {{ session('tambah_kategori') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button>
            </div>
            @endif
            @if (session()->has('delete_kategori'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('delete_kategori') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button>
            </div>
            @endif
            @if (session()->has('edit_kategori'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('edit_kategori') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button>
            </div>
            @endif

            <div class="card-tools">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambah_kategori">
                        <i class="fas fa-plus"></i> Tambah Kategori Produk
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal Tambah Kategori -->
        <div class="modal fade" id="tambah_kategori" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form action="/tambah_kategori" id="rooms-setting" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Kategori</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Kategori</label>
                                <input type="text" min="1" name="nama_kategori" id="site_title_inp" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Gambar</label>
                                <input type="file" name="gambar" id="site_title_inp" class="form-control shadow-none" accept="image/*" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Deskripsi</label>
                                <input type="text" min="1" name="deskripsi" id="site_title_inp" class="form-control shadow-none" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn text-secondary shadow-none" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-success text-white shadow-none">Tambah</button>
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
                            <th>Deskripsi</th>
                            <th>Gambar</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th>Gambar</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </tfoot>
                    @php
                        $counter = 1;
                    @endphp
                    @foreach ($kategori as $item)
                        <tbody>
                            <tr>
                                <td>{{ $counter++ }}</td>
                                <td>{{ $item->nama_kategori }}</td>
                                <td>{{ $item->deskripsi }}</td>
                                <td class="text-center">
                                    <img src="{{ asset('assets/img/'.$item->gambar) }}" style="width: 200px;" class="align-items-center">
                                </td>
                                <td class="project-actions text-center">
                                    <a class="btn btn-info btn-sm" href="/kategori/{{ $item->id }}/edit" title="Edit Kategori">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <a class="btn btn-danger btn-sm" href="/kategori/{{ $item->id }}/delete" onclick="return confirm('Apakah yakin ingin menghapus?')" title="Hapus Kategori">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
