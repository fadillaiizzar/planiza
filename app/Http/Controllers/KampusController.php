<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kampus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KampusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kampus = Kampus::oldest()->paginate(10);
        $kampusCount = Kampus::count();
        $allKampus = Kampus::all();

        $user = Auth::user();
        $userCount = User::count();

        // $filterOptions = Kampus::select('alamat')
        //     ->distinct()
        //     ->orderBy('alamat', 'asc')
        //     ->get()
        //     ->map(fn($kampus) => [
        //         'label' => $kampus->alamat,
        //         'value' => $kampus->alamat
        //     ])
        //     ->toArray();

        return view('admin.pages.kampus', [
            'kampus' => $kampus,
            'kampusCount' => $kampusCount,
            'allKampus' => $allKampus,
            'user' => $user,
            'userCount' => $userCount,
            // 'filterOptions' => $filterOptions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.eksplorasi_kuliah.kampus.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kampus' => 'required|string|max:255',
            'website' => 'nullable|string|max:255',
            'alamat' => 'required|string',
        ]);

        Kampus::create($request->all());

        return redirect()->route('admin.eksplorasi-jurusan.kampus.index')->with('success', 'Kampus berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $kampus = Kampus::findOrFail($id);
        return view('admin.eksplorasi_kuliah.kampus.show', compact('kampus'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kampus = Kampus::findOrFail($id);
        return view('admin.eksplorasi_kuliah.kampus.edit', compact('kampus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kampus' => 'required|string|max:255',
            'website' => 'nullable|string|max:255',
            'alamat' => 'required|string',
        ]);

        $kampus = Kampus::findOrFail($id);
        $kampus->update($request->all());

        return redirect()->route('admin.eksplorasi-jurusan.kampus.index')->with('success', 'Kampus berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kampus = Kampus::findOrFail($id);
        $kampus->delete();

        return redirect()->route('admin.eksplorasi-jurusan.kampus.index')->with('success', 'Kampus berhasil dihapus');
    }
}
