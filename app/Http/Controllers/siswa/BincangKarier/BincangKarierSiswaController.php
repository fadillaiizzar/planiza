<?php

namespace App\Http\Controllers\Siswa\BincangKarier;

use Illuminate\Http\Request;
use App\Models\BincangKarier;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BincangKarierSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bincangKarier = BincangKarier::with('user')->latest()->paginate(10);

        return view('siswa.pages.bincang-karier', compact('bincangKarier'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'isi_pertanyaan' => 'required|string|max:5000'
        ]);

        BincangKarier::create([
            'user_id' => Auth::id(),
            'isi_pertanyaan' => $request->isi_pertanyaan,
        ]);

        return redirect()->route('siswa.bincang-karier.index')->with('success', 'Pertanyaan berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $bincangKarier = BincangKarier::with(['user', 'tanggapanKarier.user'])->findOrFail($id);

        return view('siswa.bincang_karier.show', compact('bincangKarier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $bincangKarier = BincangKarier::findOrFail($id);

        if ($bincangKarier->user_id != Auth::id()) {
            abort(403, 'Akses tidak diizinkan.');
        }

        $request->validate([
            'isi_pertanyaan' => 'required|string|max:5000',
        ]);

        $bincangKarier->update([
            'isi_pertanyaan' => $request->isi_pertanyaan,
        ]);

        return redirect()->route('siswa.bincang-karier.index')->with('success', 'Pertanyaan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $bincangKarier = BincangKarier::findOrFail($id);

        if ($bincangKarier->user_id != Auth::id()) {
            abort(403, 'Akses tidak diizinkan.');
        }

        $bincangKarier->delete();

        return redirect()->route('siswa.bincang-karier.index')->with('success', 'Pertanyaan berhasil dihapus');
    }
}
