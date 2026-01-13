<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    protected $table = 'departemen';

    protected $fillable = [
        'nama_departemen',

    ];
    public function staffs()
    {
        return $this->hasMany(Staff::class, 'departemen_id');
    }
    public function aktivitas()
    {
        return $this->hasMany(Aktivitas::class);
    }
}
