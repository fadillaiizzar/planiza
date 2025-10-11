<?php

namespace App\Http\Controllers;

use App\Models\Kampus;
use Illuminate\Http\Request;
use App\Models\JurusanKuliah;
use App\Models\KampusJurusan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class KampusJurusanController extends Controller
{
    private function clearKampusJurusanCache()
    {
        Cache::forget('kampus_jurusan_stats');
        Cache::forget('jurusan_per_kampus');
        Cache::forget('kampus_per_jurusan');
        Cache::forget('filterOptions');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $relations = Kampus::with('jurusanKuliahs')->whereHas('jurusanKuliahs')->paginate(50);

        $stats = Cache::remember('kampus_jurusan_stats', 3600, function () {
            return KampusJurusan::selectRaw('
                COUNT(*) as total_relasi,
                COUNT(DISTINCT kampus_id) as total_kampus,
                COUNT(DISTINCT jurusan_kuliah_id) as total_jurusan
            ')->first();
        });

        $allRelations = KampusJurusan::with([
            'kampus:id,nama_kampus',
            'jurusanKuliah:id,nama_jurusan_kuliah'
        ])->paginate(50);

        $jurusanPerKampus = Cache::remember('jurusan_per_kampus', 3600, function () {
            return KampusJurusan::join('kampus', 'kampus.id', '=', 'kampus_jurusans.kampus_id')
                ->select('kampus.nama_kampus', DB::raw('COUNT(*) as total'))
                ->groupBy('kampus.nama_kampus')
                ->pluck('total', 'nama_kampus');
        });

        $kampusPerJurusan = Cache::remember('kampus_per_jurusan', 3600, function () {
            return KampusJurusan::join('jurusan_kuliahs', 'jurusan_kuliahs.id', '=', 'kampus_jurusans.jurusan_kuliah_id')
                ->select('jurusan_kuliahs.nama_jurusan_kuliah', DB::raw('COUNT(*) as total'))
                ->groupBy('jurusan_kuliahs.nama_jurusan_kuliah')
                ->pluck('total', 'nama_jurusan_kuliah');
        });

        $kampus = Cache::remember('kampus_list', 3600, fn() =>
            Kampus::select('id', 'nama_kampus')->orderBy('nama_kampus')->get()
        );
        
        $jurusanKuliahs = Cache::remember('jurusan_list', 3600, fn() =>
            JurusanKuliah::select('id', 'nama_jurusan_kuliah')->orderBy('nama_jurusan_kuliah')->get()
        );

        $filterOptions = Cache::remember('filterOptions', 3600, function() {
            return KampusJurusan::join('jurusan_kuliahs', 'kampus_jurusans.jurusan_kuliah_id', '=', 'jurusan_kuliahs.id')
                ->select('jurusan_kuliahs.nama_jurusan_kuliah')
                ->distinct()
                ->orderBy('nama_jurusan_kuliah')
                ->get()
                ->map(fn($item) => [
                    'label' => $item->nama_jurusan_kuliah,
                    'value' => strtolower($item->nama_jurusan_kuliah)
                ])
                ->toArray();
            });

        return view('admin.eksplorasi_kuliah.kampus_jurusan.kampus-jurusan', [
            'relations' => $relations,
            'relasiCount' => $stats->total_relasi,
            'jurusanKuliahCount' => $stats->total_jurusan,
            'kampusCount' => $stats->total_kampus,
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
        $kampus = Kampus::select('id', 'nama_kampus')->orderBy('nama_kampus')->get();
        $jurusanKuliahs = JurusanKuliah::select('id', 'nama_jurusan_kuliah')->orderBy('nama_jurusan_kuliah')->get();

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

        $this->clearKampusJurusanCache();

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

        $this->clearKampusJurusanCache();

        return redirect()->route('admin.eksplorasi-jurusan.kampus-jurusan.index')->with('success', 'Relasi Kampus - Jurusan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kampusJurusan = KampusJurusan::findOrFail($id);
        $kampusJurusan->delete();

        $this->clearKampusJurusanCache();

        return redirect()->route('admin.eksplorasi-jurusan.kampus-jurusan.index')->with('success', 'Relasi Kampus - Jurusan berhasil dihapus');
    }

    public function checkExists(Request $request)
    {
        $exists = KampusJurusan::where('kampus_id', $request->kampus_id)
            ->where('jurusan_kuliah_id', $request->jurusan_kuliah_id)
            ->exists();

        return response()->json(['exists' => $exists]);
    }
}
