<?php

namespace App\Jawaban;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class NomorSatu {

    public function auth(Request $request) {
        $credentials = $request->validate([
            'username_or_email' => 'required|string',
            'password' => 'required|string',
        ]);

        $loginField = filter_var($credentials['username_or_email'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::attempt([$loginField => $credentials['username_or_email'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
            return redirect()->route('event.home')->with('success', 'Login berhasil!');
        }

        return back()->withErrors(['username_or_email' => 'Email/Username atau Password salah']);
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('event.home')->with('success', 'Logout berhasil!');
    }
}
