<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    // Tampilkan form login
    public function index(): View
    {
        return view('auth.login');
    }

    // Tampilkan form registrasi
    public function registration(): View
    {
        return view('auth.registration');
    }

    // Proses login
    public function postLogin(Request $request): RedirectResponse
{
    $request->validate([
        'email'    => 'required|email',
        'password' => 'required',
    ]);

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {

        $request->session()->regenerate();
        $user = Auth::user();

        // Redirect sesuai role
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('user.dashboard');
    }

    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ]);
}


    // Proses registrasi
    public function postRegistration(Request $request): RedirectResponse
    {
        $request->validate([
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|min:6',
            'password_confirmation' => 'required|same:password',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'user', // Semua registrasi default user
        ]);

        Auth::login($user);

        return redirect()->route('beranda')
                         ->with('success', 'Registrasi berhasil! Selamat datang di Toko Berkah Elektronik.');
    }

    // Logout
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('beranda')->with('success', 'Berhasil logout');
    }

    // Form reset password
    public function resetPassword(): View
    {
        return view('auth.reset-password');
    }

    // Update password tanpa token/email
    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'email'                 => 'required|email',
            'password'              => 'required|min:6|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Email tidak ditemukan!');
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('login')->with('success', 'Password berhasil direset! Silakan login dengan password baru.');
    }
}
