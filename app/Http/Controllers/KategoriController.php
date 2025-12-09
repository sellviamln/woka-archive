<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        return view('admin.kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|max:150|unique:kategori,nama_kategori',
            'deskripsi'     => 'nullable',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.unique'   => 'Nama kategori sudah ada, silakan gunakan nama lain.',
        ]);

        $slug = Str::slug($request->nama_kategori);
        $originalSlug = $slug;
        $count = 1;

        while (Kategori::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
            'slug'          => $slug,
            'deskripsi'     => $request->deskripsi
        ]);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }


    public function edit($kategori)
    {
        $kategori = Kategori::findOrFail($kategori);
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $kategori)
    {
        $request->validate([
            'nama_kategori' => 'required|max:150',
            'deskripsi'     => 'nullable',
        ]);

        $kategori = Kategori::findOrFail($kategori);

        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
            'slug'          => Str::slug($request->nama_kategori),
            'deskripsi'     => $request->deskripsi,
        ]);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy($kategori)
    {
        $kategori = Kategori::findOrFail($kategori);
        $kategori->delete();

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
