@extends('layouts.app')

@section('title', 'Kelola Dokumen')

@section('content')
<div class="container mt-4">

    <h3 class="mb-4">Kelola Dokumen</h3>

    <h5 class="mb-3">Kategori</h5>

    <div class="row g-3">
        @foreach ($dokumen as $kat)
        <div class="col-6 col-md-4 col-lg-3">
            <a href="{{ route('staff.dokumen.show', $kat->id) }}" class="text-decoration-none text-dark">
                <div class="card shadow-sm p-3 text-center">

                    <img
                        src="https://cdn-icons-png.flaticon.com/512/599/599534.png"
                        srcset="https://cdn-icons-png.flaticon.com/512/599/599534.png 1x, https://cdn-icons-png.flaticon.com/1024/599/599534.png 2x"
                        alt="folder"
                        width="64">


                    <h6 class="fw-bold">{{ $kat->nama }}</h6>
                    <small class="text-muted d-block">
                        {{ $kat->keterangan ?? '-' }}
                    </small>
                </div>
            </a>
        </div>
        @endforeach
    </div>

</div>
@endsection