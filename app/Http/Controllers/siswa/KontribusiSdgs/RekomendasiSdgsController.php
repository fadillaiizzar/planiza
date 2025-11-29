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

        // ===============================
        // 1️⃣ Hitung total poin kategori SDGs
        // ===============================
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

        // ===============================
        // 2️⃣ Hitung relevansi profesi (VERSI BARU)
        // ===============================
        $profesiScores = [];

        foreach ($profesiList as $profesi) {
            $score = 0;

            $profesiWords = $this->cleanWords(
                $profesi->nama_profesi_kerja . ' ' .
                $profesi->deskripsi . ' ' .
                $profesi->info_skill
            );

            foreach ($kontribusi as $item) {
                $kontribusiWords = $this->cleanWords(
                    $item->judul . ' ' . $item->deskripsi_refleksi
                );

                $commonWords = array_intersect($kontribusiWords, $profesiWords);

                $score += count($commonWords);
            }

            $profesiScores[$profesi->id] = max($score, 1);
        }

        arsort($profesiScores);

        // 3 teratas → tampil dulu, sisanya untuk "lihat lainnya"
        [$topProfesi, $profesiLainnya] = $this->getTopAndSimilar($profesiScores, 3);

        // Jika semua skor sama atau tidak ada yang benar-benar relevan → Random 3 profesi
        if (count($topProfesi) === 0 || max($profesiScores) === 1) {
            $randomProfesi = $kategori->profesiKerjas()
                ->inRandomOrder()
                ->take(3)
                ->pluck('id')
                ->toArray();

            // Set skor default = 1
            $topProfesi = array_fill_keys($randomProfesi, 1);
        }

        // ===============================
        // 3️⃣ Hitung relevansi jurusan (VERSI BARU)
        // ===============================
        $jurusanScores = [];

        foreach ($jurusanList as $jurusan) {
            $score = 0;

            $jurusanWords = $this->cleanWords(
                $jurusan->nama_jurusan_kuliah . ' ' .
                $jurusan->deskripsi . ' ' .
                $jurusan->info_matkul . ' ' .
                $jurusan->info_prospek
            );

            foreach ($kontribusi as $item) {
                $kontribusiWords = $this->cleanWords(
                    $item->judul . ' ' . $item->deskripsi_refleksi
                );

                $commonWords = array_intersect($kontribusiWords, $jurusanWords);

                $score += count($commonWords);
            }

            $jurusanScores[$jurusan->id] = max($score, 1);
        }

        arsort($jurusanScores);

        // 3 teratas → tampil dulu
        [$topJurusan, $jurusanLainnya] = $this->getTopAndSimilar($jurusanScores, 3);

        // Jika semua skor sama atau tidak ada yang benar-benar relevan → Random 3 jurusan
        if (count($topJurusan) === 0 || max($jurusanScores) === 1) {
            $randomJurusan = $kategori->jurusanKuliahs()
                ->inRandomOrder()
                ->take(3)
                ->pluck('id')
                ->toArray();

            $topJurusan = array_fill_keys($randomJurusan, 1);
        }

        // ===============================
        // 4️⃣ Hapus rekomendasi lama
        // ===============================
        KenaliProfesi::where('user_id', $user->id)
            ->where('sumber_rekomendasi', 'sdgs')
            ->delete();

        KenaliJurusan::where('user_id', $user->id)
            ->where('sumber_rekomendasi', 'sdgs')
            ->delete();

        // ===============================
        // 5️⃣ Simpan rekomendasi baru
        // ===============================
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
                'total_poin' => $score,
                'attempt' => 1
            ]);
        }

        // ===============================
        // Simpan data "lainnya" di session agar URL tetap bersih
        // ===============================
        session([
            'profesi_lainnya' => $profesiLainnya,
            'jurusan_lainnya' => $jurusanLainnya,
        ]);

        return redirect()->route('siswa.rekomendasi-sdgs.hasil');
    }

    public function index()
    {
        $user = Auth::user();

        $kontribusi = KontribusiSdgs::where('user_id', $user->id)->get();
        $kontribusiCount = $kontribusi->count();

        // ---- Hitung ulang kategori SDGs ----
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

        // kategori tertinggi
        $kategoriTerpilihId = array_keys($kategoriPoin, max($kategoriPoin))[0];
        $kategoriTerpilih = KategoriSdgs::find($kategoriTerpilihId);
        $kategoriTertinggiPoin = $kategoriPoin[$kategoriTerpilihId];

        $profesi = KenaliProfesi::with('profesiKerja')
            ->where('user_id', $user->id)
            ->where('sumber_rekomendasi', 'sdgs')
            ->orderBy('total_poin', 'DESC')
            ->get();

        $jurusan = KenaliJurusan::with('jurusanKuliah')
            ->where('user_id', $user->id)
            ->where('sumber_rekomendasi', 'sdgs')
            ->orderBy('total_poin', 'DESC')
            ->get();

        $profesiLainnya = session('profesi_lainnya', []);
        $jurusanLainnya = session('jurusan_lainnya', []);

        return view('siswa.kontribusi_sdgs.rekomendasi_sdgs.rekomendasi-sdgs',
            compact('profesi', 'jurusan', 'kontribusiCount', 'kategoriTerpilih', 'kategoriTertinggiPoin', 'profesiLainnya', 'jurusanLainnya'));
    }

    // ===============================
    // Helper: Top dengan ties
    // ===============================
    private function getTopAndSimilar(array $scores, int $max)
    {
        arsort($scores);

        $top = [];
        $similar = [];

        $i = 0;
        $scoreThreshold = null;

        foreach ($scores as $id => $score) {
            if ($i < $max) {
                $top[$id] = $score;
                $i++;
                $scoreThreshold = $score; // simpan skor item terakhir di top
            } else {
                // Masukkan ke similar jika skor sama dengan item ke-max
                if ($score === $scoreThreshold) {
                    $similar[$id] = $score;
                }
                // Skor lebih rendah dari threshold → abaikan
            }
        }

        return [$top, $similar];
    }

    // ===============================
    // Stemming sederhana + stopwords
    // ===============================
    private function stem($word)
    {
        $word = preg_replace('/^(meng|meny|mem|me|peng|peny|pem|pe)/', '', $word);
        $word = preg_replace('/(kan|an|nya)$/', '', $word);

        return $word;
    }

    private function cleanWords($text)
    {
        $stopwords = [
            'yang','dan','untuk','dengan','di','ke','dari','adalah','sebagai','pada','sebuah','dalam',
            'itu','ini','atau','serta','para','agar','karena','juga','dapat','akan','oleh','secara',
            'lebih','tanpa','dengan','hingga','pada','dalam'
        ];

        $words = explode(' ', strtolower($text));

        $filtered = array_diff($words, $stopwords);

        return array_map(fn($w) => $this->stem($w), $filtered);
    }
}
