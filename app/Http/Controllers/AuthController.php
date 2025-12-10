<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    /**
     * Show login form.
     */
    public function index(): View
    {
        return view('auth.login');
    }

    /**
     * Show registration form.
     */
    public function registration(): View
    {
        return view('auth.registration');
    }

    /**
     * Handle login request.
     */
    public function postLogin(Request $request): RedirectResponse
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        
        $user = Auth::user();
        
        if ($user->role === 'admin') {
            // Admin -> dashboard admin
            return redirect()->route('admin.dashboard');
        } else {
            // User biasa -> dashboard pembeli
            return redirect()->route('user.dashboard');
        }
    }

    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ]);
}


    /**
     * Handle registration request.
     */
    public function postRegistration(Request $request): RedirectResponse
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'password_confirmation' => 'required|same:password',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'user',
    ]);

    Auth::login($user);

    // Registrasi selalu user, arahkan ke beranda
    return redirect()->route('beranda')
                    ->with('success', 'Registrasi berhasil! Selamat datang di Toko Berkah Elektronik.');
}

    /**
     * Logout user.
     */
    public function logout(Request $request)
{
    auth()->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('beranda')->with('success', 'Berhasil logout');
}


    // HALAMAN RESET PASSWORD LANGSUNG
    public function resetPassword(): View
    {
        return view('auth.reset-password');
    }

    // UPDATE PASSWORD TANPA TOKEN / EMAIL LINK
    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Email tidak ditemukan!');
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect('/login')->with('success', 'Password berhasil direset! Silakan login dengan password baru.');
    }

    public function checkAccount(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $userExists = User::where('email', $request->email)->exists();
        
        return response()->json([
            'exists' => $userExists
        ]);
    }
}