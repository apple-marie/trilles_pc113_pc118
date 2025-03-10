<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login(Request $request)
{
    try {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'user' => $user,
            'token' => $token,
        ]);
    } catch (Exception $e) {
        return response()->json([
        'message' => 'Error occurred during login', 
        'error' => $e->getMessage(),
    ], 400);
    }
}


    public function create(Request $request)
{
    
    $validatedData = $request->validate([
        'name' => 'required',
        'email' => 'required',
        'password' => 'required',
        'role' => 'required|in:admin,user',
    ]);

    $validatedData['password'] = Hash::make($validatedData['password']);

    $user = User::create($validatedData);

    // mo generate cja ug token after registration
    $token = $user->createToken('authToken')->plainTextToken;

    return response()->json([
        'message' => 'User created successfully',
        'user' => $user,
        'token' => $token,
    ], 201);
}

}
