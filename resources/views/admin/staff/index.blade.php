@extends('layouts.app')

@section('title', 'Staff')
@section('content')
<section class="section">

    @if(session('success'))
        <div class="alert alert-success small">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Daftar Staff</h4>
            <a href="{{ route('admin.staff.create') }}" class="btn btn-warning btn-sm">
                <i class="fas fa-plus"></i> Tambah Staff
            </a>
        </div>

        <div class="card-body">
            <table class="table table-striped align-middle text-center" id="basic-datatables">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Departemen</th>
                        <th>No HP</th>
                        <th>Status</th>
                        <th>Akses</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($staffs as $staff)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="text-start">{{ $staff->user->name }}</td>
                        <td>{{ $staff->departemen->nama_departemen }}</td>
                        <td>{{ $staff->no_hp }}</td>

                        {{-- STATUS --}}
                        <td>
                            <form method="POST" class="d-grid gap-1">
                                @csrf
                                @method('PATCH')

                                @if($staff->status === null)
                                    <button formaction="{{ route('admin.user.status.active', $staff->user_id) }}"
                                        class="btn btn-success btn-sm w-100">Active</button>

                                    <button formaction="{{ route('admin.user.status.inactive', $staff->user_id) }}"
                                        class="btn btn-secondary btn-sm w-100">Inactive</button>

                                @elseif($staff->status === 'active')
                                    <button class="btn btn-success btn-sm w-100" disabled>Active</button>

                                    <button formaction="{{ route('admin.user.status.inactive', $staff->user_id) }}"
                                        class="btn btn-secondary btn-sm w-100">Inactive</button>

                                @elseif($staff->status === 'inactive')
                                    <button formaction="{{ route('admin.user.status.active', $staff->user_id) }}"
                                        class="btn btn-success btn-sm w-100">Active</button>

                                    <button class="btn btn-secondary btn-sm w-100" disabled>Inactive</button>
                                @endif
                            </form>
                        </td>

                        {{-- AKSES --}}
                        <td>
                            <form method="POST" class="d-grid gap-1">
                                @csrf
                                @method('PATCH')

                                @if($staff->akses === null)
                                    <button formaction="{{ route('admin.staff.akses.read', $staff->id) }}"
                                        class="btn btn-success btn-sm w-100">Read</button>

                                    <button formaction="{{ route('admin.staff.akses.write', $staff->id) }}"
                                        class="btn btn-secondary btn-sm w-100">Write</button>

                                @elseif($staff->akses === 'read')
                                    <button class="btn btn-success btn-sm w-100" disabled>Read</button>

                                    <button formaction="{{ route('admin.staff.akses.write', $staff->id) }}"
                                        class="btn btn-secondary btn-sm w-100">Write</button>

                                @elseif($staff->akses === 'write')
                                    <button formaction="{{ route('admin.staff.akses.read', $staff->id) }}"
                                        class="btn btn-success btn-sm w-100">Read</button>

                                    <button class="btn btn-secondary btn-sm w-100" disabled>Write</button>
                                @endif
                            </form>
                        </td>

                        {{-- ACTION --}}
                        <td>
                            <div class="d-grid gap-1">
                                <a href="{{ route('admin.staff.edit', $staff->id) }}"
                                    class="btn btn-warning btn-sm w-100">Edit</a>

                                <form action="{{ route('admin.staff.destroy', $staff->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm w-100">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</section>
@endsection
