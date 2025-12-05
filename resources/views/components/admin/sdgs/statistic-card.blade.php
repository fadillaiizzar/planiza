<div class="bg-white rounded-xl border border-border-gray shadow-sm p-5 hover:shadow-md transition-shadow duration-300">
    <h4 class="text-lg font-semibold text-slate-navy mb-4">
        <i class="{{ $icon }}"></i> {{ $label }}
    </h4>
    <ul class="space-y-3 text-cool-gray max-h-36 overflow-y-auto pr-1">
        @forelse(($items ?? []) as $kategori => $data)
            <li class="border-b border-border-gray pb-2 last:border-none">
                <!-- Judul kategori + jumlah -->
                <div class="flex justify-between font-semibold text-slate-navy">
                    <span>{{ $kategori }}</span>
                    <span>{{ $data['count'] }}</span>
                </div>

                <!-- Daftar nama profesi/jurusan -->
                @if (!empty($data['names']))
                    <ul class="mt-1 ml-4 list-disc text-sm text-slate-600 space-y-1">
                        @foreach($data['names'] as $name)
                            <li>{{ $name }}</li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @empty
            <li class="text-gray-500 text-sm italic">Belum ada data</li>
        @endforelse
    </ul>
</div>
