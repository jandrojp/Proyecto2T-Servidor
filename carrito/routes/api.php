<?php
use App\Http\Controllers\Api\ApiCarritoController;

Route::middleware('auth:api')->group(function () {

    Route::get('/carrito', [ApiCarritoController::class, 'index']);
    Route::post('/carrito', [ApiCarritoController::class, 'store']);
    Route::delete('/carrito/{id}', [ApiCarritoController::class, 'destroy'])->name('api.carrito.destroy');
    Route::put('/carrito/{id}', [ApiCarritoController::class, 'update'])->name('api.carrito.update');
});
