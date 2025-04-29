<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    
    public function getUserProfile()
    {
        dd("hola estoy aca");
        return response()->json(Auth::user());
    }
}
