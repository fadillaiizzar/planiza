@props([
    'icon' => null,
    'gradient' => 'from-emerald-400 to-emerald-600',
    'title' => '',
    'desc' => '',
    'delay' => null,
])

<div class="group bg-white/50 backdrop-blur-sm cursor-pointer border border-border-gray hover:border-slate-navy rounded-2xl p-6 hover:shadow-2xl hover:shadow-slate-navy/10 transition-all duration-300 hover:-translate-y-2"
     @if($delay) style="animation-delay: {{ $delay }}ms;" @endif>
    <div class="flex items-start gap-5">
        <div class="w-10 h-10 bg-gradient-to-br {{ $gradient }} rounded-xl flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300">
            @if(Str::startsWith($icon, '<svg'))
                {!! $icon !!}
            @else
                <i class="{{ $icon }} text-white text-lg"></i>
            @endif
        </div>
        <div class="flex-1">
            <h3 class="font-bold text-lg text-slate-navy mb-1 group-hover:text-cool-gray transition-colors">
                {{ $title }}
            </h3>
            <p class="text-cool-gray leading-relaxed">
                {{ $desc }}
            </p>
        </div>
    </div>
</div>
