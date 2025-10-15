<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginForm()
    {
        return Inertia::render('Login');
    }


    /**
     * @OA\Post(
     *     path="/login",
     *     summary="Iniciar sesión",
     *     description="Verifica las credenciales del usuario y devuelve un token o sesión activa.",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "password"},
     *             @OA\Property(property="name", type="string", example="admin"),
     *             @OA\Property(property="password", type="string", example="123456")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Inicio de sesión exitoso"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Credenciales incorrectas"
     *     )
     * )
     */

    // Procesar el login
    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('user', $request->name)->first();

        if (!$user) {
            return back()->withErrors(['name' => 'Usuario no encontrado'])->onlyInput('name');
        }

        if ($user->password !== $request->password) {
            return back()->withErrors(['password' => 'Contraseña incorrecta'])->onlyInput('name');
        }
        
        // Autenticación exitosa
        session(['usuario' => $user]);

        return redirect()->route('form');
    }

    // Cerrar sesión
    public function logout()
    {
        session()->forget('usuario');
        return redirect()->route('login');
    }
}