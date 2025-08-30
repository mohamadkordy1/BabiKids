<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RefreshToken;   // <-- make sure you created this model
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:parent,teacher,admin',
        ]);

        $user = \App\Models\User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => $data['role'],
        ]);

        // Create access token (expires in 15 minutes)
        $accessToken = $user->createToken('Token', ['*'], now()->addMinutes(15))->plainTextToken;

        // Create refresh token (valid for 7 days)
        $refreshToken = Str::random(64);
        RefreshToken::create([
            'user_id' => $user->id,
            'token' => hash('sha256', $refreshToken),
            'expires_at' => now()->addDays(7),
        ]);

        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
            'access_token' => $accessToken,
            'refresh_token' => $refreshToken,
        ], 201);
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (!\Auth::attempt($data)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user = \Auth::user();

        // Create access token (expires in 15 minutes)
        $accessToken = $user->createToken('Token', ['*'], now()->addMinutes(15))->plainTextToken;

        // Create refresh token (valid for 7 days)
        $refreshToken = Str::random(64);
        RefreshToken::updateOrCreate(
            ['user_id' => $user->id],
            [
                'token' => hash('sha256', $refreshToken),
                'expires_at' => now()->addDays(7),
            ]
        );

        return response()->json([
            'message' => 'Login successful',
            'user' => $user,
            'access_token' => $accessToken,
            'refresh_token' => $refreshToken,
        ], 200);
    }

    public function refresh(Request $request)
    {
        $request->validate([
            'refresh_token' => 'required|string',
        ]);

        $refreshToken = RefreshToken::where('token', hash('sha256', $request->refresh_token))
            ->where('expires_at', '>', now())
            ->first();

        if (!$refreshToken) {
            return response()->json(['message' => 'Invalid or expired refresh token'], 401);
        }

        $user = $refreshToken->user;

        // Issue a new access token
        $accessToken = $user->createToken('Token', ['*'], now()->addMinutes(15))->plainTextToken;

        return response()->json([
            'access_token' => $accessToken,
        ], 200);
    }

    public function logout(Request $request)
    {
        // Delete access token
        $request->user()->currentAccessToken()->delete();

        // Optionally delete refresh token too
        RefreshToken::where('user_id', $request->user()->id)->delete();

        return response()->json(['message' => 'Logged out successfully'], 200);
    }
}
