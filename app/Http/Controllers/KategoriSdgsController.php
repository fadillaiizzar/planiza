<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\KategoriSdgs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KategoriSdgsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoriSdgs = KategoriSdgs::orderBy('nomor_kategori')->paginate(10);
        $kategoriSdgsCount = $kategoriSdgs->total();
        $allKategoriSdgs = KategoriSdgs::select('id', 'nama_kategori')->get();

        $user = Auth::user();
        $userCount = User::count();

        $filterOptions = [];

        return view('admin.sdgs.kategori_sdgs.kategori-sdgs', compact(
            'kategoriSdgs', 'kategoriSdgsCount', 'allKategoriSdgs', 'user', 'userCount', 'filterOptions'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sdgs.kategori_sdgs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomor_kategori' => 'required|integer|min:1|max:17|unique:kategori_sdgs,nomor_kategori',
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        KategoriSdgs::create($request->all());

        return redirect()->route('admin.sdgs.kategori-sdgs.index')->with('success', 'Kategori SDGs berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $kategoriSdgs = KategoriSdgs::findOrFail($id);
        return view('admin.sdgs.kategori_sdgs.show', compact('kategoriSdgs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kategoriSdgs = KategoriSdgs::findOrFail($id);
        return view('admin.sdgs.kategori_sdgs.edit', compact('kategoriSdgs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nomor_kategori' => 'required|integer|min:1|max:17|unique:kategori_sdgs,nomor_kategori,' . $id,
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        $kategoriSdgs = KategoriSdgs::findOrFail($id);
        $kategoriSdgs->update($request->all());

        return redirect()->route('admin.sdgs.kategori-sdgs.index')->with('success', 'Kategori SDGs berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kategoriSdgs = KategoriSdgs::findOrFail($id);
        $kategoriSdgs->delete();

        return redirect()->route('admin.sdgs.kategori-sdgs.index')->with('success', 'Kategori SDGs berhasil dihapus');
    }
}
