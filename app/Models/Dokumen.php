<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
     protected $table = 'dokumen';

    protected $fillable = [
        'id_departemen',
        'id_kategori',
        'no_dokumen',
        'judul',
        'tipe_file',
        'dokumens',
        'deskripsi',
        'status',
        'tanggal_upload',
        'tanggal_kadaluarsa'
    ];

    protected $casts = [
        'tanggal_upload' => 'date',
        'tanggal_kadaluarsa' => 'date',
    ];

    /** 🔗 Relasi */
    public function department()
    {
        return $this->belongsTo(Departemen::class, 'id_departement');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_kategori');
    }
}
