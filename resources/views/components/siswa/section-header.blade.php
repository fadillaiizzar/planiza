<div class="mb-6 pt-14">
    <div class="flex items-center space-x-3 mb-2">
        <a href="{{ $backRoute ? route($backRoute) : '#' }}"
           class="text-slate-600 hover:underline text-lg">&lt;</a>
        <h1 class="text-2xl font-bold text-slate-800">{{ $title }}</h1>
    </div>
    <p class="text-slate-600">
        {{ $subtitle }}
    </p>
</div>
