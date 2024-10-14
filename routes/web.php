<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KesiswaanController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\WaliSiswaController;
use Illuminate\Support\Facades\Auth;

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


Auth::routes();

// Route untuk halaman utama/login
Route::get('/', function () {
    if (auth()->check()) {
        $role = auth()->user()->role;

        // Redirect sesuai role pengguna
        return redirect()->to(redirectTo($role));
    }
    return view('login-page-user'); // Tampilkan halaman login jika belum terautentikasi
})->name('log');

// Route untuk proses login
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Metode untuk mengarahkan ke halaman sesuai role
function redirectTo($role)
{
    switch ($role) {
        case 'kesiswaan':
            return 'kesiswaan';
        case 'siswa':
            return 'siswa';
        case 'wali':
            return 'wali';
        case 'operator':
            return 'operator';
        case 'ortu':
            return 'ortu';
        default:
            return '/'; // Redirect default jika role tidak dikenali
    }
}


Route::middleware(['auth', 'Siswa:siswa'])->group(function() {
    // ABSEN
    Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.dashboard');
    Route::get('/siswa/absen', [SiswaController::class, 'absen'])->name('siswa.absen');
    Route::post('/absen/store', [SiswaController::class, 'store']);

    // FORM
    Route::get('/formsakit', [SiswaController::class, 'sakit'])->name('form.sakit');
    Route::get('/formizin', [SiswaController::class, 'izin'])->name('form.izin');
    Route::post('/formsakit/submit', [SiswaController::class, 'sakitstore'])->name('sakit.store');
    Route::post('/formizin/submit', [SiswaController::class, 'izinstore'])->name('izin.store');

    // PROFILE
    Route::get('/profile', [SiswaController::class, 'editprofile'])->name('profile');
    Route::post('/editprofile', [SiswaController::class, 'profilesubmit'])->name('profile.submit');

    // REKAP
    Route::get('/rekap', [SiswaController::class, 'rekap'])->name('siswa.rekap');
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
    Route::post('/walikelas/import', [OperatorController::class, 'importWali'])->name('import-walikelas');


// DAFTAR JURUSAN
    Route::get('/jurusan', [OperatorController::class, 'jurusan'])->name('jurusan');
    Route::post('tambahjurusan', [OperatorController::class, 'jurusanStore'])->name('tambahjurusan');
    Route::put('/jurusan/{id_jurusan}', [OperatorController::class, 'jurusanUpdate'])->name('editjurusan');
    Route::delete('/jurusan/{id_jurusan}', [OperatorController::class, 'jurusanDestroy'])->name('hapusjurusan');


// DAFTAR KELAS
    Route::get('/kelas', [OperatorController::class, 'kelas'])->name('kelas');
    Route::post('tambahkelas', [OperatorController::class, 'kelasStore'])->name('tambahkelas');
    Route::put('/editkelas/{id_kelas}', [OperatorController::class, 'kelasUpdate'])->name('editkelas');
    Route::delete('/hapuskelas/{id_kelas}', [OperatorController::class, 'kelasDestroy'])->name('hapuskelas');
    Route::post('/kelas/import', [OperatorController::class, 'importKelas'])->name('import-kelas');

// DAFTAR SISWA
    Route::get('/siswa/{id_kelas}', [OperatorController::class, 'siswa'])->name('daftarsiswa');
    Route::put('/editsiswa/{nis}', [OperatorController::class, 'siswaUpdate'])->name('editsiswa');
    Route::post('/siswa/tambahsiswa', [OperatorController::class, 'siswaStore'])->name('tambahsiswa');
    Route::delete('/siswa/{nis}', [OperatorController::class, 'siswaDestroy'])->name('hapusSiswa');

// DAFTAR KESISWAAN
    Route::get('/daftarkesiswaan', [OperatorController::class, 'kesiswaan'])->name('daftarkesiswaan');
    Route::post('/kesiswaan/store', [OperatorController::class, 'kesiswaansSore'])->name('kesiswaan.store');
    Route::put('/kesiswaan/{id}', [OperatorController::class, 'kesiswaanUpdate'])->name('editkesiswaan');
    Route::delete('/kesiswaan/{id}', [OperatorController::class, 'kesiswaanDestroy'])->name('hapuskesiswaan');

// DAFTAR WALI SISWA
    Route::get('/daftarwalisiswa', [OperatorController::class, 'walisiswa'])->name('daftarwalisiswa');
    Route::post('/walikelas/store', [OperatorController::class, 'tambahwalisiswa'])->name('walisiswa.tambah');
    Route::delete('/walikelas/destroy/{nik}', [OperatorController::class, 'waliDestroy'])->name('walisiswa.hapus');
});

// KESISWAAN
Route::middleware(['auth', 'Kesiswaan:kesiswaan'])->group(function() {
    Route::get('/kesiswaan', [KesiswaanController::class, 'index'])->name('kesiswaan');
    Route::get('/laporan', [KesiswaanController::class, 'laporan'])->name('laporan');
    Route::get('/laporan/daftarsiswa/{kelas_id}', [KesiswaanController::class, 'laporanSiswa'])->name('kesiswaan.daftarsiswa');

});

// WALI SISWA
Route::middleware(['auth', 'Ortu:ortu'])->group(function() {
    Route::get('/ortu', [WaliSiswaController::class, 'index'])->name('ortu.dashboard');
    Route::get('/profile', [WaliSiswaController::class, 'profil'])->name('profile');
});
