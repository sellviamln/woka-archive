@extends('layouts.app')

@section('title', 'Tambah Staff')

@section('content')
<section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambah Staff</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.staff.store')}}" method="post">
                  @csrf 
                  <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">Nama </label>
                            <input type="text" name="name" class="form-control" id="name">
                            @error('name')
                            <div class="text-danger">{{ $message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email </label>
                            <input type="email" name="email" class="form-control" id="email">
                            @error('email')
                            <div class="text-danger">{{ $message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password </label>
                            <input type="password" name="password" class="form-control" id="password">
                            @error('password')
                            <div class="text-danger">{{ $message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jabatan">Jabatan</label>
                            <input type="text" name="jabatan" class="form-control" id="jabatan">
                            @error('jabatan')
                            <div class="text-danger">{{ $message}}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="departemen_id">Departemen </label>
                            <select name="departemen_id" id="departemen_id" class="form-control"class="form-control">
                              <option value="">--Pilih Departemen--</option>
                              @foreach($departemens as $d)
                              <option value="{{$d->id}}">{{ $d->nama_departemen }}</option>
                              @endforeach
                            </select>
                            @error('departemen_id')
                            <div class="text-danger">{{ $message}}</div>
                            @enderror
                        </div>
                          <div class="form-group">
                            <label for="no_hp">No Hp</label>
                            <input type="int" name="no_hp" class="form-control" id="no_hp">
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

