<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Jurusan;
use App\Models\Rencana;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['role', 'siswa.kelas', 'siswa.jurusan', 'siswa.rencana'])->oldest()->paginate(10);
        $userCount = User::count();

        $administratorCount = User::whereHas('role', function ($query) {
            $query->where('nama_role', 'Administrator');
        })->count();

        $adminCount = User::whereHas('role', function ($query) {
            $query->where('nama_role', 'Admin');
        })->count();

        $siswaCount = User::whereHas('role', function ($query) {
            $query->where('nama_role', 'Siswa');
        })->count();

        $roles = Role::all();
        $roleCounts = $roles->mapWithKeys(function($role) {
            return [$role->nama_role => User::where('role_id', $role->id)->count()];
        })->toArray();

        $kelas = Kelas::all();
        $jurusans = Jurusan::all();
        $rencanas = Rencana::all();

        return view('admin.pages.user', [
            'user' => Auth::user(),
            'users' => $users,
            'userCount' => $userCount,
            'administratorCount' => $administratorCount,
            'adminCount' => $adminCount,
            'siswaCount' => $siswaCount,
            'roles' => $roles,
            'roleCounts' => $roleCounts,
            'kelas' => $kelas,
            'jurusans' => $jurusans,
            'rencanas' => $rencanas,
        ]);
    }

    public function create()
    {
        $user = Auth::user();

        if (!$user || !in_array($user->role->nama_role, ['Administrator', 'Admin'])) {
            abort(403);
        }

        $roles = Role::where('nama_role', '!=', 'Administrator')->get();

        return view('auth.register', [
            'user' => $user,
            'roles' => $roles
        ]);
    }

    public function store(Request $request)
    {
        $role = Role::findOrFail($request->role_id);

        if ($role->nama_role === 'Administrator') {
            abort(403, 'Tidak dapat membuat akun Administrator baru');
        }

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

        return redirect()->route('admin.user.index')->with('success', 'Registrasi berhasil');
    }

    public function show($id)
    {
       $detailUser = User::with('role')->findOrFail($id);

        $siswa = null;
        if (strtolower($detailUser->role->nama_role) === 'siswa') {
            $siswa = $detailUser->siswa()->with(['kelas', 'jurusan', 'rencana'])->first();
        }

        return view('admin.user.show', [
            'detailUser' => $detailUser,
            'siswa' => $siswa,
        ]);
    }

    public function edit($id)
    {
        $detailUser = User::with('role','siswa')->findOrFail($id);
        $roles = Role::all();
        $kelas = Kelas::all();
        $jurusans = Jurusan::all();
        $rencanas = Rencana::all();

        $siswa = null;
        if ($detailUser->role && $detailUser->role->nama_role === 'Siswa') {
            $siswa = $detailUser->siswa;
        }

        return view('admin.user.edit', compact(
            'detailUser', 'roles', 'kelas', 'jurusans', 'rencanas', 'siswa'));
    }

    public function update(Request $request, $id)
    {
        $detailUser = User::with('role','siswa')->findOrFail($id);
        $role = Role::findOrFail($request->role_id);

        $rules = [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $detailUser->id,
            'role_id' => 'required|exists:roles,id',
        ];

        if ($role->nama_role === 'Siswa') {
            $rules['kelas_id'] = 'required|exists:kelas,id';
            $rules['jurusan_id'] = 'required|exists:jurusans,id';
            $rules['rencana_id'] = 'nullable|exists:rencanas,id';
            $rules['no_hp'] = 'nullable|string|max:20';
        }

        $validated = $request->validate($rules);

        $detailUser->update([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'role_id' => $validated['role_id'],
        ]);

        if ($role->nama_role === 'Siswa') {
            if ($detailUser->siswa) {
                $detailUser->siswa->update([
                    'kelas_id' => $validated['kelas_id'],
                    'jurusan_id' => $validated['jurusan_id'],
                    'rencana_id' => $validated['rencana_id'] ?? null,
                    'no_hp' => $validated['no_hp'] ?? null,
                ]);
            } else {
                Siswa::create([
                    'user_id' => $detailUser->id,
                    'kelas_id' => $validated['kelas_id'],
                    'jurusan_id' => $validated['jurusan_id'],
                    'rencana_id' => $validated['rencana_id'] ?? null,
                    'no_hp' => $validated['no_hp'] ?? null,
                ]);
            }
        } else {
            if ($detailUser->siswa) $detailUser->siswa->delete();
        }

        return redirect()->route('admin.user.index')->with('success', 'user berhasil diperbarui');
    }

    public function destroy(User $user)
    {
        if ($user->role->nama_role === 'Administrator') {
            return redirect()->back()->with('error', 'Administrator tidak dapat dihapus.');
        }

        if ($user->siswa) {
            $user->siswa->delete();
        }
        $user->delete();

        return redirect()->route('admin.user.index')->with('success', 'User berhasil dihapus');
    }

    public function resetPassword(Request $request, $id)
    {
        $detailUser = User::findOrFail($id);

        if ($request->reset_type === 'default') {
            $newPassword = '12345678';
        } else {
            $validated = $request->validate([
                'password' => 'required|confirmed|min:6',
            ]);
            $newPassword = $validated['password'];
        }

        $detailUser->update([
            'password' => Hash::make($newPassword),
        ]);

        return redirect()->route('admin.user.index')->with('success', 'password berhasil direset');
    }
}
