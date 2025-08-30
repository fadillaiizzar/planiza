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
        $soalTes = SoalTes::oldest()->paginate(10);
        $soalTesCount = SoalTes::count();
        $allSoalTes = SoalTes::all();
        $tesList = Tes::all();

        return view('admin.pages.soal-tes', [
            'soalTes' => $soalTes,
            'soalTesCount' => $soalTesCount,
            'allSoalTes' => $allSoalTes,
            'tesList' => $tesList,
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
            'isi_pertanyaan' => 'required|string',
            'jenis_soal' => 'required|in:single,multi',
            'max_select' => 'nullable|integer|min:1',
        ]);

        $data = $request->all();

        if($data['jenis_soal'] === 'single') {
            $data['max_Select'] = 1;
        }

        SoalTes::create($data);

         return redirect()->route('admin.kenali-profesi.soal-tes.index')->with('success', 'Soal Tes berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
