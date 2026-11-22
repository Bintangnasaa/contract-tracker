<x-app-layout>
    <div class="py-6 px-6 lg:px-8 max-w-7xl mx-auto space-y-6">

        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-sm font-medium flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                {{ session('success') }}
            </div>
        @endif

        {{-- HERO BANNER BIRU ELEKTRIK + GRAFIK KUNING --}}
        <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-[#2442E6] via-[#2848F0] to-[#1E39C8] p-6 sm:p-8 text-white shadow-lg shadow-blue-600/20 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
            <div class="relative z-10 max-w-lg">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-extrabold uppercase tracking-wider bg-[#FFDC4A] text-slate-950 mb-4">
                    <span class="w-1.5 h-1.5 rounded-full bg-slate-950"></span>
                    {{ auth()->user()->role === 'admin' ? 'Dashboard Tim' : 'Ruang Kerja Crew' }}
                </span>
                <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Progres Konten</h1>
                <p class="text-sm text-blue-100 mt-1.5 leading-relaxed">
                    Lihat status produksi, progres, dan tenggat setiap konten dalam satu tempat.
                </p>
            </div>

            {{-- Ilustrasi Grafik Minimalis --}}
            <div class="hidden md:block relative z-10 w-72 shrink-0">
                <svg viewBox="0 0 260 110" class="w-full h-auto">
                    <line x1="10" y1="88" x2="250" y2="88" stroke="rgba(255,255,255,0.2)" stroke-dasharray="3 3"/>
                    <rect x="25" y="64" width="22" height="24" rx="4" fill="rgba(255,255,255,0.22)"/>
                    <rect x="65" y="54" width="22" height="34" rx="4" fill="rgba(255,255,255,0.32)"/>
                    <rect x="105" y="42" width="22" height="46" rx="4" fill="rgba(255,255,255,0.45)"/>
                    <rect x="145" y="48" width="22" height="40" rx="4" fill="rgba(255,255,255,0.38)"/>
                    <rect x="185" y="32" width="22" height="56" rx="4" fill="rgba(255,255,255,0.65)"/>
                    <rect x="225" y="20" width="22" height="68" rx="4" fill="#FFDC4A"/>
                    <polyline fill="none" stroke="#FFDC4A" stroke-width="2" points="36,56 76,46 116,32 156,38 196,22 236,10"/>
                    <circle cx="36" cy="56" r="3" fill="#FFDC4A"/>
                    <circle cx="76" cy="46" r="3" fill="#FFDC4A"/>
                    <circle cx="116" cy="32" r="3" fill="#FFDC4A"/>
                    <circle cx="156" cy="38" r="3" fill="#FFDC4A"/>
                    <circle cx="196" cy="22" r="3" fill="#FFDC4A"/>
                    <circle cx="236" cy="10" r="4" fill="#FFDC4A" stroke="white" stroke-width="1.5"/>
                    <text x="20" y="104" fill="rgba(255,255,255,0.6)" font-size="8" font-weight="700" letter-spacing="1.5">BRIEF</text>
                    <text x="104" y="104" fill="rgba(255,255,255,0.6)" font-size="8" font-weight="700" letter-spacing="1.5">PRODUKSI</text>
                    <text x="214" y="104" fill="rgba(255,255,255,0.6)" font-size="8" font-weight="700" letter-spacing="1.5">TERBIT</text>
                </svg>
            </div>
        </div>

        @if(auth()->user()->role === 'admin')
            {{-- 4 KARTU KPI --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-[#FFDC4A] text-slate-950 p-5 rounded-2xl shadow-sm">
                    <div class="flex items-center gap-2.5 mb-3">
                        <span class="w-7 h-7 rounded-lg bg-white/60 flex items-center justify-center">
                            <svg class="w-4 h-4 text-slate-900" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                        </span>
                        <span class="text-xs font-bold">Semua konten</span>
                    </div>
                    <p class="text-3xl font-extrabold tracking-tight">{{ str_pad($stats['total'], 2, '0', STR_PAD_LEFT) }}</p>
                    <p class="text-xs text-slate-800/80 mt-1">Dalam ruang kerja</p>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-2xs">
                    <div class="flex items-center gap-2.5 mb-3">
                        <span class="w-7 h-7 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                        </span>
                        <span class="text-xs font-semibold text-slate-600">Dalam produksi</span>
                    </div>
                    <p class="text-3xl font-extrabold text-slate-950 tracking-tight">{{ str_pad($stats['in_progress'], 2, '0', STR_PAD_LEFT) }}</p>
                    <p class="text-xs text-slate-400 mt-1">Sedang dikerjakan</p>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-2xs">
                    <div class="flex items-center gap-2.5 mb-3">
                        <span class="w-7 h-7 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </span>
                        <span class="text-xs font-semibold text-slate-600">Rencana & Ide</span>
                    </div>
                    <p class="text-3xl font-extrabold text-slate-950 tracking-tight">{{ str_pad($stats['idea'], 2, '0', STR_PAD_LEFT) }}</p>
                    <p class="text-xs text-slate-400 mt-1">Menunggu eksekusi</p>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-2xs">
                    <div class="flex items-center gap-2.5 mb-3">
                        <span class="w-7 h-7 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </span>
                        <span class="text-xs font-semibold text-slate-600">Sudah terbit</span>
                    </div>
                    <p class="text-3xl font-extrabold text-slate-950 tracking-tight">{{ str_pad($stats['published'], 2, '0', STR_PAD_LEFT) }}</p>
                    <p class="text-xs text-slate-400 mt-1">Selesai dipublikasikan</p>
                </div>
            </div>

            {{-- TABEL DAFTAR KONTEN --}}
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-2xs overflow-hidden"
                 x-data="{ activeTab: 'all', search: '' }">
                <div class="p-6 pb-4">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-4">
                        <div>
                            <h2 class="text-lg font-extrabold text-slate-950">Daftar Konten</h2>
                            <p class="text-xs text-slate-500 mt-0.5">Pantau progres, penanggung jawab, dan tenggat tiap konten.</p>
                        </div>
                        <a href="{{ route('contents.create') }}" class="inline-flex items-center justify-center gap-1.5 px-4 py-2 rounded-xl bg-[#254EDB] text-white text-xs font-bold hover:bg-blue-700 transition">
                            + Konten Baru
                        </a>
                    </div>

                    <div class="flex flex-col md:flex-row md:items-center gap-3">
                        <div class="flex flex-wrap items-center gap-1.5">
                            @foreach(['all' => 'Semua', 'idea' => 'Idea', 'scripting' => 'Scripting', 'shooting' => 'Shooting', 'editing' => 'Editing', 'published' => 'Terbit'] as $key => $label)
                                <button type="button"
                                        @click="activeTab = '{{ $key }}'"
                                        :class="activeTab === '{{ $key }}' ? 'bg-blue-50 text-blue-700 font-bold' : 'text-slate-500 hover:bg-slate-50 font-medium'"
                                        class="px-3.5 py-1.5 rounded-xl text-xs transition">
                                    {{ $label }}
                                </button>
                            @endforeach
                        </div>

                        <div class="relative flex-1">
                            <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            <input type="text" x-model="search" placeholder="Cari judul konten..." class="w-full pl-9 pr-4 py-2 rounded-xl bg-slate-50 border border-slate-200/80 text-xs text-slate-700 placeholder-slate-400 focus:bg-white focus:border-blue-500 focus:ring-blue-500">
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-y border-slate-100 text-[11px] font-bold uppercase tracking-wider text-slate-400 bg-slate-50/50">
                                <th class="py-3 px-6">Konten</th>
                                <th class="py-3 px-4">Status</th>
                                <th class="py-3 px-4">Progres</th>
                                <th class="py-3 px-4">Penanggung Jawab</th>
                                <th class="py-3 px-6 text-right">Tenggat</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">
                            @forelse($allContents as $content)
                                @php
                                    $totalT = $content->tasks->count();
                                    $doneT = $content->tasks->where('is_done', true)->count();
                                    $percent = $totalT > 0 ? round(($doneT / $totalT) * 100) : ($content->status === 'published' ? 100 : 0);
                                    $filledBlocks = (int) round($percent / 10);
                                    $pic = $content->tasks->first()?->user;
                                    $daysLeft = (int) \Carbon\Carbon::today()->diffInDays(\Carbon\Carbon::parse($content->deadline)->startOfDay(), false);

                                    $statusStyle = match($content->status) {
                                        'published' => ['bg' => 'bg-slate-950 text-white', 'dot' => 'bg-[#FFDC4A]', 'label' => 'Terbit'],
                                        'editing' => ['bg' => 'bg-amber-50 text-amber-800', 'dot' => 'bg-amber-400', 'label' => 'Editing'],
                                        'shooting' => ['bg' => 'bg-blue-50 text-blue-700', 'dot' => 'bg-blue-600', 'label' => 'Shooting'],
                                        'scripting' => ['bg' => 'bg-indigo-50 text-indigo-700', 'dot' => 'bg-indigo-500', 'label' => 'Scripting'],
                                        default => ['bg' => 'bg-slate-100 text-slate-700', 'dot' => 'bg-slate-400', 'label' => 'Idea'],
                                    };
                                @endphp

                                <tr x-show="(activeTab === 'all' || activeTab === '{{ $content->status }}') && '{{ strtolower($content->title) }}'.includes(search.toLowerCase())"
                                    class="hover:bg-slate-50/80 transition">
                                    <td class="py-4 px-6">
                                        <div class="flex items-center gap-3.5">
                                            <x-platform-icon :platform="$content->platform" />
                                            <div>
                                                <a href="{{ route('contents.show', $content) }}" class="font-bold text-slate-950 hover:text-blue-600 transition text-sm">
                                                    {{ $content->title }}
                                                </a>
                                                <p class="text-xs text-slate-400 uppercase mt-0.5">{{ str_replace('_', ' ', $content->platform) }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4">
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold {{ $statusStyle['bg'] }}">
                                            <span class="w-1.5 h-1.5 rounded-full {{ $statusStyle['dot'] }}"></span>
                                            {{ $statusStyle['label'] }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="w-28">
                                            <p class="text-xs font-bold text-slate-700 mb-1.5">{{ $percent }}%</p>
                                            <div class="flex items-center gap-0.5">
                                                @for($i = 1; $i <= 10; $i++)
                                                    <span class="h-1.5 flex-1 rounded-xs {{ $i <= $filledBlocks ? 'bg-[#254EDB]' : 'bg-slate-200' }}"></span>
                                                @endfor
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4">
                                        @if($pic)
                                            <div class="flex items-center gap-2.5">
                                                <span class="w-7 h-7 rounded-full bg-blue-50 text-blue-700 font-bold text-[11px] flex items-center justify-center shrink-0">
                                                    {{ strtoupper(substr($pic->name, 0, 2)) }}
                                                </span>
                                                <span class="text-xs font-medium text-slate-700">
                                                    {{ explode(' -', $pic->name)[0] }}
                                                    @if($totalT > 1)
                                                        <span class="text-slate-400">+{{ $totalT - 1 }}</span>
                                                    @endif
                                                </span>
                                            </div>
                                        @else
                                            <span class="text-xs text-slate-400">Belum ada PIC</span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-6 text-right">
                                        <p class="text-xs font-bold text-slate-700">{{ \Carbon\Carbon::parse($content->deadline)->format('d/m') }}</p>
                                        @if($content->status !== 'published' && $daysLeft <= 3)
                                            <p class="text-[10px] font-bold {{ $daysLeft <= 0 ? 'text-red-600' : 'text-amber-600' }}">
                                                {{ $daysLeft < 0 ? 'Telat ' . abs($daysLeft) . 'h' : ($daysLeft === 0 ? 'Hari ini' : 'H-' . $daysLeft) }}
                                            </p>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-10 text-center text-slate-400 text-sm">Belum ada konten.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        @else
            {{-- TAMPILAN CREW --}}
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-2xs p-6">
                <div class="flex items-center justify-between mb-5">
                    <div>
                        <h2 class="text-lg font-extrabold text-slate-950">Daftar Tugas Saya</h2>
                        <p class="text-xs text-slate-500 mt-0.5">Tandai selesai jika tugasmu sudah beres.</p>
                    </div>
                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-[#FFDC4A] text-slate-950">
                        {{ $myTasks->where('is_done', false)->count() }} Belum Selesai
                    </span>
                </div>

                <div class="divide-y divide-slate-100">
                    @forelse($myTasks as $task)
                        @php
                            $daysLeft = (int) \Carbon\Carbon::today()->diffInDays(\Carbon\Carbon::parse($task->content->deadline)->startOfDay(), false);
                        @endphp
                        <div class="py-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <div>
                                <p class="text-sm font-bold {{ $task->is_done ? 'line-through text-slate-400' : 'text-slate-950' }}">
                                    {{ $task->task_name }}
                                </p>
                                <p class="text-xs text-slate-500 mt-1">
                                    Konten:
                                    <a href="{{ route('contents.show', $task->content) }}" class="font-semibold text-blue-600 hover:underline">
                                        {{ $task->content->title }}
                                    </a>
                                    •
                                    @if(!$task->is_done)
                                        <span class="font-bold {{ $daysLeft <= 1 ? 'text-red-600' : 'text-amber-600' }}">
                                            {{ $daysLeft < 0 ? 'Telat ' . abs($daysLeft) . ' Hari' : ($daysLeft === 0 ? 'Hari Ini!' : 'Kurang ' . $daysLeft . ' Hari') }}
                                        </span>
                                    @else
                                        <span class="text-emerald-600 font-bold">Selesai</span>
                                    @endif
                                </p>
                            </div>
                            <form action="{{ route('tasks.toggle', $task) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="px-4 py-2 text-xs rounded-xl font-bold transition {{ $task->is_done ? 'bg-red-50 text-red-600 hover:bg-red-100 border border-red-200' : 'bg-[#254EDB] text-white hover:bg-blue-700' }}">
                                    {{ $task->is_done ? 'Batal Selesai ✕' : 'Tandai Selesai ✓' }}
                                </button>
                            </form>
                        </div>
                    @empty
                        <p class="py-8 text-center text-sm text-slate-400">Belum ada tugas yang diberikan untukmu.</p>
                    @endforelse
                </div>
            </div>
        @endif

    </div>
</x-app-layout>