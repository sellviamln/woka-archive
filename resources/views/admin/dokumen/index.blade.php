@extends('layouts.app')

@section('title', 'Dokumen')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Daftar Dokumen</h4>
            <h5 class="card-title">
                <a href="{{ route('admin.dokumen.create') }}" class="btn btn-primary text-white">+ Tambah</a>
            </h5>
        </div>

        <div class="card-body">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Dokumen</th>
                        <th>Departemen</th>
                        <th>Kategori</th>
                        <th>Judul</th>
                        <th>Tanggal Upload</th>
                        <th>Tanggal Kadaluarsa</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dokumens as $dokumen)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $dokumen->no_dokumen }}</td>
                         <td>{{ $dokumen->departemen->nama_departemen}}</td>
                        <td>{{ $dokumen->kategori->nama_kategori}}</td>
                        <td>{{ $dokumen->judul}}</td>
                        <td>{{ $dokumen->tanggal_upload }}</td>
                        <td>{{ $dokumen->tanggal_kadaluarsa}}</td>
                        <td>
                            <a href="" class="btn btn-info btn-sm">Download</a>
                            <form class="d-inline" action="{{ route('admin.dokumen.destroy', $dokumen->id)}}" method="post" onsubmit="return confirm('yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus </button>
                            </form>

                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailDokumen{{ $dokumen->id }}">
                                Detail
                            </button>
                        </td>
                    </tr>
                    <!-- Modal Detail Dokumen -->
                    <div class="modal fade" id="detailDokumen{{ $dokumen->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Detail Dokumen</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="judul">Tipe File</label>
                                                <input type="file" name="tipe_file" class="form-control" id="tipe_file" value="{{ old('tipe_file', $dokumen->tipe_file) }}">
                                                @error(tipe_file')
                                                <div class="invalidate-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <input type="text" name="status" class="form-control" id="status" value="{{ old('status', $dokumen->status) }}">
                                                @error('status')
                                                <div class="invalidate-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="deskripsi">Deskripsi</label>
                                            <textarea name="deskripsi" id="deskripsi" rows="5" class="form-control">{{ $dokumen->deskripsi }}</textarea>
                                            @error('jam_selesai')
                                            <div class="invalidate-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="dokumen">Dokumen</label><br>
                                        <img src="{{ asset('storage/'. $dokumen->dokumen) }}" alt="Dokumen" width="200">
                                        @error('dokumen')
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
</section>
@endsection