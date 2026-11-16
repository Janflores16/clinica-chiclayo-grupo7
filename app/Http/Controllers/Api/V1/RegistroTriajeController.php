<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\RegistroTriaje;
use Illuminate\Http\Request;

class RegistroTriajeController extends Controller
{
    public function index()
    {
        return response()->json(RegistroTriaje::all(), 200);
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'paciente_dni' => 'required|digits:8',
            'temperatura' => 'required|numeric',
            'frecuencia_cardiaca' => 'required|integer|min:1'
        ]);

        if ($datos['temperatura'] < 36.0) {
            $datos['mensaje_alerta'] = 'ALERTA: HIPOTERMIA';
        } elseif ($datos['temperatura'] <= 37.5) {
            $datos['mensaje_alerta'] = 'SIGNOS VITALES NORMALES';
        } else {
            $datos['mensaje_alerta'] = 'ALERTA: FIEBRE / DERIVAR';
        }

        $registro = RegistroTriaje::create($datos);

        return response()->json($registro, 201);
    }

    public function show(string $id)
    {
        $registro = RegistroTriaje::find($id);

        if (!$registro) {
            return response()->json(['mensaje' => 'Registro no encontrado'], 404);
        }

        return response()->json($registro, 200);
    }

    public function update(Request $request, string $id)
    {
        $registro = RegistroTriaje::find($id);

        if (!$registro) {
            return response()->json(['mensaje' => 'Registro no encontrado'], 404);
        }

        $datos = $request->validate([
            'paciente_dni' => 'required|digits:8',
            'temperatura' => 'required|numeric',
            'frecuencia_cardiaca' => 'required|integer|min:1'
        ]);

        if ($datos['temperatura'] < 36.0) {
            $datos['mensaje_alerta'] = 'ALERTA: HIPOTERMIA';
        } elseif ($datos['temperatura'] <= 37.5) {
            $datos['mensaje_alerta'] = 'SIGNOS VITALES NORMALES';
        } else {
            $datos['mensaje_alerta'] = 'ALERTA: FIEBRE / DERIVAR';
        }

        $registro->update($datos);

        return response()->json($registro, 200);
    }

    public function destroy(string $id)
    {
        $registro = RegistroTriaje::find($id);

        if (!$registro) {
            return response()->json(['mensaje' => 'Registro no encontrado'], 404);
        }

        $registro->delete();

        return response()->json(['mensaje' => 'Registro eliminado correctamente'], 200);
    }
}
