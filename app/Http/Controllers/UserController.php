<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function login()
    { 
        $credentials = $request->only('email', 'password');
        if (auth()->attempt($credentials)) {
            $user = auth()->user();
            $token = $user->createToken('authToken')->plainTextToken;
            return response()->json([
                'message' => 'Login successful',
                'user' => $user,
                'token' => $token,
            ]);
        }
        return response()->json(['message' => 'Invalid credentials'], 401);
    }
}
