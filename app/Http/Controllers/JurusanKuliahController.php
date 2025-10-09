<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\JurusanKuliah;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class JurusanKuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jurusanKuliahs = JurusanKuliah::oldest()->paginate(10);
        $jurusanKuliahCount = JurusanKuliah::count();
        $allJurusanKuliah = JurusanKuliah::all();

        $user = Auth::user();
        $userCount = User::count();

        return view('admin.pages.jurusan-kuliah', [
            'jurusanKuliahs' => $jurusanKuliahs,
            'jurusanKuliahCount' => $jurusanKuliahCount,
            'allJurusanKuliah' => $allJurusanKuliah,
            'user' => $user,
            'userCount' => $userCount,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.eksplorasi_kuliah.jurusan_kuliah.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_jurusan_kuliah' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'required|string',
            'info_matkul' => 'required|string',
            'info_prospek' => 'required|string',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('jurusanKuliah', 'public');
        }

        JurusanKuliah::create($data);

        return redirect()->route('admin.eksplorasi-jurusan.jurusan-kuliah.index')->with('success', 'Jurusan Kuliah berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $jurusanKuliah = JurusanKuliah::findOrFail($id);
        return view('admin.eksplorasi_kuliah.jurusan_kuliah.show', compact('jurusanKuliah'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $jurusanKuliah = JurusanKuliah::findOrFail($id);
        return view('admin.eksplorasi_kuliah.jurusan_kuliah.edit', compact('jurusanKuliah'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_jurusan_kuliah' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'required|string',
            'info_matkul' => 'required|string',
            'info_prospek' => 'required|string',
        ]);

        $jurusanKuliah = JurusanKuliah::findOrFail($id);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            if ($jurusanKuliah->gambar) {
                Storage::disk('public')->delete($jurusanKuliah->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('jurusanKuliah', 'public');
        }

        $jurusanKuliah->update($data);

        return redirect()->route('admin.eksplorasi-jurusan.jurusan-kuliah.index')->with('success', 'Jurusan Kuliah berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $jurusanKuliah = JurusanKuliah::findOrFail($id);
        if ($jurusanKuliah->gambar) {
            Storage::disk('public')->delete($jurusanKuliah->gambar);
        }
        $jurusanKuliah->delete();

        return redirect()->route('admin.eksplorasi-jurusan.jurusan-kuliah.index')->with('success', 'Jurusan Kuliah berhasil dihapus');
    }
}
