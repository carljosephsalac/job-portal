<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginUser(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        if (!Auth::attempt($validated)) {
            throw ValidationException::withMessages([
                'email' => 'Wrong Credentials'
            ]);
        }

        $request->session()->regenerate();

        return redirect()->route('job-portals.index');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function registerUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'type' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed'
        ]);

        $hashedPassword = Hash::make($validated['password']);
        $now = now();

        DB::statement("
            INSERT INTO users (name, type, email, password, created_at, updated_at)
            VALUES (?, ?, ?, ?, ?, ?)
        ", [
            $validated['name'],
            $validated['type'],
            $validated['email'],
            $hashedPassword,
            $now,
            $now
        ]);

        $user = DB::selectOne("SELECT * FROM users WHERE email = ?", [$validated['email']]);

        Auth::loginUsingId($user->id);

        $request->session()->regenerate();

        return redirect()->route('job-portals.index');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
