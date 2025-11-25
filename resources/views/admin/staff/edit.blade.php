@extends('layouts.app')

@section('title', 'Edit Staff')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Staff</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.staff.update', $staff->id)}}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $staff->user->name) }}">
                            @error('name')
                            <div class="text-danger">{{ $message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" id="email" value="{{ old('email', $staff->user->email) }}">
                            @error('email')
                            <div class="text-danger">{{ $message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password">
                            @error('password')
                            <div class="text-danger">{{ $message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jabatan">Jabatan</label>
                            <input type="text" name="jabatan" class="form-control" id="jabatan" value="{{ old('jabatan', $staff->jabatan) }}">
                            @error('jabatan')
                            <div class="text-danger">{{ $message}}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="departemen_id">Departemen </label>
                            <select name="departemen_id" id="departemen_id" class="form-control" class="form-control">
                                <option value="">--Pilih Departemen--</option>
                                @foreach($kelas as $k)
                                <option value="{{$k->id}}" {{ old('departemen_id', $staff->departemen_id) == $d->id ? 'selected' : ''}}>{{ $d->nama_departemen }}</option>
                                @endforeach
                            </select>
                            @error('departemen_id')
                            <div class="text-danger">{{ $message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="no_hp">No Hp</label>
                            <input type="int" name="no_hp" class="form-control" id="no_hp" value="{{ old('no_hp', $siswa->no_hp) }}">
                            @error('no_hp')
                            <div class="text-danger">{{ $message}}</div>
                            @enderror
                        </div>
                        

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('admin.staff.index')}}" class="btn btn-secondary">Kembali</a>

                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection