<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ReservaController;

// Home routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index']);
Route::post('/home/test', [HomeController::class, 'test']);
Route::get('/home/testdb', [HomeController::class, 'testdb']);

// Auth routes
Route::get('/auth/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/auth/login', [AuthController::class, 'login']);
Route::get('/auth/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes (require authentication)
Route::middleware(['auth:viajero'])->group(function () {
    // Usuario routes
    Route::get('/usuario/profile', [UsuarioController::class, 'profile'])->name('usuario.profile');
    Route::post('/usuario/update', [UsuarioController::class, 'update'])->name('usuario.update');
    Route::post('/usuario/update-password', [UsuarioController::class, 'updatePassword'])->name('usuario.updatePassword');
    Route::post('/usuario/delete', [UsuarioController::class, 'delete'])->name('usuario.delete');
    
    // Reserva routes
    Route::get('/reserva/mis-reservas', [ReservaController::class, 'misReservas'])->name('reserva.misReservas');
    Route::get('/reserva/crear', [ReservaController::class, 'crear'])->name('reserva.crear');
    Route::post('/reserva/store', [ReservaController::class, 'store'])->name('reserva.store');
    Route::get('/reserva/{id}/editar', [ReservaController::class, 'editar'])->name('reserva.editar');
    Route::post('/reserva/{id}/update', [ReservaController::class, 'update'])->name('reserva.update');
    Route::post('/reserva/{id}/delete', [ReservaController::class, 'delete'])->name('reserva.delete');
});

// Admin routes
Route::middleware(['auth:viajero', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/calendar', [AdminController::class, 'calendar'])->name('admin.calendar');
    Route::get('/reservations', [AdminController::class, 'reservations'])->name('admin.reservations');
    Route::get('/hoteles', [AdminController::class, 'hoteles'])->name('admin.hoteles');
    Route::get('/hoteles/{id}/editar', [AdminController::class, 'editarHotel'])->name('admin.hoteles.editar');
    Route::post('/hoteles/{id}/update', [AdminController::class, 'updateHotel'])->name('admin.hoteles.update');
});
