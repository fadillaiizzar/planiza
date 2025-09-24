@props([
    'icon' => 'fas fa-chart-bar',
    'colorIcon' => 'text-blue-600',
    'number' => '0',
    'title' => 'title',
    'desc' => 'desc',
])

<div class="bg-off-white p-6 rounded-lg shadow-sm border border-border-gray text-center">
    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
        <i class="{{ $icon }} text-2xl {{ $colorIcon }}"></i>
    </div>
    <div class="text-3xl font-bold text-gray-900 mb-2">{{ $number }}</div>
    <div class="text-slate-navy mb-2">{{ $title }}</div>
    <div class="text-sm text-cool-gray">{{ $desc }}</div>
</div>
