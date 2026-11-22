<x-app-layout>
    <div class="py-6 px-6 lg:px-8 max-w-4xl mx-auto space-y-6">

        {{-- Header Halaman --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
                <h1 class="text-2xl font-extrabold text-slate-950 tracking-tight">Pengaturan Akun</h1>
                <p class="text-xs text-slate-500 mt-0.5">Kelola informasi profil, kata sandi, dan keamanan akunmu.</p>
            </div>
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-extrabold uppercase bg-[#FFDC4A] text-slate-950 w-fit">
                <span class="w-1.5 h-1.5 rounded-full bg-slate-950"></span>
                Role {{ auth()->user()->role }}
            </span>
        </div>

        {{-- Update Informasi Profil --}}
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-2xs p-6 sm:p-8">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        {{-- Update Password --}}
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-2xs p-6 sm:p-8">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        {{-- Hapus Akun --}}
        <div class="bg-white rounded-2xl border border-red-200/80 shadow-2xs p-6 sm:p-8">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>

    </div>
</x-app-layout>