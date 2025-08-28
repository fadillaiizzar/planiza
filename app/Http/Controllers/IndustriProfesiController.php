<?php

namespace App\Http\Controllers;

use App\Models\Industri;
use App\Models\IndustriProfesi;
use App\Models\ProfesiKerja;
use Illuminate\Http\Request;

class IndustriProfesiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $relations = Industri::with('profesiKerjas')->whereHas('profesiKerjas')->get();

        $relasiCount = IndustriProfesi::count();

        $profesiCount = IndustriProfesi::distinct('profesi_kerja_id')->count('profesi_kerja_id');
        $industriCount = IndustriProfesi::distinct('industri_id')->count('industri_id');

        $allRelations = IndustriProfesi::with(['industri', 'profesiKerja'])->get();

        $profesiPerIndustri = $allRelations->groupBy(fn($relasi) => $relasi->industri->nama_industri ?? '-')->map->count();

        $industriPerProfesi = $allRelations->groupBy(fn($relasi) => $relasi->profesiKerja->nama_profesi_kerja ?? '-')->map->count();

        $industris = Industri::all();
        $profesis = ProfesiKerja::all();

        $filterOptions = IndustriProfesi::with('profesiKerja')
            ->get()
            ->map(fn($relasi) => [
                'label' => $relasi->profesiKerja->nama_profesi_kerja,
                'value' => strtolower($relasi->profesiKerja->nama_profesi_kerja)
            ])
            ->unique('value')
            ->sortBy('label')
            ->values()
            ->toArray();

        return view('admin.pages.industri-profesi', [
            'relations' => $relations,
            'relasiCount' => $relasiCount,
            'profesiCount' => $profesiCount,
            'industriCount' => $industriCount,
            'allRelations' => $allRelations,
            'profesiPerIndustri' => $profesiPerIndustri,
            'industriPerProfesi' => $industriPerProfesi,
            'industris' => $industris,
            'profesis' => $profesis,
            'filterOptions' => $filterOptions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $industris = Industri::all();
        $profesis = ProfesiKerja::all();

        return view('admin.eksplorasi_kerja.industri_profesi.create', compact('industris', 'profesis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'industri_id' => 'required|exists:industris,id',
            'profesi_kerja_id' => 'required|exists:profesi_kerjas,id',
        ]);

        $industri = Industri::findOrFail($request->industri_id);

        // tambahkan relasi tanpa menghapus yang lama
        $industri->profesiKerjas()->syncWithoutDetaching([$request->profesi_kerja_id]);

        return redirect()->route('admin.eksplorasi-profesi.industri-profesi.index')
            ->with('success', 'Relasi industri - profesi berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $industriProfesi = IndustriProfesi::with(['industri', 'profesiKerja'])->findOrFail($id);

        return view('admin.eksplorasi_kerja.industri_profesi.show', compact('industriProfesi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $industriProfesi = IndustriProfesi::findOrFail($id);
        $industris = Industri::all();
        $profesis = ProfesiKerja::all();

        return view('admin.eksplorasi_kerja.industri_profesi.edit', compact('industriProfesi', 'industris', 'profesis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'industri_id' => 'required|exists:industris,id',
            'profesi_kerja_id' => 'required|exists:profesi_kerjas,id',
        ]);

        $pivot = IndustriProfesi::findOrFail($id);
        $pivot->update([
            'industri_id' => $request->industri_id,
            'profesi_kerja_id' => $request->profesi_kerja_id,
        ]);

        return redirect()->route('admin.eksplorasi-profesi.industri-profesi.index')->with('success', 'Relasi industri - profesi berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     * butuh dua ID: industri_id dan profesi_id
     */
    public function destroy($id)
    {
        $industriProfesi = IndustriProfesi::findOrFail($id);
        $industriProfesi->delete();

        return redirect()->route('admin.eksplorasi-profesi.industri-profesi.index')->with('success', 'Relasi industri - profesi berhasil dihapus');
    }
}
