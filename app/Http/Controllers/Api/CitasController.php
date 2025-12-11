<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\citas;

class CitasController extends Controller
{
    public function index()
    {
        return citas::all();
    }

    /**
     * Cristian
     */
    public function store(Request $request)
    {
         $datos = $request->validate([
        'nombre_paciente' => 'required|string|max:255',
        'nombre_doctor' => 'required|string|max:255',
        'motivo_consulta' => 'required|string|max:255',
        'estados_cita' => 'sometimes|required|in:Pendiente,Realizada,Cancelada',
        'fecha' => 'required|date',
        'tiempo' => 'required|date_format:H:i:s',

    ]);
        $cita = citas::create($datos);

             return response()->json($cita, 201);

    }

    /**
     * Cristian
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Kata ♡
     */
    public function update(Request $request, citas $cita)
    {
        $datos = $request->validate([
            'nombre_paciente' => 'required|string|max:255',
            'nombre_doctor'   => 'required|string|max:255',
            'motivo_consulta' => 'required|string|max:255',
            'estados_cita'    => 'required|in:Pendiente,Realizada,Cancelada',
            'fecha'           => 'required|date',
            'tiempo'          => 'required|date_format:H:i:s',
        ]);

        $cita->update($datos);
        $cita->refresh();
        return response()->json($cita, 200);
    }


    /**
     * Kata ♡
     */
    public function destroy(citas $cita)
    {
        $cita -> delete();
        return response()->json(['message' => 'Cita Eliminada Exitosamente ✅']);
    }
}
