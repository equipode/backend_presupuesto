<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\users\usersController;
use App\Http\Controllers\users\rolesController;

Route::get('usuarios', [usersController::class, 'index']);
Route::get('usuarios/search', [usersController::class, 'search']);
Route::get('usuarios/validarEmail', [usersController::class, 'validarUniqueUser']);
Route::get('usuarios/validarUpdateEmail', [usersController::class, 'validarUniqueUpdateUser']);
Route::get('usuarios/{id}', [usersController::class, 'show']);
Route::post('usuarios', [usersController::class, 'create']);
Route::put('usuarios/{id}', [usersController::class, 'update']);
Route::put('usuariosCredntials/{id}', [usersController::class, 'updateCredentialsAcces']);
Route::put('usuariosEmail/{id}', [usersController::class, 'updateEmailUser']);
Route::put('usuariosPassword/{id}', [usersController::class, 'updatePassword']);
Route::delete('usuarios/{id}', [usersController::class, 'destroy']);

Route::get('roles', [rolesController::class, 'index']);
Route::get('roles/search', [rolesController::class, 'search']);
Route::get('roles/{id}', [rolesController::class, 'show']);