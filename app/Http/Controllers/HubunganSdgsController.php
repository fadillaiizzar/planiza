<?php

namespace App\Http\Controllers;

use App\Models\HubunganSdgs;
use App\Models\KategoriSdgs;
use App\Models\ProfesiKerja;
use Illuminate\Http\Request;
use App\Models\JurusanKuliah;

class HubunganSdgsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua relasi SDGs beserta relasinya
        $relations = HubunganSdgs::with(['kategoriSdgs', 'profesiKerja', 'jurusanKuliah'])
            ->whereHas('kategoriSdgs')
            ->get();

        // Count total relasi
        $relasiCount = HubunganSdgs::count();

        // Count distinct kategori, profesi, jurusan
        $kategoriCount = HubunganSdgs::distinct('kategori_sdgs_id')->count('kategori_sdgs_id');
        $profesiCount = HubunganSdgs::distinct('profesi_kerja_id')->count('profesi_kerja_id');
        $jurusanCount = HubunganSdgs::distinct('jurusan_kuliah_id')->count('jurusan_kuliah_id');

        // Ambil semua relasi lengkap untuk statistik grouping
        $allRelations = HubunganSdgs::with(['kategoriSdgs', 'profesiKerja', 'jurusanKuliah'])->get();

        // Statistik: jumlah profesi per kategori
        $profesiPerKategori = $allRelations
            ->groupBy(fn($r) => $r->kategoriSdgs->nomor_kategori . ' - ' . $r->kategoriSdgs->nama_kategori)
            ->map(function ($group) {
                $profesi = $group
                    ->pluck('profesiKerja.nama_profesi_kerja')
                    ->filter()
                    ->unique()
                    ->values();

                return [
                    'count' => $profesi->count(),
                    'names' => $profesi
                ];
            });

        // Statistik: jumlah jurusan per kategori
        $jurusanPerKategori = $allRelations
            ->groupBy(fn($r) => $r->kategoriSdgs->nomor_kategori . ' - ' . $r->kategoriSdgs->nama_kategori)
            ->map(function ($group) {
                $jurusan = $group
                    ->pluck('jurusanKuliah.nama_jurusan_kuliah')
                    ->filter()
                    ->unique()
                    ->values();

            return [
                'count' => $jurusan->count(),
                'names' => $jurusan
            ];
            });

        // Ambil semua kategori, profesi, jurusan
        $kategoriSdgs = KategoriSdgs::all();
        $profesis = ProfesiKerja::all();
        $jurusans = JurusanKuliah::all();

        // Filter dropdown (berdasarkan profesi — sama seperti industri-profesi)
        $filterOptions = HubunganSdgs::with('profesiKerja')
            ->get()
            ->map(fn($relasi) => [
                'label' => $relasi->profesiKerja->nama_profesi_kerja ?? '-',
                'value' => strtolower($relasi->profesiKerja->nama_profesi_kerja ?? '-')
            ])
            ->unique('value')
            ->sortBy('label')
            ->values()
            ->toArray();

        return view('admin.sdgs.hubungan_sdgs.hubungan-sdgs', compact('relations', 'relasiCount', 'kategoriCount', 'profesiCount', 'jurusanCount', 'allRelations', 'profesiPerKategori', 'jurusanPerKategori', 'kategoriSdgs', 'profesis', 'jurusans', 'filterOptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoriSdgs = KategoriSdgs::all();
        $profesis = ProfesiKerja::all();
        $jurusans = JurusanKuliah::all();

        return view('admin.sdgs.hubungan_sdgs.create', compact( 'kategoriSdgs', 'profesis', 'jurusans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori_sdgs_id' => 'required|exists:kategori_sdgs,id',
            'profesi_kerja_id' => 'nullable|array',
            'profesi_kerja_id.*' => 'nullable|exists:profesi_kerjas,id',
            'jurusan_kuliah_id' => 'nullable|array',
            'jurusan_kuliah_id.*' => 'nullable|exists:jurusan_kuliahs,id',
        ]);

        $profesiIds = $request->profesi_kerja_id ?? [];
        $jurusanIds = $request->jurusan_kuliah_id ?? [];

        if (empty($profesiIds) && empty($jurusanIds)) {
            return redirect()->back()
            ->withInput()
            ->withErrors(['profesi_kerja_id' => 'Pilih minimal 1 Profesi atau 1 Jurusan'])
            ->with('openCreateModal', true);
        }

        // Hitung jumlah maksimum iterasi (profesi yang lebih banyak)
        $max = max(count($profesiIds), count($jurusanIds));

        for ($i = 0; $i < $max; $i++) {

            $profesi = $profesiIds[$i] ?? null;   // jika profesi habis → null
            $jurusan = $jurusanIds[$i] ?? null;   // jika jurusan habis → null

            // jangan simpan kalau dua-duanya null
            if ($profesi === null && $jurusan === null) {
                continue;
            }

            HubunganSdgs::create([
                'kategori_sdgs_id' => $request->kategori_sdgs_id,
                'profesi_kerja_id' => $profesi,
                'jurusan_kuliah_id' => $jurusan,
            ]);
        }

        return redirect()->route('admin.sdgs.hubungan-sdgs.index')->with('success', 'Relasi Hubungan SDGs berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $hubunganSdgs = HubunganSdgs::with(['kategoriSdgs', 'profesiKerja', 'jurusanKuliah'])->findOrFail($id);

        return view('admin.sdgs.hubungan_sdgs.show', compact('hubunganSdgs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $hubungan = HubunganSdgs::findOrFail($id);

        $kategoriSdgs = KategoriSdgs::all();
        $profesis = ProfesiKerja::all();
        $jurusans = JurusanKuliah::all();

        return view('admin.sdgs.hubungan_sdgs.edit', compact('hubungan', 'kategoriSdgs', 'profesis', 'jurusans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori_sdgs_id' => 'required|exists:kategori_sdgs,id',
            'profesi_kerja_id' => 'nullable|exists:profesi_kerjas,id',
            'jurusan_kuliah_id' => 'nullable|exists:jurusan_kuliahs,id',
        ]);

        if (!$request->profesi_kerja_id && !$request->jurusan_kuliah_id) {
            return back()->withErrors('Pilih minimal 1 Profesi atau 1 Jurusan');
        }

        $hubungan = HubunganSdgs::findOrFail($id);

        $hubungan->update([
            'kategori_sdgs_id' => $request->kategori_sdgs_id,
            'profesi_kerja_id' => $request->profesi_kerja_id,
            'jurusan_kuliah_id' => $request->jurusan_kuliah_id,
        ]);

        return redirect()->route('admin.sdgs.hubungan-sdgs.index')->with('success', 'Relasi Hubungan SDGs berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $hubunganSdgs = HubunganSdgs::findOrFail($id);
        $hubunganSdgs->delete();

        return redirect()->route('admin.sdgs.hubungan-sdgs.index')->with('success', 'Relasi Hubungan SDGs berhasil dihapus');
    }
}
