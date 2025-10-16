<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Records\FormController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAuth;

// Login
Route::get('/', [AuthController::class, 'loginForm'])->name('loginForm');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rutas protegidas
Route::middleware([CheckAuth::class])->group(function () {
Route::get('/form', [FormController::class, 'index'])->name('form');
Route::get('/records/create', [FormController::class, 'create']);
Route::post('/records/store', [FormController::class, 'store']);
Route::get('/records/blocks/{project}', [FormController::class, 'blocks']);
Route::get('/records/pieces/{block}', [FormController::class, 'pieces']);
});
