@props([
    'links' => [],
])

<nav class="text-sm flex items-center gap-3 mb-4">
    @foreach ($links as $key => $link)
        @if ($key !== count($links) - 1)
            <a href="{{ $link['href'] ?? '#' }}"
               class="flex items-center gap-2 text-gray-500">
                <i class="{{ $link['icon'] }} text-base"></i>
                <span class="hover:underline">{{ $link['title'] }}</span>
            </a>
            <span class="text-gray-400">›</span>
        @else
            <p class="flex items-center gap-2 text-indigo-600 font-medium">
                <i class="{{ $link['icon'] }} text-base"></i>
                <span>{{ $link['title'] }}</span>
            </p>
        @endif
    @endforeach
</nav>
