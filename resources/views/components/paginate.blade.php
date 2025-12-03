<div class="mt-5 flex justify-center items-center mx-auto">
    <div class="flex space-x-2">
        @php
            $total = $items->lastPage();
            $current = $items->currentPage();

            if($total <= 5){
                $pages = range(1, $total);
            } else {
                $pages = [];

                $pages[] = 1;

                if($current > 3){
                    $pages[] = '...';
                }

                for($i = max(2, $current-1); $i <= min($total-1, $current+1); $i++){
                    $pages[] = $i;
                }

                if($current < $total - 2){
                    $pages[] = '...';
                }

                $pages[] = $total;
            }
        @endphp

        @foreach($pages as $page)
            @if($page === '...')
                <span class="px-2 py-1 text-cool-gray">...</span>
            @elseif($page == $current)
                <span class="px-3 py-1 rounded-full bg-slate-navy text-off-white">{{ $page }}</span>
            @else
                <a href="{{ $items->url($page) }}" class="px-3 py-1 rounded-full bg-off-white text-slate-navy hover:bg-slate-navy hover:text-off-white transition">{{ $page }}</a>
            @endif
        @endforeach
    </div>
</div>
