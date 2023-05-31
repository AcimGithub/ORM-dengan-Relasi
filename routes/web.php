<?php

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

Route::get('/', function () {
    return view('welcome');
});
