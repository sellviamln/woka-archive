<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    protected $table = 'departmen';

    protected $fillable = [
        'nama_departemen',
        'deskripsi',
    ];
}
