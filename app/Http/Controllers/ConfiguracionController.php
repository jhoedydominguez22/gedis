<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Expediente;

class ConfiguracionController extends Controller
{
    public function getExpedienteActivo()
    {
        $config = DB::table('configuraciones')
            ->where('clave', 'expediente_consultas_id')
            ->first();

        return response()->json([
            'valor' => $config->valor ?? null
        ]);
    }

    public function setExpedienteActivo(Request $request)
    {
        $request->validate([
            'expediente_id' => 'required|integer|exists:expedientes,id'
        ]);

        DB::table('configuraciones')->updateOrInsert(
            ['clave' => 'expediente_consultas_id'],
            ['valor' => $request->expediente_id, 'updated_at' => now()]
        );

        return response()->json(['message' => 'Expediente activo actualizado']);
    }

        
    public function obtenerexpedientes()
    {
        // Si quieres todos los expedientes sin filtro:
        return response()->json(Expediente::all());
    }
}
