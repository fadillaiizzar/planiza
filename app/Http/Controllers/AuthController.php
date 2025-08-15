<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('redirect');
        }

        return back()->with('error', 'username atau password salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function redirectByRole()
    {
        $user = Auth::user();

        if (in_array($user->role->nama_role, ['Administrator', 'Admin'])) {
            return redirect('/dashboard/pages/admin');
        } elseif ($user->role->nama_role === 'Siswa') {
            $siswa = $user->siswa;

            if (is_null($siswa->no_hp) || is_null($siswa->rencana)) {
                return redirect('/dashboard/pages/siswa')->with('loginSuccess', true);
            }

            return redirect('/dashboard/pages/siswa');
        } else {
            return redirect('/');
        }
    }
}
