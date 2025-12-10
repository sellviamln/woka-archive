@extends('layouts.app')

@section('title', 'Kategori')

@section('content')
<section class="section">
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Daftar Kategori</h4>
                    <a href="{{ route('admin.kategori.create') }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-plus"></i> Tambah Kategori
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
                                    <th>Nama Kategori</th>
                                    <th>Slug</th>
                                    <th>Deskripsi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($kategori as $index => $k)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $k->nama_kategori }}</td>
                                    <td>{{ $k->slug }}</td>
                                    <td>{{ $k->deskripsi?? '-' }}</td>

                                    <td>
                                        <a href="{{ route('admin.kategori.edit', $k->id) }}"
                                           class="btn btn-warning btn-sm">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.kategori.destroy', $k->id) }}"
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
