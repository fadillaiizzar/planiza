<div class="relative bg-gradient-to-br from-slate-navy/5 to-cool-gray/5 p-8">
    {{-- Status Badge --}}
    <div class="absolute top-4 right-4">
        <span class="px-4 py-1.5 text-xs font-bold rounded-full shadow-md
            {{ $kampusData['status'] == 'Tinggi' ? 'bg-green-500 text-white' : ($kampusData['status']=='Sedang' ? 'bg-yellow-400 text-slate-navy' : 'bg-red-500 text-white') }}">
            Peluang {{ $kampusData['status'] }}
        </span>
    </div>

    {{-- Icon --}}
    <div class="w-16 h-16 bg-slate-navy rounded-2xl flex items-center justify-center shadow-md group-hover:scale-110 transition-transform duration-300">
        <i class="fas fa-university text-2xl text-off-white"></i>
    </div>
</div>
