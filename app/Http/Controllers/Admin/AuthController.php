<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        return view("admin.pages.auth.login");
    }

    public function register()
    {
        return view("admin.pages.auth.register");
    }

    public function doLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function doRegister(Request $request)
    {
        try {
            // Log the incoming request
            Log::info('Registration attempt', $request->all());

            // Validate the request
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);

            // Try to create the user
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ]);

            Log::info('User created successfully', ['user_id' => $user->id]);

            // Login the user
            Auth::login($user);

            return redirect('/dashboard')->with('success', 'Account registered successfully!');
        } catch (ValidationException $e) {
            Log::error('Validation failed', [
                'errors' => $e->errors(),
                'request' => $request->all()
            ]);
            throw $e;
        } catch (QueryException $e) {
            Log::error('Database error during registration', [
                'error' => $e->getMessage(),
                'sql' => $e->getSql(),
                'bindings' => $e->getBindings()
            ]);
            return back()
                ->withInput($request->except('password', 'password_confirmation'))
                ->withErrors(['database' => 'Database error occurred. Please try again.']);
        } catch (Exception $e) {
            Log::error('Unexpected error during registration', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()
                ->withInput($request->except('password', 'password_confirmation'))
                ->withErrors(['error' => 'An unexpected error occurred. Please try again.']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
