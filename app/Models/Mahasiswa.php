<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mahasiswas;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = "mahasiswas"; 
    // public $timestamps= false;
    protected $primaryKey = 'Nim';

    protected $fillable = [
        'Nim',
        'Nama',
        'kelas_id',
        'Jurusan',
        'Hp',
        'Email',
        'TTL',
    ];

    public function kelas()
    {
        return $this -> belongsTo(Kelas::class);
    }

}
