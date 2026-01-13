@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold">Dashboard Woka</h3>
        <p class="text-muted">Sistem Arsip Dokumen — Woka Archive</p>
    </div>
    <div>

    </div>
</div>

<div class="row g-4">
    <div class="col-md-6">
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body d-flex align-items-center">
                <div class="flex-shrink-0 me-3">
                    <i class="fas fa-folder fa-2x text-primary"></i>
                </div>
                <div>
                    <p class="text-muted mb-0">Total Dokumen</p>
                    <h4 class="fw-bold">{{$totalDokumen ?? 0}}</h4>
                    <p class="mb-0">
                        <span class="text-succes text-sm font-weight-bolder"></span><a href="{{route('staff.dokumen.index')}}">Lihat Dokumen</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body d-flex align-items-center">
                <div class="flex-shrink-0 me-3">
                    <i class="fas fa-layer-group fa-2x text-success"></i>
                </div>
                 <div>
                    <p class="text-muted mb-0">Total Kategori</p>
                    <h4 class="fw-bold">{{$totalKategori ?? 0}}</h4>
                    
                </div>
            </div>
        </div>
    </div>



    {{-- Tabel Aktivitas Mulai --}}
    <div class="card mt-5 shadow-sm border-0 rounded-3">
        <div class="card-header bg-white">
            <h5 class="fw-bold mb-0">Aktivitas Departemen</h5>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover table-striped mb-0">
                <thead>
                    <tr>
                        <th>Staff</th>
                        <th>Departemen</th>
                        <th>Aktivitas</th>
                        <th>Keterangan</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    @forelse($aktivitas ?? [] as $a)
                    <tr>
                        <td>{{ $a->user->name }}</td>
                        <td>{{ $a->departemen->nama_departemen }}</td>
                        <td>{{ ucfirst($a->aktivitas) }}</td>
                        <td>{{ $a->keterangan }}</td>
                        <td><button type="button"
                                class="btn btn-info btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#detailAktivitas{{ $a->id }}">
                                Detail
                            </button></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-3">Belum ada aktivitas.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    {{-- Tabel Aktivitas End --}}

</div>
@endsection