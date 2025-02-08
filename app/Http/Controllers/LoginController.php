<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // validate the login request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log in the user
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            // Redirect based on role
            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard');
            }

            if ($user->isMahasiswa()) {
                return redirect()->route('mahasiswa.dashboard');
            }

            if ($user->isDosen()) {
                return redirect()->route('dosen.dashboard');
            }

            // Logout if no valid role
            Auth::logout();
            return back()->withErrors(['email' => 'Anda tidak memiliki akses.']);
        }

        // Invalid credentials
        return back()->withErrors(['email' => 'Email atau password salah.']);
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
