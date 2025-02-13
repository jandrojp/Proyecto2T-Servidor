<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\LineaPedidoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/', [AuthController::class, 'login'])->name('login.submit');


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [UserController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/register', [UserController::class, 'showRegisterForm'])->name('admin.register');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/admin/update', [UserController::class, 'showUpdateForm'])->name('admin.update');
    Route::put('/users/update', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});


Route::middleware(['auth', 'client'])->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('client.index');
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('client.show');
    Route::get('/carrito', [CarritoController::class, 'index'])->name('client.carrito');
    Route::post('/carrito', [CarritoController::class, 'store'])->name('carrito.store');
    Route::delete('/carrito/{id}', [CarritoController::class, 'destroy'])->name('carrito.destroy');
    Route::put('/carrito/update/{id}', [CarritoController::class, 'update'])->name('carrito.update');

    Route::post('/carrito/confirmar', [PedidoController::class, 'confirmarPedido'])->name('carrito.confirmar');
    Route::get('/pedido/{id}', [PedidoController::class, 'show'])->name('client.pedido');
});
