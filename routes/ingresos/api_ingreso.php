<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ingresos\ingresosController;
use App\Http\Controllers\ingresos\egresosController;

Route::get('ingresos', [ingresosController::class, 'index']);
Route::get('egresos', [egresosController::class, 'index']);
