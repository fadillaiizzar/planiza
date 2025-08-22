<div class="bg-white rounded-xl border border-border-gray shadow-sm p-5 hover:shadow-md transition-shadow duration-300">
    <h4 class="text-lg font-semibold text-slate-navy mb-4">
        <i class="{{ $icon }}"></i> {{ $label }}
    </h4>
    <ul class="space-y-2 text-cool-gray max-h-60 overflow-y-auto">
        @forelse(($items ?? []) as $name => $count)
            <li class="flex justify-between items-center border-b border-border-gray pb-1 last:border-none last:pb-0">
                <span>{{ $name }}</span>
                <strong class="text-slate-navy">{{ $count }}</strong>
            </li>
        @empty
            <li class="text-gray-500 text-sm italic">Belum ada data</li>
        @endforelse
    </ul>
</div>
