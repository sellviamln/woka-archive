@extends('layouts.app')

@section('title', $kategori->nama)

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>{{ $kategori->nama }}</h3>
        <a href="{{ route('staff.dokumen.index') }}" class="btn btn-sm btn-outline-secondary">Kembali</a>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif


    {{-- Card Upload --}}
    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <h5 class="fw-bold">Upload Dokumen Baru</h5>
            <form action="{{ route('staff.dokumen.upload', $kategori->id) }}"
                method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Upload File --}}
                <div class="form-group mb-3">
                    <label for="dokumen">File Dokumen</label>
                    <input type="file" name="dokumen" id="dokumen" class="form-control" required>
                </div>
                @error('dokumen')
                <div class="text-danger">{{ $message }}</div>
                @enderror

                {{-- Judul --}}
                <div class="form-group mb-3">
                    <label for="judul">Judul Dokumen</label>
                    <input type="text" name="judul" id="judul" class="form-control" required>
                </div>
                @error('judul')
                <div class="text-danger">{{ $message }}</div>
                @enderror

                {{-- Deskripsi --}}
                <div class="form-group mb-3">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" rows="4" class="form-control"></textarea>
                </div>
                @error('deskripsi')
                <div class="text-danger">{{ $message }}</div>
                @enderror

                {{-- Tanggal Upload --}}
                <div class="form-group mb-3">
                    <label for="tanggal_upload">Tanggal Upload</label>
                    <input type="date" name="tanggal_upload" id="tanggal_upload" class="form-control" required>
                </div>
                @error('tanggal_upload')
                <div class="text-danger">{{ $message }}</div>
                @enderror

                {{-- Tanggal Kadaluarsa --}}
                <div class="form-group mb-3">
                    <label for="tanggal_kadaluarsa">Tanggal Kadaluarsa</label>
                    <input type="date" name="tanggal_kadaluarsa" id="tanggal_kadaluarsa" class="form-control" required>
                </div>
                @error('tanggal_kadaluarsa')
                <div class="text-danger">{{ $message }}</div>
                @enderror

                {{-- Hidden kategori --}}
                <input type="hidden" name="kategori_id" value="{{ $kategori->id }}">


                <button type="submit" class="btn btn-primary">Upload Dokumen</button>
            </form>
        </div>
    </div>



</div>
@endsection