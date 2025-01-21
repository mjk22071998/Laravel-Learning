<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;

class AuthenticationController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('authentication.login');
    }

    /**
     * Handle login request.
     */
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if (Auth::attempt($request->only('email', 'password'))) {
                return redirect()->intended(route('/'))->with('success', 'Logged in successfully.');
            }

            return back()->withErrors(['email' => 'Invalid credentials.'])->withInput();
        } catch (Exception $e) {
            // Log the exception
            Log::error('Login Error: ' . $e->getMessage());

            return back()->with('error', 'An unexpected error occurred. Please try again later. Error: ' . $e->getMessage());
        }
    }

    /**
     * Show the registration form.
     */
    public function showRegistrationForm()
    {
        return view('authentication.register');
    }

    /**
     * Handle registration request.
     */
    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8|confirmed',
            ]);

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return redirect()->route('login')->with('success', 'Account created successfully. Please login.');
        } catch (QueryException $qe) {
            // Handle database-related exceptions
            Log::error('Database Error during Registration: ' . $qe->getMessage());

            return back()->with('error', 'A database error occurred. Please try again later. Error: ' . $qe->getMessage());
        } catch (Exception $e) {
            // Log any other unexpected exceptions
            Log::error('Registration Error: ' . $e->getMessage());

            return back()->with('error', 'An unexpected error occurred. Please try again later. Error: ' . $e->getMessage());
        }
    }

    /**
     * Logout the user.
     */
    public function logout()
    {
        try {
            Auth::logout();

            return redirect()->route('login')->with('success', 'Logged out successfully.');
        } catch (Exception $e) {
            // Log the exception
            Log::error('Logout Error: ' . $e->getMessage());

            return back()->with('error', 'An error occurred while logging out. Please try again.');
        }
    }

    /**
     * Show the form to request a password reset link.
     */
    public function showForgotPasswordForm()
    {
        return view('authentication.forgot-password');
    }

    /**
     * Send a password reset link to the given email address.
     */
    public function sendResetLinkEmail(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email|exists:users,email',
            ]);

            $response = Password::sendResetLink(
                $request->only('email')
            );

            if ($response == Password::RESET_LINK_SENT) {
                return back()->with('status', 'We have emailed your password reset link!');
            }

            return back()->withErrors(['email' => 'We could not find an account with that email address.']);
        } catch (Exception $e) {
            // Log the exception
            Log::error('Password Reset Link Error: ' . $e->getMessage());

            return back()->with('error', 'An unexpected error occurred. Please try again later.');
        }
    }

}