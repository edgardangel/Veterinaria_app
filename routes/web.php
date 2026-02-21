<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\MascotaController;
use App\Http\Controllers\VeterinarioController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\HistorialMedicoController;
use App\Http\Controllers\UserController;

// ── Auth ───────────────────────────────────────────────
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ── Protected routes ───────────────────────────────────
Route::middleware('auth')->group(function () {

    // Dashboard — all roles
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Clientes — Admin, Recepcionista
    Route::middleware('role:Administrador,Recepcionista')->group(function () {
        Route::resource('clientes', ClienteController::class)->except(['show']);
    });

    // Quick store de clientes (disponible para todos los roles que pueden crear citas)
    Route::post('clientes/quick-store', [ClienteController::class, 'quickStore'])->name('clientes.quick-store');

    // Mascotas — Admin, Recepcionista
    Route::middleware('role:Administrador,Recepcionista')->group(function () {
        Route::resource('mascotas', MascotaController::class)->except(['show']);
    });

    // Veterinarios — Admin only
    Route::middleware('role:Administrador')->group(function () {
        Route::resource('veterinarios', VeterinarioController::class)->except(['show']);
    });

    // Citas — All roles
    Route::resource('citas', CitaController::class)->except(['show']);

    // Historiales Médicos — Veterinario, Admin
    Route::middleware('role:Administrador,Veterinario')->group(function () {
        Route::resource('historiales', HistorialMedicoController::class)->only(['index', 'create', 'store', 'show']);
    });

    // Usuarios — Admin only
    Route::middleware('role:Administrador')->group(function () {
        Route::resource('users', UserController::class)->except(['show']);
    });
});
