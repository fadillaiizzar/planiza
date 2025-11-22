<x-admin.toast />

<div class="mx-auto max-w-7xl space-y-6">
    @include('admin.components.header.header', [
        'pageTitle' => $pageTitle,
        'addButtonText' => $addButtonText,
        'userCount' => $userCount,
        'stats' => $stats,
        'searchPlaceholder' => $searchPlaceholder ?? 'Cari...',
        'itemCount' => $itemCount ?? 0,
    ])

    <!-- Daftar Jurusan Kuliah -->
    <section class="bg-white rounded-xl shadow p-6 mt-6">
        <x-h3>{{ $tableTitle }}</x-h3>
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
                    @forelse ($items as $item)
                        <tr class="border-b border-border-gray hover:bg-off-white/50 transition-colors jurusan-kuliah-row"
                            data-jurusan='{{ strtolower($item->nama_jurusan_kuliah) }}'
                            data-deskripsi='{{ strtolower($item->deskripsi) }}'
                            data-matkul='{{ strtolower($item->info_matkul) }}'
                            data-prospek='{{ strtolower($item->info_prospek) }}'
                        >
                            <td class="p-4">{{ $item->id }}</td>
                            <td class="p-4">{{ Str::limit($item->nama_jurusan_kuliah, 20) }}</td>
                            <td class="p-4">
                                @if($item->gambar)
                                    <img src="{{ asset('storage/'.$item->gambar) }}" alt="{{ $item->nama_jurusan_kuliah }}" class="w-12 h-12 object-cover rounded-lg">
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="p-4">{{ Str::limit($item->deskripsi, 20) }}</td>
                            <td class="p-4">{{ Str::limit($item->info_matkul, 10) }}</td>
                            <td class="p-4">{{ Str::limit($item->info_prospek, 20) }}</td>
                            <td class="p-4 relative overflow-visible">
                                <button onclick="toggleDropdown({{ $item->id }})"
                                    class="p-2 rounded-lg hover:bg-off-white focus:outline-none focus:ring-2 focus:ring-blue-200 transition-all">
                                    <i class="fas fa-cog text-cool-gray"></i>
                                </button>

                                <div id="dropdown-{{ $item->id }}" class="hidden absolute right-12 mt-2 bg-white border border-border-gray rounded-lg shadow-xl z-20 min-w-[180px] overflow-visible">
                                    <a href="{{ route('admin.eksplorasi-jurusan.jurusan-kuliah.show', $item->id) }}"
                                        class="px-5 py-3 hover:bg-yellow-50 flex items-center gap-3 text-blue-600 transition-colors text-base">
                                        <i class="fas fa-eye w-5 h-5"></i>
                                        <span>Detail</span>
                                    </a>
                                    <div class="border-t border-border-gray"></div>
                                    <button onclick="showEdit({{ $item->id }})"
                                        class="px-5 py-3 hover:bg-green-50 flex items-center gap-3 text-green-600 transition-colors text-base">
                                        <i class="fas fa-edit w-5 h-5"></i>
                                        <span>Edit</span>
                                    </button>
                                    <div class="border-t border-border-gray"></div>
                                    <form action="{{ route('admin.eksplorasi-jurusan.jurusan-kuliah.destroy', $item->id) }}" method="POST" class="w-full">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            onclick="showDeleteModal({{ $item->id }}, '{{ addslashes($item->nama_jurusan_kuliah) }}', '{{ route('admin.eksplorasi-jurusan.jurusan-kuliah.destroy', $item->id) }}')"
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
                            colspan="6"
                            icon="fas fa-graduation-cap"
                            message="Belum ada jurusan kuliah. Tambahkan data"
                            button="true"
                            buttonAction="openModal()"
                            buttonText="+ Tambah Jurusan"
                        />
                    @endforelse

                    <x-no-data-row />
                </tbody>
            </table>
        </div>
    </section>
</div>

@include('admin.eksplorasi_kuliah.jurusan_kuliah.delete')

<script>
    // Modal Edit
    function showEdit(id) {
        fetch(`/admin/eksplorasi-jurusan/jurusan-kuliah/${id}/edit`)
            .then(res => res.text())
            .then(html => {
                document.getElementById('modalContentEdit').innerHTML = html;
                openModalEdit();
        });
    }

    function openModalEdit() {
        const modal = document.getElementById('modalEdit');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.classList.add('overflow-hidden');
    }

    function closeModalEdit() {
        const modal = document.getElementById('modalEdit');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.classList.remove('overflow-hidden');
    }

    // Modal Delete
    function showDeleteModal(id, name, action) {
        document.getElementById('deleteModal').classList.remove('hidden');
        document.getElementById('deleteJurusanName').textContent = name;
        const form = document.getElementById('deleteForm');
        form.action = action;
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }
</script>
