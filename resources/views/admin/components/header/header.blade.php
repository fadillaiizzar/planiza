@php
    $pageTitle = $pageTitle ?? 'Dashboard';
    $addButtonText = $addButtonText ?? 'Tambah Data';
    $addUserRoute = $addUserRoute ?? '#';
    $stats = $stats ?? [];
    $filterOptions = $filterOptions ?? [];
    $searchPlaceholder = $searchPlaceholder ?? 'Cari...';
    $itemCount = $itemCount ?? 0;
@endphp

<!-- Mobile header -->
<div class="md:hidden flex justify-between items-center mb-4">
    <button onclick="toggleSidebar()" class="text-2xl text-slate-navy hover:text-cool-gray transition-colors">
        <i class="fas fa-bars"></i>
    </button>
    <div class="flex gap-2">
        <button class="px-3 py-2 bg-off-white/80 backdrop-blur-sm text-slate-navy hover:bg-off-white border border-border-gray rounded-lg transition-all shadow-sm hover:shadow-md">
            <i class="fas fa-download"></i>
        </button>
        <a href="{{ $addUserRoute }}" class="bg-gradient-to-r from-slate-navy to-cool-gray text-off-white px-4 py-2 rounded-lg hover:from-cool-gray hover:to-slate-navy transition-all shadow-lg hover:shadow-xl">
            <i class="fas fa-user-plus mr-0 sm:mr-2"></i>
            <span class="hidden sm:inline">{{ $addButtonText }}</span>
        </a>
    </div>
</div>

<!-- Desktop Header -->
<div class="hidden md:flex justify-between items-center">
    <h1 class="text-3xl font-bold bg-gradient-to-r from-slate-navy to-cool-gray bg-clip-text text-transparent">
        {{ $pageTitle }}
    </h1>
    <div class="flex gap-2">
        <button class="px-4 py-2 bg-off-white/80 backdrop-blur-sm text-slate-navy hover:bg-off-white border border-border-gray rounded-lg transition-all shadow-sm hover:shadow-md">
            <i class="fas fa-download mr-2"></i>
            Export
        </button>

        <a href="{{ $addUserRoute }}" class="px-6 py-2 bg-gradient-to-r from-slate-navy to-cool-gray text-off-white hover:from-cool-gray hover:to-slate-navy rounded-lg transition-all shadow-lg hover:shadow-xl">
            <i class="fas fa-plus mr-2"></i>
            {{ $addButtonText }}
        </a>
    </div>
</div>

<!-- Stats Cards -->
@if(count($stats) > 0)
<div class="grid grid-cols-2 gap-4 md:grid-cols-4 mb-6">
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
@if(count($filterOptions) > 0)
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
            <div class="flex gap-2">
                <div class="relative inline-block w-48">
                    <select id="filterSelect" class="appearance-none w-full px-4 py-2 pr-10 bg-white border border-gray-300 rounded-lg shadow-sm
                        focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition cursor-pointer">
                        <option value="">Semua</option>
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
        </div>

        <div class="text-sm text-slate-600">
            <span id="resultCount">{{ $itemCount }}</span> data ditemukan
        </div>
    </div>
</div>
@endif

@push('scripts')
<script>
    function initializeFilters() {
        const searchInput = document.getElementById('searchInput');
        const filterSelect = document.getElementById('filterSelect');
        const resultCount = document.getElementById('resultCount');

        // Cari baris data, cek kelas user-row / topik-row, dll sesuai konvensi data
        let rows = [];
        if (document.querySelectorAll('.user-row').length > 0) {
            rows = document.querySelectorAll('.user-row');
        } else if (document.querySelectorAll('.topik-row').length > 0) {
            rows = document.querySelectorAll('.topik-row');
        } else {
            return; // Tidak ada data untuk difilter
        }

        function filterItems() {
            const searchTerm = searchInput.value.toLowerCase().trim();
            const selectedFilter = filterSelect.value.toLowerCase();

            let visibleCount = 0;

            rows.forEach(row => {
                let matchesSearch = false;
                let matchesFilter = false;

                if (row.classList.contains('user-row')) {
                    const name = row.dataset.name || '';
                    const username = row.dataset.username || '';
                    const role = row.dataset.role || '';

                    matchesSearch = name.includes(searchTerm) || username.includes(searchTerm);
                    matchesFilter = !selectedFilter || role === selectedFilter;
                } else if (row.classList.contains('topik-row')) {
                    const judul = row.dataset.judul || '';
                    const kelas = row.dataset.kelas || '';
                    const jurusan = row.dataset.jurusan || '';
                    const rencana = row.dataset.rencana || '';

                    matchesSearch = judul.includes(searchTerm);
                    matchesFilter = !selectedFilter || kelas === selectedFilter || jurusan === selectedFilter || rencana === selectedFilter;
                }

                if (matchesSearch && matchesFilter) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            resultCount.textContent = visibleCount;
        }

        searchInput.addEventListener('input', filterItems);
        filterSelect.addEventListener('change', filterItems);
    }

    document.addEventListener('DOMContentLoaded', initializeFilters);
</script>
@endpush
