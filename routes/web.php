<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::resource('mahasiswas', MahasiswaController::class);

Route::get('/search', [MahasiswaController::class,'search']);

Route::get('mahasiswa/{mahasiswa}/khs', [MahasiswaController::class, 'khs'])->name('mahasiswas.nilai');

Route::get('/article/cetak_pdf', [ArticleController::class, 'cetak_pdf']);

Route::get('mahasiswa/{mahasiswa}/cetak_khs', [MahasiswaController::class, 'cetak_khs'])->name('mahasiswa.cetak_khs');

Route::resource('articles', ArticleController::class);

Route::get('/', function () {
    return view('welcome');
});
