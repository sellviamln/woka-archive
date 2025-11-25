@extends('layouts.app')

@section('title', 'Staff')
@section('content')
<section class="section">

    @if(session('success'))
    <div class="alert alert-success small">{{session('success')}}</div>
    @endif

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">
                <a href="{{route('admin.staff.create')}}" class="btn btn-primary">Tambah +</a>
            </h5>
        </div>

        <div class="card-body">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Departemen</th>
                        <th>No HP</th>
                        <th>Status</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($staffs as $staff)
                    <tr>
                        <td class="border p-2">{{ $loop->iteration }}</td>
                        <td class="border p-2">{{ $staff->user->name }}</td>
                        <td class="border p-2">{{ $staff->jabatan }}</td>
                        <td class="border p-2">{{ $staff->departemen }}</td>
                        <td class="border p-2">{{ $staff->no_hp}}</td>
                        <form action="{{ route('admin.dokumen.toggle-status', $dokumen->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('PATCH')

                            @if($dokumen->status === 'active')
                            <button class="btn btn-success btn-sm">Active</button>
                            @else
                            <button class="btn btn-secondary btn-sm">Inactive</button>
                            @endif
                        </form>
                        <td>
                            <a href="{{ route('admin.staff.edit', $staff->id) }}" class="btn btn-warning btn-sm">Active</a>
                            <form class="d-inline" action="{{ route('admin.staff.destroy', $staff->id)}}" method="post" onsubmit="return confirm('Yakin ingin hapus data ini?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger btn-sm">Inactive</button>
                            </form>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</section>
@endsection