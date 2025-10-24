@extends('layouts.admin')

@section('title', 'Riwayat Pengerjaan - ' . ($student->name ?? '-'))

@section('content')
<div class="mx-auto max-w-6xl space-y-6 p-4 md:p-6">
    <x-admin.breadcrumb :links="[
        ['href' => route('admin.dashboard'), 'icon' => 'fas fa-home', 'title' => 'Dashboard'],
        ['href' => route('admin.kenali-jurusan.hasil-form.index'), 'icon' => 'fas fa-clipboard-list', 'title' => 'Hasil Form'],
        ['title' => $student->name, 'icon' => 'fas fa-user'],
    ]" />

    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-slate-800">{{ $student->name }}</h1>
        <p class="text-slate-500">
            {{ ($student->siswa?->kelas?->nama_kelas ?? '-') . ' ' . ($student->siswa?->jurusan?->nama_jurusan ?? '-') }}
        </p>
    </div>

    <div class="overflow-x-auto bg-white shadow-md rounded-xl border border-gray-100">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50">
                <tr>
                    <th class="p-4 font-semibold text-gray-600">Attempt</th>
                    <th class="p-4 font-semibold text-gray-600">Update Terakhir</th>
                    <th class="p-4 font-semibold text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($attempts as $item)
                    <tr class="border-b border-border-gray hover:bg-off-white/50 transition-colors">
                        <td class="p-4 text-gray-700">Attempt {{ $item->attempt_number }}</td>
                        <td class="p-4 text-gray-700">
                            {{ $item->update_terakhir ? \Carbon\Carbon::parse($item->update_terakhir)->format('d M Y H:i') : '-' }}
                        </td>
                        <td class="p-4">
                            <a href="{{ route('admin.kenali-jurusan.hasil-form.user-attempt', ['user_id' => $student->id, 'form_id' => $item->form_id]) }}"
                                class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full hover:shadow-md transition">
                                Lihat Form
                            </a>
                        </td>
                    </tr>
                @empty
                    <x-empty-state
                        icon="fas fa-list"
                        message="Belum ada attempt form"
                    />
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
