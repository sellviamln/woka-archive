@extends('layouts.app')
@section('title', 'Edit Dokumen')
@section('content')

<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Dokumen</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.dokumen.update', $dokumen->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Dokumen</label>
                            <input type="file" name="dokumen" class="form-control" id="dokumen_input">

                            <small class="text-muted d-block mt-1">
                                File saat ini:
                                <a href="{{ Storage::url($dokumen->dokumen) }}" target="_blank" id="current_file_link">
                                    {{ $dokumen->dokumen }}
                                </a>
                            </small>
                        </div>
                        @php
                        $tipe = strtolower(pathinfo($dokumen->dokumen, PATHINFO_EXTENSION));
                        @endphp
                        <div class="form-group">
                            <label>Tipe File</label>
                            <input type="text" id="show_tipe_file" class="form-control" value="{{ strtoupper($tipe) }}" readonly>
                            <input type="hidden" name="tipe_file" id="tipe_file" value="{{ $tipe }}">
                        </div>
                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" name="judul" class="form-control" value="{{ old('judul', $dokumen->judul) }}" required>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Upload</label>
                            <input type="date" name="tanggal_upload" class="form-control" value="{{ old('tanggal_upload', $dokumen->tanggal_upload->format('Y-m-d')) }}">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Kadaluarsa</label>
                            <input type="date" name="tanggal_kadaluarsa" class="form-control" value="{{ old('tanggal_kadaluarsa', $dokumen->tanggal_kadaluarsa->format('Y-m-d')) }}">
                        </div>
                        <div class="form-group">
                            <label>Departemen</label>
                            <select name="departemen_id" class="form-control">
                                <option value="">-- Pilih Departemen --</option>
                                @foreach ($departemens as $departemen)
                                <option value="{{ $departemen->id }}"
                                    {{ old('departemen_id', $dokumen->departemen_id) == $departemen->id ? 'selected' : '' }}>
                                    {{ $departemen->nama_departemen }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kategori</label>
                            <select name="kategori_id" class="form-control">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}"
                                    {{ old('kategori_id', $dokumen->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                @foreach (['active','archive'] as $status)
                                <option value="{{ $status }}"
                                    {{ $dokumen->status == $status ? 'selected' : '' }}>
                                    {{ ucfirst($status) }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" class="form-control">{{ old('deskripsi', $dokumen->deskripsi) }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('admin.dokumen.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<script>
    document.addEventListener("DOMContentLoaded", function() {

        const inputFile = document.getElementById('dokumen_input');

        inputFile.addEventListener('change', function() {

            let file = this.files[0];
            if (!file) return;

            let ext = file.name.split('.').pop().toLowerCase();

            const allowed = ['pdf', 'docx', 'jpg', 'png'];

            if (!allowed.includes(ext)) {
                alert("Format file tidak didukung!");
                this.value = "";
                return;
            }

            document.getElementById('show_tipe_file').value = ext.toUpperCase();
            document.getElementById('tipe_file').value = ext;

            document.getElementById('current_file_link').innerText = file.name;

            let previewURL = URL.createObjectURL(file);
            document.getElementById('current_file_link').href = previewURL;
        });

    });
</script>

@endsection