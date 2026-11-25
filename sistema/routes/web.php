<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Rutas de acceso: solo usuarios invitados pueden iniciar sesión.
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

// Todas las rutas internas requieren autenticación.
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

    // CRUD de medicamentos y clientes: crea 6 rutas (index, create, store, edit, update, destroy)
    Route::resource('medicines', MedicineController::class)->except(['show'])
        ->middleware('role:Administrador,Químico farmacéutico');
    Route::resource('customers', CustomerController::class)->except(['show']);
    Route::resource('sales', SaleController::class)->except(['edit', 'update']);

    // CRUD de categorías, roles y usuarios: solo para administradores
    Route::middleware('role:Administrador')->group(function () {
        Route::resource('categories', CategoryController::class)->except(['show']);
        Route::resource('roles', RoleController::class)->except(['show']);
        Route::resource('users', UserController::class)->except(['show']);
    });
});
