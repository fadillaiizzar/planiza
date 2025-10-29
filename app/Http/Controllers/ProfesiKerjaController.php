<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ProfesiKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfesiKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profesiKerjas = ProfesiKerja::oldest()->paginate(10);
        $profesiCount = ProfesiKerja::count();
        $allProfesi = ProfesiKerja::all();

        $user = Auth::user();
        $userCount = User::count();

        return view('admin.pages.profesi-kerja', [
            'profesiKerjas' => $profesiKerjas,
            'profesiCount' => $profesiCount,
            'allProfesi' => $allProfesi,
            'user' => $user,
            'userCount' => $userCount,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.eksplorasi_kerja.profesi_kerja.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_profesi_kerja' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'gaji' => 'required|numeric',
            'deskripsi' => 'required|string',
            'info_skill' => 'required|string',
            'info_jurusan' => 'required|string',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('profesi', 'public');
        }

        ProfesiKerja::create($data);

        return redirect()->route('admin.eksplorasi-profesi.profesi-kerja.index')->with('success', 'Profesi Kerja berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $profesi = ProfesiKerja::findOrFail($id);
        return view('admin.eksplorasi_kerja.profesi_kerja.show', compact('profesi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $profesi = ProfesiKerja::findOrFail($id);
        return view('admin.eksplorasi_kerja.profesi_kerja.edit', compact('profesi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_profesi_kerja' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'gaji' => 'required|numeric',
            'deskripsi' => 'required|string',
            'info_skill' => 'required|string',
            'info_jurusan' => 'required|string',
        ]);

        $profesi = ProfesiKerja::findOrFail($id);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            if ($profesi->gambar) {
                Storage::disk('public')->delete($profesi->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('profesi', 'public');
        }

        $profesi->update($data);

        return redirect()->route('admin.eksplorasi-profesi.profesi-kerja.index')->with('success', 'Profesi Kerja berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $profesi = ProfesiKerja::findOrFail($id);
        if ($profesi->gambar) {
            Storage::disk('public')->delete($profesi->gambar);
        }
        $profesi->delete();

        return redirect()->route('admin.eksplorasi-profesi.profesi-kerja.index')->with('success', 'Profesi Kerja berhasil dihapus');
    }
}
