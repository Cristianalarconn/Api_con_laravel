<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class citas extends Model
{
    protected $fillable =[
        'nombre_paciente',
        'nombre_doctor',
        'motivo_consulta',
        'estados_cita',
        'fecha',
        'tiempo',
    ];
}
