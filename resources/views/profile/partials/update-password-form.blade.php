<section>
    <header class="mb-5">
        <h2 class="text-base font-extrabold text-slate-950">Ubah Kata Sandi</h2>
        <p class="mt-1 text-xs text-slate-500">Gunakan kombinasi kata sandi yang kuat agar akun tetap aman.</p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-4">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-xs font-bold text-slate-700 mb-1.5">Kata Sandi Saat Ini</label>
            <input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password"
                   class="w-full px-4 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-900 focus:bg-white focus:border-[#254EDB] focus:ring-[#254EDB] transition">
            @error('current_password', 'updatePassword') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="update_password_password" class="block text-xs font-bold text-slate-700 mb-1.5">Kata Sandi Baru</label>
            <input id="update_password_password" name="password" type="password" autocomplete="new-password"
                   class="w-full px-4 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-900 focus:bg-white focus:border-[#254EDB] focus:ring-[#254EDB] transition">
            @error('password', 'updatePassword') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-xs font-bold text-slate-700 mb-1.5">Konfirmasi Kata Sandi Baru</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password"
                   class="w-full px-4 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-900 focus:bg-white focus:border-[#254EDB] focus:ring-[#254EDB] transition">
            @error('password_confirmation', 'updatePassword') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="pt-2 flex items-center gap-3">
            <button type="submit" class="px-5 py-2.5 rounded-xl bg-slate-950 hover:bg-slate-800 text-white text-xs font-bold transition">
                Perbarui Kata Sandi
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2500)"
                   class="text-xs font-bold text-emerald-600">
                    Kata sandi diperbarui ✓
                </p>
            @endif
        </div>
    </form>
</section>