<x-app-layout>
    <div class="py-6 px-6 lg:px-8 max-w-3xl mx-auto space-y-6">

        {{-- Header --}}
        <div>
            <a href="{{ route('contents.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-400 hover:text-[#254EDB] transition mb-1.5">
                &larr; Kembali ke Daftar Konten
            </a>
            <h1 class="text-2xl font-extrabold text-slate-950 tracking-tight">Tambah Konten Baru</h1>
        </div>

        {{-- Form Card --}}
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-2xs p-6 sm:p-8">
            <form action="{{ route('contents.store') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label for="campaign_id" class="block text-xs font-bold text-slate-700 mb-1.5">Campaign</label>
                    <select id="campaign_id" name="campaign_id" required
                            class="w-full px-4 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-900 focus:bg-white focus:border-[#254EDB] focus:ring-[#254EDB] transition">
                        <option value="">-- Pilih Campaign --</option>
                        @foreach($campaigns as $campaign)
                            <option value="{{ $campaign->id }}" {{ old('campaign_id') == $campaign->id ? 'selected' : '' }}>
                                {{ $campaign->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('campaign_id') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="title" class="block text-xs font-bold text-slate-700 mb-1.5">Judul Konten</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" required placeholder="Contoh: Reels Teaser H-7 Event"
                           class="w-full px-4 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-900 placeholder-slate-400 focus:bg-white focus:border-[#254EDB] focus:ring-[#254EDB] transition">
                    @error('title') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label for="platform" class="block text-xs font-bold text-slate-700 mb-1.5">Platform</label>
                        <select id="platform" name="platform" required
                                class="w-full px-4 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-900 focus:bg-white focus:border-[#254EDB] focus:ring-[#254EDB] transition">
                            <option value="ig_reels" {{ old('platform') === 'ig_reels' ? 'selected' : '' }}>IG Reels</option>
                            <option value="tiktok" {{ old('platform') === 'tiktok' ? 'selected' : '' }}>TikTok</option>
                            <option value="youtube" {{ old('platform') === 'youtube' ? 'selected' : '' }}>YouTube</option>
                            <option value="shorts" {{ old('platform') === 'shorts' ? 'selected' : '' }}>Shorts</option>
                        </select>
                    </div>

                    <div>
                        <label for="status" class="block text-xs font-bold text-slate-700 mb-1.5">Status Awal</label>
                        <select id="status" name="status" required
                                class="w-full px-4 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-900 focus:bg-white focus:border-[#254EDB] focus:ring-[#254EDB] transition">
                            @foreach(['idea', 'scripting', 'shooting', 'editing', 'published'] as $st)
                                <option value="{{ $st }}" {{ old('status', 'idea') === $st ? 'selected' : '' }}>{{ ucfirst($st) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="deadline" class="block text-xs font-bold text-slate-700 mb-1.5">Deadline</label>
                        <input type="date" id="deadline" name="deadline" value="{{ old('deadline') }}" required
                               class="w-full px-4 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-900 focus:bg-white focus:border-[#254EDB] focus:ring-[#254EDB] transition">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="script_link" class="block text-xs font-bold text-slate-700 mb-1.5">Link Script (Opsional)</label>
                        <input type="url" id="script_link" name="script_link" value="{{ old('script_link') }}" placeholder="https://docs.google.com/..."
                               class="w-full px-4 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-900 placeholder-slate-400 focus:bg-white focus:border-[#254EDB] focus:ring-[#254EDB] transition">
                    </div>

                    <div>
                        <label for="asset_link" class="block text-xs font-bold text-slate-700 mb-1.5">Link Aset / Drive (Opsional)</label>
                        <input type="url" id="asset_link" name="asset_link" value="{{ old('asset_link') }}" placeholder="https://drive.google.com/..."
                               class="w-full px-4 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-900 placeholder-slate-400 focus:bg-white focus:border-[#254EDB] focus:ring-[#254EDB] transition">
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-2.5">
                    <a href="{{ route('contents.index') }}" class="px-4 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition">
                        Batal
                    </a>
                    <button type="submit" class="px-5 py-2.5 rounded-xl bg-[#254EDB] hover:bg-blue-700 text-white text-xs font-bold shadow-sm shadow-blue-600/20 transition">
                        Simpan Konten
                    </button>
                </div>
            </form>
        </div>

    </div>
</x-app-layout>