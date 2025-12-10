@extends('layouts.app')

@section('title', 'Edit Departemen')

@section('content')
<section class="section" style="padding-top: 80px;">
    <div class="row">
        <div class="col-md-8 mx-auto">

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Edit Departemen</h4>
                    <a href="{{ route('admin.departemen.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.departemen.update', $departeman->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="nama_departemen" class="form-label">Nama Departemen</label>
                            <input type="text" name="nama_departemen" id="nama_departemen"
                                class="form-control @error('nama_departemen') is-invalid @enderror"
                                value="{{ old('nama_departemen', $departeman->nama_departemen) }}" required autofocus>

                            @error('nama_departemen')
                            <div class="invalid-feedback small">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fas fa-save"></i> Update Data
                        </button>

                    </form>
                </div>

            </div>

        </div>
    </div>
</section>
@endsection