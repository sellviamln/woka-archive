<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use Illuminate\Http\Request;

class DepartemenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departemen = Departemen::all();
        return view('admin.departemen.index', compact('departemen'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.departemen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_departemen' => 'required|string|max:255|unique:departemen,nama_departemen',
            'deskripsi' => 'nullable|string',
        ]);

        Departemen::create([
            'nama_departemen' => $request->nama_departemen,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.departemen.index')->with('success', 'Departemen berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Departemen $departeman)
    {
        return view('admin.departemen.edit', compact('departeman'));
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, Departemen $departeman)
{
    
    $request->validate([
        'nama_departemen' => 'required|string|max:255|unique:departemen,nama_departemen,' . $departeman->id,
       
    ]);

    $departeman->update($request->only('nama_departemen'));

    return redirect()->route('admin.departemen.index')->with('success', 'Departemen berhasil diupdate!');
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $departeman = Departemen::findOrFail($id);
        $departeman->delete();

        return redirect()->route('admin.departemen.index')->with('success', 'Departemen berhasil dihapus!');

    }
}
