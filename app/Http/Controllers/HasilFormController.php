<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\FormKuliah;
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
        $user = User::findOrFail($user_id);
        $attempts = FormKuliah::with(['minats.jurusanKuliah', 'minats.hobi'])
        ->where('user_id', $user_id)
        ->orderBy('attempt', 'asc')
        ->get();

        return view('admin.kenali_jurusan.hasil_form.user-detail', [
            'data' => $history,
            'user' => $user,
            'attempts' => $attempts,
        ]);
    }

    public function showAttempt ($user_id)
    {
        $user = User::findOrFail($user_id);

        // Ambil semua attempt dari FormKuliah milik user
        $attempts = FormKuliah::with(['minats.jurusanKuliah', 'minats.hobi'])
            ->where('user_id', $user_id)
            ->orderBy('attempt', 'asc')
            ->get();

        return view('admin.kenali_jurusan.hasil_form.user-attempt', [
            'user' => $user,
            'attempts' => $attempts,
        ]);
    }
}
