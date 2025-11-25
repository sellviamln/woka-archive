@extends('layouts.app')

@section('title', 'Departemen')

@section('content')
<section class="section" style="padding-top: 80px;">
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Daftar Departemen</h4>
                    <a href="{{ route('admin.departemen.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> + Tambah Departemen
                    </a>
                </div>

                @if(session('success'))
                    <div class="m-3 alert alert-success small">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover no-wrap-header">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Departemen</th>
                                    <th>Deskripsi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($departemen as $index => $d)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $d->nama_departemen }}</td>
                                    <td>{{ $d->deskripsi }}</td>
                                    <td>
                                        <a href="{{ route('admin.departemen.edit', $d->id) }}"
                                            class="btn btn-warning btn-sm">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.departemen.destroy', $d->id) }}"
                                            method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">
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
        </div>
    </div>
</section>
@endsection
