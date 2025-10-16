<?php

namespace App\Http\Controllers\Auth;
use Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use PharIo\Manifest\AuthorCollection;

class AuthController extends Auth
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

        error_log('Intento de login con datos: ' . json_encode($request->all()));
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('name', $request->name)->first();

        if (!$user) {
            error_log('Usuario no encontrado: ' . $request->name);
            return back()->withErrors(['credentials' => 'Usuario no encontrado']);
        }

        if (!Hash::check($request->password, $user->password)) {
            error_log('Contraseña incorrecta para el usuario: ' . $request->name);
            return back()->withErrors(['credentials' => 'Contraseña incorrecta']);
        }
        
        // Autenticación exitosa
        session(['usuario' => $user]);
        error_log("Usuario autenticado: " . $user->name);

        return redirect()->route('form')->with('success', 'Has iniciado sesión correctamente');
    }

    // Cerrar sesión
    public function logout()
    {
        session()->forget('usuario');
        return redirect()->route('loginForm');
    }
}