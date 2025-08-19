<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Materi;
use App\Models\TopikMateri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MateriController extends Controller
{
    public function index()
    {
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
            'tipe_file' => 'required|in:pdf,img,video',
            'file_materi' => 'required',
        ]);

        $uploadedFiles = [];
        if ($request->hasFile('file_materi')) {
            foreach ($request->file('file_materi') as $file) {
                $ext = strtolower($file->getClientOriginalExtension());
                if ($request->tipe_file === 'pdf' && $ext !== 'pdf') {
                    return back()->withErrors(['file_materi'=>'Semua file harus PDF']);
                }
                if ($request->tipe_file === 'img' && !in_array($ext,['jpg','jpeg','png','gif'])) {
                    return back()->withErrors(['file_materi'=>'Semua file harus gambar']);
                }
                if ($request->tipe_file === 'video' && !in_array($ext,['mp4','avi','mov','mkv'])) {
                    return back()->withErrors(['file_materi'=>'Semua file harus video']);
                }
                $uploadedFiles[] = $file->store('materi_files','public');
            }
        }

        Materi::create([
            'topik_materi_id'=>$request->topik_materi_id,
            'nama_materi'=>$request->nama_materi,
            'deskripsi_materi'=>$request->deskripsi_materi,
            'tipe_file'=>$request->tipe_file,
            'file_materi'=>json_encode($uploadedFiles),
        ]);

        return redirect()->route('admin.materi.index')->with('success', 'Materi berhasil ditambahkan');
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
            'tipe_file' => 'required|in:pdf,img,video',
            'file_materi' => 'required',
        ]);

        $materi = Materi::findOrFail($id);

        $uploadedFiles = json_decode($materi->file_materi,true) ?: [];
        if ($request->hasFile('file_materi')) {
            foreach ($request->file('file_materi') as $file) {
                $uploadedFiles[] = $file->store('materi_files','public');
            }
        }

        $materi->update([
            'topik_materi_id'=>$request->topik_materi_id,
            'nama_materi'=>$request->nama_materi,
            'deskripsi_materi'=>$request->deskripsi_materi,
            'tipe_file'=>$request->tipe_file,
            'file_materi'=>json_encode($uploadedFiles),
        ]);

        return redirect()->route('admin.materi.index')->with('success', 'materi berhasil diupdate');
    }

    public function destroy($id)
    {
        $materi = Materi::findOrFail($id);
        $materi->delete();

        return redirect()->route('admin.materi.index')->with('success', 'materi berhasil dihapus');
    }
}
