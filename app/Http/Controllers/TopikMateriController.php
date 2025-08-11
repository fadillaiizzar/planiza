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
    public function index()
    {

        $topikMateris = TopikMateri::with(['kelas', 'jurusan', 'rencana'])->get();

        $materiPerKelas = $topikMateris->groupBy(fn($item) => $item->kelas->nama_kelas ?? '-')->map->count();

        $materiPerJurusan = $topikMateris->groupBy(fn($item) => $item->jurusan->nama_jurusan ?? '-')->map->count();

        $materiCount = $topikMateris->count();

        $user = Auth::user();

        $userCount = User::count();

        return view('admin.pages.materi', compact(
            'topikMateris',
            'materiCount',
            'materiPerKelas',
            'materiPerJurusan',
            'user',
            'userCount',
        ));
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
