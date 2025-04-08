<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Rutas sin autenticación - PUBLICAS
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

// Rutas con autenticación - PRIVADAS
Route::group(['middleware' => ['auth:api', 'isauthuser']], function () {
    Route::get('user', [AuthController::class, 'getUser']);
    Route::post('logout', [AuthController::class, 'logout']);
});


// Rutas exclusivamente para administradores
Route::group(['middleware' => ['auth:api', 'isadmin']], function () {
    // Ejemplo de ruta protegida para admin:
    Route::get('admin/users', [AuthController::class, 'getAllUsers']);
});