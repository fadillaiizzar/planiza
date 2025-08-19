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
        $topikMateris = TopikMateri::with(['kelas', 'jurusan', 'rencana'])->oldest()->paginate(10);

        $topikMaterisCount = TopikMateri::count();

        $kelas = Kelas::all();
        $jurusan = Jurusan::all();
        $rencana = Rencana::all();

        // Data untuk statistik
        $allMateris = TopikMateri::with(['kelas', 'jurusan', 'rencana'])->get();
        $materiPerKelas = $allMateris->groupBy(fn($item) => $item->kelas->nama_kelas ?? '-')->map->count();
        $materiPerJurusan = $allMateris->groupBy(fn($item) => $item->jurusan->nama_jurusan ?? '-')->map->count();
        $materiPerRencana = $allMateris->groupBy(fn($item) => $item->rencana->nama_rencana ?? '-')->map->count();

        $user = Auth::user();
        $userCount = User::count();

       return view('admin.pages.topik', [
            'topikMateris' => $topikMateris,
            'allMateris' => $allMateris,
            'topikMaterisCount' => $topikMaterisCount,
            'materiPerKelas' => $materiPerKelas,
            'materiPerJurusan' => $materiPerJurusan,
            'materiPerRencana' => $materiPerRencana,
            'user' => $user,
            'userCount' => $userCount,

            'kelas' => $kelas,
            'jurusan' => $jurusan,
            'rencana' => $rencana,
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
        return view('admin.materi.topik.create', $this->getDropdownData());
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

        return redirect()->route('admin.topik.materi.index')->with('success', 'topik materi berhasil ditambahkan');
    }

    public function show($id)
    {
        $topik = TopikMateri::with(['kelas', 'jurusan', 'rencana'])->findOrFail($id);
        return view('admin.materi.topik.show', compact('topik'));
    }

    public function edit($id)
    {
        $topik = TopikMateri::findOrFail($id);
        return view('admin.materi.topik.edit', array_merge(
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

        return redirect()->route('admin.topik.materi.index')->with('success', 'topik materi berhasil diupdate');
    }

    public function destroy($id)
    {
        $topik = TopikMateri::findOrFail($id);
        $topik->delete();

        return redirect()->route('admin.topik.materi.index')->with('success', 'topik materi berhasil dihapus');
    }
}
