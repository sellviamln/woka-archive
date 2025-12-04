@extends('layouts.app')

@section('title', 'Dokumen ' . $kategori->nama)

@section('content')
<section class="section">

    {{-- Pesan sukses --}}
    @if(session('success'))
    <div class="alert alert-success small">{{ session('success') }}</div>
    @endif

    {{-- Judul --}}
    <div class="card shadow-sm">
        <div class="card-header d-flex align-items-center">
            <h4 class="card-title mb-0">
                Dokumen Kategori: <strong>{{ $kategori->nama }}</strong>
            </h4>


            {{-- Tombol tambah di kanan --}}
            <a href="{{ route('staff.dokumen.tambah', $kategori->id) }}" class="btn btn-primary btn-sm ms-auto">
                + Tambah Dokumen
            </a>

            <a href="{{ route('staff.dokumen.index') }}" class="btn btn-secondary btn-sm ms-2">
                &larr; Kembali
            </a>
        </div>


        <div class="card-body">


            {{-- Jika tidak ada dokumen --}}
            @if($dokumens->isEmpty())
            <p class="text-muted">Belum ada dokumen dalam kategori ini.</p>
            @else
            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Tanggal Upload</th>
                            <th>Tanggal Kadaluarsa</th>
                            <th>Tipe</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($dokumens as $dokumen)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $dokumen->judul }}</td>
                            <td>{{ $dokumen->tanggal_upload }}</td>
                            <td>{{ $dokumen->tanggal_kadaluarsa }}</td>

                            <td>{{ strtoupper(pathinfo($dokumen->dokumen, PATHINFO_EXTENSION)) }}</td>

                            <td>
                                <a href="{{ asset('storage/' . $dokumen->dokumen) }}"
                                    target="_blank"
                                    class="btn btn-primary btn-sm">
                                    Lihat
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif

        </div>
    </div>

</section>
@endsection