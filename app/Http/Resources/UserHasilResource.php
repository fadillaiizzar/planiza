<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserHasilResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nama' => $this->name,
            'pengerjaan' => $this->whenLoaded('hasilTes', function () {
                return $this->hasilTes->map(function ($hasil, $i) {
                    return [
                        'ke' => $i + 1,
                        'tanggal' => $hasil->created_at->format('d M Y'),
                        'skor' => $hasil->total_poin ?? '-',
                        'id_hasil' => $hasil->id,
                        'status' => $hasil->is_finished ? 'Selesai' : 'Belum',
                    ];
                })->values();
            }, []),
            'total_pengerjaan' => $this->whenLoaded('hasilTes', fn() => $this->hasilTes->count())
        ];
    }
}
