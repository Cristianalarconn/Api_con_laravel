<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Cristian
 * Modelo que representa la tabla de citas en la base de datos.
 * Aquí se especifican los campos que pueden ser asignados de forma masiva.
 */
class citas extends Model
{
    // Lista de columnas que el modelo permite guardar mediante create() o update()
    protected $fillable =[
        'nombre_paciente',
        'nombre_doctor',
        'motivo_consulta',
        'estados_cita',
        'fecha',
        'tiempo',
    ];
}
