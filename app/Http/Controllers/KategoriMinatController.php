<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\KategoriMinat;
use Illuminate\Support\Facades\Auth;

class KategoriMinatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoriMinats = KategoriMinat::oldest()->paginate(10);
        $kategoriMinatCount = KategoriMinat::count();
        $allKategoriMinat = KategoriMinat::all();

        $user = Auth::user();
        $userCount = User::count();

        $filterOptions = KategoriMinat::select('nama_kategori')
            ->distinct()
            ->orderBy('nama_kategori', 'asc')
            ->get()
            ->map(fn($minat) => [
                'label' => $minat->nama_kategori,
                'value' => $minat->nama_kategori
            ])
            ->toArray();

        return view('admin.pages.kategori-minat', [
            'kategoriMinats' => $kategoriMinats,
            'kategoriMinatCount' => $kategoriMinatCount,
            'allkategoriMinat' => $allKategoriMinat,
            'user' => $user,
            'userCount' => $userCount,
            'filterOptions' => $filterOptions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kenali_profesi.kategori_minat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        KategoriMinat::create($request->all());

        return redirect()->route('admin.kenali-profesi-kerja.kategori-minat.index')->with('success', 'kategori minat berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $kategoriMinat = KategoriMinat::findOrFail($id);
        return view('admin.kenali_profesi.kategori_minat.show', compact('kategoriMinat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kategoriMinat = KategoriMinat::findOrFail($id);
        return view('admin.kenali_profesi.kategori_minat.edit', compact('kategoriMinat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        $kategoriMinat = KategoriMinat::findOrFail($id);
        $kategoriMinat->update($request->all());

        return redirect()->route('admin.kenali-profesi-kerja.kategori-minat.index')->with('success', 'kategori minat berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategoriMinat = KategoriMinat::findOrFail($id);
        $kategoriMinat->delete();

        return redirect()->route('admin.kenali-profesi-kerja.kategori-minat.index')->with('success', 'kategori minat berhasil dihapus');
    }
}
