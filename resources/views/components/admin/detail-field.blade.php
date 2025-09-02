@props(['icon', 'colorIcon', 'label', 'value' => '-'])

<div class="group">
    <label class="block text-sm font-semibold text-slate-700 mb-3 flex items-center">
        <i class="{{ $icon }} {{ $colorIcon }} mr-2"></i> {{ $label }}
    </label>
    <div class="w-full px-5 py-4 border border-slate-200 rounded-2xl text-sm text-slate-900 bg-white shadow-sm capitalize">
        {{ $value }}
    </div>
</div>
