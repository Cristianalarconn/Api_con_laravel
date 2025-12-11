<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CitasController;

// Creación de ruta
Route::get('/gestioncitas', function () {
    return ['status' => 'API EXITOSA ✅'];
});

Route::apiResource('citas', CitasController::class);

