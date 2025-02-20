<?php
use App\Http\Controllers\Api\ApiCarritoController;
use App\Http\Controllers\Api\LoginController;

Route::post('login', [LoginController::class, 'login']);

Route::middleware('auth:api')->group(function () {

    Route::get('/carrito', [ApiCarritoController::class, 'index']);
    Route::post('/carrito', [ApiCarritoController::class, 'store']);
    Route::delete('/carrito', [ApiCarritoController::class, 'destroy']);
    Route::put('/carrito', [ApiCarritoController::class, 'update']);
});
