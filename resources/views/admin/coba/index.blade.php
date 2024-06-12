@extends('admin.layouts.app')
@push('styles')
<link rel="stylesheet" href="{{ asset('plugins/datatables/datatable.css') }}">
@endpush
@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-end mb-2">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-posyandu_modal">
                <i class="fas fa-plus"></i>
                <span>
                    Tambah
                </span>
            </button>
        </div>
        <div class="table-responsive">
            {{ $dataTable->table() }}
        </div>
    </div>
</div>
@push('scripts')
<script src="{{ asset('plugins/datatables/datatable.js') }}"></script>
{{ $dataTable->scripts() }}
@endpush
@endsection
