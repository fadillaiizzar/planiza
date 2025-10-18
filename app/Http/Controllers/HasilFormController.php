<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\HasilFormService;

class HasilFormController extends Controller
{
    protected HasilFormService $service;

    public function __construct(HasilFormService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $data = $this->service->getSummary();

        $totalUser = $data->sum('jumlah_user');
        $totalPengerjaan = $data->sum('jumlah_pengerjaan');

        return view('admin.pages.hasil-form', compact(
            'data', 'totalUser', 'totalPengerjaan'
        ));
    }
}
