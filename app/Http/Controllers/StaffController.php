<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use App\Models\Dokumen;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    public function index()
    {
        $staffs = Staff::with(['user', 'departemen'])->get();
        return view('admin.staff.index', compact('staffs'));
    }

    public function create()
    {
        $users = User::where('role', 'staff')->get();
        $departemens = Departemen::all();
        return view('admin.staff.create', compact('users', 'departements'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',

            'jabatan' => 'required',
            'departemen_id' => 'required',
            'status' => 'required|in:active,inactive'

        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'staff',
        ]);

        Staff::create([
            'user_id' => $user->id,
            'jabatan' => $request->jabatan,
            'departemen_id' => $request->departemen_id,
            'no_hp' => $request->no_hp,
            'status' => $request->status,

        ]);

        return redirect()->route('admin.staff.index')->with('success', 'Data staff berhasil ditambahkan');
    }

    public function toggleStatus(Dokumen $dokumen)
    {
        $newStatus = $dokumen->status === 'active' ? 'inactive' : 'active';

        $dokumen->update([
            'status' => $newStatus
        ]);

        return back()->with('success', 'Status berhasil diubah!');
    }

    public function edit(Staff $staff)
    {
        $user = Auth::user();

        // siswa hanya bisa edit datanya sendiri
        if ($user->role === 'staff' && $staff->user_id !== $user->id) {
            abort(403, 'Anda tidak memiliki izin untuk mengedit data ini');
        }

        $users = User::where('role', 'staff')->get();
        $departemens = Departemen::all();
        return view('admin.staff.edit', compact('users', 'departemens'));
    }

    public function update(Request $request, Staff $staff)
    {
        $user = User::findOrFail($staff->user_id);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',

            'jabatan' => 'required',
            'departemen_id' => 'required',
            'status' => 'required|in:active,inactive'

        ]);

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $user->password,
        ]);

        $staff->update([
            'user_id' => $user->id,
            'jabatan' => $request->jabatan,
            'departemen_id' => $request->departemen_id,
            'no_hp' => $request->no_hp,
            'status' => $request->status,

        ]);
        return redirect()->route('admin.staff.index')->with('success', 'Data staff berhasil diperbarui');
    }

    public function destroy(Staff $staff)
    {

        $user = User::find($staff->user_id);
        $user->delete();
        $staff->delete();
        return redirect()->route('admin.staff.index')->with('success', 'Data staff berhasil dihapus');
    }
}
