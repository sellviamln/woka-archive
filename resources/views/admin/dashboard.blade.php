@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold">Dashboard Admin</h3>
            <p class="text-muted">Sistem Arsip Dokumen — Woka Archive</p>
        </div>
        <div>
            <a href="{{ route('login')}}" class="btn btn-primary btn-sm">Logout</a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body d-flex align-items-center">
                    <div class="flex-shrink-0 me-3">
                        <i class="fas fa-folder fa-2x text-primary"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-0">Total Dokumen</p>
                        <h4 class="fw-bold">{{ $totalDokumen  }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body d-flex align-items-center">
                    <div class="flex-shrink-0 me-3">
                        <i class="fas fa-layer-group fa-2x text-success"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-0">Kategori</p>
                        <h4 class="fw-bold">{{ $totalKategori  }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body d-flex align-items-center">
                    <div class="flex-shrink-0 me-3">
                        <i class="fas fa-building fa-2x text-info"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-0">Departemen</p>
                        <h4 class="fw-bold">{{ $totalDepartemen  }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body d-flex align-items-center">
                    <div class="flex-shrink-0 me-3">
                        <i class="fas fa-users fa-2x text-warning"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-0">Staff Pengelola</p>
                        <h4 class="fw-bold">{{ $totalStaff  }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabel Aktivitas Mulai --}}
    <div class="card mt-5 shadow-sm border-0 rounded-3">
        <div class="card-header bg-white">
            <h5 class="fw-bold mb-0">History</h5>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover table-striped mb-0">
                <thead>
                    <tr>
                        <th>Staff</th>
                        <th>Aktivitas</th>
                        <th class="text-end">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($aktivitas ?? [] as $a)
                    <tr>
                        <td>{{ $a->user->name }}</td>
                        <td>{{ $a->keterangan }}</td>
                        <td class="text-end">{{ $a->created_at->format('d M Y H:i') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted py-3">Belum ada aktivitas.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    {{-- Tabel Aktivitas End --}}

</div>
@endsection
