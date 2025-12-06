@props([
    'id' => 'search',
    'placeholder' => 'Cari sesuatu...',
    'includeSmk' => false // default false, kalau true search juga nama jurusan SMK
])

<div class="mb-8">
    <div class="relative max-w-2xl mx-auto z-30">
        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
            <i class="fas fa-search text-cool-gray text-lg"></i>
        </div>
        <input type="text"
            id="{{ $id }}"
            placeholder="{{ $placeholder }}"
            class="w-full pl-14 pr-6 py-4 bg-white border-2 border-border-gray rounded-3xl shadow-lg
            focus:outline-none focus:border-slate-navy focus:ring-4 focus:ring-slate-navy/10
            transition-all duration-300 text-slate-navy placeholder-cool-gray"
        >
    </div>

    {{-- Empty State --}}
    <div id="{{ $id }}-no-result" class="hidden col-span-full mt-6">
        <div class="bg-white rounded-3xl shadow-xl p-12 text-center border-2 border-dashed border-border-gray">
            <div class="w-20 h-20 rounded-full bg-slate-navy/5 flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-search text-4xl text-cool-gray/40"></i>
            </div>
            <h3 class="text-2xl font-bold text-slate-navy mb-3">Tidak ada hasil ditemukan</h3>
            <p class="text-cool-gray max-w-md mx-auto">
                Tidak ada data yang cocok dengan pencarianmu
            </p>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        const searchInput = document.getElementById('{{ $id }}');
        const includeSmk = {{ $includeSmk ? 'true' : 'false' }};
        const containers = document.querySelectorAll('[data-search-container="{{ $id }}"]');
        const noResult = document.getElementById('{{ $id }}-no-result');

        searchInput.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase().trim();
            let totalVisible = 0;

            containers.forEach(container => {
                const items = container.querySelectorAll('[data-search-item]');
                let containerHasVisible = false;

                items.forEach(item => {
                    let text = item.dataset.searchItem.toLowerCase();
                    if (includeSmk && item.dataset.searchSmk) {
                        text += ' ' + item.dataset.searchSmk.toLowerCase();
                    }

                    if (text.includes(searchTerm)) {
                        item.style.display = '';
                        containerHasVisible = true;
                        totalVisible++;
                    } else {
                        item.style.display = 'none';
                    }
                });

                // Show/hide container dan header SMK
                const parentGroup = container.closest('.jurusan-smk-group');
                if (parentGroup) {
                    parentGroup.style.display = containerHasVisible ? '' : 'none';
                }
            });

            // Show/hide empty state
            if (totalVisible === 0 && searchTerm !== '') {
                noResult.classList.remove('hidden');
            } else {
                noResult.classList.add('hidden');
            }

            // Reset kalau search kosong
            if (searchTerm === '') {
                containers.forEach(container => {
                    container.querySelectorAll('[data-search-item]').forEach(item => item.style.display = '');
                    const parentGroup = container.closest('.jurusan-smk-group');
                    if (parentGroup) parentGroup.style.display = '';
                });
                noResult.classList.add('hidden');
            }
        });
    </script>
@endpush
