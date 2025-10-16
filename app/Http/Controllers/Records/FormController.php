<?php

namespace App\Http\Controllers\Records;

use Auth;
use Inertia\Inertia;
use App\Models\Proyecto;
use App\Models\Bloque;
use App\Models\Pieza;
use App\Models\Registros;

class FormController extends Auth
{
    public function index()
    {
        return Inertia::render('Form', [
            'usuario' => session('usuario')
        ]);
    }

       public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'block_id' => 'required|exists:blocks,id',
            'piece_id' => 'required|exists:pieces,id',
            'real_weight' => 'required|numeric',
        ]);

        $piece = Piezas::findOrFail($request->piece_id);
        $difference = $request->real_weight - $piece->theoretical_weight;

        Registros::create([
            'project_id' => $request->project_id,
            'block_id' => $request->block_id,
            'piece_id' => $request->piece_id,
            'real_weight' => $request->real_weight,
            'difference' => $difference
        ]);

        return redirect()->back()->with('success', 'Registro guardado correctamente');
    }

    // Obtener bloques de un proyecto (AJAX)
    public function blocks($projectId)
    {
        return Bloque::where('project_id', $projectId)->get();
    }

    // Obtener piezas de un bloque (AJAX)
    public function pieces($blockId)
    {
        return Pieza::where('block_id', $blockId)->where('status','Pendiente')->get();
    }
}
