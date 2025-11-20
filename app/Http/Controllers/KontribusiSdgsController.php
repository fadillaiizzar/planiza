<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\KontribusiSdgs;

class KontribusiSdgsController extends Controller
{
    public function index()
    {
        // Ambil semua kontribusi lengkap dengan relasi user, siswa, kelas, kategori sdgs
        $items = KontribusiSdgs::with([
            'user.siswa.kelas',
            'kategoriSdgs'
        ])
        ->orderBy('created_at', 'desc')
        ->get();

        // COUNT DATA
        $totalKontribusi = $items->count();
        $totalPending    = $items->where('status', 'pending')->count();
        $totalApproved   = $items->where('status', 'approved')->count();
        $totalRejected   = $items->where('status', 'rejected')->count();

        // Filter kelas (opsional)
        $filterOptions = KontribusiSdgs::select('status')
            ->distinct()
            ->get()
            ->map(function ($item) {
                return [
                    'label' => ucfirst($item->status),
                    'value' => $item->status,
                ];
            })
            ->toArray();

        return view('admin.sdgs.kontribusi_sdgs.kontribusi-sdgs', compact(
            'items', 'filterOptions', 'totalKontribusi', 'totalPending', 'totalApproved', 'totalRejected'
        ));
    }

    public function show($id)
    {
        $item = KontribusiSdgs::with([
            'user.siswa.kelas',
            'kategoriSdgs'
        ])->findOrFail($id);

        return view('admin.sdgs.kontribusi_sdgs.show', compact('item'));
    }

    public function updateStatus($id)
    {
        request()->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $item = KontribusiSdgs::findOrFail($id);
        $item->update([
            'status' => request('status'),
        ]);

        return back()->with('success', 'Status berhasil diperbarui');
    }
}
