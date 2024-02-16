<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember'); // Check if "Remember Me" option is selected


        if (Auth::attempt($credentials)) {
            // Authentication successful
            return response()->json(['message' => 'Authenticated']);
        } else {
            // Authentication failed
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    }
}
