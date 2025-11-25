@extends('layouts.app')

@section('title', 'Departemen')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Departemen</h1>
    <ol class="breadcrumb mb-4"></ol>
    @if(session('success'))
    <div class="alert alert-success small">{{ session('success')}}</div>
    @endif
    <div class="card mb-4">
        <div class="card-body d-flex">
            <a href="{{ route('admin.departemen.create') }}" class="btn btn-primary me-auto">
                <i class="fas fa-plus"></i> Tambah Departemen
            </a>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Kembali ke Dashboard</a>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover text-center" id="kelas">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Nama Departemen</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($departemen as $index => $d)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $d->nama_departemen }}</td>
                        <td>{{ $d->deskripsi }}</td>
                        <td>
                            <a href="{{ route('admin.departemen.edit', $d->id) }}" class="btn btn-warning btn-sm">
                                Edit
                            </a>
                            <form action="{{ route('admin.departemen.destroy', $d->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin mau hapus departemen ini?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#kelas').DataTable();
    });
</script>
@endsection
