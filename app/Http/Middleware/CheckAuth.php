<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {


        if(!session()->has('usuario')){
            return redirect()->route('loginForm')->with('error', 'Debes iniciar sesión para acceder a esta página');
        }

        error_log("hola desde el middleware");
        return $next($request);
    }
}
