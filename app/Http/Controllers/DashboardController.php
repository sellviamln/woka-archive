<?php

namespace App\Http\Controllers;

use App\Models\Aktivitas;
use App\Models\Departemen;
use App\Models\Dokumen;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
   public function index() {
    $user = Auth::user();

    if ($user->role === 'admin') {
        $totalDepartemen = Departemen::count();
        $totalKategori = Kategori::count();
        $totalDokumen = Dokumen::count();
        $totalStaff = User::where('role', 'staff')->count();
        $aktivitas = Aktivitas::with('staff')->get();

        return view('admin.dashboard', compact(
            'user',
            'totalDepartemen',
            'totalKategori',
            'totalDokumen',
            'totalStaff',
            'aktivitas'
        ));
    }

    // Jika role lain, misalnya staff
    return view('staff.dashboard', compact('user'));
}

}
