<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aktivitas extends Model
{
    use HasFactory;

    protected $table = 'aktivitas';

    protected $fillable = [
        'id_user',
        'id_departemen',
        'aktivitas',
        'keterangan',
    ];

    /** Relasi ke User */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    /** Relasi ke Departemen */
    public function departemen()
    {
        return $this->belongsTo(Departemen::class, 'id_departemen');
    }
}
