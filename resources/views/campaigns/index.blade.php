<x-app-layout>
    <div class="py-6 px-6 lg:px-8 max-w-7xl mx-auto space-y-6">

        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-sm font-medium flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                {{ session('success') }}
            </div>
        @endif

        {{-- Header Halaman --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
                <h1 class="text-2xl font-extrabold text-slate-950 tracking-tight">Daftar Campaign</h1>
                <p class="text-xs text-slate-500 mt-0.5">Kelola induk kampanye, periode event, dan total konten di dalamnya.</p>
            </div>
            <a href="{{ route('campaigns.create') }}" class="inline-flex items-center justify-center gap-1.5 px-4 py-2.5 rounded-xl bg-[#254EDB] hover:bg-blue-700 text-white text-xs font-bold transition shadow-sm shadow-blue-600/20">
                + Tambah Campaign
            </a>
        </div>

        {{-- Tabel Campaign --}}
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-2xs overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-100 text-[11px] font-bold uppercase tracking-wider text-slate-400 bg-slate-50/50">
                            <th class="py-3.5 px-6">Campaign</th>
                            <th class="py-3.5 px-4">Periode</th>
                            <th class="py-3.5 px-4">Jumlah Konten</th>
                            <th class="py-3.5 px-4">Status</th>
                            <th class="py-3.5 px-6 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse($campaigns as $campaign)
                            @php
                                $statusStyle = match($campaign->status) {
                                    'active' => ['bg' => 'bg-emerald-50 text-emerald-700', 'dot' => 'bg-emerald-500', 'label' => 'Active'],
                                    'completed' => ['bg' => 'bg-slate-950 text-white', 'dot' => 'bg-[#FFDC4A]', 'label' => 'Selesai'],
                                    default => ['bg' => 'bg-slate-100 text-slate-700', 'dot' => 'bg-slate-400', 'label' => ucfirst($campaign->status)],
                                };
                                $totalKonten = $campaign->contents_count ?? $campaign->contents->count();
                            @endphp

                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="py-4 px-6">
                                    <div class="flex items-start gap-3.5">
                                        <div class="w-9 h-9 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0 mt-0.5">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <div class="max-w-md">
                                            <p class="font-bold text-slate-950 text-sm">{{ $campaign->title }}</p>
                                            <p class="text-xs text-slate-500 mt-0.5 line-clamp-1">{{ $campaign->description ?? 'Tidak ada deskripsi.' }}</p>
                                        </div>
                                    </div>
                                </td>

                                <td class="py-4 px-4 whitespace-nowrap">
                                    <p class="text-xs font-bold text-slate-800">
                                        {{ \Carbon\Carbon::parse($campaign->start_date)->format('d M Y') }}
                                    </p>
                                    <p class="text-[11px] text-slate-400 mt-0.5">
                                        s/d {{ \Carbon\Carbon::parse($campaign->end_date)->format('d M Y') }}
                                    </p>
                                </td>

                                <td class="py-4 px-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-[#254EDB]">
                                        {{ $totalKonten }} Konten
                                    </span>
                                </td>

                                <td class="py-4 px-4 whitespace-nowrap">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold {{ $statusStyle['bg'] }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $statusStyle['dot'] }}"></span>
                                        {{ $statusStyle['label'] }}
                                    </span>
                                </td>

                                <td class="py-4 px-6 text-right whitespace-nowrap">
                                    <div class="inline-flex items-center gap-1.5">
                                        <a href="{{ route('campaigns.edit', $campaign) }}" class="px-3 py-1.5 rounded-lg bg-slate-100 text-slate-700 hover:bg-slate-200 text-xs font-semibold transition">
                                            Edit
                                        </a>
                                        <form action="{{ route('campaigns.destroy', $campaign) }}" method="POST" class="inline" onsubmit="return confirm('Hapus campaign ini beserta seluruh konten di dalamnya?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-2.5 py-1.5 rounded-lg text-slate-400 hover:text-red-600 hover:bg-red-50 text-xs font-semibold transition">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-12 text-center text-slate-400 text-sm">
                                    Belum ada campaign. Klik <strong>+ Tambah Campaign</strong> untuk memulai.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>