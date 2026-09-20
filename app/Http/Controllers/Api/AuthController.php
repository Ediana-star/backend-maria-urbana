<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function setup(Request $request)
    {
        if (User::count() > 0) {
            return response()->json(['message' => 'El sistema ya tiene un administrador configurado.'], 403);
        }

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $user = new User();
        $user->name = 'Administrador';
        $user->email = trim($request->email); // Limpiamos espacios fantasmas
        $user->password = Hash::make(trim($request->password));
        $user->save();

        return response()->json(['message' => '¡Administrador maestro creado con éxito!']);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $emailLimpio = trim($request->email);
        $claveLimpia = trim($request->password);

        // 1. Buscamos el correo exacto
        $user = User::where('email', $emailLimpio)->first();

        if (!$user) {
            return response()->json(['message' => 'Credenciales inválidas. Verificá tu usuario y contraseña.'], 401);
        }

        // 2. Comparamos la contraseña
        if (!Hash::check($claveLimpia, $user->password)) {
            return response()->json(['message' => 'Credenciales inválidas. Verificá tu usuario y contraseña.'], 401);
        }

        // 3. Si todo está perfecto, imprimimos el Token Sanctum
        $token = $user->createToken('admin-token')->plainTextToken;

        return response()->json([
            'message' => 'Login exitoso',
            'token' => $token,
            'user' => $user
        ]);
    }
}
