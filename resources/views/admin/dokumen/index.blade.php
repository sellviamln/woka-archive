@extends('layouts.app')

@section('title', 'Dokumen')

@section('content')
<section class="section" style="padding-top: 80px;">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Daftar Dokumen</h4>
                    <a href="{{ route('admin.dokumen.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> + Tambah Dokumen
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover no-wrap-header">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Tipe File</th>
                                    <th>Tanggal Upload</th>
                                    <th>Tanggal Kadaluarsa</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dokumens as $dokumen)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $dokumen->judul }}</td>
                                    <td>{{ $dokumen->tipe_file }}</td>
                                    <td>{{ $dokumen->tanggal_upload }}</td>
                                    <td>{{ $dokumen->tanggal_kadaluarsa }}</td>
                                    <td>{{ $dokumen->status }}</td>

                                    <td>
                                        <a href="#" class="btn btn-primary btn-sm">Download</a>
                                        <form class="d-inline" action="{{ route('admin.dokumen.destroy', $dokumen->id) }}" method="post" onsubmit="return confirm('yakin ingin menghapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailKegiatan{{ $kegiatan->id }}">
                                            Detail
                                        </button>
                                    </td>
                                </tr>
                                <!-- MODAL DETAIL -->
                                <div class="modal fade" id="detailKegiatan{{ $kegiatan->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Detail Dokumen</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body"> <!-- Modal body ini di ambil dari edit yang untuk menampilkan -->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="tanggal_upload">Judul</label>
                                                            <input type="text" name="judul" class="form-control" id="judul" value="{{ old('judul', $dokumen->judul) }}">
                                                            @error('judul')
                                                            <div class="invalidate-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="tanggal_upload">Tipe File</label>
                                                            <input type="file" name="tipe_file" class="form-control" id="tipe_file" value="{{ old('file', $dokumen->file) }}">
                                                            @error('judul')
                                                            <div class="invalidate-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="tanggal_upload">Tanggal Upload</label>
                                                            <input type="date" name="tanggal_upload" class="form-control" id="tanggal_upload" value="{{ old('tanggal_upload', $dokumen->tanggal_upload) }}">
                                                            @error('tanggal_upload')
                                                            <div class="invalidate-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="tanggal_upload">Tanggal Kadaluarsa</label>
                                                            <input type="date" name="tanggal_kadaluarsa" class="form-control" id="tanggal_kadaluarsa" value="{{ old('tanggal_kadaluarsa', $kegiatan->tanggal_kadaluarsa) }}">
                                                            @error('tanggal_kadaluarsa')
                                                            <div class="invalidate-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="status">Status</label>
                                                            <input type="text" name="status" class="form-control" id="status" value="{{ old('status', $dokumen->status) }}" >
                                                            @error('status')
                                                            <div class="invalidate-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="jam_selesai">Deskripsi</label>
                                                            <input type="text" name="deskripsi" class="form-control" id="deskripsi" value="{{ old('deskripsi', $dokumen->deskripsi) }}" >
                                                            @error('jam_selesai')
                                                            <div class="invalidate-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="file">File</label><br>
                                                    <img src="{{ asset('storage/'. $dokumen->file) }}" alt="file" width="200">
                                                    @error('file')
                                                    <div class="invalidate-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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