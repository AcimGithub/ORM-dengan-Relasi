<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mahasiswas;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function MataKuliah(): BelongsToMany
    {
        return $this->belongsToMany(Matakuliah::class, 'nilai', 'mahasiswa_id', 'matakuliah_id')->withPivot('nilai');
    }

    public function getRouteKeyName()
    {
        return 'Nim';
    }


}
