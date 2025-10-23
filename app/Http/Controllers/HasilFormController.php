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
        $totals = $this->service->getTotals();

        return view('admin.kenali_jurusan.hasil_form.hasil-form', [
            'data' => $data,
            'totalUser' => $totals['totalUser'],
            'totalPengerjaan' => $totals['totalPengerjaan'],
        ]);
    }

    public function showUserHistory($user_id)
    {
        $history = $this->service->getUserHistory($user_id);
        return response()->json($history);
    }
}
