<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\Credentials;

class UserController extends Controller
{   
    public function index()
    {
        return response()->json(User::all());
    }

    public function login(Request $request) 
    {
        $credentials = User::where('email', $request->email)->first();

        try {
            if(!$credentials || !Hash::check($request->password, $credentials->password)) {
                throw new Exception('Invalid credentials');
            }
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 401);
        }
         // Automatically assign roles: admin = 0, regular user = 1
        if ($credentials) {
            $credentials->role = $credentials->role ? 0 : 1; 
            $credentials->save();
        }
        
        if($credentials && Hash::check($request->password, $credentials->password)) {
            $token = $credentials->createToken('personal-token')->plainTextToken;
            return response()->json([
                'token' => $token,
                'data' => $credentials
            ]);
        }
    }

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'mimes:jpeg,png,jpg,gif|max:10240',
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'contact' => 'required',
            'role' => 'required|in:0,1', // 0 for admin, 1 for regular user
            'password' => 'required',
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('images','public');
            $validatedData['image'] = $path;
        }

        $user = User::create($validatedData);
        // Hash the email credentials
        Mail::to($validatedData['email'])->send(new Credentials($user->id, $user->name));

        return response()->json([
            'message' => 'User created successfully',
            'user' => $user,
        ], 201);
    }
    
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'contact' => 'required',
            'role' => 'required|in:0,1', // 0 for admin, 1 for regular user
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('images','public');
            $validatedData['image'] = $path;
        }

        $user = User::find($request->id);
        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }
        
        $user->update($validatedData);

        return response()->json([
            'message' => 'User updated successfully',
            'user' => $user,
        ]);
    }
    public function delete(Request $request)
    {
        $user = User::find($request->id);
        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }
        
        $user->delete();

        return response()->json([
            'message' => 'User deleted successfully',
        ]);
    }
    public function logout(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }
        
        $user->tokens()->delete();

        return response()->json([
            'message' => 'User logged out successfully',
        ]);
    }

}
