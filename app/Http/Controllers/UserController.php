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
        $users = User::with('role')->oldest()->paginate(10);
        $userCount = User::count();

        $administratorCount = User::whereHas('role', function ($query) {
            $query->where('nama_role', 'administrator');
        })->count();

        $adminCount = User::whereHas('role', function ($query) {
            $query->where('nama_role', 'admin');
        })->count();

        $siswaCount = User::whereHas('role', function ($query) {
            $query->where('nama_role', 'siswa');
        })->count();

        $roles = Role::all();
        $kelas = Kelas::all();
        $jurusans = Jurusan::all();
        $rencanas = Rencana::all();

        return view('admin.pages.user', [
            'user' => Auth::user(),
            'userCount' => $userCount,
            'administratorCount' => $administratorCount,
            'adminCount' => $adminCount,
            'siswaCount' => $siswaCount,
            'aktivitas' => User::latest()->get(),
            'users' => $users,
            'roles' => $roles,
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

    public function edit(User $user)
    {
        $roles = Role::all();
        $kelas = Kelas::all();
        $jurusans = Jurusan::all();
        $rencanas = Rencana::all();
        $siswa = $user->role->nama_role === 'Siswa' ? $user->siswa : null;

        return view('admin.user.edit', compact('user', 'roles', 'kelas', 'jurusans', 'rencanas', 'siswa'));
    }

    public function update(Request $request, User $user)
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

    public function resetPassword(Request $request, User $user)
    {
        if ($request->reset_type === 'default') {
            $newPassword = '12345678';
        } else {
            $validated = $request->validate([
                'password' => 'required|confirmed|min:6',
            ]);
            $newPassword = $validated['password'];
        }

        $user->update([
            'password' => Hash::make($newPassword),
        ]);

        return redirect()->route('admin.user.edit',$user->id)->with('success', 'password berhasil direset');
    }
}
