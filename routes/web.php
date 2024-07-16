<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BajaController;
use App\Http\Controllers\BienvenidoController;
use App\Http\Controllers\IngresoController;
use App\Http\Controllers\PatrimonioController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    } else {
        return redirect()->route('home');
    }
});
Route::get('/', [BienvenidoController::class, 'home'])
    ->name('home');

Route::get('/register', [RegisterController::class, 'create'])
    ->name('register.index');
Route::post('/register', [RegisterController::class, 'store'])
    ->name('register.store');

Route::get('/login', [SessionsController::class, 'create'])
    ->name('login.index');
Route::post('/login', [SessionsController::class, 'store'])
    ->name('login.store');
Route::get('/logout', [SessionsController::class, 'destroy'])
    ->middleware('auth')
    ->name('login.destroy');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [BienvenidoController::class, 'dashboard'])
        ->name('dashboard');
    // Módulos      php artisan route:list
    Route::resource('Personal', PersonalController::class)
        ->names('personal');
    Route::resource('Patrimonio', PatrimonioController::class)
        ->names('patrimonio');
    Route::resource('Ingresos', IngresoController::class)
        ->names('ingresos');
    Route::resource('Bajas', BajaController::class)
        ->names('bajas');
});
    /*Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
        // otras rutas de admin...
    };*/