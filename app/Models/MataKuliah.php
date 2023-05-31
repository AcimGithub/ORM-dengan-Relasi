<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    use HasFactory;

    protected $table='matakuliah';

    function getNilai() {
        return $this->hasMany(Mahasiswa_Matakuliah::class);
    }
}
