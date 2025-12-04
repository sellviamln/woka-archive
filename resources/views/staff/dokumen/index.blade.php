@extends('layouts.app')

@section('title', 'Kelola Dokumen')

@section('content')
<div class="container mt-4">

    <h3 class="mb-4">Kelola Dokumen</h3>

    <h5 class="mb-3">Kategori</h5>

    <div class="row g-3">
        @foreach ($kategori as $kat)
        <div class="col-6 col-md-4 col-lg-3">
            <a href="{{ route('staff.dokumen.tampil-dokumen', $kat->slug) }}" class="text-decoration-none text-dark">
                <div class="card shadow-sm p-3 text-center">

                    <img src="https://cdn-icons-png.flaticon.com/512/599/599534.png"
                         width="60"
                         class="mb-3"
                         alt="folder">

                    <h6 class="fw-bold">{{ $kat->nama_kategori }}</h6>
                    <small class="text-muted d-block">
                        {{ $kat->deskripsi ?? '-' }}
                    </small>
                </div>
            </a>
        </div>
        @endforeach
    </div>

</div>
@endsection
