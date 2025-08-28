<?php

namespace App\Http\Controllers;

use App\Models\KategoriMinat;
use App\Models\ProfesiKategori;
use App\Models\ProfesiKerja;
use Illuminate\Http\Request;

class ProfesiKategoriController extends Controller
{
    public function index()
    {
        $relations = ProfesiKerja::with('kategoriMinats')->whereHas('kategoriMinats')->get();

        $relasiCount = ProfesiKategori::count();

        $profesiCount = ProfesiKategori::distinct('profesi_kerja_id')->count('profesi_kerja_id');
        $kategoriMinatCount = ProfesiKategori::distinct('kategori_minat_id')->count('kategori_minat_id');

        $allRelations = ProfesiKategori::with(['profesiKerja', 'kategoriMinat'])->get();

        $profesiKategori = $allRelations->groupBy(fn($relasi) => $relasi->profesiKerja->nama_profesi_kerja ?? '-')->map->count();

        $kategoriProfesi = $allRelations->groupBy(fn($relasi) => $relasi->kategoriMinat->nama_kategori ?? '-')->map->count();

        $profesis = ProfesiKerja::all();
        $kategoriMinats = KategoriMinat::all();

        $filterOptions = ProfesiKategori::with('kategoriMinat')
            ->get()
            ->map(fn($relasi) => [
                'label' => $relasi->kategoriMinat->nama_kategori,
                'value' => strtolower($relasi->kategoriMinat->nama_kategori)
            ])
            ->unique('value')
            ->sortBy('label')
            ->values()
            ->toArray();

        return view('admin.pages.profesi-kategori', [
            'relations' => $relations,
            'relasiCount' => $relasiCount,
            'profesiCount' => $profesiCount,
            'kategoriMinatCount' => $kategoriMinatCount,
            'allRelations' => $allRelations,
            'profesiKategori' => $profesiKategori,
            'kategoriProfesi' => $kategoriProfesi,
            'profesis' => $profesis,
            'kategoriMinats' => $kategoriMinats,
            'filterOptions' => $filterOptions,
        ]);
    }

    public function create()
    {
        $profesis = ProfesiKerja::all();
        $kategoriMinats = KategoriMinat::all();

        return view('admin.kenali_profesi.profesi_kategori.create', compact('profesis', 'kategoriMinats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'profesi_kerja_id' => 'required|exists:profesi_kerjas,id',
            'kategori_minat_id' => 'required|exists:kategori_minats,id',
        ]);

        $profesi = ProfesiKerja::findOrFail($request->profesi_kerja_id);

        // tambahkan relasi tanpa menghapus yang lama
        $profesi->kategoriMinats()->syncWithoutDetaching([$request->kategori_minat_id]);

        return redirect()->route('admin.kenali-profesi.profesi-kategori.index')->with('success', 'Relasi profesi - kategori minat berhasil ditambahkan');
    }

    public function show($id)
    {
        $profesiKategori = ProfesiKategori::with(['profesiKerja', 'kategoriMinat'])->findOrFail($id);

        return view('admin.kenali_profesi.profesi_kategori.show', compact('profesiKategori'));
    }

    public function edit($id)
    {
        $profesiKategori = ProfesiKategori::findOrFail($id);
        $profesis = ProfesiKerja::all();
        $kategoriMinats = KategoriMinat::all();
        return view('admin.kenali_profesi.profesi_kategori.edit', compact('profesiKategori', 'profesis', 'kategoriMinats'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'profesi_kerja_id' => 'required|exists:profesi_kerjas,id',
            'kategori_minat_id' => 'required|exists:kategori_minats,id',
        ]);

        $pivot = ProfesiKategori::findOrFail($id);
        $pivot->update([
            'profesi_kerja_id' => $request->profesi_kerja_id,
            'kategori_minat_id' => $request->pkategori_minat_id,
        ]);

        return redirect()->route('admin.kenali-profesi.profesi-kategori.index')->with('success', 'Relasi profesi - kategori minat berhasil diperbarui');
    }

    public function destroy($id)
    {
        $profesiKategori = ProfesiKategori::findOrFail($id);
        $profesiKategori->delete();

        return redirect()->route('admin.kenali-profesi.profesi-kategori.index')->with('success', 'Relasi profesi - kategori minat berhasil dihapus');
    }
}
