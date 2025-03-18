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
//use Barryvdh\DomPDF\Facade\Pdf as PDF; 


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
        $request->validate([ 
            'name' => 'required|string|max:255', 
            'email' => 'required|string|email|max:255|unique:users', 
            'password' => 'required|string|min:8', 
            
        ]); 
        
        $user = User::create([ 
            'name' => $request->name, 
            'email' => $request->email, 
            'password' => Hash::make($request->password), 
        ]); 

        Mail::to($user->email)->send(new WelcomeMail($user));

        $token = $user->createToken('auth_token')->plainTextToken; 
    
        

        //$pdf = Pdf::loadView('pdf.user', compact('user'));
        //$pdfContent = $pdf->output(); 

        $user->notify(new WelcomeNotification($user));

        return response()->json([ 
            'user' => $user, 
            'token' => $token 
        ]); 
    }
    public function logout(Request $request) 
 { 
     $request->user()->tokens()->delete(); 
 
     return response()->json(['message' => 'Sesión cerrada correctamente']); 
 }

 /*public function getUserInfo(Request $request)
 {
     $user = Auth::user();
     $infoUsuari = InfoUsuari::where('user_id', $user->id)->first();
 
     //$pdf = PDF::loadView('pdf.user', compact('user', 'infoUsuari'));
     //$pdfContent = $pdf->output();
 
     //$user->notify(new WelcomeNotification($user, $pdfContent));
 
     return response()->json([
         'user' => $user,
         'infoUsuari' => $infoUsuari,
     ]);
 }*/
 


 /*public function setUserInfo(Request $request)
 {
     $request->validate([
         'telefon' => 'required|string|max:20',
         'pais_residencia' => 'required|string|max:255',
     ]);
 
     $user = Auth::user();
 
     $infoUsuari = InfoUsuari::updateOrCreate(
         ['user_id' => $user->id],
         ['telefon' => $request->telefon, 'pais_residencia' => $request->pais_residencia]
     );
 
     $pdf = PDF::loadView('pdf.user', compact('user', 'infoUsuari'));
     $pdfContent = $pdf->output();
 
     $user->notify(new WelcomeNotification($user, $pdfContent));
 
     return response()->json([
         'message' => 'Información actualizada correctamente',
         'infoUsuari' => $infoUsuari,
     ]);
 }*/
 


}