<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\inversion_venta\repuestosController;
use App\Http\Controllers\inversion_venta\vehiculosController;
use App\Http\Controllers\inversion_venta\ventasController;

Route::get('repuestos', [repuestosController::class, 'index']);
Route::post('repuestos', [repuestosController::class, 'create']);

Route::get('vehiculos', [vehiculosController::class, 'index']);
Route::post('vehiculos', [vehiculosController::class, 'create']);

Route::get('ventas', [ventasController::class, 'index']);
Route::post('ventas', [ventasController::class, 'create']);
