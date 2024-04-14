<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\authController;



Route::post('v1/login', [authController::class, 'login']);
Route::get('v1/pruebas', [authController::class, 'pruebas']);

Route::group(['middleware' => ['jwt.verify']], function () {

    Route::post('v1/logout', [authController::class, 'logout']);

    Route::prefix('v1')->group(function () {
        require __DIR__ . '/users/api_users.php';
    });
});