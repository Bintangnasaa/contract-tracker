<x-app-layout>
    <div class="py-6 px-6 lg:px-8 max-w-5xl mx-auto space-y-6">

        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-sm font-medium flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                {{ session('success') }}
            </div>
        @endif

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
                <a href="{{ auth()->user()->role === 'admin' ? route('contents.index') : route('dashboard') }}"
                   class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-400 hover:text-[#254EDB] transition mb-1.5">
                    &larr; Kembali
                </a>
                <div class="flex items-center gap-3">
                    <x-platform-icon :platform="$content->platform" />
                    <div>
                        <h1 class="text-2xl font-extrabold text-slate-950 tracking-tight">{{ $content->title }}</h1>
                        <p class="text-xs text-slate-500 mt-0.5">
                            Campaign: <span class="font-bold text-slate-700">{{ $content->campaign->title }}</span>
                        </p>
                    </div>
                </div>
            </div>

            @if(auth()->user()->role === 'admin')
                <a href="{{ route('contents.edit', $content) }}"
                   class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl bg-white border border-slate-200 hover:border-[#254EDB] text-slate-700 text-xs font-bold transition">
                    Edit Konten
                </a>
            @endif
        </div>

        {{-- Info Ringkas Konten --}}
        @php
            $totalTasks = $content->tasks->count();
            $doneTasks = $content->tasks->where('is_done', true)->count();
            $progress = $totalTasks > 0 ? round(($doneTasks / $totalTasks) * 100) : 0;
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-2xs">
                <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Status & Deadline</p>
                <div class="mt-2 flex items-center justify-between">
                    <span class="px-3 py-1 rounded-full text-xs font-bold uppercase bg-blue-50 text-[#254EDB]">
                        {{ $content->status }}
                    </span>
                    <span class="text-xs font-bold text-slate-800">
                        {{ \Carbon\Carbon::parse($content->deadline)->format('d M Y') }}
                    </span>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-2xs">
                <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Progres Task</p>
                <div class="mt-2 flex items-center justify-between text-xs font-bold text-slate-800 mb-1.5">
                    <span>{{ $doneTasks }} / {{ $totalTasks }} Selesai</span>
                    <span class="text-[#254EDB]">{{ $progress }}%</span>
                </div>
                <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden">
                    <div class="h-full bg-[#254EDB] rounded-full transition-all" style="width: {{ $progress }}%"></div>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-2xs">
                <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Tautan Kerja</p>
                <div class="mt-2 flex items-center gap-2">
                    @if($content->script_link)
                        <a href="{{ $content->script_link }}" target="_blank" class="px-3 py-1.5 rounded-lg bg-slate-100 hover:bg-blue-50 hover:text-[#254EDB] text-xs font-bold text-slate-700 transition">
                            Script &nearr;
                        </a>
                    @endif
                    @if($content->asset_link)
                        <a href="{{ $content->asset_link }}" target="_blank" class="px-3 py-1.5 rounded-lg bg-slate-100 hover:bg-blue-50 hover:text-[#254EDB] text-xs font-bold text-slate-700 transition">
                            Aset Drive &nearr;
                        </a>
                    @endif
                    @if(!$content->script_link && !$content->asset_link)
                        <span class="text-xs text-slate-400">Belum ada link dilampirkan.</span>
                    @endif
                </div>
            </div>
        </div>

        {{-- Form Tambah Task (Khusus Admin) --}}
        @if(auth()->user()->role === 'admin')
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-2xs p-6">
                <h2 class="text-sm font-bold text-slate-900 mb-4">Assign Task Baru ke Crew</h2>
                <form action="{{ route('tasks.store', $content) }}" method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-3">
                    @csrf
                    <input type="text" name="task_name" required placeholder="Nama tugas (misal: Editing Video Reels)"
                           class="md:col-span-2 rounded-xl bg-slate-50 border border-slate-200 text-xs px-3.5 py-2.5 focus:bg-white focus:border-[#254EDB] focus:ring-[#254EDB]">

                    <select name="user_id" required
                            class="rounded-xl bg-slate-50 border border-slate-200 text-xs px-3.5 py-2.5 focus:bg-white focus:border-[#254EDB] focus:ring-[#254EDB]">
                        <option value="">-- Pilih Crew --</option>
                        @foreach($crews as $crew)
                            <option value="{{ $crew->id }}">{{ $crew->name }}</option>
                        @endforeach
                    </select>

                    <button type="submit" class="bg-[#254EDB] hover:bg-blue-700 text-white text-xs font-bold px-4 py-2.5 rounded-xl transition">
                        + Assign Task
                    </button>
                </form>
            </div>
        @endif

        {{-- Daftar Task --}}
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-2xs overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                <h2 class="text-sm font-extrabold text-slate-950">Daftar Tugas ({{ $totalTasks }})</h2>
            </div>

            <div class="divide-y divide-slate-100">
                @forelse($content->tasks as $task)
                    <div class="px-6 py-4 flex flex-col sm:flex-row sm:items-center justify-between gap-3 hover:bg-slate-50/70 transition">
                        <div class="flex items-start gap-3">
                            <span class="mt-1 w-2.5 h-2.5 rounded-full shrink-0 {{ $task->is_done ? 'bg-emerald-500' : 'bg-amber-400' }}"></span>
                            <div>
                                <p class="text-sm font-bold {{ $task->is_done ? 'line-through text-slate-400' : 'text-slate-900' }}">
                                    {{ $task->task_name }}
                                </p>
                                <p class="text-xs text-slate-500 mt-0.5">
                                    PIC: <span class="font-semibold text-slate-700">{{ $task->user->name ?? '-' }}</span>
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <form action="{{ route('tasks.toggle', $task) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="px-3.5 py-1.5 rounded-lg text-xs font-bold transition {{ $task->is_done ? 'bg-slate-100 text-slate-600 hover:bg-slate-200' : 'bg-emerald-600 text-white hover:bg-emerald-700' }}">
                                    {{ $task->is_done ? 'Batal Selesai' : 'Tandai Selesai ✓' }}
                                </button>
                            </form>

                            @if(auth()->user()->role === 'admin')
                                <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Hapus task ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-2.5 py-1.5 rounded-lg text-xs font-semibold text-slate-400 hover:text-red-600 hover:bg-red-50 transition">
                                        Hapus
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="py-10 text-center text-sm text-slate-400">
                        Belum ada task untuk konten ini.
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</x-app-layout>