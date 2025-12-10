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

        // Cek apakah email terdaftar
        $user = User::where('email', $request->email)->first();
        
        if (!$user) {
            return redirect()->route('login')
                ->with('error', 'Akun belum terdaftar') // PERBAIKAN: tambahkan key 'error'
                ->withInput($request->only('email'));
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('admin.dashboard')
                             ->with('success', 'Anda berhasil masuk!'); // PERBAIKAN: tambahkan key 'success'
        }

        return redirect()->route('login')
                         ->with('error', 'Password salah') // PERBAIKAN: tambahkan key 'error'
                         ->withInput($request->only('email'));
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
        ]);

        $user = $this->create($request->all());

        Auth::login($user);

        return redirect()->route('admin.dashboard')->with('success', 'Great! You have successfully registered.');
    }

    /**
     * Dashboard page.
     */
    public function dashboard()
    {
        if (Auth::check()) {
            return view('dashboard');
        }

        return redirect()->route('login')->with('error', 'Oops! You do not have access.');
    }


    /**
     * Create new user.
     */
    protected function create(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * Logout user.
     */
    public function logout(): RedirectResponse
    {
        Session::flush();
        Auth::logout();

        return redirect()->route('login')->with('success', 'You have logged out successfully.');
    }

    // HALAMAN RESET PASSWORD LANGSUNG
    public function resetPassword()
    {
        return view('auth.reset-password');
    }

    // UPDATE PASSWORD TANPA TOKEN / EMAIL LINK
    public function updatePassword(Request $request)
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

        return redirect('/login')->with('success', 'Password berhasil direset!');
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