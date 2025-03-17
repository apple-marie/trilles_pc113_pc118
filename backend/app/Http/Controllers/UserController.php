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

public function login(Request $request){
    $credentials = User::where('email', $request->email)->first();

    if($credentials && Hash::check($request->password, $credentials->password)) {
        $token = $credentials->createToken('personal-token')->plainTextToken;
        return response()->json([
            'token' => $token,
            'data' => $credentials
        ]);
    }

}
}
