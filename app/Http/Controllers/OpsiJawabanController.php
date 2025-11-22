<?php

namespace App\Http\Controllers;

use App\Models\SoalTes;
use App\Models\OpsiJawaban;
use App\Models\ProfesiKerja;
use Illuminate\Http\Request;
use App\Models\KategoriMinat;

class OpsiJawabanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $opsiJawaban = OpsiJawaban::oldest()->paginate(10);
        $opsiJawabanCount = OpsiJawaban::count();
        $allOpsiJawaban = OpsiJawaban::all();

        $filterOptions = SoalTes::select('id', 'isi_pertanyaan')
            ->distinct()
            ->orderBy('isi_pertanyaan', 'asc')
            ->get()
            ->map(fn($soal) => [
                'label' => $soal->isi_pertanyaan,
                'value' => $soal->isi_pertanyaan,
            ])
            ->toArray();

        return view('admin.pages.opsi-jawaban', [
            'opsiJawaban' => $opsiJawaban,
            'opsiJawabanCount' => $opsiJawabanCount,
            'allOpsiJawaban' => $allOpsiJawaban,
            'filterOptions' => $filterOptions,
        ]);
    }

    public function getDropdownData()
    {
        return [
            'soalTesList' => SoalTes::all(),
            'profesiKerjaList' => ProfesiKerja::all(),
            'kategoriMinatList'=> KategoriMinat::all(),
        ];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $data = $this->getDropdownData();
        $selectedSoalTesId = $request->get('soal_tes_id');

        return view('admin.kenali_profesi.opsi_jawaban.create', array_merge(
            $data,
            compact('selectedSoalTesId')
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'soal_tes_id' => 'required|exists:soal_tes,id',
            'isi_opsi.*' => 'required|string',
        ]);

        $soalTes = SoalTes::findOrFail($request->soal_tes_id);

        $kategoriIds = is_array($request->kategori_minat_id) ? $request->kategori_minat_id : [$request->kategori_minat_id];
        $profesiIds  = is_array($request->profesi_kerja_id) ? $request->profesi_kerja_id : [$request->profesi_kerja_id];

        if ($soalTes->jenis_soal === 'single') {
            $request->validate([
                'kategori_minat_id.*' => 'required|exists:kategori_minats,id',
            ]);

            foreach ($request->isi_opsi as $i => $opsi) {
                $kategoriId = $request->kategori_minat_id[$i] ?? null;
                if ($kategoriId) {
                    OpsiJawaban::create([
                        'soal_tes_id'       => $soalTes->id,
                        'kategori_minat_id' => $kategoriId,
                        'profesi_kerja_id'  => null,
                        'isi_opsi'          => $opsi,
                    ]);
                }
            }
        } else {
            $request->validate([
                'profesi_kerja_id' => 'required|exists:profesi_kerjas,id',
            ]);

            foreach ($request->isi_opsi as $i => $opsi) {
                $profesiId = $profesiIds[$i] ?? null;

                if ($profesiId) {
                    OpsiJawaban::create([
                        'soal_tes_id'       => $soalTes->id,
                        'profesi_kerja_id'  => $profesiId,
                        'kategori_minat_id' => null,
                        'isi_opsi'          => $opsi,
                    ]);
                }
            }
        }

        return redirect()->route('admin.kenali-profesi.opsi-jawaban.index')->with('success', 'Opsi Jawaban berhasil ditambahkan');
    }

    private function findOpsiJawaban($id)
    {
        return OpsiJawaban::findOrFail($id);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $opsiJawaban = OpsiJawaban::with(['soalTes.tes', 'kategoriMinat.profesiKerjas', 'profesiKerja'])->findOrFail($id);
        return view('admin.kenali_profesi.opsi_jawaban.show', compact('opsiJawaban'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $opsiJawaban = $this->findOpsiJawaban($id);

        return view('admin.kenali_profesi.opsi_jawaban.edit', array_merge(
            compact('opsiJawaban'),
            $this->getDropdownData()
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'soal_tes_id' => 'required|exists:soal_tes,id',
            'isi_opsi' => 'required|string',
        ]);

        $opsiJawaban = $this->findOpsiJawaban($id);
        $soalTes = SoalTes::findOrFail($request->soal_tes_id);

        if ($soalTes->jenis_soal === 'single') {
            $request->validate([
                'kategori_minat_id' => 'required|exists:kategori_minats,id',
            ]);

            $opsiJawaban->update([
                'soal_tes_id'       => $soalTes->id,
                'kategori_minat_id' => $request->kategori_minat_id,
                'profesi_kerja_id'  => null,
                'isi_opsi'          => $request->isi_opsi,
            ]);
        } else {
            $request->validate([
                'profesi_kerja_id' => 'required|exists:profesi_kerjas,id',
            ]);

            $opsiJawaban->update([
                'soal_tes_id'       => $soalTes->id,
                'profesi_kerja_id'  => $request->profesi_kerja_id,
                'kategori_minat_id' => null,
                'isi_opsi'          => $request->isi_opsi,
            ]);
        }

        return redirect()->route('admin.kenali-profesi.opsi-jawaban.index')->with('success', 'Opsi Jawaban berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $opsiJawaban = $this->findOpsiJawaban($id);
        $opsiJawaban->delete();

        return redirect()->route('admin.kenali-profesi.opsi-jawaban.index')->with('success', 'Opsi Jawaban berhasil dihapus');
    }
}
