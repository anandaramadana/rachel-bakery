@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <h3 class="mb-2 mt-5 text-gray-800 font-weight-bold">Pengaturan Menu</h3>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            @if (session()->has('tambah_menu'))
            <div class="alert alert-info alert-dismissible" role="alert">
                {{ session('tambah_menu') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button>
            </div>
            @endif
            @if (session()->has('delete_menu'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('delete_menu') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button>
            </div>
            @endif
            @if (session()->has('edit_menu'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('edit_menu') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button>
            </div>
            @endif

            <div class="card-tools">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambah_menu">
                        <i class="fas fa-plus"></i> Tambah Menu
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal Tambah Menu -->
        <div class="modal fade" id="tambah_menu" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form action="/tambah_menu" id="rooms-setting" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Menu</h5>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Kue</label>
                                    <input type="text" min="1" name="nama_kue" id="site_title_inp" class="form-control shadow-none" required>
                                    </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kategori</label>
                                    <br>
                                        <select name="kategori_id" class="form-select form-control form-control-lg mb-0" aria-label=".form-select-sm example" style="font-size: 16px">
                                            <option selected hidden>Pilih Kategori</option>
                                            @foreach ($kategori as $p)
                                                <option value="{{ $p->id }}">{{ $p->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Harga</label>
                                    <input type="text" min="1" name="harga" id="site_title_inp" class="form-control shadow-none" required>
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
                            <th>Kategori</th>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th>Harga</th>
                            <th>Gambar</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th>Harga</th>
                            <th>Gambar</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </tfoot>
                    @php
                        $counter = 1;
                    @endphp
                    <tbody>
                        @foreach ($menu as $item)
                            <tr>
                                <td>{{ $counter++ }}</td>
                                <td>{{ $item->kategori->nama_kategori }}</td>
                                <td>{{ $item->nama_kue }}</td>
                                <td>{{ $item->deskripsi }}</td>
                                <td>{{ $item->harga }}</td>
                                <td class="text-center">
                                    <img src="{{ asset('assets/img/'.$item->gambar) }}" style="width: 200px;" class="align-items-center">
                                </td>
                                <td class="project-actions text-center">
                                    <a class="btn btn-info btn-sm" href="/menu/{{ $item->id }}/edit" title="Edit Menu">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <a class="btn btn-danger btn-sm" href="/menu/{{ $item->id }}/delete" onclick="return confirm('Apakah yakin ingin menghapus?')" title="Hapus Menu">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
