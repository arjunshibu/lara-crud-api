<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // post /users/signup
    public function signup(Request $request) {
        $request->validate([
            'name' => ['required', 'max:50'],
            'username' => ['required', 'unique:users', 'max:50'],
            'email' => ['required', 'email', 'unique:users', 'max:50'],
            'password' => ['required', 'max:30']
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        return response($user, 201);
    }

    // post /users/login
    public function login(Request $request) {
        $request->validate([
            'email' => ['required', 'email', 'max:50'],
            'password' => ['required', 'max:30']
        ]);

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Login failed'
            ], 401);
        }

        $user = User::where('email', $request->email)->first();

        $authToken = $user->createToken('authToken')->plainTextToken;
        return response()->json([
            'auth_token' => $authToken
        ]);
    }

    // get /users/logout
    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Revoked current session token'
        ]);
    }

    // get /users/logout/all
    public function logoutAll(Request $request) {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Revoked all session tokens'
        ]);
    }
}