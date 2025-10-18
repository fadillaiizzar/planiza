<tr>
    <td colspan="{{ $colspan ?? 7 }}" class="text-center py-10">
        <div class="flex flex-col items-center justify-center space-y-3">
            <i class="{{ $icon ?? 'fas fa-info-circle' }} text-gray-400 text-4xl"></i>
            <p class="text-gray-500 text-lg font-medium">
                {{ $message ?? 'Belum ada data.' }}
            </p>
            @if ($button ?? false)
                <button onclick="{{ $buttonAction ?? '' }}"
                    class="px-6 py-3 rounded-full font-semibold shadow-lg transition-all duration-300 border border-cool-gray hover:bg-cool-gray text-cool-gray hover:text-off-white hover:scale-105 focus:ring-4 focus:ring-cool-gray">
                    {{ $buttonText ?? '+ Tambah Data' }}
                </button>
            @endif
        </div>
    </td>
</tr>
