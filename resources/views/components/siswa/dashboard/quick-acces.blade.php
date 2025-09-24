@props([
    'href' => '#',
    'icon' => 'fas fa-globe',
    'title' => 'title',
    'desc' => 'desc',
])

<a href="{{ $href }}" class="bg-off-white border border-border-gray hover:shadow-xl rounded-2xl p-6 sm:p-8 transition-all duration-300 hover:scale-105 hover:-translate-y-2 group">
    <div class="text-3xl sm:text-4xl mb-3 group-hover:scale-110 transition-transform">
        <i class="{{ $icon }}"></i>
    </div>
    <h3 class="font-semibold text-slate-navy text-base sm:text-lg">{{ $title }}</h3>
    <p class="text-cool-gray text-sm mt-1">{{ $desc }}</p>
</a>
