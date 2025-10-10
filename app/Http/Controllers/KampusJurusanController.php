<?php

namespace App\Http\Controllers;

use App\Models\JurusanKuliah;
use App\Models\Kampus;
use Illuminate\Http\Request;
use App\Models\KampusJurusan;

class KampusJurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $relations = Kampus::with('jurusanKuliahs')->whereHas('jurusanKuliahs')->get();

        $relasiCount = KampusJurusan::count();
        $jurusanKuliahCount = KampusJurusan::distinct('jurusan_kuliah_id')->count('jurusan_kuliah_id');
        $kampusCount = KampusJurusan::distinct('kampus_id')->count('kampus_id');

        $allRelations = KampusJurusan::with(['kampus', 'jurusanKuliah'])->get();

        $jurusanPerKampus = $allRelations->groupBy(fn($relasi) => $relasi->kampus->nama_kampus ?? '-')->map->count();
        $kampusPerJurusan = $allRelations->groupBy(fn($relasi) => $relasi->jurusanKuliah->nama_jurusan_kuliah ?? '-')->map->count();

        $kampus = Kampus::all();
        $jurusanKuliahs = JurusanKuliah::all();

        $filterOptions = KampusJurusan::with('jurusanKuliah')
            ->get()
            ->map(fn($relasi) => [
                'label' => $relasi->jurusanKuliah->nama_jurusan_kuliah,
                'value' => strtolower($relasi->jurusanKuliah->nama_jurusan_kuliah)
            ])
            ->unique('value')
            ->sortBy('label')
            ->values()
            ->toArray();

        return view('admin.eksplorasi_kuliah.kampus_jurusan.kampus-jurusan', [
            'relations' => $relations,
            'relasiCount' => $relasiCount,
            'jurusanKuliahCount' => $jurusanKuliahCount,
            'kampusCount' => $kampusCount,
            'allRelations' => $allRelations,
            'jurusanPerKampus' => $jurusanPerKampus,
            'kampusPerJurusan' => $kampusPerJurusan,
            'kampus' => $kampus,
            'jurusanKuliahs' => $jurusanKuliahs,
            'filterOptions' => $filterOptions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kampus = Kampus::all();
        $jurusanKuliahs = JurusanKuliah::all();

        return view('admin.eksplorasi_kuliah.kampus_jurusan.create', compact('kampus', 'jurusanKuliahs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kampus_id' => 'required|exists:kampus,id',
            'jurusan_kuliah_id' => 'required|exists:jurusan_kuliahs,id',
            'passing_grade' => 'required|integer|min:0|max:1000',
        ]);

        KampusJurusan::updateOrCreate(
            [
                'kampus_id' => $request->kampus_id,
                'jurusan_kuliah_id' => $request->jurusan_kuliah_id,
            ],
            [
                'passing_grade' => $request->passing_grade,
            ]
        );

        return redirect()->route('admin.eksplorasi-jurusan.kampus-jurusan.index')
            ->with('success', 'Relasi Kampus - Jurusan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $kampusJurusan = KampusJurusan::with(['kampus', 'jurusanKuliah'])->findOrFail($id);

        return view('admin.eksplorasi_kuliah.kampus_jurusan.show', compact('kampusJurusan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kampusJurusan = KampusJurusan::with(['kampus', 'jurusanKuliah'])->findOrFail($id);
        $kampus = Kampus::all();
        $jurusanKuliahs = JurusanKuliah::all();

        return view('admin.eksplorasi_kuliah.kampus_jurusan.edit', compact('kampusJurusan', 'kampus', 'jurusanKuliahs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'kampus_id' => 'required|exists:kampus,id',
            'jurusan_kuliah_id' => 'required|exists:jurusan_kuliahs,id',
            'passing_grade' => 'required|integer|min:0|max:1000',
        ]);

        $pivot = KampusJurusan::findOrFail($id);
        $pivot->update([
            'kampus_id' => $request->kampus_id,
            'jurusan_kuliah_id' => $request->jurusan_kuliah_id,
            'passing_grade' => $request->passing_grade,
        ]);

        return redirect()->route('admin.eksplorasi-jurusan.kampus-jurusan.index')->with('success', 'Relasi Kampus - Jurusan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kampusJurusan = KampusJurusan::findOrFail($id);
        $kampusJurusan->delete();

        return redirect()->route('admin.eksplorasi-jurusan.kampus-jurusan.index')->with('success', 'Relasi Kampus - Jurusan berhasil dihapus');
    }
}
