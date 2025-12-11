<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\citas;

class CitasController extends Controller
{
    /**
     * Muestra todas las citas registradas en la base de datos.
     */
    public function index()
    {
        return citas::all();
    }

    /**
     * Cristian
     * Guarda una nueva cita.
     * Antes de crearla, se validan los datos enviados para asegurar que cumplan
     * con los formatos y campos requeridos.
     */
    public function store(Request $request)
    {
        // Validación de los datos que llegan desde el cliente
         $datos = $request->validate([
            'nombre_paciente' => 'required|string|max:255',
            'nombre_doctor'   => 'required|string|max:255',
            'motivo_consulta' => 'required|string|max:255',
            'estados_cita'    => 'sometimes|required|in:Pendiente,Realizada,Cancelada',
            'fecha'           => 'required|date',
            'tiempo'          => 'required|date_format:H:i:s',

        ]);

        // Creación de la cita con los datos validados
        $cita = citas::create($datos);

        // Se retorna la cita creada con código 201 (creado)
        return response()->json($cita, 201);

    }

    /**
     * Cristian
     * Muestra una cita específica gracias al modelo que se recibe por inyección.
     */
    public function show(citas $cita)
    {
        return $cita;
    }

    /**
     * Kata ♡
     * Actualiza los datos de una cita existente.
     * Igual que en store, se valida la información antes de guardar los cambios.
     */
    public function update(Request $request, citas $cita)
    {
        // Validación de los datos enviados
        $datos = $request->validate([
            'nombre_paciente' => 'required|string|max:255',
            'nombre_doctor'   => 'required|string|max:255',
            'motivo_consulta' => 'required|string|max:255',
            'estados_cita'    => 'sometimes|required|in:Pendiente,Realizada,Cancelada',
            'fecha'           => 'required|date',
            'tiempo'          => 'required|date_format:H:i:s',
        ]);

        // Actualización de la cita
        $cita->update($datos);
        // Se refrescan los datos por si hubo cambios automáticos
        $cita->refresh();
        return response()->json($cita, 200);
    }


    /**
     * Kata ♡
     * Elimina una cita del sistema.
     */
    public function destroy(citas $cita)
    {
        $cita -> delete();
        return response()->json(['message' => 'Cita Eliminada Exitosamente ✅']);
    }
}
