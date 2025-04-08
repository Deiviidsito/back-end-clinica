<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    // Registro metodo
    public function register(Request $request)
    {
        // Validación de los datos recibidos
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|min:3|max:255',
            'lastname'  => 'required|string|min:3|max:255',
            'rut'       => 'required|string|max:255|unique:users',
            'phone'     => 'required|string|size:12',
            'email'     => 'required|string|email|max:255|unique:users',
            'password'  => 'required|string|min:6|confirmed',
        ]);
    
        // Retornar error si la validación falla
        if ($validator->fails()) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Validation error',
                'errors'  => $validator->errors(),
            ], 422);
        }
    
        // Asignar rol por defecto (2 = paciente)
        $roleId = 2;
    
        // Crear nuevo usuario
        $user = User::create([
            'name'     => $request->name,
            'lastname' => $request->lastname,
            'rut'      => $request->rut,
            'phone'    => $request->phone,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'role_id'  => $roleId,
        ]);
    
        // Retornar respuesta exitosa
        return response()->json([
            'status'  => 'success',
            'message' => 'User registered successfully',
            'data'    => $user,
        ], 201);
    }
    

    // Login metodo
    public function login(Request $request)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'email'    => 'required|string|email|max:255',
            'password' => 'required|string|size:6',
        ]);
    
        // Si la validación falla, devolver un error
        if ($validator->fails()) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Validation error',
                'errors'  => $validator->errors(),
            ], 422);
        }
    
        // Obtener las credenciales del request
        $credentials = $request->only('email', 'password');
    
        try {
            // Intentar autenticar y generar token JWT
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Invalid credentials',
                ], 401);
            }
    
            // Obtener usuario autenticado
            $user = JWTAuth::user();
    
            // Respuesta exitosa con token y datos del usuario
            return response()->json([
                'status'  => 'success',
                'message' => 'Login successful',
                'data'    => [
                    'user'  => $user,
                    'token' => $token,
                ],
            ], 200);
    
        } catch (\Exception $e) {
            // Captura de errores inesperados
            return response()->json([
                'status'  => 'error',
                'message' => 'Login failed',
                'errors'  => $e->getMessage(),
            ], 500);
        }
    }
    

    // Obtener el usuario autenticado
    public function getUser()
    {
        // Obtener el usuario autenticado
        $user = JWTAuth::user();
    
        // Validar si el usuario está autenticado
        if (!$user) {
            return response()->json([
                'status'  => 'error',
                'message' => 'User not authenticated',
            ], 401);
        }
    
        // Retornar datos del usuario autenticado
        return response()->json([
            'status'  => 'success',
            'message' => 'User authenticated successfully',
            'data'    => $user,
        ], 200);
    }
    

    // Logout metodo
    public function logout()
    {
        try {
            // Invalidar el token actual
            JWTAuth::invalidate(JWTAuth::getToken());
    
            return response()->json([
                'status'  => 'success',
                'message' => 'Logout exitoso.',
            ], 200);
    
        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Error al cerrar sesión.',
                'errors'  => $e->getMessage(),
            ], 500);
        }
    }
    
    
}
