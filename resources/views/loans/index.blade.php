<x-app-layout>
    <div class="py-6 px-6 lg:px-8 max-w-7xl mx-auto space-y-6">

        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-sm font-medium flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm font-medium">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
                <h1 class="text-2xl font-extrabold text-slate-950 tracking-tight">Transaksi Peminjaman Alat</h1>
                <p class="text-xs text-slate-500 mt-0.5">Stok alat otomatis berkurang saat dipinjam dan bertambah kembali saat dikembalikan.</p>
            </div>
            <a href="{{ route('equipments.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white border border-slate-200 text-slate-700 text-xs font-bold hover:border-blue-300 transition">
                Lihat Master Alat
            </a>
        </div>

        {{-- Form Transaksi Peminjaman --}}
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-2xs p-6">
            <h2 class="text-sm font-bold text-slate-900 mb-4">Catat Peminjaman Baru</h2>
            <form action="{{ route('loans.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-5 gap-3">
                @csrf
                <select name="content_id" required class="rounded-xl bg-slate-50 border border-slate-200 text-xs px-3 py-2.5 focus:bg-white focus:border-[#254EDB]">
                    <option value="">-- Pilih Konten --</option>
                    @foreach($contents as $c)
                        <option value="{{ $c->id }}">{{ $c->title }}</option>
                    @endforeach
                </select>

                <select name="user_id" required class="rounded-xl bg-slate-50 border border-slate-200 text-xs px-3 py-2.5 focus:bg-white focus:border-[#254EDB]">
                    <option value="">-- Pilih Crew Peminjam --</option>
                    @foreach($crews as $crew)
                        <option value="{{ $crew->id }}">{{ explode(' -', $crew->name)[0] }}</option>
                    @endforeach
                </select>

                <select name="equipment_id" required class="rounded-xl bg-slate-50 border border-slate-200 text-xs px-3 py-2.5 focus:bg-white focus:border-[#254EDB]">
                    <option value="">-- Pilih Alat (Stok) --</option>
                    @foreach($equipments as $eq)
                        <option value="{{ $eq->id }}">{{ $eq->name }} (Sisa: {{ $eq->stock }})</option>
                    @endforeach
                </select>

                <div class="flex gap-2">
                    <input type="number" name="qty" min="1" value="1" required placeholder="Qty"
                           class="w-20 rounded-xl bg-slate-50 border border-slate-200 text-xs px-3 py-2.5 focus:bg-white focus:border-[#254EDB]">
                    <input type="date" name="borrow_date" value="{{ date('Y-m-d') }}" required
                           class="flex-1 rounded-xl bg-slate-50 border border-slate-200 text-xs px-3 py-2.5 focus:bg-white focus:border-[#254EDB]">
                </div>

                <button type="submit" class="bg-[#254EDB] hover:bg-blue-700 text-white text-xs font-bold px-4 py-2.5 rounded-xl transition shadow-sm">
                    + Pinjam Alat
                </button>
            </form>
        </div>

        {{-- Tabel Riwayat Transaksi Peminjaman --}}
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-2xs overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-100 text-[11px] font-bold uppercase tracking-wider text-slate-400 bg-slate-50/50">
                            <th class="py-3.5 px-6">Alat & Jumlah</th>
                            <th class="py-3.5 px-4">Untuk Konten</th>
                            <th class="py-3.5 px-4">Peminjam</th>
                            <th class="py-3.5 px-4">Tgl Pinjam / Kembali</th>
                            <th class="py-3.5 px-4">Status</th>
                            <th class="py-3.5 px-6 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse($loans as $loan)
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="py-4 px-6">
                                    <p class="font-bold text-slate-900">{{ $loan->equipment->name }}</p>
                                    <p class="text-xs text-blue-600 font-semibold">{{ $loan->qty }} Unit</p>
                                </td>
                                <td class="py-4 px-4 text-xs font-medium text-slate-700">{{ $loan->content->title }}</td>
                                <td class="py-4 px-4 text-xs text-slate-600">{{ explode(' -', $loan->user->name)[0] }}</td>
                                <td class="py-4 px-4 text-xs text-slate-500">
                                    <p>Pinjam: {{ \Carbon\Carbon::parse($loan->borrow_date)->format('d M Y') }}</p>
                                    @if($loan->return_date)
                                        <p class="text-emerald-600 font-medium">Kembali: {{ \Carbon\Carbon::parse($loan->return_date)->format('d M Y') }}</p>
                                    @endif
                                </td>
                                <td class="py-4 px-4">
                                    @if($loan->status === 'borrowed')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Dipinjam
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-slate-950 text-white">
                                            <span class="w-1.5 h-1.5 rounded-full bg-[#FFDC4A]"></span> Dikembalikan
                                        </span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 text-right">
                                    @if($loan->status === 'borrowed')
                                        <form action="{{ route('loans.return', $loan) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="px-3.5 py-1.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold transition">
                                                Kembalikan ✓
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-xs text-slate-400 font-medium">Selesai</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-10 text-center text-slate-400 text-sm">Belum ada transaksi peminjaman.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>