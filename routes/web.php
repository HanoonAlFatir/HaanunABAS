<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KesiswaanController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KelasController;

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

Route::get('/', function () {
    if (auth()->check()) {
        $role = auth()->user()->role;

        if ($role == 'kesiswaan') {
            return redirect('kesiswaan');
        } elseif ($role == 'siswa') {
            return redirect('siswa');
        } elseif ($role == 'wali') {
            return redirect('wali');
        } elseif ($role == 'operator') {
            return redirect('operator');
        }
        else {
            return redirect('/');
        }
    }
    return view('login-page-user');
});

Auth::routes();

Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

// KESISWAAN
Route::middleware(['auth', 'Kesiswaan:kesiswaan'])->group(function() {
    Route::resource('kesiswaan', App\Http\Controllers\KesiswaanController::class);
});

// OPERATOR
Route::middleware(['auth', 'Operator:operator'])->group(function() {
    Route::resource('operator', App\Http\Controllers\OperatorController::class);
    Route::get('/walikelas', [OperatorController::class, 'index'])->name('walikelas');
    Route::get('/setlokasi', [OperatorController::class, 'lokasi'])->name('lokasi');

// DAFTAR WALI KELAS
    Route::get('/operator/{nuptk}/edit', [OperatorController::class, 'edit'])->name('operator.edit');
    Route::put('/operator/{nuptk}', [OperatorController::class, 'update'])->name('operator.update');
    Route::delete('/operator/{nuptk}', [OperatorController::class, 'destroy'])->name('operator.destroy');
    Route::post('tambahwalikelas', [OperatorController::class, 'store'])->name('walikelas.store');

// DAFTAR JURUSAN
    Route::get('/jurusan', [JurusanController::class, 'index'])->name('jurusan');
    Route::post('tambahjurusan', [JurusanController::class, 'store'])->name('tambahjurusan');

// DAFTAR KELAS
    Route::get('/kelas', [KelasController::class, 'index'])->name('kelas');
    Route::post('tambahkelas', [KelasController::class, 'store'])->name('tambahkelas');

});

