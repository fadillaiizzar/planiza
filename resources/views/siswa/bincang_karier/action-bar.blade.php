<div class="flex flex-col sm:flex-row gap-3 mb-6 items-stretch sm:items-center">
    {{-- Search Bar --}}
    <div class="flex-1 relative">
        <input
            type="text"
            id="search"
            placeholder="Cari pertanyaan berdasarkan kata kunci..."
            class="w-full pl-11 pr-4 py-2.5 rounded-xl border border-border-gray focus:outline-none focus:ring-2 focus:ring-slate-navy focus:border-transparent text-sm transition-all"
        />
        <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-cool-gray text-sm"></i>
    </div>

    {{-- Create Button --}}
    <button onclick="openCreateBincang()"
        class="bg-slate-navy text-white px-6 py-2.5 rounded-xl shadow-sm hover:shadow-md transition-all duration-200 text-sm font-semibold flex items-center justify-center gap-2 hover:bg-opacity-90 whitespace-nowrap">
        <i class="fas fa-plus"></i>
        <span>Buat Pertanyaan</span>
    </button>
</div>
