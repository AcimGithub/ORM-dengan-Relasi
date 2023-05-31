<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mahasiswas;

class Mahasiswa_MataKuliah extends Model
{
    use HasFactory;
    protected $table='nilai';

    function getMataKuliah() {
        return $this->belongsTo(MataKuliah::class);
    }

    function getMahasiswa() {
        return $this->belongsTo(Mahasiswa::class);
    }
}
