<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KesiswaanController;

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
            return redirect('/home');
        }
    }
    return view('login-page-user');
});

Auth::routes();

Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
Route::middleware(['auth', 'Kesiswaan:kesiswaan'])->group(function() {
    Route::resource('kesiswaan', App\Http\Controllers\KesiswaanController::class);
});
Route::middleware(['auth', 'Operator:operator'])->group(function() {
    Route::resource('operator', App\Http\Controllers\OperatorController::class);
});

