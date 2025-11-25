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
    public function staffs()
     { 
        return $this->hasMany(Staff::class, 'departemen_id');
     }
}
