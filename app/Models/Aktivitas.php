<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aktivitas extends Model
{
    use HasFactory;

    protected $table = 'aktivitas';

    protected $fillable = [
        'user_id',
        'departemen_id',
        'aktivitas',
        'keterangan',
    ];

    /** Relasi ke User */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /** Relasi ke Departemen */
    public function departemen()
    {
        return $this->belongsTo(Departemen::class, 'departemen_id');
    }
}
