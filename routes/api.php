<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CitasController;

/**
 * Kata ♡
 * Ruta básica para verificar que la API está funcionando correctamente.
 * Cuando se visita /gestioncitas, devuelve un mensaje de estado.
 */
Route::get('/gestioncitas', function () {
    return ['status' => 'API EXITOSA ✅'];
});

/**
 * Kata ♡
 * Aquí se registran automáticamente todas las rutas necesarias
 * para trabajar con el controlador de citas (index, store, show, update, destroy).
 * Esto simplifica el manejo de rutas REST.
 */
Route::apiResource('citas', CitasController::class);


