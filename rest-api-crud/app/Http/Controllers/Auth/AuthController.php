<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;

class AuthController extends Controller
{
    /**
     * Register a new user.
     */
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);


        /* 
         * Assigning a role to user assuming drivers are signing up here
         */
        $user->assignRole('driver');

        return response()->json([
            'message' => 'User registered successfully.',
        ], 200);
    }

    /**
     * Login the user.
     */
    public function login(LoginRequest $request)
    {
        // Validate incoming request
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Attempt login with email and password
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            $token = $user->createToken(name: env('APP_NAME'))->plainTextToken;

            return response()->json([
                'message' => 'Login successful.',
                'token' => $token,
            ], 200);
        }

        // If authentication fails
        return response()->json([
            'message' => 'Invalid credentials.',
        ], 401);
    }

    /**
     * Logout the user.
     */
    public function logout(Request $request)
    {
        $request->user()->tokens->delete();

        return response()->json([
            'message' => 'Logged out successfully.',
        ], 200);
    }
}