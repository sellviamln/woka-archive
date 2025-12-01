<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\Departemen;
use App\Models\kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DokumenController extends Controller
{

    public function index()
    {
        $dokumens = Dokumen::with(['departemen', 'kategori'])
            ->orderBy('tanggal_upload', 'desc')
            ->get();

        return view('admin.dokumen.index', compact('dokumens'));
    }

    public function create()
    {
        $departemens = Departemen::all();
        $kategoris   = kategori::all();
        $dokumens    = Dokumen::all();

        return view('admin.dokumen.create', compact('departemens', 'kategoris', 'dokumens'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'judul'          => 'required',
            'departemen_id'   => 'required',
            'kategori_id'      => 'required',
            'tanggal_upload'  => 'required|date',
            'tanggal_kadaluarsa' => 'required|date',
            'tipe_file'  => 'required',
            'deskripsi'   => 'nullable',
            'dokumen' => 'required|file|max:50000|mimes:docx,jpg,jpeg,png,pdf',


        ]);

        $filePath = $request->file('dokumen')->store('dokumen', 'public');

        Dokumen::create([
            'no_dokumen'        => 'DOC-' . time(),
            'departemen_id'     => $request->departemen_id,
            'kategori_id'       => $request->kategori_id,
            'judul'             => $request->judul,
            'tanggal_upload'    => $request->tanggal_upload,
            'tanggal_kadaluarsa' => $request->tanggal_kadaluarsa,
            'tipe_file'         => $request->tipe_file,
            'deskripsi'         => $request->deskripsi,
            'dokumen'           => $filePath,
            'uploaded_by' => Auth::id(),

        ]);


        return redirect()->route('admin.dokumen.index')
            ->with('success', 'Dokumen berhasil ditambahkan.');
    }


    public function destroy($id)
    {
        $dokumen = Dokumen::findOrFail($id);

        if (Storage::disk('public')->exists($dokumen->dokumen)) {
            Storage::disk('public')->delete($dokumen->dokumen);
        }
        $dokumen->delete();

        return redirect()->route('admin.dokumen.index')->with('success', 'Dokumen berhasil dihapus.');
    }
}
