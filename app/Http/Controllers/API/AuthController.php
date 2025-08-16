<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class AuthController extends Controller
{
public function register(Request $request)
    {
        // Validate the request data
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:parent,teacher,admin', // Example roles
        ]);
        
        // Create the user
        $user = \App\Models\User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => $data['role'],
        ]);
        $token = $user->createToken('Token')->plainTextToken;




        // Return a response
        return response()->json(['message' => 'User registered successfully', 'user' => $user,'token'=>$token], 201);
    }

public function login(Request $request)
    {
        // Validate the request data
        $data = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Attempt to authenticate the user
        if (!\Auth::attempt($data)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        // Get the authenticated user
        $user = \Auth::user();
        $token = $user->createToken('Token')->plainTextToken;

        // Return a response
        return response()->json(['message' => 'Login successful', 'user' => $user, 'token' => $token], 200);
    }
public function logout(Request $request)
    {
        // Revoke the user's token
        $request->user()->currentAccessToken()->delete();

        // Return a response
        return response()->json(['message' => 'Logged out successfully'], 200);
    }

}
