@extends('layouts.app')

@section('title', $kategori->nama)

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-primary">{{ $kategori->nama }}</h3>
        <a href="{{ route('staff.dokumen.index') }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">
            Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger shadow-sm">
            <strong>Perhatikan beberapa kesalahan berikut:</strong>
            <ul class="mt-2 mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

   

       
    <!-- Card Upload (Improved UI) -->
    <div class="card shadow-lg border-0 rounded-4 mb-5">
        <div class="card-header bg-primary text-white py-3 rounded-top-4 d-flex align-items-center">
    <img src="https://cdn-icons-png.flaticon.com/512/716/716784.png" width="45" class="me-3" alt="folder-icon">
            <h5 class="fw-bold mb-0"><i class="bi bi-upload me-2"></i>Upload Dokumen Baru</h5>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('staff.dokumen.upload', $kategori->id) }}" method="POST" enctype="multipart/form-data" class="row g-3">
                @csrf

                <!-- File Upload -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">File Dokumen</label>
                    <div class="input-group input-group-lg">
                        <span class="input-group-text bg-light"><i class="bi bi-file-earmark"></i></span>
                        <input type="file" name="dokumen" class="form-control" required>
                    </div>
                </div>

                <!-- Judul -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Judul Dokumen</label>
                    <input type="text" name="judul" class="form-control form-control-lg" placeholder="Masukkan judul..." required>
                </div>

                <!-- Deskripsi -->
                <div class="col-12">
                    <label class="form-label fw-semibold">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="3" placeholder="Tambahkan deskripsi dokumen..."></textarea>
                </div>

                <!-- Tanggal Upload -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Tanggal Upload</label>
                    <input type="date" name="tanggal_upload" class="form-control form-control-lg" required>
                </div>

                <!-- Tanggal Kadaluarsa -->
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Tanggal Kadaluarsa</label>
                    <input type="date" name="tanggal_kadaluarsa" class="form-control form-control-lg" required>
                </div>

                <!-- Button -->
                <div class="col-12 text-end mt-3">
                    <button type="submit" class="btn btn-primary btn-lg px-4">
                        <i class="bi bi-cloud-arrow-up me-1"></i> Upload Dokumen
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
