<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UnidadDocumental;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Configuracion; // 👈 Asegúrate de importar el modelo

class UnidadDocumentalController extends Controller
{
    public function store(Request $request)
    {
        $unidad = UnidadDocumental::create([
            'id_expediente' => $request->id_expediente,
            'tipo' => $request->tipo,
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'archivo' => $request->hasFile('archivo')
                ? $request->file('archivo')->store('documentos', 'public')
                : null
        ]);

        return response()->json($unidad);
    }

    public function storePdfFormulario(Request $request)
    {
        $request->validate([
            'archivo' => 'required|file|mimes:pdf', // max 20MB, ajusta si quieres
            'tipo' => 'required|string',
            'nombre' => 'required|string',
        ]);

        // 1️⃣ Obtener expediente desde configuraciones
        $expedienteId = Configuracion::where('clave', 'expediente_consultas_id')->value('valor');

        if (!$expedienteId) {
            return response()->json(['error' => 'No hay expediente configurado para consultas'], 500);
        }

        // 2️⃣ Guardar el archivo en storage/app/public/documentos
        $path = $request->file('archivo')->store('documentos', 'public');

        // 3️⃣ Crear registro en la tabla unidades_documentales
        $unidad = UnidadDocumental::create([
            'id_expediente' => $expedienteId,
            'tipo' => $request->tipo,
            'nombre' => $request->nombre,
            'descripcion' => null,
            'archivo' => $path, // Guarda la ruta relativa (ejemplo: documentos/abc123.pdf)
        ]);

        return response()->json([
            'message' => 'PDF guardado correctamente',
            'unidad' => $unidad,
            'url' => asset('storage/' . $path)
        ]);
    }
}
