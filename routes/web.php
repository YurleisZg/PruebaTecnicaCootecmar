<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FormularioController;
use Illuminate\Support\Facades\Route;

// Login
Route::get('/', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rutas protegidas
Route::middleware(['checkauth'])->group(function () {
    Route::get('/form', [FormularioController::class, 'index'])->name('formulario');
});
