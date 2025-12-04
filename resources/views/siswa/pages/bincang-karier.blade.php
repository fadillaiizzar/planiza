@extends('layouts.siswa')

@section('title', 'Bincang Karier - Siswa')

@section('content')

<div id="main-content" class="px-4 py-8 sm:px-8">

    {{-- Header Section --}}
    <x-siswa.section-header
        title="Bincang Karier"
        subtitle="Ajukan pertanyaan seputar pilihan karier, jurusan kuliah, dan masa depanmu"
        back-route="siswa.dashboard"
    />

    {{-- Action Bar : Search + Create Button --}}
    @include('siswa.bincang_karier.action-bar')

    {{-- Stats Summary --}}
    @include('siswa.bincang_karier.stats-summary')

    {{-- Card Questions --}}
    @include('siswa.bincang_karier.card-questions')

    {{-- Pagination --}}
    <div class="mt-8">
        {{ $bincangKarier->links() }}
        <x-paginate :items="$bincangKarier" />
    </div>
</div>

<div id="modalCreateBincang" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
    @include('siswa.bincang_karier.create')
</div>

<div id="modalEditBincang" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
    @include('siswa.bincang_karier.edit')
</div>

<div id="modalDeleteBincang" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
    @include('siswa.bincang_karier.delete')
</div>

@endsection

@push('scripts')
    <script>
        // ========== SEARCH FUNCTIONALITY ==========
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search');
            const cards = document.querySelectorAll('.card-question');

            // Tambahkan container untuk empty message
            const container = document.querySelector('.grid');
            let emptyMsg = document.createElement('div');
            emptyMsg.className = 'col-span-full text-center text-cool-gray italic py-6 hidden';
            emptyMsg.textContent = 'Tidak ada pertanyaan atau tanggapan yang cocok.';
            container.appendChild(emptyMsg);

            searchInput.addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase();
                let visibleCount = 0;

                cards.forEach(card => {
                    const pertanyaan = card.querySelector('h3')?.textContent.toLowerCase() || '';
                    const tanggapanCount = card.querySelector('.fa-comments + span')?.textContent.toLowerCase() || '';

                    if (pertanyaan.includes(searchTerm) || tanggapanCount.includes(searchTerm)) {
                        card.style.display = 'block';
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                // Tampilkan pesan jika tidak ada hasil
                if (visibleCount === 0) {
                    emptyMsg.classList.remove('hidden');
                } else {
                    emptyMsg.classList.add('hidden');
                }
            });
        });

        // ========== CREATE ==========
        function openCreateBincang() {
            document.getElementById('modalCreateBincang').classList.remove('hidden');
            document.getElementById('modalCreateBincang').classList.add('flex');
        }

        function closeCreateBincang() {
            document.getElementById('modalCreateBincang').classList.add('hidden');
            document.getElementById('modalCreateBincang').classList.remove('flex');
        }

        // ========== EDIT ==========
        function openEditBincang(id, isi) {
            // Set action form update
            document.getElementById('formEditBincang').action = `/siswa/bincang-karier/${id}`;
            // Set textarea value
            document.getElementById('editIsiPertanyaan').value = isi;

            document.getElementById('modalEditBincang').classList.remove('hidden');
            document.getElementById('modalEditBincang').classList.add('flex');
        }

        function closeEditBincang() {
            document.getElementById('modalEditBincang').classList.add('hidden');
            document.getElementById('modalEditBincang').classList.remove('flex');
        }

        // ========== DELETE ==========
        function openDeleteBincang(id, text) {
            document.getElementById('modalDeleteBincang').classList.remove('hidden');
            document.getElementById('modalDeleteBincang').classList.add('flex');
            document.getElementById('deleteBincangText').textContent = '"' + text + '"';

            const form = document.getElementById('deleteBincangForm');
            form.action = `/siswa/bincang-karier/${id}`;
        }

        function closeDeleteBincang() {
            document.getElementById('modalDeleteBincang').classList.add('hidden');
        }
    </script>
@endpush
