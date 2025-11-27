<?php

namespace App\Http\Controllers\Siswa\KontribusiSdgs;

use App\Models\KategoriSdgs;
use Illuminate\Http\Request;
use App\Models\KontribusiSdgs;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class KontribusiSdgsSiswaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $siswa = $user->siswa ?? null;

        $kategoriSdgs = KategoriSdgs::orderBy('nomor_kategori')->get();

        // 🔹 Riwayat kontribusi user yang sudah submit
        $riwayatKontribusi = KontribusiSdgs::with('kategoriSdgs')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'asc')
            ->get();

       return view('siswa.pages.kontribusi-sdgs', compact('siswa', 'kategoriSdgs', 'riwayatKontribusi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_sdgs_id' => 'required|exists:kategori_sdgs,id',
            'judul_kegiatan' => 'required|string|max:255',
            'deskripsi_refleksi' => 'required|string',
            'tanggal_pelaksanaan' => 'required|date',
            'durasi_nilai' => 'required|integer|min:1',
            'durasi_satuan' => 'required|in:menit,jam',
            'jenis_kegiatan' => 'required|in:individu,kelompok,event',
            'peran' => 'required|in:peserta,panitia,ketua',
            'bukti_upload' => 'required|array',
            'bukti_upload.*' => 'image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $user = Auth::user();

         // Konversi durasi ke menit
        $durasi_kegiatan = $request->durasi_satuan === 'jam'
            ? $request->durasi_nilai * 60
            : $request->durasi_nilai;

        // Simpan file bukti kegiatan
        $paths = [];
        if ($request->hasFile('bukti_upload')) {
            foreach ($request->file('bukti_upload') as $file) {
                $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $timestamp = now()->format('Ymd_His');
                $newName = $originalName . '_' . $timestamp . '.' . $extension;
                $paths[] = $file->storeAs('bukti_upload', $newName, 'public');
            }
        }

        // Simpan data ke database
        KontribusiSdgs::create([
            'user_id' => $user->id,
            'kategori_sdgs_id' => $request->kategori_sdgs_id,
            'judul_kegiatan' => $request->judul_kegiatan,
            'deskripsi_refleksi' => $request->deskripsi_refleksi,
            'tanggal_pelaksanaan' => $request->tanggal_pelaksanaan,
            'durasi_kegiatan' => $durasi_kegiatan,
            'jenis_kegiatan' => $request->jenis_kegiatan,
            'peran' => $request->peran,
            'bukti_upload' => $paths,
            'status' => 'pending',
        ]);

        return redirect()->route('siswa.kontribusi-sdgs.index')->with('success', 'Kontribusi SDGs berhasil disimpan!');
    }

    public function show($id)
    {
        $data = KontribusiSdgs::with('kategoriSdgs')->findOrFail($id);

        return response()->json($data);
    }
}
