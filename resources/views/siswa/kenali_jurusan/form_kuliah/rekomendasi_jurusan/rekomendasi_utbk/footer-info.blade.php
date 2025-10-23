<div class="mt-auto space-y-2 pt-4 border-t border-border-gray">
    <a href="{{ $kampusData['kampus']->website }}" target="_blank"
        class="flex items-center gap-2 text-sm text-slate-navy hover:text-cool-gray transition-colors group/link">
        <i class="fas fa-globe"></i>
        <span class="group-hover/link:underline truncate">Website Kampus</span>
        <i class="fas fa-external-link-alt text-xs ml-auto"></i>
    </a>

    <div class="flex items-start gap-2 text-sm text-cool-gray">
        <i class="fas fa-map-marker-alt mt-0.5 flex-shrink-0"></i>
        <span class="line-clamp-2">{{ $kampusData['kampus']->alamat }}</span>
    </div>
</div>
