<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Tampilkan Form Register
    public function showRegister()
    {
        return view('auth.register');
    }

    // Proses Register
    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', // confirmed cek field password_confirmation
        ]);

        // Simpan ke Database
        // Catatan: Karena di desain tidak ada input Email, kita buat email dummy otomatis 
        // atau kita anggap username adalah email jika formatnya email.
        // Disini saya buat email otomatis dari username agar tidak error database.

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->username . '@looplife.com', // Dummy email sementara
            'password' => Hash::make($request->password),
        ]);

        // Login otomatis setelah daftar
        Auth::login($user);

        return redirect()->route('home')->with('success', 'Registrasi berhasil!');
    }

    // Tampilkan Form Login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Proses Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Coba login menggunakan username
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ]);
    }

    // Proses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
