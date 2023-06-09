<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Mahasiswa as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model; //Model Eloquent


class Mahasiswa extends Model //Definisi Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = "mahasiswa"; 
    // public $timestamps= false;
    protected $primaryKey = 'nim';
        
    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'Nim',
        'Nama',
        'Kelas',
        'Jurusan',
        'Hp',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    
}
