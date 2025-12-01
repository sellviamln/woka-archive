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

                        <div class="form-group">
                            <label for="dokumen">Dokumen</label>
                            <input type="file" name="dokumen" class="form-control" id="dokumen">
                        </div>

                        <div class="form-group">
                            <label for="tipe_file">Tipe File</label>
                            <input type="text" name="tipe_file" class="form-control" id="tipe_file" readonly>
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
                            <label for="departemen_id">Departemen</label>
                            <select name="departemen_id" class="form-control">
                                <option value="">--Pilih--</option>
                                @foreach($departemens as $departemen)
                                <option value="{{ $departemen->id }}">{{ $departemen->nama_departemen }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="kategori_id">Kategori</label>
                            <select name="kategori_id" class="form-control">
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

<script>
document.addEventListener('DOMContentLoaded', function () {

    const fileInput = document.getElementById('dokumen');
    const tipeFileInput = document.getElementById('tipe_file');

    fileInput.addEventListener('change', function () {
        if (this.files.length > 0) {

            let fileName = this.files[0].name;

            // ambil ekstensi
            let ext = fileName.split('.').pop().toLowerCase();

            // tampilkan di input tipe file
            tipeFileInput.value = ext;
        }
    });

});
</script>

@endsection
