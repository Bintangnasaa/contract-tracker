<section>
    <header class="mb-5">
        <h2 class="text-base font-extrabold text-slate-950">Informasi Profil</h2>
        <p class="mt-1 text-xs text-slate-500">Perbarui nama akun dan alamat email yang terdaftar.</p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-4">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="block text-xs font-bold text-slate-700 mb-1.5">Nama Lengkap</label>
            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name"
                   class="w-full px-4 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-900 focus:bg-white focus:border-[#254EDB] focus:ring-[#254EDB] transition">
            @error('name') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="email" class="block text-xs font-bold text-slate-700 mb-1.5">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username"
                   class="w-full px-4 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-900 focus:bg-white focus:border-[#254EDB] focus:ring-[#254EDB] transition">
            @error('email') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-xs text-slate-600">
                        Email kamu belum diverifikasi.
                        <button form="send-verification" class="underline font-bold text-[#254EDB] hover:text-blue-700">
                            Kirim ulang email verifikasi.
                        </button>
                    </p>
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-1.5 font-semibold text-xs text-emerald-600">
                            Link verifikasi baru telah dikirim ke email kamu.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="pt-2 flex items-center gap-3">
            <button type="submit" class="px-5 py-2.5 rounded-xl bg-[#254EDB] hover:bg-blue-700 text-white text-xs font-bold shadow-sm shadow-blue-600/20 transition">
                Simpan Perubahan
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2500)"
                   class="text-xs font-bold text-emerald-600">
                    Tersimpan ✓
                </p>
            @endif
        </div>
    </form>
</section>