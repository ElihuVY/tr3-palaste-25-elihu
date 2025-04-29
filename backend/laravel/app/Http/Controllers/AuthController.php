<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Mail\WelcomeMail;
use App\Notifications\WelcomeNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\App;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'message' => 'Login exitoso',
                'user' => $user,
                'token' => $token,
            ], 200);
        }

        return response()->json([
            'message' => 'Credenciales incorrectas',
        ], 401);
    }


    public function register(Request $request){
        try{
        $request->validate([ 
            'name' => 'required|string|max:255', 
            'email' => 'required|string|email|max:255|unique:users', 
            'password' => 'required|string|min:8|confirmed', 
            
        ]); 
        
        $user = User::create([ 
            'name' => $request->name, 
            'email' => $request->email, 
            'password' => Hash::make($request->password), 
        ]); 
        
        $token = $user->createToken('auth_token')->plainTextToken; 
        $user->update(['personal_access_token' => $token]);
        Mail::to($user->email)->send(new WelcomeMail($user));
        
        return response()->json([ 
            'message' => 'Usuario registrado exitosamente',
            'user' => $user, 
            'token' => $token 
        ]); 
    } catch(Exception $e){
        error_log($e->getMessage());
    }

}

    
public function showLoginForm()
{
    return view('auth.login');
}



    public function logout(Request $request) 
 { 
     $request->user()->tokens()->delete(); 
 
     return response()->json(['message' => 'Sesión cerrada correctamente']); 
 }

 public function user(Request $request)
    {
        return response()->json($request->user());
    }


    public function cambiarContrasena(Request $request)
    {
       $usuario = $request->user();
       if (!Hash::check($request->contrasena_actual, $usuario->password)) {
           return response()->json(['mensaje' => 'La contraseña actual es incorrecta.'], 403);
       }

       $usuario->update(['password' => Hash::make($request->nueva_contrasena)]);
       return response()->json(['mensaje' => 'Contraseña actualizada correctamente.'], 200);
    }

}