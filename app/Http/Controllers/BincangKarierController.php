<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BincangKarier;
use Illuminate\Support\Facades\Auth;

class BincangKarierController extends Controller
{
    public function index()
    {
        $bincangKarier = BincangKarier::with('user')
            ->withCount('tanggapanKarier')
            ->oldest()
            ->paginate(10);
        return view('admin.pages.bincang-karier', compact('bincangKarier'));
    }

    public function show($id)
    {
        $bincangKarier = BincangKarier::with(['user', 'tanggapanKarier.user'])->findOrFail($id);
        $tanggapanKarier = $bincangKarier->tanggapanKarier;
        return view('admin.bincang_karier.show', compact('bincangKarier', 'tanggapanKarier'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'isi_pertanyaan' => 'required|string|max:5000'
        ]);

        BincangKarier::create([
            'user_id' => Auth::id(),
            'isi_pertanyaan' => $request->isi_pertanyaan,
        ]);

        return redirect()->route('admin.bincang-karier.index')->with('success', 'Pertanyaan berhasil dibuat');
    }

    public function update(Request $request, $id)
    {
        $bincangKarier = BincangKarier::findOrFail($id);

        $request->validate([
            'isi_pertanyaan' => 'required|string|max:5000'
        ]);

        $bincangKarier->update([
            'isi_pertanyaan' => $request->isi_pertanyaan
        ]);

        return redirect()->route('admin.bincang-karier.index')->with('success', 'Pertanyaan berhasil diupdate');
    }

    public function destroy($id)
    {
        $bincangKarier = BincangKarier::findOrFail($id);
        $bincangKarier->delete();

        return redirect()->route('admin.bincang-karier.index')->with('success', 'Pertanyaan berhasil dihapus');
    }
}
