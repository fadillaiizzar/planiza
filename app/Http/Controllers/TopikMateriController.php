<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Jurusan;
use App\Models\Rencana;
use App\Models\TopikMateri;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class TopikMateriController extends Controller
{
    public function index(Request $request)
    {
       $topikMateris = TopikMateri::with(['kelas', 'jurusan', 'rencana'])
        ->oldest()
        ->paginate(10);

        $topikMaterisCount = TopikMateri::count();

        // Hitung berdasarkan kelas
        $kelasXCount = TopikMateri::whereHas('kelas', function($query) {
            $query->where('nama_kelas', 'X');
        })->count();

        $kelasXICount = TopikMateri::whereHas('kelas', function($query) {
            $query->where('nama_kelas', 'XI');
        })->count();

        $kelasXIICount = TopikMateri::whereHas('kelas', function($query) {
            $query->where('nama_kelas', 'XII');
        })->count();

        $kelasXIIICount = TopikMateri::whereHas('kelas', function($query) {
            $query->where('nama_kelas', 'XIII');
        })->count();

        // Hitung berdasarkan jurusan
        $jurusanTKRCount = TopikMateri::whereHas('jurusan', function($query) {
            $query->where('nama_jurusan', 'TKR');
        })->count();

        $jurusanSIJACount = TopikMateri::whereHas('jurusan', function($query) {
            $query->where('nama_jurusan', 'SIJA');
        })->count();

        $jurusanTAVCount = TopikMateri::whereHas('jurusan', function($query) {
            $query->where('nama_jurusan', 'TAV');
        })->count();

        $jurusanTITLCount = TopikMateri::whereHas('jurusan', function($query) {
            $query->where('nama_jurusan', 'TITL');
        })->count();

        $jurusanTPCount = TopikMateri::whereHas('jurusan', function($query) {
            $query->where('nama_jurusan', 'TP');
        })->count();

        $jurusanDPIBCount = TopikMateri::whereHas('jurusan', function($query) {
            $query->where('nama_jurusan', 'DPIB');
        })->count();

        $jurusanKGSPCount = TopikMateri::whereHas('jurusan', function($query) {
            $query->where('nama_jurusan', 'KGSP');
        })->count();

        $jurusanDKVCount = TopikMateri::whereHas('jurusan', function($query) {
            $query->where('nama_jurusan', 'DKV');
        })->count();

        $jurusanGEOCount = TopikMateri::whereHas('jurusan', function($query) {
            $query->where('nama_jurusan', 'GEO');
        })->count();

        // Hitung berdasarkan rencana
        $rencanaKuliahCount = TopikMateri::whereHas('rencana', function($query) {
            $query->where('nama_rencana', 'Kuliah');
        })->count();

        $rencanaKerjaCount = TopikMateri::whereHas('rencana', function($query) {
            $query->where('nama_rencana', 'Kerja');
        })->count();

        // Data untuk statistik
        $allMateris = TopikMateri::with(['kelas', 'jurusan', 'rencana'])->get();
        $materiPerKelas = $allMateris->groupBy(fn($item) => $item->kelas->nama_kelas ?? '-')->map->count();
        $materiPerJurusan = $allMateris->groupBy(fn($item) => $item->jurusan->nama_jurusan ?? '-')->map->count();
        $materiPerRencana = $allMateris->groupBy(fn($item) => $item->rencana->nama_rencana ?? '-')->map->count();

        $user = Auth::user();
        $userCount = User::count();

       return view('admin.pages.materi', [
            'topikMateris' => $topikMateris,
            'allMateris' => $allMateris,
            'topikMaterisCount' => $topikMaterisCount,
            'materiPerKelas' => $materiPerKelas,
            'materiPerJurusan' => $materiPerJurusan,
            'materiPerRencana' => $materiPerRencana,
            'user' => $user,
            'userCount' => $userCount,

            // Count berdasarkan kelas
            'kelasXCount' => $kelasXCount,
            'kelasXICount' => $kelasXICount,
            'kelasXIICount' => $kelasXIICount,
            'kelasXIIICount' => $kelasXIIICount,

            // Count berdasarkan jurusan
            'jurusanTKRCount' => $jurusanTKRCount,
            'jurusanSIJACount' => $jurusanSIJACount,
            'jurusanTAVCount' => $jurusanTAVCount,
            'jurusanTITLCount' => $jurusanTITLCount,
            'jurusanTPCount' => $jurusanTPCount,
            'jurusanDPIBCount' => $jurusanDPIBCount,
            'jurusanKGSPCount' => $jurusanKGSPCount,
            'jurusanDKVCount' => $jurusanDKVCount,
            'jurusanGEOCount' => $jurusanGEOCount,

            // Count berdasarkan rencana
            'rencanaKuliahCount' => $rencanaKuliahCount,
            'rencanaKerjaCount' => $rencanaKerjaCount,
        ]);
    }

    private function getDropdownData()
    {
        return [
            'kelasList' => Kelas::all(),
            'jurusanList' => Jurusan::all(),
            'rencanaList' => Rencana::all(),
        ];
    }

    public function create()
    {
        return view('admin.materi.create', $this->getDropdownData());
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_topik' => 'required|string|max:255',
            'kelas_id' => 'required|exists:kelas,id',
            'jurusan_id' => 'required|exists:jurusans,id',
            'rencana_id' => 'required|exists:rencanas,id',
        ]);

        TopikMateri::create($request->all());

        return redirect()->route('admin.materi.index')->with('success', 'topik materi berhasil ditambahkan');
    }

    public function show($id)
    {
        $topik = TopikMateri::findOrFail($id);
        return view('admin.materi.show', compact('topik'));
    }

    public function edit($id)
    {
        $topik = TopikMateri::findOrFail($id);
        return view('admin.materi.edit', array_merge(
            compact('topik'),
            $this->getDropdownData()
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul_topik' => 'required|string|max:255',
            'kelas_id' => 'required|exists:kelas,id',
            'jurusan_id' => 'required|exists:jurusans,id',
            'rencana_id' => 'required|exists:rencanas,id',
        ]);

        $topik = TopikMateri::findOrFail($id);
        $topik->update($request->all());

        return redirect()->route('admin.materi.index')->with('success', 'topik materi berhasil diupdate');
    }

    public function destroy($id)
    {
        $topik = TopikMateri::findOrFail($id);
        $topik->delete();

        return redirect()->route('admin.materi.index')->with('success', 'topik materi berhasil dihapus');
    }
}
