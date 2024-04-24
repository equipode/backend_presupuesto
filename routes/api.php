<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\authController;
use App\Http\Controllers\users\usersController;


Route::post('v1/login', [authController::class, 'login']);
Route::get('v1/pruebas', [authController::class, 'pruebas']);
// Route::post('usuarios', [usersController::class, 'create']);


Route::group(['middleware' => ['jwt.verify']], function () {

    Route::post('v1/logout', [authController::class, 'logout']);

    Route::prefix('v1')->group(function () {
        require __DIR__ . '/users/api_users.php';
    });
    Route::prefix('v1')->group(function () {
        require __DIR__ . '/ingresos/api_ingreso.php';
    });
});
