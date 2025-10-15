<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class FormController extends Controller
{
    public function index()
    {
        return Inertia::render('Formulario', [
            'usuario' => session('usuario')
        ]);
    }
}
