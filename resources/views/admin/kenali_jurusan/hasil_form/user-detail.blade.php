@extends('layouts.admin')

@section('title', 'Detail Pengerjaan - ' . ($user->name ?? '-'))

@section('content')
<div class="mx-auto w-full space-y-6 p-4 md:p-6">
    <x-admin.breadcrumb :links="[
        ['href' => route('admin.dashboard'), 'icon' => 'fas fa-home', 'title' => 'Dashboard'],
        ['href' => route('admin.kenali-jurusan.hasil-form.index'), 'icon' => 'fas fa-file-alt', 'title' => 'Hasil Form'],
        ['href' => '#', 'icon' => 'fas fa-user', 'title' => $user->name],
    ]" />

    <section class="bg-white rounded-xl shadow p-6 mt-6">
        <h3 class="text-lg font-semibold text-slate-navy mb-4">Detail Pengerjaan {{ $user->name }}</h3>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-off-white">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-navy">Pengerjaan ke</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-navy">Tanggal</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-slate-navy">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-gray">
                    @foreach ($data['riwayat'] as $r)
                        <tr class="hover:bg-off-white transition-colors duration-150">
                            <td class="px-6 py-4 text-slate-navy font-medium">{{ $r['ke'] }}</td>
                            <td class="px-6 py-4 text-cool-gray">{{ $r['tanggal'] }}</td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('admin.kenali-jurusan.hasil-form.user-attempt', [
                                    'userId' => request()->route('user_id'),
                                    'attempt' => $r['ke']
                                ]) }}"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-slate-navy rounded-lg hover:bg-opacity-90 transition">
                                    Lihat Form
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4 text-sm text-cool-gray">
                Total <span class="font-semibold text-slate-navy">{{ $data['total'] }}</span> pengerjaan
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
@endpush
