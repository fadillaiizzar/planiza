<div class="bg-white rounded-2xl overflow-hidden mb-10 shadow-lg border border-border-gray/30">
    <div class="px-6 py-5 bg-gradient-to-r from-slate-navy to-cool-gray">
        <h2 class="text-lg font-bold text-white tracking-wide">Daftar Jawaban</h2>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-off-white border-b-2 border-slate-navy/10">
                    <th class="px-6 py-4 text-left text-slate-navy">No</th>
                    <th class="px-6 py-4 text-left text-slate-navy">Pertanyaan</th>
                    <th class="px-6 py-4 text-left text-slate-navy">Jawaban</th>
                    <th class="px-6 py-4 text-left text-slate-navy">Poin</th>
                    <th class="px-6 py-4 text-left text-slate-navy">Profesi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border-gray/50">
                @php $no = 1; @endphp
                @forelse ($jawaban as $soal)
                    @foreach ($soal['jawaban'] as $idx => $jwb)
                        <tr class="group hover:bg-gradient-to-r hover:from-off-white hover:to-white transition-all duration-200">
                            @if ($idx == 0)
                                <td rowspan="{{ count($soal['jawaban']) }}" class="px-6 py-4 align-top">
                                    <div class="w-8 h-8 rounded-lg  flex items-center justify-center">
                                        <span class="text-sm font-bold text-slate-navy">{{ $no++ }}</span>
                                    </div>
                                </td>
                                <td rowspan="{{ count($soal['jawaban']) }}" class="px-6 py-4 text-sm text-slate-navy font-medium align-top max-w-md">
                                    {{ $soal['pertanyaan'] }}
                                </td>
                            @endif
                            <td class="px-6 py-4 text-sm text-cool-gray">{{ $jwb['isi_opsi'] }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center justify-center min-w-[2.5rem] px-3 py-1.5 rounded-lg bg-gradient-to-r from-slate-navy to-cool-gray text-white text-xs font-bold shadow-sm">
                                    {{ $jwb['poin'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-navy font-medium">{{ $jwb['profesi_tujuan'] ?? '-' }}</td>
                        </tr>
                    @endforeach
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <div class="w-16 h-16 rounded-full bg-off-white flex items-center justify-center">
                                    <svg class="w-8 h-8 text-cool-gray" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                    </svg>
                                </div>
                                <p class="text-cool-gray font-medium">Belum ada jawaban</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
