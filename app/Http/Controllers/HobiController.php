<?php

namespace App\Http\Controllers;

use App\Models\Hobi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HobiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hobis = Hobi::oldest()->paginate(10);
        $hobiCount = Hobi::count();
        $allHobi = Hobi::all();

        $user = Auth::user();
        $userCount = User::count();

        return view('admin.kenali_jurusan.hobi.hobi', [
            'hobis' => $hobis,
            'hobiCount' => $hobiCount,
            'allHobi' => $allHobi,
            'user' => $user,
            'userCount' => $userCount,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kenali_jurusan.hobi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_hobi' => 'required|string|max:255',
        ]);

        Hobi::create($request->only('nama_hobi'));

        return redirect()->route('admin.kenali-jurusan.hobi.index')->with('success', 'Hobi berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $hobi = Hobi::findOrFail($id);
        return view('admin.kenali_jurusan.hobi.show', compact('hobi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $hobi = Hobi::findOrFail($id);
        return view('admin.kenali_jurusan.hobi.edit', compact('hobi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_hobi' => 'required|string|max:255',
        ]);

        $hobi = Hobi::findOrFail($id);
        $hobi->update($request->only('nama_hobi'));

        return redirect()->route('admin.kenali-jurusan.hobi.index')->with('success', 'Hobi berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $hobi = Hobi::findOrFail($id);
        $hobi->delete();

        return redirect()->route('admin.kenali-jurusan.hobi.index')->with('success', 'Hobi berhasil dihapus');
    }
}
