@php
    $pageTitle = $pageTitle ?? 'Dashboard';
    $addButtonText = $addButtonText ?? '';
    $addRoute = $addRoute ?? null;
    $showExport = $showExport ?? false;
    $exportRoute = $exportRoute ?? null;
    $stats = $stats ?? [];
    $filterOptions = $filterOptions ?? [];
    $searchPlaceholder = $searchPlaceholder ?? '';
    $itemCount = $itemCount ?? 0;
@endphp

<!-- Mobile header -->
<div class="md:hidden flex justify-between items-center mb-4">
    <div class="flex items-center gap-2">
        <button onclick="toggleSidebar()" class="text-2xl text-slate-navy hover:text-cool-gray transition-colors">
            <i class="fas fa-bars"></i>
        </button>
        <h1 class="text-lg ml-3 md:ml-0 font-semibold bg-gradient-to-r from-slate-navy to-cool-gray bg-clip-text text-transparent">
            {{ $pageTitle }}
        </h1>
    </div>

    <div class="flex gap-2">
        @if(!empty($showExport))
            <a href="{{ route($exportRoute ?? '#') }}"
               class="px-3 py-2 bg-off-white/80 backdrop-blur-sm text-slate-navy hover:bg-off-white border border-border-gray rounded-lg transition-all shadow-sm hover:shadow-md">
                <i class="fas fa-download"></i>
            </a>
        @endif

        @if(!empty($addButtonText))
            @if(!empty($addRoute))
                <a href="{{ route($addRoute) }}"
                   class="bg-gradient-to-r from-slate-navy to-cool-gray text-off-white px-4 py-2 rounded-lg hover:from-cool-gray hover:to-slate-navy transition-all shadow-lg hover:shadow-xl">
                    <i class="fas fa-user-plus mr-0 sm:mr-2"></i>
                    {{ $addButtonText }}
                </a>
            @else
                <button onclick="openModal()"
                        class="bg-gradient-to-r from-slate-navy to-cool-gray text-off-white px-4 py-2 rounded-lg hover:from-cool-gray hover:to-slate-navy transition-all shadow-lg hover:shadow-xl">
                    <i class="fas fa-user-plus mr-0 sm:mr-2"></i>
                    {{ $addButtonText }}
                </button>
            @endif
        @endif
    </div>
</div>

<!-- Desktop header -->
<div class="hidden md:flex justify-between items-center">
    <h1 class="text-3xl font-bold bg-gradient-to-r from-slate-navy to-cool-gray bg-clip-text text-transparent">
        {{ $pageTitle }}
    </h1>

    <div class="flex gap-2">
        @if(!empty($showExport))
            <a href="{{ route($exportRoute ?? '#') }}"
               class="px-4 py-2 bg-off-white/80 backdrop-blur-sm text-slate-navy hover:bg-off-white border border-border-gray rounded-lg transition-all shadow-sm hover:shadow-md">
                <i class="fas fa-download mr-2"></i>
                Export
            </a>
        @endif

        @if(!empty($addButtonText))
            @if(!empty($addRoute))
                <a href="{{ route($addRoute) }}"
                   class="px-6 py-2 bg-gradient-to-r from-slate-navy to-cool-gray text-off-white hover:from-cool-gray hover:to-slate-navy rounded-lg transition-all shadow-lg hover:shadow-xl">
                    <i class="fas fa-plus mr-2"></i>
                    {{ $addButtonText }}
                </a>
            @else
                <button onclick="openModal()"
                        class="px-6 py-2 bg-gradient-to-r from-slate-navy to-cool-gray text-off-white hover:from-cool-gray hover:to-slate-navy rounded-lg transition-all shadow-lg hover:shadow-xl">
                    <i class="fas fa-plus mr-2"></i>
                    {{ $addButtonText }}
                </button>
            @endif
        @endif
    </div>
</div>

<!-- Stats Cards -->
@if(count($stats) > 0)
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:grid-cols-4 mb-6">
    @foreach ($stats as $stat)
        <div class="bg-gradient-to-br {{ $stat['bg'] }} text-white rounded-xl p-4 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="{{ $stat['textColor'] }} text-sm">{{ $stat['label'] }}</p>
                    <h3 class="text-2xl font-bold">{{ $stat['count'] }}</h3>
                </div>
                <div class="bg-white/20 p-3 rounded-lg">
                    <i class="{{ $stat['icon'] }} text-xl"></i>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endif

<!-- Search & Filter -->
@if(!empty($searchPlaceholder))
<div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border-0 p-6 mb-6">
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div class="flex flex-col gap-4 md:flex-row md:items-center">
            <!-- Search Input -->
            <div class="relative flex-1 md:w-96">
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
                <input
                    type="text"
                    id="searchInput"
                    placeholder="{{ $searchPlaceholder }}"
                    class="w-full pl-10 pr-4 py-2 bg-white border border-slate-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all"
                >
            </div>

            <!-- Dynamic Filter Select -->
            @if(count($filterOptions) > 0)
            <div class="flex gap-2">
                <div class="relative inline-block w-48">
                    <select id="filterSelect" class="appearance-none w-full px-4 py-2 pr-10 bg-white border border-gray-300 rounded-lg shadow-sm
                        focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition cursor-pointer">
                        <option value="">{{ $defaultFilterText ?? 'Semua' }}</option>
                        @foreach ($filterOptions as $option)
                            <option value="{{ strtolower($option['value']) }}">{{ $option['label'] }}</option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                            stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 9l6 6 6-6"></path>
                        </svg>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <div class="text-sm text-slate-600">
            <span id="resultCount">{{ $itemCount }}</span> data ditemukan
        </div>
    </div>
</div>
@endif

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', initializeFilters);
    function initializeFilters() {
        const searchInput = document.getElementById('searchInput');
        const filterSelect = document.getElementById('filterSelect');
        const resultCount = document.getElementById('resultCount');

        const rowClasses = [
            'user-row', 'topik-row', 'materi-row', 'profesi-row', 'industri-row', 'industri-profesi-row', 'kategori-minat-row', 'profesi-kategori-row', 'tes-row', 'soal-tes-row', 'hasil-form-row', 'kategori-sdgs-row', 'kontribusi-sdgs-row'
        ];

        let rows = rowClasses.map(cls=> document.querySelectorAll(`.${cls}`))
                             .find(list => list.length > 0);
        if (!rows) return;

        const strategies = {
            'user-row': row => {
                const { name='', username='', role='' } = row.dataset;
                return {
                    search: [name, username, role],
                    filter: role
                };
            },
            'topik-row': row => {
            const { judul='', kelas='', jurusan='', rencana='' } = row.dataset;
            return {
                search: [judul, kelas, jurusan, rencana],
                filter: kelas
            };
            },
            'materi-row': row => {
                const { nama='', topik='', deskripsi='', tipe='', file='' } = row.dataset;
                return {
                    search: [nama, topik, deskripsi, tipe, file],
                    filter: topik
                };
            },
            'profesi-row': row => {
                const { nama='', deskripsi='', skill='', jurusan='' } = row.dataset;
                return {
                    search: [nama, deskripsi, skill, jurusan],
                };
            },
            'industri-row': row => {
                const { nama='', website='', alamat='' } = row.dataset;
                return {
                    search: [nama, website, alamat],
                    filter: alamat
                };
            },
            'industri-profesi-row': row => {
                const { profesi='', industri='' } = row.dataset;
                return {
                    search: [profesi, industri],
                    filter: profesi
                };
            },
            'kategori-minat-row': row => {
                const { nama='', deskripsi='' } = row.dataset;
                return {
                    search: [nama, deskripsi],
                    filter: nama
                };
            },
            'profesi-kategori-row': row => {
                const { profesi='', kategori='' } = row.dataset;
                return {
                    search: [profesi, kategori],
                    filter: kategori
                };
            },
            'tes-row': row => {
                const { nama='' } = row.dataset;
                return {
                    search: [nama],
                    filter: nama
                };
            },
            'soal-tes-row': row => {
                const { tes='', pertanyaan='', jenis='', max='' } = row.dataset;
                return {
                    search: [tes, pertanyaan, jenis, max],
                    filter: tes
                };
            },
            'hasil-form-row': row => {
                const { name='', kelas='', jurusan='', count='', update='' } = row.dataset;
                return {
                    search: [name, kelas, jurusan, count, update],
                    filter: kelas
                };
            },
            'kategori-sdgs-row': row => {
                const { nomor = '', nama = '', deskripsi = '' } = row.dataset;
                return {
                    search: [nomor, nama, deskripsi],
                };
            },
            'kontribusi-sdgs-row': row => {
                const { nama = '', kelas = '', jurusan = '', judul = '', kategori = '', tanggal = '', status = ''} = row.dataset;
                return {
                    search: [nama, kelas, jurusan, judul, kategori, tanggal, status],
                };
            }
        };

        function filterItems() {
            const searchTerm = searchInput.value.toLowerCase().trim();
            const selectedFilter = filterSelect ? filterSelect.value.toLowerCase() : '';
            let visibleCount = 0;

            rows.forEach(row => {
                const cls = rowClasses.find(c => row.classList.contains(c));
                if (!cls) return;

                const { search, filter } = strategies[cls](row);

                const matchesSearch = search.some(val => val.toLowerCase().includes(searchTerm));
                const matchesFilter = !selectedFilter ||
                                    (Array.isArray(filter)
                                        ? filter.includes(selectedFilter)
                                        : filter === selectedFilter);

                if (matchesSearch && matchesFilter) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            resultCount.textContent = visibleCount;

            const noDataRow = document.getElementById('noDataRow');
            if (noDataRow) {
                noDataRow.classList.toggle('hidden', visibleCount !== 0);
            }
        }

        searchInput.addEventListener('input', filterItems);
        if (filterSelect) filterSelect.addEventListener('change', filterItems);
    }

    function openModal() {
        const modal = document.getElementById('modalCreate');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.classList.add('overflow-hidden');
    }

    function closeModal() {
        const modal = document.getElementById('modalCreate');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.classList.remove('overflow-hidden');
    }
</script>
@endpush
