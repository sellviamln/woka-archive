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
        return view('admin.staff.create', compact('users', 'departemens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'departemen_id' => 'required',


        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'staff',
        ]);

        Staff::create([
            'user_id' => $user->id,
            'departemen_id' => $request->departemen_id,
            'no_hp' => $request->no_hp,

        ]);

        return redirect()->route('admin.staff.index')->with('success', 'Data staff berhasil ditambahkan');
    }

    public function edit(Staff $staff)
    {
        $user = Auth::user();

        // siswa hanya bisa edit datanya sendiri
        if ($user->role === 'staff' && $staff->user_id !== $user->id) {
            abort(403, 'Anda tidak memiliki izin untuk mengedit data ini');
        }

        $departemens = Departemen::all();
        return view('admin.staff.edit', compact('staff', 'departemens'));
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

    // Set akses menjadi read
    public function setRead($id)
    {
        $staff = Staff::findOrFail($id);
        $staff->akses = 'read';
        $staff->save();

        return back()->with('success', 'Akses diubah menjadi READ');
    }

    // Set akses menjadi write
    public function setWrite($id)
    {
        $staff = Staff::findOrFail($id);
        $staff->akses = 'write';
        $staff->save();

        return back()->with('success', 'Akses diubah menjadi WRITE');
    }
}
