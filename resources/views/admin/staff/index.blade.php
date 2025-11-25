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
                        <th>Departemen</th>
                        <th>No HP</th>
                        <th>Akses</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($staffs as $staff)
                    <tr>
                        <td class="border p-2">{{ $loop->iteration }}</td>
                        <td class="border p-2">{{ $staff->user->name }}</td>
                        <td class="border p-2">{{ $staff->departemen->nama_departemen }}</td>
                        <td class="border p-2">{{ $staff->no_hp}}</td>
                        <td>
                            <form action="" method="POST" style="display:inline">
                                @csrf
                                @method('PATCH')

                                {{-- Akses: null -> dua-duanya aktif --}}
                                @if($staff->akses === null)
                                <button formaction="{{route('admin.staff.akses.read', $staff->id)}}"
                                    class="btn btn-success btn-sm">
                                    Read
                                </button>

                                <button formaction="{{route('admin.staff.akses.write', $staff->id)}}"
                                    class="btn btn-secondary btn-sm">
                                    Write
                                </button>

                                {{-- Akses: read -> hanya Write aktif --}}
                                @elseif($staff->akses === 'read')
                                <button class="btn btn-success btn-sm" disabled>
                                    Read
                                </button>

                                <button formaction="{{route('admin.staff.akses.write', $staff->id)}}"
                                    class="btn btn-secondary btn-sm">
                                    Write
                                </button>

                                {{-- Akses: write -> hanya Read aktif --}}
                                @elseif($staff->akses === 'write')
                                <button formaction="{{route('admin.staff.akses.read', $staff->id)}}"
                                    class="btn btn-success btn-sm">
                                    Read
                                </button>

                                <button class="btn btn-secondary btn-sm" disabled>
                                    Write
                                </button>
                                @endif

                            </form>
                        </td>

                        <td>
                            <a href="{{ route('admin.staff.edit', $staff->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form class="d-inline" action="{{ route('admin.staff.destroy', $staff->id)}}" method="post" onsubmit="return confirm('Yakin ingin hapus data ini?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
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