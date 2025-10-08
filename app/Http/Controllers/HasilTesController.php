<?php

namespace App\Http\Controllers;

use App\Models\Tes;
use App\Models\User;
use App\Services\HasilTesService;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\UserHasilResource;

class HasilTesController extends Controller
{
    protected HasilTesService $service;

    public function __construct(HasilTesService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $data = $this->service->getSummary();

        $tesCount = $data->count();
        $totalUser = $data->sum('jumlah_user');
        $totalPengerjaan = $data->sum('jumlah_pengerjaan');
        $filterOptions = $this->service->getFilterOptions();

        return view('admin.pages.hasil-tes', compact(
            'data', 'tesCount', 'totalUser', 'totalPengerjaan', 'filterOptions'
        ));
    }

    public function show($tes_id)
    {
        $users = $this->service->getUsersByTes($tes_id);

        $tes = optional($users->first()->hasilTes->first()?->tes ?? null);
        $tesModel = Tes::find($tes_id);

        return response()->json([
            'tes' => $tesModel ? $tesModel->nama_tes : null,
            'users' => UserHasilResource::collection($users)->resolve()
        ]);
    }

    public function showUsers($tes_id)
    {
        $tes = Tes::findOrFail($tes_id);

        $users = $this->service->getUsersForView($tes_id);

        return view('admin.kenali_profesi.hasil_tes.hasil-tes-users', compact('tes', 'users'));
    }

    public function showUserHistory($tes_id, $user_id)
    {
        $result = $this->service->getUserHistory($tes_id, $user_id);
        return response()->json($result);
    }

    public function showAttempt($tes_id, $user_id, $attempt)
    {
        $data = $this->service->getAttemptDetail($tes_id, $user_id, $attempt);

        return view('admin.kenali_profesi.hasil_tes.detail-attempt', $data);
    }
}
