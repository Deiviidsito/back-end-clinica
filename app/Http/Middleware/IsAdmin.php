<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth('api')->user();
    
        // Verificar si el usuario es administrador y si está autenticado
        if ($user && $user->role_id == 1) {
            return $next($request);
        }
    
        return response()->json([
            'status' => false,
            'message' => 'No tienes permisos de administrador para acceder a este recurso',
        ], 403);  // Código de error 403 en lugar de 401
    }
    
}
