<div class="mx-auto max-w-7xl space-y-6">
    @include('admin.components.header.header', [
        'pageTitle' => $pageTitle,
        'addButtonText' => $addButtonText,
        'userCount' => $userCount,
        'stats' => $stats,
        'filterOptions' => $filterOptions ?? [],
        'searchPlaceholder' => $searchPlaceholder ?? 'Cari...',
        'itemCount' => $itemCount ?? 0,
    ])

    <!-- Statistik -->
    <section class="bg-off-white rounded-2xl shadow-lg p-6">
        <h3 class="text-xl font-bold text-slate-navy mb-6">{{ $statistikTitle }}</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Profesi per Industri -->
            <div class="bg-white rounded-xl border border-border-gray shadow-sm p-5 hover:shadow-md transition-shadow duration-300">
                <h4 class="text-lg font-semibold text-slate-navy mb-4">{{ $iconKelas ?? '💼' }} {{ $labelKelas }}</h4>
                <ul class="space-y-2 text-cool-gray">
                    @foreach(($allProfesi->groupBy('industri') ?? []) as $industri => $profesi)
                        <li class="flex justify-between items-center border-b border-border-gray pb-1 last:border-none last:pb-0">
                            <span>{{ $industri ?: 'Tidak ada industri' }}</span>
                            <strong class="text-slate-navy">{{ $profesi->count() }}</strong>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    <!-- Daftar Profesi -->
    <section class="bg-white rounded-xl shadow p-6 mt-6">
        <h3 class="text-xl font-bold mb-6 text-slate-navy">{{ $tableTitle }}</h3>
        <div class="overflow-x-auto scrollbar-none">
            <table class="w-full text-left text-sm table-auto">
                <thead class="bg-off-white border-b border-border-gray">
                    <tr>
                        @foreach($tableHeaders as $header)
                            <th class="p-4 font-semibold text-slate-navy">{{ $header }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr class="border-b border-border-gray hover:bg-off-white/50 transition-colors">
                            <td class="p-4">{{ $item->id }}</td>
                            <td class="p-4">{{ Str::limit($item->nama_profesi_kerja, 15) }}</td>
                            <td class="p-4">Rp{{ number_format($item->gaji, 0, ',', '.') }}</td>
                            <td class="p-4">{{ Str::limit($item->info_skill, 15) }}</td>
                            <td class="p-4">{{ Str::limit($item->info_jurusan, 15) }}</td>
                            <td class="p-4 relative overflow-visible">
                                <button onclick="toggleDropdown({{ $item->id }})"
                                    class="p-2 rounded-lg hover:bg-off-white focus:outline-none focus:ring-2 focus:ring-blue-200 transition-all">
                                    <i class="fas fa-cog text-cool-gray"></i>
                                </button>

                                <div id="dropdown-{{ $item->id }}" class="hidden absolute right-20 mt-2 bg-white border border-border-gray rounded-lg shadow-xl z-20 min-w-[180px] overflow-visible">
                                    <a href="{{ route('admin.profesi-kerja.show', $item->id) }}"
                                        class="px-5 py-3 hover:bg-yellow-50 flex items-center gap-3 text-blue-600 transition-colors text-base">
                                        <i class="fas fa-eye w-5 h-5"></i>
                                        <span>Detail</span>
                                    </a>
                                    <div class="border-t border-border-gray"></div>
                                    <a href="{{ route('admin.profesi-kerja.edit', $item->id) }}"
                                        class="px-5 py-3 hover:bg-green-50 flex items-center gap-3 text-green-600 transition-colors text-base">
                                        <i class="fas fa-edit w-5 h-5"></i>
                                        <span>Edit</span>
                                    </a>
                                    <div class="border-t border-border-gray"></div>
                                    <form action="{{ route('admin.profesi-kerja.destroy', $item->id) }}" method="POST"
                                        class="w-full">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="w-full text-left px-5 py-3 hover:bg-red-50 flex items-center gap-3 text-red-600 transition-colors text-base">
                                            <i class="fas fa-trash-alt w-5 h-5"></i>
                                            <span>Hapus</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</div>
