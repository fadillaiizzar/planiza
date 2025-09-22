<?php

namespace App\Http\Controllers;

use App\Models\Tes;
use App\Models\SoalTes;
use Illuminate\Http\Request;

class SoalTesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tesList = Tes::withCount('soalTes')->paginate(10);

        $tesCount = Tes::count();

        $filterOptions = Tes::select('nama_tes')
            ->distinct()
            ->orderBy('nama_tes', 'asc')
            ->get()
            ->map(fn($tes) => [
                'label' => $tes->nama_tes,
                'value' => $tes->nama_tes
            ])
            ->toArray();

        return view('admin.pages.soal-tes', [
            'tesList' => $tesList,
            'tesCount' => $tesCount,
            'filterOptions' => $filterOptions,
        ]);
    }

    public function getDropdownData()
    {
        return [
            'tesList' => Tes::all(),
        ];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $data = $this->getDropdownData();
        $selectedTesId = $request->get('tes_id');

        return view('admin.kenali_profesi.soal_tes.create', array_merge(
            $data,
            compact('selectedTesId')
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tes_id' => 'required|exists:tes,id',
            'isi_pertanyaan.*' => 'required|string',
            'jenis_soal.*' => 'required|in:single,multi',
            'max_select.*' => 'nullable|integer|min:1',
        ]);

        foreach ($request->isi_pertanyaan as $i => $pertanyaan) {
            SoalTes::create([
                'tes_id' => $request->tes_id,
                'isi_pertanyaan' => $pertanyaan,
                'jenis_soal' => $request->jenis_soal[$i],
                'max_select' => $request->jenis_soal[$i] === 'single'
                    ? 1
                    : ($request->max_select[$i] ?? null),
            ]);
        }

        return redirect()->route('admin.kenali-profesi.soal-tes.index')->with('success', 'Soal Tes berhasil ditambahkan');
    }

    private function findSoalTes($id)
    {
        return SoalTes::findOrFail($id);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $tes = Tes::with('soalTes.opsiJawabans')->findOrFail($id);
        return view('admin.kenali_profesi.soal_tes.show', compact('tes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $soalTes = $this->findSoalTes($id);

        return view('admin.kenali_profesi.soal_tes.edit', array_merge(
            compact('soalTes'),
            $this->getDropdownData()
    ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tes_id' => 'required|exists:tes,id',
            'isi_pertanyaan' => 'required|string',
            'jenis_soal' => 'required|in:single,multi',
            'max_select' => 'nullable|integer|min:1',
        ]);

        $soalTes = $this->findSoalTes($id);

        $soalTes->update([
            'tes_id' => $request->tes_id,
            'isi_pertanyaan' => $request->isi_pertanyaan,
            'jenis_soal' => $request->jenis_soal,
            'max_select' => $request->jenis_soal === 'single'
                ? 1
                : ($request->max_select ?? null),
        ]);

        return redirect()->route('admin.kenali-profesi.soal-tes.index')->with('success', 'Soal Tes berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $soalTes = $this->findSoalTes($id);
        $soalTes->delete();

        return redirect()->route('admin.kenali-profesi.soal-tes.show')->with('success', 'Soal Tes berhasil dihapus');
    }
}
