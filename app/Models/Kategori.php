<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';

    protected $fillable = [
        'nama_kategori',
        'slug',
        'deskripsi',
    ];

    /** Relasi: Satu kategori punya banyak dokumen */
    public function dokumens()
    {
        return $this->hasMany(Dokumen::class, 'id_kategori');
    }
}
