@extends('layouts.app')

@section('title', 'Profil Staff')

@section('content')
<section class="section">

    {{-- Alert sukses --}}
    @if (session('success'))
        <div id="alert-success"
            class="alert alert-success alert-dismissible fade show shadow-sm border-0 rounded-3 px-4 py-3 mt-2 small"
            role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        </div>

        <script>
            setTimeout(() => {
                const alert = document.getElementById('alert-success');
                if (alert) {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }
            }, 3000);
        </script>
    @endif

    {{-- Alert error --}}
    @if ($errors->any())
        <div id="alert-danger"
            class="alert alert-danger alert-dismissible fade show shadow-sm border-0 rounded-3 px-4 py-3 mt-2 small"
            role="alert">
            <i class="bi bi-x-circle-fill me-2"></i>{{ $errors->first() }}
        </div>

        <script>
            setTimeout(() => {
                const alert = document.getElementById('alert-danger');
                if (alert) {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }
            }, 3000);
        </script>
    @endif

    {{-- Card Profil --}}
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-header border-0 py-3 px-4 d-flex align-items-center justify-content-between"
            style="background-color: var(--bs-primary);">
            <h5 class="mb-0 fw-semibold text-white">
                <i class="bi bi-person-badge-fill me-2 text-white"></i> Profil Staff
            </h5>
        </div>

        <form action="{{ route('staff.profile.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card-body px-4 py-4">
                <div class="row g-4 align-items-start">

                    {{-- FOTO --}}
                    <div class="col-lg-4 text-center">
                        <div class="p-3 border-0 shadow-sm rounded-4"
                            style="background-color: var(--bs-body-bg); color: var(--bs-body-color);">

                            <div class="mb-3 position-relative d-inline-block">
                                @if ($staff->foto)
                                    <img src="{{ asset('storage/' . $staff->foto) }}" alt="Foto Profil"
                                        class="img-fluid rounded-circle shadow-sm border border-3 border-primary-subtle"
                                        style="width: 150px; height: 150px; object-fit: cover;">
                                @else
                                    <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto shadow-sm"
                                        style="width: 150px; height: 150px; background-color: var(--bs-secondary-bg);">
                                        <i class="bi bi-person-fill fs-1" style="color: var(--bs-secondary-color);"></i>
                                    </div>
                                @endif

                                {{-- Tombol kamera --}}
                                <label for="uploadFoto"
                                    class="position-absolute d-flex align-items-center justify-content-center
                                        bg-primary text-white rounded-circle shadow"
                                    style="
                                        width: 32px;
                                        height: 32px;
                                        cursor: pointer;
                                        bottom: -10px;
                                        left: 50%;
                                        transform: translateX(-50%);
                                        border: 2px solid white;
                                    ">
                                    <i class="bi bi-camera-fill fs-6"></i>
                                </label>
                            </div>

                            <h6 class="fw-semibold mb-1">{{ $staff->user->name ?? '-' }}</h6>
                            <p class="small mb-0">{{ $staff->user->email ?? '-' }}</p>
                            <hr class="my-3 opacity-50">

                            <div class="small text-muted text-start ps-3">
                                <div class="mb-1"><strong>Departemen :</strong> {{ $staff->departemen->nama_departemen }}</div>
                                <div class="mb-1"><strong>No Hp :</strong> {{ $staff->no_hp }}</div>
                                <div class="mb-1"><strong>Status :</strong> {{ ucfirst($staff->user->status ?? '-') }}</div>
                                <div class="mb-1"><strong>Akses :</strong> {{ $staff->akses ?? '-' }}</div>
                            </div>

                        </div>
                    </div>

                    {{-- INFORMASI PRIBADI --}}
                    <div class="col-lg-8">
                        <div class="shadow-sm rounded-4 p-4"
                            style="background-color: var(--bs-body-bg); color: var(--bs-body-color);">

                            <h6 class="fw-semibold mb-3 text-primary d-flex align-items-center">
                                <i class="bi bi-info-circle me-2"></i> Informasi Pribadi
                            </h6>

                            <div class="row g-3">

                                <div class="col-md-6">
                                    <label class="form-label small text-muted mb-1">Nama Lengkap</label>
                                    <input type="text" name="name" class="form-control bg-transparent border shadow-sm rounded-3 py-2"
                                        value="{{ $staff->user->name }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label small text-muted mb-1">Email</label>
                                    <input type="email" name="email" class="form-control bg-transparent border shadow-sm rounded-3 py-2"
                                        value="{{ $staff->user->email }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label small text-muted mb-1">Password</label>
                                    <input type="password" name="password" class="form-control bg-transparent border shadow-sm rounded-3 py-2">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label small text-muted mb-1">No Hp</label>
                                    <input type="text" name="no_hp" class="form-control bg-transparent border shadow-sm rounded-3 py-2"
                                        value="{{ $staff->no_hp }}">
                                </div>

                                {{-- upload foto --}}
                                <input type="file" id="uploadFoto" name="foto" class="d-none" accept="image/*"
                                    onchange="this.form.submit()">

                                <div class="col-md-6">
                                    <label class="form-label small text-muted mb-1">Departemen</label>
                                    <div class="form-control bg-transparent border shadow-sm rounded-3 py-2">
                                        {{ $staff->departemen->nama_departemen }}
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <div class="card-footer text-end py-3 px-4 border-0">
                <button type="submit" class="btn btn-warning fw-semibold shadow-sm px-4">
                    <i class="bi bi-pencil-square me-1"></i> Simpan Perubahan
                </button>
            </div>

        </form>
    </div>

</section>
@endsection
