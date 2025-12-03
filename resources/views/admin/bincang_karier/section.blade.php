<x-admin.toast />

<div class="mx-auto max-w-7xl space-y-6">

    @include('admin.components.header.header', [
        'pageTitle' => $pageTitle,
        'addButtonText' => $addButtonText,
        'stats' => $stats,
        'filterOptions' => $filterOptions ?? [],
        'searchPlaceholder' => $searchPlaceholder ?? 'Cari...',
        'defaultFilterText' => 'Semua Status',
        'itemCount' => count($items),
    ])

    <section class="bg-white rounded-xl shadow p-6 mt-6">
        <h3 class="text-lg font-semibold text-slate-navy mb-4">Daftar Pertanyaan Bincang Karier</h3>

        <div class="overflow-x-auto scrollbar-none">
            <table class="w-full text-left text-sm table-auto">
                <thead class="bg-off-white border-b border-border-gray">
                    <tr>
                        @foreach ($tableHeaders as $header)
                            <th class="p-4 font-semibold text-slate-navy">{{ $header }}</th>
                        @endforeach
                    </tr>
                </thead>

                <tbody>
                    @forelse ($items as $index => $item)
                        <tr class="border-b border-border-gray hover:bg-off-white/50 transition">
                            <td class="p-4">{{ $items->firstItem() + $index }}</td>

                            <td class="p-4">{{ Str::limit($item->user?->name ?? '-', 15) }}</td>

                            <td class="p-4">{{ Str::limit($item->isi_pertanyaan, 50) }}</td>

                            <td class="p-4">{{ $item->tanggapanKarier_count ?? $item->tanggapanKarier->count() }}</td>

                            <td class="p-4">{{ $item->created_at->format('d M Y') }}</td>

                            <td class="p-4 relative overflow-visible">
                                <button onclick="toggleDropdown({{ $item->id }})"
                                    class="p-2 rounded-lg hover:bg-off-white focus:outline-none focus:ring-2 focus:ring-blue-200 transition-all">
                                    <i class="fas fa-cog text-cool-gray"></i>
                                </button>

                                <div id="dropdown-{{ $item->id }}" class="hidden absolute right-12 mt-2 bg-white border border-border-gray rounded-lg shadow-xl z-20 min-w-[180px] overflow-visible">
                                    <a href="{{ route('admin.bincang-karier.show', $item->id) }}"
                                        class="px-5 py-3 hover:bg-yellow-50 flex items-center gap-3 text-blue-600 transition-colors text-base">
                                        <i class="fas fa-eye w-5 h-5"></i>
                                        <span>Detail</span>
                                    </a>
                                    <div class="border-t border-border-gray"></div>
                                    <form action="{{ route('admin.bincang-karier.destroy', $item->id) }}" method="POST" class="w-full">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            onclick="showDeleteModal({{ $item->id }}, '{{ addslashes(Str::limit($item->isi_pertanyaan, 30)) }}', '{{ route('admin.bincang-karier.destroy', $item->id) }}')"
                                            class="w-full text-left px-5 py-3 hover:bg-red-50 flex items-center gap-3 text-red-600 transition-colors text-base">
                                            <i class="fas fa-trash-alt w-5 h-5"></i>
                                            <span>Hapus</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <x-empty-state
                            icon="fas fa-comments"
                            message="Belum ada pertanyaan Bincang Karier"
                        />
                    @endforelse

                    <x-no-data-row />
                </tbody>
            </table>
        </div>


    </section>
</div>

@include('admin.bincang_karier.delete')

<script>
    // DELETE
    function showDeleteModal(id, name, action) {
        document.getElementById('deleteBincangModal').classList.remove('hidden');
        document.getElementById('deleteNamaBincang').innerText = name;
        document.getElementById('deleteBincangForm').action = action;
        const form = document.getElementById('deleteForm');
        form.action = action;
    }

    function closeDeleteModal() {
        document.getElementById('deleteBincangModal').classList.add('hidden');
    }
</script>
