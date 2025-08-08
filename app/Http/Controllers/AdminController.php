<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\Kelas;
use App\Models\Jurusan;
use App\Models\Rencana;
use App\Models\Siswa;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.pages.dashboard', [
            'user' => Auth::user(),
            'userCount' => User::count(),
            'materiCount' => 23,
            'eksplorasiCount' => 12,
            'aktivitas' => [
                (object)[
                    'created_at' => now()->subMinutes(5),
                    'user' => (object)['name' => 'Dilla'],
                    'aktivitas' => 'Menambahkan materi baru',
                ],
                (object)[
                    'created_at' => now()->subHours(1),
                    'user' => (object)['name' => 'Rina'],
                    'aktivitas' => 'Mengedit eksplorasi',
                ],
                (object)[
                    'created_at' => now()->subDays(1),
                    'user' => (object)['name' => 'Budi'],
                    'aktivitas' => 'Menghapus akun user',
                ],
            ],
        ]);
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

    public function detailUser(User $user)
    {
        $roles = Role::all();
        $siswa = $user->role->nama_role === 'Siswa' ? $user->siswa : null;

        return view('admin.users.detail', compact('user', 'roles', 'siswa'));
    }

    public function updateUser(Request $request, User $user)
    {
        $role = Role::findOrFail($request->role_id);

        $rules = [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'role_id' => 'required|exists:roles,id',
        ];

        if ($role->nama_role === 'Siswa') {
            $rules['kelas_id'] = 'required|exists:kelas,id';
            $rules['jurusan_id'] = 'required|exists:jurusans,id';
            $rules['rencana_id'] = 'nullable|exists:rencanas,id';
            $rules['no_hp'] = 'nullable|string|max:20';
        }

        $validated = $request->validate($rules);

        $user->update([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'role_id' => $validated['role_id'],
        ]);

        if ($role->nama_role === 'Siswa') {
            if ($user->siswa) {
                $user->siswa->update([
                    'kelas_id' => $validated['kelas_id'],
                    'jurusan_id' => $validated['jurusan_id'],
                    'rencana_id' => $validated['rencana_id'] ?? null,
                    'no_hp' => $validated['no_hp'] ?? null,
                ]);
            } else {
                Siswa::create([
                    'user_id' => $user->id,
                    'kelas_id' => $validated['kelas_id'],
                    'jurusan_id' => $validated['jurusan_id'],
                    'rencana_id' => $validated['rencana_id'] ?? null,
                    'no_hp' => $validated['no_hp'] ?? null,
                ]);
            }
        } else {
            if ($user->siswa) $user->siswa->delete();
        }

        return redirect()->route('admin.user')->with('success', 'user berhasil diperbarui');
    }

    public function resetPassword(Request $request, User $user)
    {
        $validated = $request->validate([
            'password' => 'required|confirmed|min:6',
        ]);

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('admin.users.edit', $user->id)->with('success', 'Password berhasil direset');
    }

    public function deleteUser(User $user)
    {
        if ($user->siswa) {
            $user->siswa->delete();
        }
        $user->delete();

        return redirect()->route('admin.user')->with('success', 'User berhasil dihapus');
    }
}
