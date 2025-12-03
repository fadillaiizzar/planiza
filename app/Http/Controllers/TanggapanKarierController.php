<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TanggapanKarier;
use Illuminate\Support\Facades\Auth;

class TanggapanKarierController extends Controller
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
    public function store(Request $request)
    {
        $request->validate([
            'isi_tanggapan' => 'required|string|max:5000',
            'bincang_karier_id' => 'required|integer|exists:bincang_kariers,id'
        ]);

        $bincangKarierId = $request->bincang_karier_id;

        TanggapanKarier::create([
            'user_id' => Auth::id(),
            'bincang_karier_id' => $bincangKarierId,
            'isi_tanggapan' => $request->isi_tanggapan
        ]);

        return redirect()->route('admin.bincang-karier.show', $bincangKarierId)->with('success', 'Tanggapan berhasil dikirim');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
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
        $tanggapanKarier = TanggapanKarier::findOrFail($id);

        $request->validate([
            'isi_tanggapan' => 'required|string|max:5000'
        ]);

        $tanggapanKarier->update([
            'isi_tanggapan' => $request->isi_tanggapan
        ]);

        return redirect()->route('admin.bincang-karier.show', $tanggapanKarier->bincang_karier_id)->with('success', 'Tanggapan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tanggapanKarier = TanggapanKarier::findOrFail($id);
        $pertanyaanId = $tanggapanKarier->bincang_karier_id;
        $tanggapanKarier->delete();

        return redirect()->route('admin.bincang-karier.show', $pertanyaanId)->with('success', 'Tanggapan berhasil dihapus');
    }
}
