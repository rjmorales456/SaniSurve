<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;
use Validator;

class AuthController extends Controller
{ 
    public function login(Request $request)
    {
        
        $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string',
        'remember' => 'boolean'
        ]);

        $credentials = request(['email','password']);
        if(!Auth::attempt($credentials))
        {
        return response()->json([
            'message' => 'Unauthorized'
        ],401);
        }

        $rememberToken = null;

        $user = $request->user()->makeVisible('id', 'email', 'first_name', 'last_name', 'role', 'contact_number');
       
         if ($request->remember) {
            $rememberToken = Str::random(60);
            $user->setRememberToken($rememberToken);
            $user->save();
        }

        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->plainTextToken;

        return response()->json([
            
            'user' => $user,
            'accessToken' =>$token,
            'rememberToken' => $rememberToken,
            'token_type' => 'Bearer',
        ]);
    }

    public function logout(Request $request)
    {
        // Revoke all of the user's access tokens
        $request->user()->tokens()->delete();
        return response()->json([
            'message' => 'Successfully logged out'
            ]);
        }    

        public function createUser(Request $request)
        {
            // Check if the current user is an admin
            if ($request->user()->role !== 1) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }
        
            // Validate the incoming request data for creating a new user
            $request->validate([
                'email' => 'required|string|email|unique:users',
                'password' => 'required|string',
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'contact_number' => 'required|string',
                // Add other necessary validation rules
            ]);
        
            // Create the new user
            $user = User::create($request->all());

            return response()->json(['message' => 'User created successfully', 'user' => $user]);
        }
        

}

    
