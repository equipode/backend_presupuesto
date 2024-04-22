<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Validation\ValidationException;
use App\Models\trabajadores\trabajadores;
use App\Models\users\roles;

class authController extends Controller
{

    public function pruebas()
    {
        return response()->json([
            "ok" => "todo funciona"
        ]);
    }

    public function login(Request $request)
    {

        try {
            $request->validate([
                'email' => 'required|email|min:6',
                'password' => 'required|min:6'
            ]);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

        $credentials = $request->only('email', 'password');

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        $user = auth()->user();
        $user_id = $user->id;
        $foto_usuario = $user->foto_usuario;
        $estado_user = $user->estado_user;
        $rol_user = $user->fk_rol;



        $datosRoles = roles::find($rol_user);
        $nombreRol = $datosRoles->name_rol;
        $tipo_rol = $datosRoles->tipo;
        $horaActual = date('H:i:s');
        $fechaActual = date('Y-m-d');

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 42000,
            'horaActual' => $horaActual,
            'fechaActual' => $fechaActual,
            'user_id' => $user_id,
            'estado_user' => $estado_user,
            'foto_usuario' => $foto_usuario,
            'nombreRol' => $nombreRol,
            'rol' => $rol_user,
            'tipo_rol' => $tipo_rol
        ]);
    }
}
