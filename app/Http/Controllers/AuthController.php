<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Mostrar formulario de login
    public function loginForm()
    {
        return Inertia::render('Login');
    }

    // Procesar el login
    public function login(Request $request)
    {
        $request->validate([
            'nombre_usuario' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('user', $request->nombre_usuario)->first();

        if (!$user) {
            return back()->withErrors(['nombre_usuario' => 'Usuario no encontrado'])->onlyInput('nombre_usuario');
        }

        if ($user->password !== $request->password) {
            return back()->withErrors(['password' => 'Contraseña incorrecta'])->onlyInput('nombre_usuario');
        }
        
        // Autenticación exitosa
        session(['usuario' => $user]);

        return redirect()->route('formulario');
    }

    // Cerrar sesión
    public function logout()
    {
        session()->forget('usuario');
        return redirect()->route('login');
    }
}