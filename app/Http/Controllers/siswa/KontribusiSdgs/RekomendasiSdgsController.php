<?php

namespace App\Http\Controllers\Siswa\KontribusiSdgs;

use App\Models\KategoriSdgs;
use Illuminate\Http\Request;
use App\Models\KenaliJurusan;
use App\Models\KenaliProfesi;
use App\Models\KontribusiSdgs;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RekomendasiSdgsController extends Controller
{
    public function generate()
    {
        $user = Auth::user();

        $kontribusi = KontribusiSdgs::where('user_id', $user->id)->get();

        if ($kontribusi->count() < 7) {
            return back()->with('error', 'Anda harus memiliki minimal 7 kontribusi untuk menghasilkan rekomendasi.');
        }

        // -----------------------------
        // 1️⃣ Hitung total poin kategori SDGs
        // -----------------------------
        $kategoriPoin = [];
        foreach ($kontribusi as $item) {
            $kategoriId = $item->kategori_sdgs_id;

            $skorDurasi = $item->durasi_kegiatan >= 120 ? 3 : ($item->durasi_kegiatan >= 60 ? 2 : 1);
            $skorJenis = match($item->jenis_kegiatan) {
                'individu' => 1,
                'kelompok' => 2,
                'event' => 3,
            };
            $skorPeran = match($item->peran) {
                'peserta' => 1,
                'panitia' => 2,
                'ketua' => 3,
            };

            $totalSkor = $skorDurasi + $skorJenis + $skorPeran;
            $kategoriPoin[$kategoriId] = ($kategoriPoin[$kategoriId] ?? 0) + $totalSkor;
        }

        $kategoriTerpilihId = array_keys($kategoriPoin, max($kategoriPoin))[0];
        $kategori = KategoriSdgs::find($kategoriTerpilihId);

        $profesiList = $kategori->profesiKerjas;
        $jurusanList = $kategori->jurusanKuliahs;

        // -----------------------------
        // 2️⃣ Hitung relevansi profesi
        // -----------------------------
        $profesiScores = [];
        foreach ($profesiList as $profesi) {
            $score = 0;
            $profesiText = strtolower($profesi->judul . ' ' . $profesi->deskripsi);

            foreach ($kontribusi as $item) {
                $kontribusiText = strtolower($item->judul . ' ' . $item->desk_refleksi);
                $commonWords = array_intersect(explode(' ', $kontribusiText), explode(' ', $profesiText));
                $score += count($commonWords);
            }

            $profesiScores[$profesi->id] = $score > 0 ? $score : 1;
        }

        arsort($profesiScores);
        $topProfesi = $this->getTopWithTies($profesiScores, 3);

        // -----------------------------
        // 3️⃣ Hitung relevansi jurusan
        // -----------------------------
        $jurusanScores = [];
        foreach ($jurusanList as $jurusan) {
            $score = 0;
            $jurusanText = strtolower($jurusan->judul . ' ' . $jurusan->deskripsi);

            foreach ($kontribusi as $item) {
                $kontribusiText = strtolower($item->judul . ' ' . $item->desk_refleksi);
                $commonWords = array_intersect(explode(' ', $kontribusiText), explode(' ', $jurusanText));
                $score += count($commonWords);
            }

            $jurusanScores[$jurusan->id] = $score > 0 ? $score : 1;
        }

        arsort($jurusanScores);
        $topJurusan = $this->getTopWithTies($jurusanScores, 3);

        // -----------------------------
        // 4️⃣ Hapus rekomendasi lama
        // -----------------------------
        KenaliProfesi::where('user_id', $user->id)
            ->where('sumber_rekomendasi', 'sdgs')
            ->delete();

        KenaliJurusan::where('user_id', $user->id)
            ->where('sumber_rekomendasi', 'sdgs')
            ->delete();

        // -----------------------------
        // 5️⃣ Simpan rekomendasi baru
        // -----------------------------
        foreach ($topProfesi as $profesiId => $score) {
            KenaliProfesi::create([
                'user_id' => $user->id,
                'tes_id' => null,
                'profesi_kerja_id' => $profesiId,
                'sumber_rekomendasi' => 'sdgs',
                'total_poin' => $score,
                'ranking' => null,
                'attempt' => 1
            ]);
        }

        foreach ($topJurusan as $jurusanId => $score) {
            KenaliJurusan::create([
                'user_id' => $user->id,
                'form_kuliah_id' => null,
                'jurusan_kuliah_id' => $jurusanId,
                'sumber_rekomendasi' => 'sdgs',
                'status_peluang' => null,
                'attempt' => 1
            ]);
        }

        return back()->with('success', 'Rekomendasi profesi dan jurusan berhasil dihasilkan!');
    }

    /**
     * Ambil top N tapi jika ada yang skor sama dengan posisi terakhir, ikutkan semuanya
     */
    private function getTopWithTies(array $scores, int $max)
    {
        $result = [];
        $i = 0;
        $lastScore = null;

        foreach ($scores as $id => $score) {
            if ($i < $max) {
                $result[$id] = $score;
                $lastScore = $score;
                $i++;
            } else {
                if ($score === $lastScore) {
                    $result[$id] = $score;
                } else {
                    break;
                }
            }
        }

        return $result;
    }
}
