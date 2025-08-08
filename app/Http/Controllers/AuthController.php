<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Kelas;
use App\Models\Jurusan;
use App\Models\Rencana;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

        return back()->with('error', 'Username atau password salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function showRegister()
    {
        $user = Auth::user();

        if (!$user || $user->role->nama_role !== 'Admin') {
            abort(403);
        }

        $roles = Role::all();
        $kelas = Kelas::all();
        $jurusans = Jurusan::all();
        $rencanas = Rencana::all();
        return view('auth.register', compact('roles', 'kelas', 'jurusans', 'rencanas'));
    }

    public function register(Request $request)
    {
        $role = Role::findOrFail($request->role_id);

        $rules = [
            'name' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required|confirmed|min:6',
            'role_id' => 'required|exists:roles,id',
        ];

        if ($role->nama_role === 'Siswa') {
            $rules['kelas_id'] = 'required|exists:kelas,id';
            $rules['jurusan_id'] = 'required|exists:jurusans,id';
            $rules['rencana_id'] = 'nullable|exists:rencanas,id';
            $rules['no_hp'] = 'nullable|string|max:20';
        }

        $validated = $request->validate($rules);

        $user = User::create([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
            'role_id' => $validated['role_id'],
        ]);

        if ($role->nama_role === 'Siswa') {
            Siswa::create([
                'user_id' => $user->id,
                'kelas_id' => $validated['kelas_id'],
                'jurusan_id' => $validated['jurusan_id'],
                'rencana_id' => $validated['rencana_id'] ?? null,
                'no_hp' => $validated['no_hp'] ?? null,
            ]);
        }

        return redirect('/user/pages/admin')->with('success', 'Registrasi berhasil');
    }

    public function redirectByRole()
    {
        $user = Auth::user();

        if ($user->role->nama_role === 'Admin') {
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
