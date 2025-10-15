<?php

namespace App\Http\Controllers;

use App\Models\Hobi;
use App\Models\JurusanKuliah;
use App\Models\HobiJurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class HobiJurusanController extends Controller
{
    private function clearHobiJurusanCache()
    {
        Cache::forget('hobi_jurusan_stats');
        Cache::forget('jurusan_per_hobi');
        Cache::forget('hobi_per_jurusan');
        Cache::forget('filterOptions');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $relations = Hobi::with('jurusanKuliahs')->whereHas('jurusanKuliahs')->paginate(50);

        $stats = Cache::remember('hobi_jurusan_stats', 3600, function () {
            return HobiJurusan::selectRaw('
                COUNT(*) as total_relasi,
                COUNT(DISTINCT hobi_id) as total_hobi,
                COUNT(DISTINCT jurusan_kuliah_id) as total_jurusan
            ')->first();
        });

        $allRelations = HobiJurusan::with([
            'hobi:id,nama_hobi',
            'jurusanKuliah:id,nama_jurusan_kuliah'
        ])->paginate(50);

        $jurusanPerHobi = Cache::remember('jurusan_per_hobi', 3600, function () {
            return HobiJurusan::join('hobis', 'hobis.id', '=', 'hobi_jurusans.hobi_id')
                ->select('hobis.nama_hobi', DB::raw('COUNT(*) as total'))
                ->groupBy('hobis.nama_hobi')
                ->pluck('total', 'nama_hobi');
        });

        $hobiPerJurusan = Cache::remember('hobi_per_jurusan', 3600, function () {
            return HobiJurusan::join('jurusan_kuliahs', 'jurusan_kuliahs.id', '=', 'hobi_jurusans.jurusan_kuliah_id')
                ->select('jurusan_kuliahs.nama_jurusan_kuliah', DB::raw('COUNT(*) as total'))
                ->groupBy('jurusan_kuliahs.nama_jurusan_kuliah')
                ->pluck('total', 'nama_jurusan_kuliah');
        });

        $hobis = Cache::remember('hobi_list', 3600, fn() =>
            Hobi::select('id', 'nama_hobi')->orderBy('nama_hobi')->get()
        );

        $jurusanKuliahs = Cache::remember('jurusan_list', 3600, fn() =>
            JurusanKuliah::select('id', 'nama_jurusan_kuliah')->orderBy('nama_jurusan_kuliah')->get()
        );

        $filterOptions = Cache::remember('filterOptions', 3600, function() {
            return HobiJurusan::join('jurusan_kuliahs', 'hobi_jurusans.jurusan_kuliah_id', '=', 'jurusan_kuliahs.id')
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

        return view('admin.kenali_jurusan.hobi_jurusan.hobi-jurusan', [
            'relations' => $relations,
            'relasiCount' => $stats->total_relasi,
            'jurusanCount' => $stats->total_jurusan,
            'hobiCount' => $stats->total_hobi,
            'allRelations' => $allRelations,
            'jurusanPerHobi' => $jurusanPerHobi,
            'hobiPerJurusan' => $hobiPerJurusan,
            'hobis' => $hobis,
            'jurusanKuliahs' => $jurusanKuliahs,
            'filterOptions' => $filterOptions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hobis = Hobi::select('id', 'nama_hobi')->orderBy('nama_hobi')->get();
        $jurusanKuliahs = JurusanKuliah::select('id', 'nama_jurusan_kuliah')->orderBy('nama_jurusan_kuliah')->get();

        return view('admin.kenali_jurusan.hobi_jurusan.create', compact('hobis', 'jurusanKuliahs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'hobi_id' => 'required|exists:hobis,id',
            'jurusan_kuliah_id' => 'required|exists:jurusan_kuliahs,id',
            'poin' => 'required|integer|min:0|max:100',
        ]);

        HobiJurusan::updateOrCreate(
            [
                'hobi_id' => $request->hobi_id,
                'jurusan_kuliah_id' => $request->jurusan_kuliah_id,
            ],
            [
                'poin' => $request->poin,
            ]
        );

        $this->clearHobiJurusanCache();

        return redirect()->route('admin.kenali-jurusan.hobi-jurusan.index')
            ->with('success', 'Relasi Hobi - Jurusan berhasil ditambahkan');
    }

     /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $hobiJurusan = HobiJurusan::with(['hobi', 'jurusanKuliah'])->findOrFail($id);

        return view('admin.kenali_jurusan.hobi_jurusan.show', compact('hobiJurusan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $hobiJurusan = HobiJurusan::with(['hobi', 'jurusanKuliah'])->findOrFail($id);
        $hobis = Hobi::all();
        $jurusanKuliahs = JurusanKuliah::all();

        return view('admin.kenali_jurusan.hobi_jurusan.edit', compact('hobiJurusan', 'hobis', 'jurusanKuliahs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'hobi_id' => 'required|exists:hobis,id',
            'jurusan_kuliah_id' => 'required|exists:jurusan_kuliahs,id',
            'poin' => 'required|integer|min:0|max:100',
        ]);

        $pivot = HobiJurusan::findOrFail($id);
        $pivot->update([
            'hobi_id' => $request->hobi_id,
            'jurusan_kuliah_id' => $request->jurusan_kuliah_id,
            'poin' => $request->poin,
        ]);

        $this->clearHobiJurusanCache();

        return redirect()->route('admin.kenali-jurusan.hobi-jurusan.index')
            ->with('success', 'Relasi Hobi - Jurusan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $hobiJurusan = HobiJurusan::findOrFail($id);
        $hobiJurusan->delete();

        $this->clearHobiJurusanCache();

        return redirect()->route('admin.kenali-jurusan.hobi-jurusan.index')
            ->with('success', 'Relasi Hobi - Jurusan berhasil dihapus');
    }

    public function checkExists(Request $request)
    {
        $exists = HobiJurusan::where('hobi_id', $request->hobi_id)
            ->where('jurusan_kuliah_id', $request->jurusan_kuliah_id)
            ->exists();

        return response()->json(['exists' => $exists]);
    }
}
