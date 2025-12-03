@extends('layouts.app')

@section('title', $kategori->nama)

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>{{ $kategori->nama }}</h3>
        <a href="{{ route('staff.dokumen.index') }}" class="btn btn-sm btn-outline-secondary">Kembali</a>
    </div>

    {{-- Card Upload --}}
    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <h5 class="fw-bold">Upload Dokumen Baru</h5>
            <form action="{{ route('staff.dokumen.upload', $kategori->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                 <div class="form-group mb-3">
                    <label for="file">File</label>
                    <input type="file" name="file" id="file" class="form-control" required>
                </div>
                @error('file')
                <div class="text-danger">{{ $message }}</div>
                @enderror

                <div class="form-group mb-3">
                    <label for="judul">Judul</label>
                    <input type="text" name="judul" class="form-control" id="judul" required>
                </div>
                 @error('judul')
                <div class="text-danger">{{ $message }}</div>
                @enderror

                <div class="form-group mb-3">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" rows="5" class="form-control"></textarea>
                </div>
                 @error('deskripsi')
                <div class="text-danger">{{ $message }}</div>
                @enderror

                <div class="form-group mb-3">
                    <label for="tanggal_upload">Tanggal Upload</label>
                    <input type="date" name="tanggal_upload" class="form-control" required>
                </div>
                 @error('tanggal_upload')
                <div class="text-danger">{{ $message }}</div>
                @enderror

                <div class="form-group mb-3">
                    <label for="tanggal_kadaluarsa">Tanggal Kadaluarsa</label>
                    <input type="date" name="tanggal_kadaluarsa" class="form-control">
                </div>
                 @error('tanggal_kadaluarsa')
                <div class="text-danger">{{ $message }}</div>
                @enderror
               

                {{-- Hidden inputs untuk kategori dan departemen --}}
                <input type="hidden" name="kategori_id" value="{{ $kategori->id }}">
                <input type="hidden" name="departemen_id" value="{{ auth()->user()->departemen_id }}">

                <button type="submit" class="btn btn-primary">Upload</button>
            </form>
        </div>
    </div>

    {{-- Daftar Dokumen --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="fw-bold mb-3">Daftar Dokumen</h5>

            @if($dokumens->isEmpty())
                <p class="text-muted">Belum ada dokumen di kategori ini.</p>
            @else
                <ul class="list-group">
                    @foreach($dokumens as $dokumen)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $dokumen->nama }}
                            <a href="{{ asset('storage/' . $dokumen->file) }}" target="_blank" class="btn btn-sm btn-outline-primary">Lihat</a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

</div>
@endsection
