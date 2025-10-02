<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login'); // gunakan view yang sudah ada
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $field = filter_var($data['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $credentials = [$field => $data['login'], 'password' => $data['password']];

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.arsip'));
        }

        return back()->with('error', 'Kredensial tidak valid.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login.form');
    }

    public function showRegisterForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'email'    => 'required|email:rfc,dns|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'prodi'    => 'nullable|string|max:255',
            'nim'      => 'nullable|string|max:50',
        ]);

        // default role (ubah sesuai kebutuhan)
        $data['role'] = 'user';

        // Eloquent akan hash otomatis karena cast 'password' => 'hashed'
        $user = User::create($data);

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
