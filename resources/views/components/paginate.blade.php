<div class="mt-8 flex justify-between items-center mx-auto">

    {{-- Previous --}}
    @if ($jurusans->onFirstPage())
        <span class="flex items-center px-4 py-2 rounded-full bg-cool-gray text-off-white cursor-not-allowed">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Prev
        </span>
    @else
        <a href="{{ $jurusans->previousPageUrl() }}" class="flex items-center px-4 py-2 rounded-full bg-off-white border border-border-gray text-slate-navy hover:bg-slate-navy hover:text-off-white transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Prev
        </a>
    @endif

    {{-- Angka halaman --}}
    <div class="flex space-x-2">
        @php
            $total = $jurusans->lastPage();
            $current = $jurusans->currentPage();

            if($total <= 5){
                $pages = range(1, $total);
            } else {
                $pages = [];

                // Tambahkan halaman 1
                $pages[] = 1;

                // Tambahkan ellipsis sebelum current jika current > 3
                if($current > 3){
                    $pages[] = '...';
                }

                // Halaman sekitar current
                for($i = max(2, $current-1); $i <= min($total-1, $current+1); $i++){
                    $pages[] = $i;
                }

                // Tambahkan ellipsis setelah current jika current < total-2
                if($current < $total - 2){
                    $pages[] = '...';
                }

                // Tambahkan halaman terakhir
                $pages[] = $total;
            }
        @endphp

        @foreach($pages as $page)
            @if($page === '...')
                <span class="px-2 py-1 text-cool-gray">...</span>
            @elseif($page == $current)
                <span class="px-3 py-1 rounded-full bg-slate-navy text-off-white">{{ $page }}</span>
            @else
                <a href="{{ $jurusans->url($page) }}" class="px-3 py-1 rounded-full bg-off-white text-slate-navy hover:bg-slate-navy hover:text-off-white transition">{{ $page }}</a>
            @endif
        @endforeach
    </div>

    {{-- Next --}}
    @if ($jurusans->hasMorePages())
        <a href="{{ $jurusans->nextPageUrl() }}" class="flex items-center px-4 py-2 rounded-full bg-off-white border border-border-gray text-slate-navy hover:bg-slate-navy hover:text-off-white transition">
            Next
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </a>
    @else
        <span class="flex items-center px-4 py-2 rounded-full bg-cool-gray text-off-white cursor-not-allowed">
            Next
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </span>
    @endif
</div>
