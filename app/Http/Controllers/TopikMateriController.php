<?php

namespace App\Http\Controllers;

use App\Models\TopikMateri;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class TopikMateriController extends Controller
{
    public function index()
    {
        // Ambil semua topik materi dengan relasi yang diperlukan
        $topikMateris = TopikMateri::with(['kelas', 'jurusan', 'rencana'])->get();

        // Hitung materi per kelas (nama kelas => jumlah materi)
        $materiPerKelas = $topikMateris->groupBy(fn($item) => $item->kelas->nama_kelas ?? '-')->map->count();

        // Hitung materi per jurusan (nama jurusan => jumlah materi)
        $materiPerJurusan = $topikMateris->groupBy(fn($item) => $item->jurusan->nama_jurusan ?? '-')->map->count();

        // Total materi
        $materiCount = $topikMateris->count();

        $user = Auth::user();

        // Jumlah user (jika diperlukan)
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

    public function create()
    {
        return view('admin.materi.create');
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

        return redirect()->route('topik-materi.index')->with('success', 'topik materi berhasil ditambahkan');
    }

    public function show($id)
    {
        $topik = TopikMateri::findOrFail($id);
        return view('admin.materi.show', compact('topik'));
    }

    public function edit($id)
    {
        $topik = TopikMateri::findOrFail($id);
        return view('admin.materi.edit', compact('topik'));
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

        return redirect()->route('topik-materi.index')->with('success', 'topik materi berhasil diupdate');
    }

    public function destroy($id)
    {
        $topik = TopikMateri::findOrFail($id);
        $topik->delete();

        return redirect()->route('topik-materi.index')->with('success', 'topik materi berhasil dihapus');
    }
}
