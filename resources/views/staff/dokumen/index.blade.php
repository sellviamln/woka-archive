@extends('layouts.app')

@section('title', 'Kelola Dokumen')

@section('content')
<style>
    .folder-card{
        border: none;
        border-radius: 16px;
        box-shadow: 0 6px 18px rgba(20,24,40,0.06);
        transition: .25s;
        padding: 25px 10px !important;
    }
    .folder-card:hover{
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(20,24,40,0.08);
    }
    .folder-icon{
        width: 70px;
        height: 70px;
        object-fit: contain;
        margin: 0 auto 15px;
        display: block;
    }
    .folder-title{
        font-weight: 700;
        color: #1f2937;
        font-size: 16px;
    }
    .folder-desc{
        font-size: 13px;
        color: #6b7280;
    }
</style>

<div class="container mt-4">

    <h3 class="fw-bold text-primary mb-4">📁 Kelola Dokumen</h3>

    <h5 class="fw-semibold text-secondary mb-3">Kategori Dokumen</h5>

    <div class="row g-3">
        @foreach ($kategori as $kat)
        <div class="col-6 col-md-4 col-lg-3">
            <a href="{{ route('staff.dokumen.tampil-dokumen', $kat->slug) }}" class="text-decoration-none">
                <div class="card folder-card text-center">

                    <img
                        <img src="https://cdn-icons-png.flaticon.com/512/716/716784.png" alt="folder" width="64"
                        class="folder-icon"
                        alt="folder">

                    <h6 class="folder-title">{{ $kat->nama_kategori }}</h6>

                    <small class="folder-desc d-block">
                        {{ $kat->deskripsi ?? '-' }}
                    </small>
                </div>
            </a>
        </div>
        @endforeach
    </div>

</div>
@endsection
