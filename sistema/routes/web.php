<?php

use App\Http\Controllers\CategoryController;
<<<<<<< Updated upstream
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Vista raíz del sistema: el dashboard
=======
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

>>>>>>> Stashed changes
Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

// CRUD de categorías: crea 6 rutas (index, create, store, edit, update, destroy)
Route::resource('categories', CategoryController::class)->except('show');
<<<<<<< Updated upstream


=======
Route::resource('medicines', MedicineController::class)->except('show');
Route::resource('customers', CustomerController::class)->except('show');
Route::resource('sales', SaleController::class)->except(['edit', 'update']);
Route::resource('roles', RoleController::class)->except('show');
Route::resource('users', UserController::class)->except('show');
>>>>>>> Stashed changes
