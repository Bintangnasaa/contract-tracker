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
                <h1 class="text-2xl font-extrabold text-slate-950 tracking-tight">Daftar Konten</h1>
                <p class="text-xs text-slate-500 mt-0.5">Kelola jadwal produksi, platform, status, dan penugasan tim.</p>
            </div>
            <a href="{{ route('contents.create') }}" class="inline-flex items-center justify-center gap-1.5 px-4 py-2.5 rounded-xl bg-[#254EDB] hover:bg-blue-700 text-white text-xs font-bold transition shadow-sm shadow-blue-600/20">
                + Tambah Konten
            </a>
        </div>

        {{-- Form Filter & Search --}}
        <form method="GET" action="{{ route('contents.index') }}" class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-2xs flex flex-wrap gap-3 items-center">
            <div class="relative flex-1 min-w-[220px]">
                <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul konten..."
                       class="w-full pl-9 pr-4 py-2 rounded-xl bg-slate-50 border border-slate-200 text-xs text-slate-700 placeholder-slate-400 focus:bg-white focus:border-[#254EDB] focus:ring-[#254EDB]">
            </div>

            <select name="status" class="rounded-xl bg-slate-50 border border-slate-200 text-xs text-slate-700 px-3.5 py-2 focus:bg-white focus:border-[#254EDB] focus:ring-[#254EDB]">
                <option value="">Semua Status</option>
                @foreach(['idea', 'scripting', 'shooting', 'editing', 'published'] as $st)
                    <option value="{{ $st }}" {{ request('status') === $st ? 'selected' : '' }}>{{ ucfirst($st) }}</option>
                @endforeach
            </select>

            <select name="platform" class="rounded-xl bg-slate-50 border border-slate-200 text-xs text-slate-700 px-3.5 py-2 focus:bg-white focus:border-[#254EDB] focus:ring-[#254EDB]">
                <option value="">Semua Platform</option>
                @foreach(['ig_reels' => 'IG Reels', 'tiktok' => 'TikTok', 'youtube' => 'YouTube', 'shorts' => 'Shorts'] as $val => $label)
                    <option value="{{ $val }}" {{ request('platform') === $val ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>

            <button type="submit" class="bg-slate-950 hover:bg-slate-800 text-white px-4 py-2 rounded-xl text-xs font-bold transition">
                Filter
            </button>

            @if(request()->hasAny(['search', 'status', 'platform']))
                <a href="{{ route('contents.index') }}" class="text-xs font-semibold text-slate-400 hover:text-red-500 transition px-1">
                    Reset
                </a>
            @endif
        </form>

        {{-- Tabel Konten --}}
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-2xs overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-100 text-[11px] font-bold uppercase tracking-wider text-slate-400 bg-slate-50/50">
                            <th class="py-3.5 px-6">Konten</th>
                            <th class="py-3.5 px-4">Campaign</th>
                            <th class="py-3.5 px-4">Deadline</th>
                            <th class="py-3.5 px-4">Status</th>
                            <th class="py-3.5 px-6 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse($contents as $content)
                            @php
                                $daysLeft = (int) \Carbon\Carbon::today()->diffInDays(\Carbon\Carbon::parse($content->deadline)->startOfDay(), false);

                                $statusStyle = match($content->status) {
                                    'published' => ['bg' => 'bg-slate-950 text-white', 'dot' => 'bg-[#FFDC4A]', 'label' => 'Terbit'],
                                    'editing' => ['bg' => 'bg-amber-50 text-amber-800', 'dot' => 'bg-amber-400', 'label' => 'Editing'],
                                    'shooting' => ['bg' => 'bg-blue-50 text-blue-700', 'dot' => 'bg-blue-600', 'label' => 'Shooting'],
                                    'scripting' => ['bg' => 'bg-indigo-50 text-indigo-700', 'dot' => 'bg-indigo-500', 'label' => 'Scripting'],
                                    default => ['bg' => 'bg-slate-100 text-slate-700', 'dot' => 'bg-slate-400', 'label' => 'Idea'],
                                };
                            @endphp

                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-3.5">
                                        <x-platform-icon :platform="$content->platform" />
                                        <div>
                                            <a href="{{ route('contents.show', $content) }}" class="font-bold text-slate-950 hover:text-[#254EDB] transition text-sm">
                                                {{ $content->title }}
                                            </a>
                                            <p class="text-[11px] text-slate-400 font-semibold uppercase mt-0.5">
                                                {{ str_replace('_', ' ', $content->platform) }}
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <td class="py-4 px-4 text-xs font-medium text-slate-600">
                                    {{ $content->campaign->title }}
                                </td>

                                <td class="py-4 px-4">
                                    <p class="text-xs font-bold text-slate-800">{{ \Carbon\Carbon::parse($content->deadline)->format('d M Y') }}</p>
                                    @if($content->status !== 'published' && $daysLeft <= 3)
                                        <p class="text-[10px] font-bold mt-0.5 {{ $daysLeft <= 0 ? 'text-red-600' : 'text-amber-600' }}">
                                            {{ $daysLeft < 0 ? 'Telat ' . abs($daysLeft) . ' hari' : ($daysLeft === 0 ? 'Hari ini!' : 'Kurang ' . $daysLeft . ' hari') }}
                                        </p>
                                    @endif
                                </td>

                                <td class="py-4 px-4">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold {{ $statusStyle['bg'] }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $statusStyle['dot'] }}"></span>
                                        {{ $statusStyle['label'] }}
                                    </span>
                                </td>

                                <td class="py-4 px-6 text-right">
                                    <div class="inline-flex items-center gap-1.5">
                                        <a href="{{ route('contents.show', $content) }}" class="px-3 py-1.5 rounded-lg bg-blue-50 text-[#254EDB] hover:bg-blue-100 text-xs font-bold transition">
                                            Detail & Task
                                        </a>
                                        <a href="{{ route('contents.edit', $content) }}" class="px-3 py-1.5 rounded-lg bg-slate-100 text-slate-700 hover:bg-slate-200 text-xs font-semibold transition">
                                            Edit
                                        </a>
                                        <form action="{{ route('contents.destroy', $content) }}" method="POST" class="inline" onsubmit="return confirm('Hapus konten ini?')">
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
                                    Belum ada konten yang cocok dengan filter.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>