<?php

namespace App\Http\Controllers\Siswa\KenaliJurusan;

use App\Models\Hobi;
use App\Models\HobiJurusan;
use App\Models\JurusanKuliah;
use App\Http\Controllers\Controller;

class KerjakanFormController extends Controller
{
    public function index()
    {
        $jurusanKuliah = JurusanKuliah::all();
        $hobis = Hobi::all();

        return view('siswa.kenali_jurusan.form_kuliah.form-kuliah', compact('jurusanKuliah', 'hobis'));
    }
}
