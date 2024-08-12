<?php

use App\Http\Controllers\DaftarKesiswaanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KesiswaanController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AbsenSiswaController;

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
    }
    return view('login-page-user');
});



Auth::routes();

Route::middleware(['auth', 'Siswa:siswa'])->group(function() {
    Route::get('/siswa', [AbsenSiswaController::class, 'index'])->name('siswa.dashboard');
});

// OPERATOR LOKASI
Route::middleware(['auth', 'Operator:operator'])->group(function() {
    Route::get('/lokasi', [LokasiController::class, 'lokasisekolah'])->name('lokasi');
    Route::post('/operator/updatelokasisekolah', [LokasiController::class, 'updatelokasisekolah'])->name('updatelokasi');
    Route::post('/operator/updatewaktu', [LokasiController::class, 'updatewaktu'])->name('updatewaktu');

// DAFTAR WALI KELAS
    Route::resource('operator', App\Http\Controllers\OperatorController::class);
    Route::get('/walikelas', [OperatorController::class, 'index'])->name('walikelas');
    Route::put('/walikelas/{id}', [OperatorController::class, 'update'])->name('walikelas.update');
    Route::delete('/hapuswali/{nuptk}', [OperatorController::class, 'destroy'])->name('operator.destroy');
    Route::post('tambahwalikelas', [OperatorController::class, 'store'])->name('tambahwalikelas');

// DAFTAR JURUSAN
    Route::get('/jurusan', [JurusanController::class, 'index'])->name('jurusan');
    Route::post('tambahjurusan', [JurusanController::class, 'store'])->name('tambahjurusan');
    Route::put('/jurusan/{id_jurusan}', [JurusanController::class, 'update'])->name('editjurusan');
    Route::delete('/jurusan/{id_jurusan}', [JurusanController::class, 'destroy'])->name('hapusjurusan');


// DAFTAR KELAS
    Route::get('/kelas', [KelasController::class, 'index'])->name('kelas');
    Route::post('tambahkelas', [KelasController::class, 'store'])->name('tambahkelas');
    Route::put('/editkelas/{id_kelas}', [KelasController::class, 'update'])->name('editkelas');
    Route::delete('/hapuskelas/{id_kelas}', [KelasController::class, 'destroy'])->name('hapuskelas');
    Route::post('/kelas/import', [KelasController::class, 'importKelas'])->name('import-kelas');

// DAFTAR SISWA
    Route::get('/siswa/{id_kelas}', [SiswaController::class, 'index'])->name('daftarsiswa');
    Route::put('/editsiswa/{nis}', [SiswaController::class, 'update'])->name('editsiswa');
    Route::post('/siswa/tambahsiswa', [SiswaController::class, 'store'])->name('tambahsiswa');
    Route::delete('/siswa/{nis}', [SiswaController::class, 'destroy'])->name('hapusSiswa');

// DAFTAR KESISWAAN
    Route::get('/daftarkesiswaan', [DaftarKesiswaanController::class, 'index'])->name('daftarkesiswaan');
    Route::post('/kesiswaan/store', [DaftarKesiswaanController::class, 'store'])->name('kesiswaan.store');
    Route::put('/kesiswaan/{id}', [DaftarKesiswaanController::class, 'update'])->name('editkesiswaan');
    Route::delete('/kesiswaan/{id}', [DaftarKesiswaanController::class, 'destroy'])->name('hapuskesiswaan');

});

// KESISWAAN
Route::middleware(['auth', 'Kesiswaan:kesiswaan'])->group(function() {
    Route::get('/kesiswaan', [App\Http\Controllers\KesiswaanController::class, 'index'])->name('kesiswaan');

});
