@extends('layouts.app')
@section('title', 'Tambah Dokumen')
@section('content')

<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Tambah Dokumen</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.dokumen.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">

                        <!-- Upload Dokumen -->
                        <div class="form-group">
                            <label for="dokumen">Dokumen</label>
                            <input type="file" name="dokumen" class="form-control" id="dokumen">
                            @error('dokumen')
                                <div class="invalidate-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tipe File Otomatis -->
                        <div class="form-group">
                            <label for="tipe_file">Tipe File</label>
                            <input type="text" name="tipe_file" class="form-control" 
                                   id="tipe_file" value="{{ old('tipe_file') }}" readonly>
                            @error('tipe_file')
                                <div class="invalidate-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" name="judul" class="form-control" id="judul">
                        </div>

                        <div class="form-group">
                            <label for="tanggal_upload">Tanggal Upload</label>
                            <input type="date" name="tanggal_upload" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="tanggal_kadaluarsa">Tanggal Kadaluarsa</label>
                            <input type="date" name="tanggal_kadaluarsa" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="departemen">Departemen</label>
                            <select name="departemen" class="form-control">
                                <option value="">--Pilih--</option>
                                @foreach($departemens as $departemen)
                                <option value="{{ $departemen->id }}">{{ $departemen->nama_departemen }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <select name="kategori" class="form-control">
                                <option value="">--Pilih--</option>
                                @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control">
                                <option value="">--Pilih--</option>
                                <option value="active">Active</option>
                                <option value="archive">Archive</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea name="deskripsi" rows="5" class="form-control"></textarea>
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('admin.dokumen.index') }}" class="btn btn-black">Batal</a>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    // Ambil extension otomatis
    document.getElementById('dokumen').addEventListener('change', function () {
        let file = this.files[0];
        if (file) {
            let ext = file.name.split('.').pop().toLowerCase();
            document.getElementById('tipe_file').value = ext;
        }
    });

});
</script>
@endsection
