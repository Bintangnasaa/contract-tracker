<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'ConTract - Content Tracker') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-[#F4F6FB] text-slate-900">
        <div class="min-h-screen flex">
            
            {{-- PANEL KIRI: Branding Dark Navy & Biru Elektrik --}}
            <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-[#141722] text-white flex-col justify-between p-12">
                {{-- Efek Glow Latar --}}
                <div class="absolute -top-24 -left-24 w-96 h-96 bg-[#254EDB]/30 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-[#FFDC4A]/15 rounded-full blur-3xl pointer-events-none"></div>

                {{-- Logo --}}
                <div class="relative z-10 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-[#FFDC4A] flex items-center justify-center shadow-lg shadow-amber-400/20">
                        <svg class="w-5 h-5 text-slate-950" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-lg font-extrabold tracking-tight text-white leading-none">ConTract</p>
                        <p class="text-xs text-slate-400 mt-0.5">Content Tracker</p>
                    </div>
                </div>

                {{-- Copywriting Utama --}}
                <div class="relative z-10 max-w-md space-y-5">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-extrabold uppercase tracking-wider bg-[#FFDC4A] text-slate-950">
                        <span class="w-1.5 h-1.5 rounded-full bg-slate-950"></span>
                        Produksi Tim
                    </span>
                    <h1 class="text-4xl font-extrabold tracking-tight leading-tight">
                        Dari brief hingga <span class="text-[#FFDC4A]">siap terbit</span> dalam satu tempat.
                    </h1>
                    <p class="text-sm text-slate-400 leading-relaxed">
                        Kelola campaign, pantau progres lintas divisi Kreatif, Produksi, dan Public Relation tanpa ribet.
                    </p>
                </div>

                {{-- Footer --}}
                <div class="relative z-10 flex items-center gap-3 text-xs text-slate-500">
                    <span>&copy; {{ date('Y') }} ConTract</span>
                    <span>•</span>
                    <span>Content Production Tracker</span>
                </div>
            </div>

            {{-- PANEL KANAN: Form Auth --}}
            <div class="w-full lg:w-1/2 flex flex-col justify-center items-center p-6 sm:p-12">
                {{-- Logo Mobile (muncul di layar kecil) --}}
                <div class="flex lg:hidden items-center gap-2.5 mb-8">
                    <div class="w-9 h-9 rounded-xl bg-[#FFDC4A] flex items-center justify-center shadow-sm">
                        <svg class="w-5 h-5 text-slate-950" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                        </svg>
                    </div>
                    <span class="text-xl font-extrabold tracking-tight text-slate-950">ConTract</span>
                </div>

                <div class="w-full max-w-md bg-white p-8 sm:p-10 rounded-3xl border border-slate-200/80 shadow-xl shadow-slate-200/40">
                    {{ $slot }}
                </div>
            </div>

        </div>
    </body>
</html>