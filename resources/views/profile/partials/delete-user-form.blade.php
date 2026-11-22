<section class="space-y-4">
    <header>
        <h2 class="text-base font-extrabold text-red-600">Hapus Akun</h2>
        <p class="mt-1 text-xs text-slate-500 leading-relaxed">
            Setelah akun dihapus, seluruh data terkait akan hilang secara permanen. Pastikan kamu sudah menyimpan data penting sebelum melanjutkan.
        </p>
    </header>

    <button type="button"
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            class="px-4 py-2.5 rounded-xl bg-red-50 hover:bg-red-600 text-red-600 hover:text-white border border-red-200 text-xs font-bold transition">
        Hapus Akun Permanen
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 space-y-4">
            @csrf
            @method('delete')

            <div>
                <h2 class="text-lg font-extrabold text-slate-950">Yakin ingin menghapus akun?</h2>
                <p class="mt-1 text-xs text-slate-500">
                    Masukkan kata sandi kamu untuk mengonfirmasi penghapusan akun secara permanen.
                </p>
            </div>

            <div>
                <label for="password" class="sr-only">Password</label>
                <input id="password" name="password" type="password" placeholder="Masukkan kata sandi..."
                       class="w-full px-4 py-2.5 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-900 focus:bg-white focus:border-red-500 focus:ring-red-500">
                @error('password', 'userDeletion') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="pt-2 flex justify-end gap-2.5">
                <button type="button" x-on:click="$dispatch('close')"
                        class="px-4 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition">
                    Batal
                </button>
                <button type="submit"
                        class="px-5 py-2.5 rounded-xl bg-red-600 hover:bg-red-700 text-white text-xs font-bold transition">
                    Ya, Hapus Akun
                </button>
            </div>
        </form>
    </x-modal>
</section>