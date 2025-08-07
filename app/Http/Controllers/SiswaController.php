<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth;
use App\Models\Rencana;

class SiswaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('siswa.pages.dashboard', compact('user'));
    }

    public function simpanRencana(Request $request)
    {
        $request->validate([
            'no_hp' => 'required|string|min:10',
            'rencana' => 'required|in:kerja,kuliah',
        ]);

        $user = Auth::user();
        
    if ($user->role->nama_role === 'Siswa') {
        $siswa = $user->siswa;

        $rencana = Rencana::where('nama_rencana', $request->rencana)->first();

        if (!$rencana) {
            return back()->withErrors(['rencana' => 'Rencana tidak valid']);
        }

        $siswa->no_hp = $request->no_hp;
        $siswa->rencana_id = $rencana->id;
        $siswa->save();
    }
        return redirect()->route('dashboard.pages.siswa')->with('success', 'Rencana berhasil disimpan.');
    }
}