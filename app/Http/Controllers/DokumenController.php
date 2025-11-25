<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use Illuminate\Http\Request;

class DokumenController extends Controller
{
    public function index()
    {
        $dokumens = Dokumen::all();
        return view('admin.dokumen.index', compact('dokumens'));
    }
    public function create()
    {
        return view('admin.dokumen.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'tipe_file' => 'required|file|mimes:pdf,docx,jpg,jpeg,png',
            'tanggal_upload' => 'required',
            'tanggal_kadaluarsa' => 'required|date|after:tanggal_upload',
            'status' => 'required|in:active,archive',
        ]);
        if ($request->hasFile('tipe_file')) {
            $filePath = $request->file('tipe_file')->store('dokumen', 'public');
            $validatedData['tipe_file'] = $filePath; 
        }

        if ($request->hasFile('dokumentasi')) {
            $dokumentasiPath = $request->file('dokumentasi')->store('dokumentasi', 'public');
            $validatedData['dokumentasi'] = $dokumentasiPath;
        } else {
            $validatedData['dokumentasi'] = null;
        }
        
        Dokumen::create([
            'judul' => $request->judul,
            'tipe_file' => $request->tipe_file,
            'tanggal_upload' => $request->tanggal_upload,
            'tanggal_kadaluarsa' => $request->tanggal_kadaluarsa,
            'status' => $request->status,
        ]);


        return redirect()->route('admin.dokumen.index')->with('success', 'Dokumen berhasil ditambahkan.'); {
        }

    }
   

}
