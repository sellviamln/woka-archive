<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
     protected $table = 'dokumen';

    protected $fillable = [
        'departemen_id',
        'kategori_id',
        'no_dokumen',
        'judul',
        'tipe_file',
        'dokumen',
        'deskripsi',
        'status',
        'tanggal_upload',
        'tanggal_kadaluarsa',
        'uploaded_by',

    ];

    protected $casts = [
        'tanggal_upload' => 'date',
        'tanggal_kadaluarsa' => 'date',
    ];

    /** 🔗 Relasi */
    public function department()
    {
        return $this->belongsTo(Departemen::class, 'departemen_id');
    }

    public function category()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
