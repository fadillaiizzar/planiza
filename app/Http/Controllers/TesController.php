<?php

namespace App\Http\Controllers;

use App\Models\Tes;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class TesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tes =  Tes::oldest()->paginate(10);
        $tesCount = Tes::count();
        $allTes = Tes::all();

        $filterOptions = Tes::select('nama_tes')
            ->distinct()
            ->orderBy('nama_tes', 'asc')
            ->get()
            ->map(fn($tes) => [
                'label' => $tes->nama_tes,
                'value' => $tes->nama_tes
            ])
            ->toArray();

        return view('admin.pages.tes', [
            'tes' => $tes,
            'tesCount' => $tesCount,
            'allTes' => $allTes,
            'filterOptions' => $filterOptions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kenali_profesi.tes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_tes' => 'required|string|max:255',
        ]);

        Tes::create($request->all());

        return redirect()->route('admin.kenali-profesi.tes.index')->with('succes', 'Tes berhasil ditambahkan');
    }

    private function findTes($id)
    {
        return Tes::findOrFail($id);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $tes = Tes::with(['soalTes.opsiJawabans'])->findOrFail($id);
        return view('admin.kenali_profesi.tes.show', compact('tes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tes = $this->findTes($id);
        return view('admin.kenali_profesi.tes.edit', compact('tes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_tes' => 'required|string|max:255',
        ]);

        $tes = $this->findTes($id);
        $tes->update($request->all());

        return redirect()->route('admin.kenali-profesi.tes.index')->with('success', 'Tes berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tes = $this->findTes($id);
        $tes->delete();

        return redirect()->route('admin.kenali-profesi.tes.index')->with('success', 'Tes berhasil dihapus');
    }
}
