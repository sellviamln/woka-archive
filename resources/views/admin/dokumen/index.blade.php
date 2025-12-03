@extends('layouts.app')

@section('title', 'Dokumen')

@section('content')
<section class="section">
    @if(session('success'))
    <div class="alert alert-success small">{{ session('success')}}</div>
    @endif
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Daftar Dokumen</h4>
            <h5 class="card-title">
                <a href="{{ route('admin.dokumen.create') }}" class="btn btn-primary text-white">+ Tambah</a>
            </h5>
        </div>

        <div class="card-body">
            <table class="table table-striped" id="basic-datatables">
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
                            <div class="d-flex flex-wrap gap-2">
                                <a href="{{ route('admin.dokumen.edit', $dokumen->id) }}" class="btn btn-warning btn-sm" title="Edit Dokumen">
                                    Edit
                                </a>
                                <form action="{{ route('admin.dokumen.destroy', $dokumen->id) }}" method="POST" class="d-inline m-0"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus dokumen: {{ $dokumen->judul }}? Aksi ini tidak dapat dibatalkan.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Hapus Dokumen">
                                        Hapus
                                    </button>
                                </form>
                                <button type="button" class="btn btn-info btn-sm" title="Lihat Detail Dokumen"
                                    data-bs-toggle="modal"
                                    data-bs-target="#detailDokumen{{ $dokumen->id }}">
                                    Detail
                                </button>
                            </div>
                        </td>
                    </tr>
                    <div class="modal fade" id="detailDokumen{{ $dokumen->id }}" tabindex="-1" aria-labelledby="detailDokumenLabel{{ $dokumen->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="detailDokumenLabel{{ $dokumen->id }}">Detail Dokumen</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Tipe File</label>
                                        <input type="text" class="form-control"
                                            value="{{ pathinfo($dokumen->dokumen, PATHINFO_EXTENSION) }}"
                                            readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <input type="text" class="form-control"
                                            value="{{ $dokumen->status }}"
                                            readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Deskripsi</label>
                                        <textarea class="form-control" rows="5" readonly>{{ $dokumen->deskripsi }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Dokumen</label>
                                        <div class="border rounded p-2 text-center">
                                            <img src="{{ asset('storage/'. $dokumen->dokumen) }}"
                                                alt="Dokumen"
                                                class="img-fluid"
                                                style="max-height: 250px; object-fit: contain;">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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