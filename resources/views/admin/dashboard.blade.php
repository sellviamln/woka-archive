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
                            <h4 class="fw-bold">{{ $totalDokumen  ?? 0}}</h4>
                            <p class="mb-0">
                                <span class="text-succes text-sm font-weight-bolder"></span><a href="{{route('admin.dokumen.index')}}">Lihat Dokumen</a>
                            </p>
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
                            <h4 class="fw-bold">{{ $totalKategori ?? 0 }}</h4>
                            <p class="mb-0">
                                <span class="text-succes text-sm font-weight-bolder"></span><a href="{{route('admin.kategori.index')}}">Lihat Kategori</a>
                            </p>
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
                            <h4 class="fw-bold">{{ $totalDepartemen ??0 }}</h4>
                            <p class="mb-0">
                                <span class="text-succes text-sm font-weight-bolder"></span><a href="{{route('admin.departemen.index')}}">Lihat Departemen</a>
                            </p>
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
                            <h4 class="fw-bold">{{ $totalStaff ??0 }}</h4>
                            <p class="mb-0">
                                <span class="text-succes text-sm font-weight-bolder"></span><a href="{{route('admin.staff.index')}}">Lihat Staff</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabel Aktivitas Mulai --}}
        <div class="card mt-5 shadow-sm border-0 rounded-3">
            <div class="card-header bg-white">
                <h5 class="fw-bold mb-0">Aktivitas</h5>
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
                        @forelse($aktivitas as $a)
                        <tr>
                            <td>{{ $a->user->name }}</td>
                            <td>{{ $a->departemen->nama_departemen }}</td>
                            <td><span class="badge bg-info">
                                    {{ strtoupper($a->aktivitas) }}
                                </span>
                            </td>
                            <td>{{ $a->keterangan }}</td>
                            <td>
                                <button type="button"
                                    class="btn btn-info btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#detailAktivitas{{ $a->id }}">
                                    Detail
                                </button>
                            </td>
                        </tr>

                        <!-- MODAL DETAIL -->
                        <div class="modal fade" id="detailAktivitas{{ $a->id }}" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title">Detail Aktivitas</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">

                                        <div class="mb-3">
                                            <label class="form-label">Staff</label>
                                            <input type="text" class="form-control" value="{{ $a->user->name }}" disabled>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Departemen</label>
                                            <input type="text" class="form-control" value="{{ $a->departemen->nama_departemen }}" disabled>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Aktivitas</label>
                                            <input type="text" class="form-control" value="{{ ucfirst($a->aktivitas) }}" disabled>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Keterangan</label>
                                            <textarea class="form-control" rows="3" disabled>{{ $a->keterangan }}</textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Waktu Aktivitas</label>
                                            <input type="text" class="form-control"
                                                value="{{ optional($a->created_at)->format('d-m-Y H:i') }}"
                                                disabled>
                                        </div>

                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            Close
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- END MODAL -->

                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-3">
                                Belum ada aktivitas.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
        {{-- Tabel Aktivitas End --}}

    </div>
    @endsection