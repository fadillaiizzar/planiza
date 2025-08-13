<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Materi;
use App\Models\TopikMateri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Contracts\Service\Attribute\Required;

class MateriController extends Controller
{
    public function index()
    {
        // Ambil data materi dengan relasi topikMateri dan paginasi
        $materis = Materi::with(['topikMateri'])->oldest()->paginate(10);

        $materisCount = Materi::count();

        $allMateris = Materi::with(['topikMateri.kelas', 'topikMateri.jurusan', 'topikMateri.rencana'])->get();

        $materiPerKelas = $allMateris
            ->groupBy(fn($item) => $item->topikMateri->kelas->nama_kelas ?? '-')
            ->map->count();

        $materiPerJurusan = $allMateris
            ->groupBy(fn($item) => $item->topikMateri->jurusan->nama_jurusan ?? '-')
            ->map->count();

        $materiPerRencana = $allMateris
            ->groupBy(fn($item) => $item->topikMateri->rencana->nama_rencana ?? '-')
            ->map->count();

        $user = Auth::user();
        $userCount = User::count();

        $filterOptions = TopikMateri::select('judul_topik')
        ->distinct()
        ->orderBy('judul_topik', 'asc')
        ->get()
        ->map(fn($topik) => [
            'label' => $topik->judul_topik,
            'value' => $topik->judul_topik
        ])
        ->toArray();

        $topikMateriList = TopikMateri::all();

        return view('admin.pages.materi', [
            'materis' => $materis,
            'materisCount' => $materisCount,
            'allMateris' => $allMateris,
            'materiPerKelas' => $materiPerKelas,
            'materiPerJurusan' => $materiPerJurusan,
            'materiPerRencana' => $materiPerRencana,
            'user' => $user,
            'userCount' => $userCount,
            'filterOptions' => $filterOptions,
            'aktivitas' => Materi::latest()->get(),
            'topikMateriList' => $topikMateriList,
        ]);
    }

    public function getDropdownData()
    {
        return [
            'topikMateriList' => TopikMateri::all(),
        ];
    }

    public function create()
    {
        return view('admin.materi.materi.create', $this->getDropdownData());
    }

    public function store(Request $request)
    {
        $request->validate([
            'topik_materi_id' => 'required|exists:topik_materis,id',
            'nama_materi' => 'required|string|max:255',
            'deskripsi_materi' => 'required|string',
            'tipe_file' => 'required|string|max:20',
            'file_materi' => 'required|string|max:255',
        ]);

        Materi::create($request->all());

        return redirect()->route('admin.materi.index')->with('success', 'materi berhasil ditambahkan');
    }

    public function show($id)
    {
        $materi = Materi::findOrFail($id);
        return view('admin.materi.materi.show', compact('materi'));
    }

    public function edit($id)
    {
        $materi = Materi::findOrFail($id);
        return view('admin.materi.materi.edit', array_merge(
            compact('materi'),
            $this->getDropdownData()
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'topik_materi_id' => 'required|exists:topik_materis,id',
            'nama_materi' => 'required|string|max:255',
            'deskripsi_materi' => 'required|string',
            'tipe_file' => 'required|string|max:20',
            'file_materi' => 'required|string|max:255',
        ]);

        $materi = Materi::findOrFail($id);
        $materi->update($request->all());

        return redirect()->route('admin.materi.index')->with('success', 'materi berhasil diupdate');
    }

    public function destroy($id)
    {
        $materi = Materi::findOrFail($id);
        $materi->delete();

        return redirect()->route('admin.materi.index')->with('success', 'materi berhasil dihapus');
    }
}
