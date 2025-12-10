<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\Departemen;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DokumenController extends Controller
{

    public function index()
    {
        $dokumens = Dokumen::orderBy('created_at', 'DESC')->get();
        return view('admin.dokumen.index', compact('dokumens'));
    }

    public function create()
    {
        $departemens = Departemen::all();
        $kategoris   = Kategori::all();

        return view('admin.dokumen.create', compact('departemens', 'kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'              => 'required',
            'departemen_id'      => 'required',
            'kategori_id'        => 'required',
            'tanggal_upload'     => 'required|date',
            'tanggal_kadaluarsa' => 'required|date',
            'status'             => 'required',
            'tipe_file'          => 'required',
            'deskripsi'          => 'nullable',
            'dokumen'            => 'required|file|max:50000|mimes:docx,jpg,jpeg,png,pdf',
        ]);


        $filePath = $request->file('dokumen')->store('dokumen', 'public');


        Dokumen::create([
            'no_dokumen'         => 'DOC-' . time(),
            'departemen_id'      => $request->departemen_id,
            'kategori_id'        => $request->kategori_id,
            'judul'              => $request->judul,
            'tanggal_upload'     => $request->tanggal_upload,
            'tanggal_kadaluarsa' => $request->tanggal_kadaluarsa,
            'status'             => $request->status,
            'tipe_file'          => $request->tipe_file,
            'deskripsi'          => $request->deskripsi,
            'dokumen'            => $filePath,
            'uploaded_by'        => Auth::id(),
        ]);

        return redirect()->route('admin.dokumen.index')
            ->with('success', 'Dokumen berhasil ditambahkan.');
    }

    public function edit(Dokumen $dokumen)
    {
        $departemens = Departemen::all();
        $kategoris   = Kategori::all();

        return view('admin.dokumen.edit', compact('dokumen', 'departemens', 'kategoris'));
    }

    public function update(Request $request, Dokumen $dokumen)
    {
        $validated = $request->validate([
            'judul' => 'required|string',
            'tanggal_upload' => 'required|date',
            'tanggal_kadaluarsa' => 'required|date',
            'departemen_id' => 'required|integer',
            'kategori_id' => 'required|integer',
            'status' => 'required|string',
            'deskripsi' => 'nullable|string',
            'tipe_file' => 'required|string',
            'dokumen' => 'required|file|mimes:pdf,docx,jpg,png|max:50000',
        ]);

        if ($request->hasFile('dokumen')) {

            if ($dokumen->dokumen && Storage::disk('public')->exists($dokumen->dokumen)) {
                Storage::disk('public')->delete($dokumen->dokumen);
            }

            $path = $request->file('dokumen')->store('dokumen', 'public');

            $dokumen->dokumen = $path;
            $dokumen->tipe_file = strtolower($validated['tipe_file']);
        }

        $dokumen->update([
            'judul' => $validated['judul'],
            'tanggal_upload' => $validated['tanggal_upload'],
            'tanggal_kadaluarsa' => $validated['tanggal_kadaluarsa'],
            'departemen_id' => $validated['departemen_id'],
            'kategori_id' => $validated['kategori_id'],
            'status' => $validated['status'],
            'deskripsi' => $validated['deskripsi'],
        ]);

        return redirect()->route('admin.dokumen.index')
            ->with('success', 'Dokumen berhasil diperbarui.');
    }

    public function destroy(Dokumen $dokumen)
    {
        if ($dokumen->dokumen && Storage::disk('public')->exists($dokumen->dokumen)) {
            Storage::disk('public')->delete($dokumen->dokumen);
        }

        $dokumen->delete();

        return redirect()->route('admin.dokumen.index')
            ->with('success', 'Dokumen berhasil dihapus.');
    }

    public function Dokumen()
    {
        $kategori = Kategori::all();
        return view('staff.dokumen.index', compact('kategori'));
    }

    public function tampil($slug)
    {
        $kategori = Kategori::where('slug', $slug)->firstOrFail();
        $user = Auth::user(); // ambil user yang login

        // Ambil dokumen berdasarkan kategori dan departemen user
        $dokumens = Dokumen::where('kategori_id', $kategori->id)
            ->when($user->role !== 'admin', function ($query) use ($user) {
                // kalau bukan admin, batasi sesuai departemen
                $query->where('departemen_id', $user->staff->departemen_id);
            })
            ->latest()
            ->get();

        return view('staff.dokumen.tampil-dokumen', compact('kategori', 'dokumens'));
    }


    public function tambah($kategoriId)
    {

        $kategori = Kategori::findOrFail($kategoriId);
        $departemen = Departemen::all();

        return view('staff.dokumen.tambah', compact('kategori', 'departemen'));
    }

    public function upload(Request $request, $kategoriId)
    {
    

        // kode lain…

        $request->validate([
            'judul'              => 'required',
            'tanggal_upload'     => 'required|date',
            'tanggal_kadaluarsa' => 'required|date',
            'deskripsi'          => 'nullable',
            'dokumen'            => 'required|file|max:50000|mimes:docx,jpg,jpeg,png,pdf',
            'kategori_id'        => 'required',
        ]);

        // Simpan file
        $filePath = $request->file('dokumen')->store('dokumen', 'public');

        Dokumen::create([
            'judul'              => $request->judul,
            'tanggal_upload'     => $request->tanggal_upload,
            'tanggal_kadaluarsa' => $request->tanggal_kadaluarsa,
            'deskripsi'          => $request->deskripsi,
            'dokumen'            => $filePath,
            'uploaded_by'        => Auth::id(),
            'kategori_id'        => $kategoriId,
            'departemen_id'      => Auth::user()->staff->departemen_id,
            'tipe_file'          => $request->file('dokumen')->getClientOriginalExtension(),
        ]);

        return redirect()->route('staff.dokumen.index')
            ->with('success', 'Dokumen berhasil ditambahkan.');
    }
}
