<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use App\Models\Dokumen;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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

            'no_hp' => 'required',
            'departemen_id' => 'required',
            'status' => 'required|in:read,write'

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
     public function setActive($id)
    {
        $staff = User::findOrFail($id);
        $staff->status = 'active';
        $staff->save();

        return back()->with('success', 'status diubah menjadi ACTIVE');
    }

    // Set akses menjadi write
    public function setInactive($id)
    {
        $staff = User::findOrFail($id);
        $staff->status = 'inactive';
        $staff->save();

        return back()->with('success', 'Status diubah menjadi Inactive');
    }

    public function profile()
    {
        $staff = Staff::where('user_id', Auth::user()->id)->first();
        return view('staff.profile.index', compact('staff'));
    }



    public function profileUpdate(Request $request)
    {
        $user = Auth::user();
        $staff = $user->staff;

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8',

            'no_hp' => 'required ',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg',
        ]);

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Update tabel users
        $dataUser = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $user->password,
        ];

        // Update tabel staff
        $dataStaff = [
            'no_hp' => $request->no_hp,
        ];

        if ($request->hasFile('foto')) {
            if ($staff->foto && Storage::disk('public')->exists($staff->foto)) {
                Storage::disk('public')->delete($staff->foto);
            }
            $dataStaff['foto'] = $request->file('foto')->store('profile', 'public');
        }

        $user->update($dataUser);

        $staff->update($dataStaff);

        return redirect()->route('staff.profile')->with('success', 'Profil berhasil diperbarui.');
    }

    
}
