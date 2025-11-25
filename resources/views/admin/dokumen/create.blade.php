@extends('layouts.app')

@section('title', 'Tambah Dokumen')

@section('content')

<section class="section" style="padding-top: 80px;">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Tambah Dokumen</h4>
                </div>

                <div class="card-body">
                    {{-- Form harus menggunakan enctype="multipart/form-data" untuk mengunggah file --}}
                    <form action="{{ route('admin.dokumen.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">

                            {{-- Kolom Kiri: Judul & File --}}
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="judul">Judul Dokumen</label>
                                    <input type="text"
                                        class="form-control @error('judul') is-invalid @enderror"
                                        id="judul"
                                        name="judul"
                                        value="{{ old('judul') }}"
                                        required>
                                    @error('judul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="tipe_file">Pilih File</label>
                                    {{-- **PENTING**: Mengubah name dari 'file' menjadi 'tipe_file' agar sesuai dengan DokumenController --}}
                                    <input type="file"
                                        class="form-control @error('tipe_file') is-invalid @enderror"
                                        id="tipe_file"
                                        name="tipe_file"
                                        required>
                                    @error('tipe_file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Format diizinkan: PDF, DOCX, JPG, JPEG, PNG. Maksimal 10MB.</small>
                                </div>
                            </div>

                            {{-- Kolom Kanan: Tanggal Upload, Kadaluarsa, Status --}}
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="tanggal_upload">Tanggal Upload</label>
                                    <input type="date"
                                        class="form-control @error('tanggal_upload') is-invalid @enderror"
                                        id="tanggal_upload"
                                        name="tanggal_upload"
                                        value="{{ old('tanggal_upload', date('Y-m-d')) }}"
                                        required>
                                    @error('tanggal_upload')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="tanggal_kadaluarsa">Tanggal Kadaluarsa</label>
                                    <input type="date"
                                        class="form-control @error('tanggal_kadaluarsa') is-invalid @enderror"
                                        id="tanggal_kadaluarsa"
                                        name="tanggal_kadaluarsa"
                                        value="{{ old('tanggal_kadaluarsa') }}">
                                    @error('tanggal_kadaluarsa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                        <option value="">Pilih Status</option>
                                        {{-- Nilai value harus 'active' dan 'archive' (huruf kecil) agar sesuai dengan validasi controller --}}
                                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="archive" {{ old('status') == 'archive' ? 'selected' : '' }}>Archive</option>
                                    </select>
                                    @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi (Opsional)</label>
                            {{-- Jika Anda ingin menyimpan deskripsi, pastikan kolom 'deskripsi' ada di tabel/model Dokumen --}}
                            <textarea class="form-control " id="deskripsi" name="deskripsi" rows="4">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="card-action mt-4">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                            <a href="{{ route('admin.dokumen.index') }}" class="btn btn-black"><i class="fas fa-times"></i> Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</section>
@endsection