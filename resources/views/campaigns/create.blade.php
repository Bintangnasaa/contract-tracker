<x-app-layout>
    <div class="py-6 px-6 lg:px-8 max-w-3xl mx-auto space-y-6">

        {{-- Header --}}
        <div class="flex items-center justify-between">
            <div>
                <a href="{{ route('campaigns.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-400 hover:text-[#254EDB] transition mb-1.5">
                    &larr; Kembali ke Daftar Campaign
                </a>
                <h1 class="text-2xl font-extrabold text-slate-950 tracking-tight">Tambah Campaign Baru</h1>
            </div>
        </div>

        {{-- Form Card --}}
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-2xs p-6 sm:p-8">
            <form action="{{ route('campaigns.store') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label for="title" class="block text-xs font-bold text-slate-700 mb-1.5">Judul Campaign</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" required placeholder="Contoh: Countdown Event Akhir Tahun"
                           class="w-full px-4 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-900 placeholder-slate-400 focus:bg-white focus:border-[#254EDB] focus:ring-[#254EDB] transition">
                    @error('title') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="description" class="block text-xs font-bold text-slate-700 mb-1.5">Deskripsi</label>
                    <textarea id="description" name="description" rows="3" placeholder="Jelaskan tujuan atau rangkaian konten dari campaign ini..."
                              class="w-full px-4 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-900 placeholder-slate-400 focus:bg-white focus:border-[#254EDB] focus:ring-[#254EDB] transition">{{ old('description') }}</textarea>
                    @error('description') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="start_date" class="block text-xs font-bold text-slate-700 mb-1.5">Tanggal Mulai</label>
                        <input type="date" id="start_date" name="start_date" value="{{ old('start_date', date('Y-m-d')) }}" required
                               class="w-full px-4 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-900 focus:bg-white focus:border-[#254EDB] focus:ring-[#254EDB] transition">
                        @error('start_date') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="end_date" class="block text-xs font-bold text-slate-700 mb-1.5">Tanggal Selesai</label>
                        <input type="date" id="end_date" name="end_date" value="{{ old('end_date') }}" required
                               class="w-full px-4 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-900 focus:bg-white focus:border-[#254EDB] focus:ring-[#254EDB] transition">
                        @error('end_date') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label for="status" class="block text-xs font-bold text-slate-700 mb-1.5">Status</label>
                    <select id="status" name="status" required
                            class="w-full px-4 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-900 focus:bg-white focus:border-[#254EDB] focus:ring-[#254EDB] transition">
                        <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="completed" {{ old('status') === 'completed' ? 'selected' : '' }}>Completed (Selesai)</option>
                    </select>
                    @error('status') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-2.5">
                    <a href="{{ route('campaigns.index') }}" class="px-4 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition">
                        Batal
                    </a>
                    <button type="submit" class="px-5 py-2.5 rounded-xl bg-[#254EDB] hover:bg-blue-700 text-white text-xs font-bold shadow-sm shadow-blue-600/20 transition">
                        Simpan Campaign
                    </button>
                </div>
            </form>
        </div>

    </div>
</x-app-layout>