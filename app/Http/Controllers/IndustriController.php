<?php

namespace App\Http\Controllers;

use App\Models\Industri;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndustriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $industris = Industri::oldest()->paginate(10);
        $industriCount = Industri::count();
        $allIndustri = Industri::all();

        $user = Auth::user();
        $userCount = User::count();

        $filterOptions = Industri::select('alamat')
            ->distinct()
            ->orderBy('alamat', 'asc')
            ->get()
            ->map(fn($industri) => [
                'label' => $industri->alamat,
                'value' => $industri->alamat
            ])
            ->toArray();

        return view('admin.pages.industri', [
            'industris' => $industris,
            'industriCount' => $industriCount,
            'allIndustri' => $allIndustri,
            'user' => $user,
            'userCount' => $userCount,
            'filterOptions' => $filterOptions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.eksplorasi_kerja.industri.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_industri' => 'required|string|max:255',
            'website' => 'nullable|string|max:255',
            'alamat' => 'required|string',
        ]);

        Industri::create($request->all());

        return redirect()->route('admin.industri.index')->with('success', 'Industri berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $industri = Industri::findOrFail($id);
        return view('admin.eksplorasi_kerja.industri.show', compact('industri'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $industri = Industri::findOrFail($id);
        return view('admin.eksplorasi_kerja.industri.edit', compact('industri'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_industri' => 'required|string|max:255',
            'website' => 'nullable|string|max:255',
            'alamat' => 'required|string',
        ]);

        $industri = Industri::findOrFail($id);
        $industri->update($request->all());

        return redirect()->route('admin.industri.index')->with('success', 'Industri berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $industri = Industri::findOrFail($id);
        $industri->delete();

        return redirect()->route('admin.industri.index')->with('success', 'Industri berhasil dihapus');
    }
}
