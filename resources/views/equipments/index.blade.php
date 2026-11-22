<x-app-layout>
    <div class="py-6 px-6 lg:px-8 max-w-7xl mx-auto space-y-6">

        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-sm font-medium flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                {{ session('success') }}
            </div>
        @endif

        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
                <h1 class="text-2xl font-extrabold text-slate-950 tracking-tight">Master Alat Produksi</h1>
                <p class="text-xs text-slate-500 mt-0.5">Kelola inventaris kamera, audio, lighting, dan aksesoris tim.</p>
            </div>
            <a href="{{ route('loans.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-[#FFDC4A] text-slate-950 text-xs font-bold hover:bg-amber-300 transition shadow-xs">
                Kelola Transaksi Peminjaman &rarr;
            </a>
        </div>

        {{-- Form Tambah Alat Baru --}}
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-2xs p-6">
            <h2 class="text-sm font-bold text-slate-900 mb-4">Tambah Alat Baru</h2>
            <form action="{{ route('equipments.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-3">
                @csrf
                <input type="text" name="name" placeholder="Nama alat (misal: Sony A7III)" required
                       class="md:col-span-2 rounded-xl bg-slate-50 border border-slate-200 text-xs px-3.5 py-2.5 focus:bg-white focus:border-[#254EDB] focus:ring-[#254EDB]">

                <select name="category" required
                        class="rounded-xl bg-slate-50 border border-slate-200 text-xs px-3.5 py-2.5 focus:bg-white focus:border-[#254EDB] focus:ring-[#254EDB]">
                    <option value="kamera">Kamera</option>
                    <option value="audio">Audio</option>
                    <option value="lighting">Lighting</option>
                    <option value="aksesoris">Aksesoris</option>
                </select>

                <div class="flex gap-2">
                    <input type="number" name="stock" min="0" value="1" placeholder="Stok" required
                           class="w-24 rounded-xl bg-slate-50 border border-slate-200 text-xs px-3 py-2.5 focus:bg-white focus:border-[#254EDB] focus:ring-[#254EDB]">
                    <button type="submit" class="flex-1 bg-[#254EDB] hover:bg-blue-700 text-white text-xs font-bold px-4 py-2.5 rounded-xl transition">
                        + Tambah
                    </button>
                </div>
            </form>
        </div>

        {{-- Tabel Inventaris Alat --}}
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-2xs overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-100 text-[11px] font-bold uppercase tracking-wider text-slate-400 bg-slate-50/50">
                            <th class="py-3.5 px-6">Nama Alat</th>
                            <th class="py-3.5 px-4">Kategori</th>
                            <th class="py-3.5 px-4">Stok Tersedia</th>
                            <th class="py-3.5 px-6 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse($equipments as $item)
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="py-4 px-6 font-bold text-slate-900">{{ $item->name }}</td>
                                <td class="py-4 px-4">
                                    <span class="px-2.5 py-1 rounded-full text-xs font-bold uppercase bg-blue-50 text-blue-700">
                                        {{ $item->category }}
                                    </span>
                                </td>
                                <td class="py-4 px-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-extrabold {{ $item->stock > 0 ? 'bg-emerald-50 text-emerald-700' : 'bg-red-50 text-red-600' }}">
                                        {{ $item->stock }} Unit
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-right">
                                    <form action="{{ route('equipments.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus alat ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs font-semibold text-slate-400 hover:text-red-600 transition">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-10 text-center text-slate-400 text-sm">Belum ada alat produksi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>