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
        try{
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

        } catch (\Illuminate\Validation\ValidationException $e) {

            // Errores de validación — HTTP 422
            return response()->json([
                'error'   => 'Datos incorrectos o vacios',
                'detalle' => $e->errors()
            ], 422);
        }
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
        try {
            // Validación de los datos enviados
            $datos = $request->validate([
                'nombre_paciente' => 'required|string|max:255',
                'nombre_doctor'   => 'required|string|max:255',
                'motivo_consulta' => 'required|string|max:255',
                'estados_cita'    => 'sometimes|required|in:Pendiente,Realizada,Cancelada',
                'fecha'           => 'required|date',
                'tiempo'          => 'required|date_format:H:i:s',
            ]);

            // Actualiza la cita
            $cita->update($datos);
            $cita->refresh();

            // Respuesta exitosa
            return response()->json([
                'mensaje' => 'Cita actualizada correctamente ✅',
                'data'    => $cita
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {

            // Errores de validación — HTTP 422
            return response()->json([
                'error'   => 'Datos inválidos 🚫',
                'detalle' => $e->errors()
            ], 422);
        }
    }

    /**
     * Kata ♡
     * Elimina una cita del sistema.
     */
    public function destroy($id)
    {
        try {
            // Buscar la cita manualmente
            $cita = citas::findOrFail($id);

            // Si se encuentra, se elimina
            $cita->delete();

            return response()->json([
                'mensaje' => 'Cita eliminada exitosamente ✅'
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return response()->json([
                'mensaje' => 'La cita no fue encontrada 👀'
            ], 404);

        } catch (\Exception $e) {

            return response()->json([
                'mensaje'   => 'Ocurrió un error al eliminar la cita 🤔',
                'detalle' => $e->getMessage()
            ], 500);
        }
    }


}
