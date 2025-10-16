<?php

namespace App\Http\Controllers\Records;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Proyecto;
use App\Models\Bloque;
use App\Models\Pieza;
use App\Models\Registro;
use Illuminate\Support\Facades\Auth;

class FormController extends Controller
{
    /**
     * Mostrar el formulario con los proyectos
     */
    public function index()
    {

        $projects = Proyecto::all(); // Trae todos los proyectos

        return Inertia::render('Form', [
            'usuario' => Auth::user(),           // usuario logueado
            'projects' => $projects
        ]);
    }

    /**
     * Guardar un registro
     */
    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:proyectos,IDPROYECTO',
            'block_id' => 'required|exists:bloques,IDBLOQUE',
            'piece_id' => 'required|exists:piezas,id',
            'real_weight' => 'required|numeric',
        ]);

        // Obtener la pieza
        $piece = Pieza::findOrFail($request->piece_id);

        // Calcular diferencia
        $difference = $request->real_weight - $piece->peso_teorico;

        // Crear registro
        Registro::create([
            'proyecto_id'   => $request->project_id,
            'bloque_id'     => $request->block_id,
            'pieza_id'      => $request->piece_id,
            'peso_real'     => $request->real_weight,
            'diferencia'    => $difference,
            'registrado_en' => now(),
            'user_id'       => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Registro guardado correctamente');
    }

    /**
     * Obtener bloques de un proyecto (AJAX)
     */
    public function blocks($projectId)
    {
        $bloques = Bloque::where('proyecto_id', $projectId)->get(['IDBLOQUE as id', 'nombre']);
        return response()->json($bloques);
    }

    /**
     * Obtener piezas de un bloque (AJAX)
     */
    public function pieces($blockId)
    {
        $piezas = Pieza::where('bloque_id', $blockId)
                        ->where('estado', 'Pendiente')
                        ->get(['id', 'codigo as name', 'peso_teorico']);
        return response()->json($piezas);
    }
}
