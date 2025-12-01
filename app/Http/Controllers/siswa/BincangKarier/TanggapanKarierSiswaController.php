<?php

namespace App\Http\Controllers\Siswa\BincangKarier;

use Illuminate\Http\Request;
use App\Models\BincangKarier;
use App\Models\TanggapanKarier;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TanggapanKarierSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request, $bincangKarierId)
    {
        $request->validate([
            'isi_tanggapan' => 'required|string|max:5000'
        ]);

        // Pastikan pertanyaan ada
        $bincangKarier = BincangKarier::findOrFail($bincangKarierId);

        TanggapanKarier::create([
            'user_id' => Auth::id(),
            'bincang_karier_id' => $bincangKarierId,
            'isi_tanggapan' => $request->isi_tanggapan
        ]);

        return redirect()->route('siswa.bincang-karier.show', $bincangKarierId)->with('success', 'Tanggapan berhasil dikirim');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tanggapanKarier = TanggapanKarier::findOrFail($id);

        if ($tanggapanKarier->user_id !== Auth::id()) {
            abort(403, "Kamu tidak memiliki akses");
        }

        return view('siswa.tanggapan_karier.edit', compact('tanggapanKarier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $tanggapanKarier = TanggapanKarier::findOrFail($id);

        if ($tanggapanKarier->user_id !== Auth::id()) {
            abort(403, "Kamu tidak memiliki akses");
        }

        $request->validate([
            'isi_tanggapan' => 'required|string|max:5000',
        ]);

        $tanggapanKarier->update([
            'isi_tanggapan' => $request->isi_tanggapan
        ]);

        return redirect()->route('siswa.bincang-karier.show', $tanggapanKarier->bincang_karier_id)->with('success', 'Tanggapan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tanggapanKarier = TanggapanKarier::findOrFail($id);

        if ($tanggapanKarier->user_id !== Auth::id()) {
            abort(403, "Kamu tidak memiliki akses.");
        }

        $pertanyaanId = $tanggapanKarier->bincang_karier_id;
        $tanggapanKarier->delete();

        return redirect()->route('siswa.bincang-karier.show', $pertanyaanId)->with('success', 'Tanggapan berhasil dihapus.');
    }
}
