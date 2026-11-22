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
        <div class="min-h-screen flex"
             x-data="{
                 sidebarOpen: localStorage.getItem('sidebarOpen') !== 'false',
                 toggleSidebar() {
                     this.sidebarOpen = !this.sidebarOpen;
                     localStorage.setItem('sidebarOpen', this.sidebarOpen);
                 }
             }">
            
            {{-- SIDEBAR GELAP (Dark Navy #141722) --}}
            <aside :class="sidebarOpen ? 'w-64' : 'w-20'"
                   class="bg-[#141722] text-slate-300 hidden md:flex flex-col justify-between fixed inset-y-0 left-0 z-30 transition-all duration-300 ease-in-out border-r border-slate-800/80">
                
                {{-- Tombol Buka/Tutup Sidebar --}}
                <button @click="toggleSidebar()"
                        title="Buka / Tutup Sidebar"
                        class="absolute -right-3.5 top-7 w-7 h-7 rounded-full bg-white border border-slate-200 shadow-md flex items-center justify-center text-slate-600 hover:text-blue-600 transition z-40">
                    <svg :class="sidebarOpen ? '' : 'rotate-180'" class="w-4 h-4 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>

                <div :class="sidebarOpen ? 'p-5' : 'p-3.5'" class="transition-all duration-300">
                    {{-- Logo ConTract --}}
                    <a href="{{ route('dashboard') }}" :class="sidebarOpen ? 'justify-start' : 'justify-center'" class="flex items-center gap-3 mb-8 px-1">
                        <div class="w-9 h-9 shrink-0 rounded-xl bg-[#FFDC4A] flex items-center justify-center shadow-md shadow-amber-400/20">
                            <svg class="w-5 h-5 text-slate-950" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                            </svg>
                        </div>
                        <div x-show="sidebarOpen" x-transition.opacity class="overflow-hidden whitespace-nowrap">
                            <p class="text-base font-extrabold tracking-tight text-white leading-none">ConTract</p>
                            <p class="text-[10px] text-slate-400 mt-1">Content Tracker</p>
                        </div>
                    </a>

                    <p x-show="sidebarOpen" class="text-[10px] font-bold uppercase tracking-widest text-slate-500 px-3 mb-2.5">
                        Ruang Kerja
                    </p>

                    {{-- Menu Navigasi --}}
                    <nav class="space-y-1.5">
                        <a href="{{ route('dashboard') }}" title="Dashboard"
                           :class="sidebarOpen ? 'px-3.5 justify-start' : 'px-0 justify-center'"
                           class="flex items-center gap-3 py-2.5 rounded-xl text-sm font-semibold transition-all {{ request()->routeIs('dashboard') ? 'bg-[#254EDB] text-white shadow-lg shadow-blue-600/30' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                            <span x-show="sidebarOpen" class="whitespace-nowrap">Dashboard</span>
                        </a>

                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('campaigns.index') }}" title="Campaigns"
                               :class="sidebarOpen ? 'px-3.5 justify-start' : 'px-0 justify-center'"
                               class="flex items-center gap-3 py-2.5 rounded-xl text-sm font-semibold transition-all {{ request()->routeIs('campaigns.*') ? 'bg-[#254EDB] text-white shadow-lg shadow-blue-600/30' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <span x-show="sidebarOpen" class="whitespace-nowrap">Campaigns</span>
                            </a>

                            <a href="{{ route('contents.index') }}" title="Daftar Konten"
                               :class="sidebarOpen ? 'px-3.5 justify-start' : 'px-0 justify-center'"
                               class="flex items-center gap-3 py-2.5 rounded-xl text-sm font-semibold transition-all {{ request()->routeIs('contents.*') ? 'bg-[#254EDB] text-white shadow-lg shadow-blue-600/30' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                                <span x-show="sidebarOpen" class="whitespace-nowrap">Daftar Konten</span>
                            </a>

                            <a href="{{ route('equipments.index') }}" title="Alat Produksi"
                               :class="sidebarOpen ? 'px-3.5 justify-start' : 'px-0 justify-center'"
                               class="flex items-center gap-3 py-2.5 rounded-xl text-sm font-semibold transition-all {{ request()->routeIs('equipments.*') ? 'bg-[#254EDB] text-white shadow-lg shadow-blue-600/30' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <span x-show="sidebarOpen" class="whitespace-nowrap">Alat Produksi</span>
                            </a>

                            <a href="{{ route('loans.index') }}" title="Peminjaman Alat"
                               :class="sidebarOpen ? 'px-3.5 justify-start' : 'px-0 justify-center'"
                               class="flex items-center gap-3 py-2.5 rounded-xl text-sm font-semibold transition-all {{ request()->routeIs('loans.*') ? 'bg-[#254EDB] text-white shadow-lg shadow-blue-600/30' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                                <span x-show="sidebarOpen" class="whitespace-nowrap">Peminjaman</span>
                            </a>
                        @endif

                        <a href="{{ route('profile.edit') }}" title="Pengaturan"
                           :class="sidebarOpen ? 'px-3.5 justify-start' : 'px-0 justify-center'"
                           class="flex items-center gap-3 py-2.5 rounded-xl text-sm font-semibold transition-all {{ request()->routeIs('profile.*') ? 'bg-[#254EDB] text-white shadow-lg shadow-blue-600/30' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span x-show="sidebarOpen" class="whitespace-nowrap">Pengaturan</span>
                        </a>
                    </nav>
                </div>

                {{-- Footer Sidebar: Card Produksi Tim + Profil User --}}
                <div :class="sidebarOpen ? 'p-4' : 'p-3'" class="space-y-4 border-t border-slate-800/80">
                    <div x-show="sidebarOpen" class="bg-[#1E2231] rounded-xl p-3.5 border border-slate-700/50">
                        <div class="flex items-center gap-1.5 text-[10px] font-bold uppercase tracking-wider text-[#FFDC4A]">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#FFDC4A]"></span>
                            Produksi Tim
                        </div>
                        <p class="text-xs text-slate-300 mt-1 leading-relaxed">Dari brief hingga siap terbit.</p>
                    </div>

                    <div :class="sidebarOpen ? 'justify-between' : 'justify-center'" class="flex items-center gap-2.5 px-1">
                        <div class="flex items-center gap-2.5 min-w-0">
                            <div class="w-8 h-8 shrink-0 rounded-full bg-blue-100 text-blue-800 font-bold text-xs flex items-center justify-center">
                                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                            </div>
                            <div x-show="sidebarOpen" class="min-w-0">
                                <p class="text-xs font-bold text-white truncate">{{ explode(' -', auth()->user()->name)[0] }}</p>
                                <p class="text-[11px] text-slate-400 capitalize">{{ auth()->user()->role }}</p>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('logout') }}" x-show="sidebarOpen">
                            @csrf
                            <button type="submit" title="Log Out" class="p-1.5 rounded-lg text-slate-400 hover:text-red-400 hover:bg-white/5 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
            </aside>

            {{-- AREA KONTEN UTAMA --}}
            <div :class="sidebarOpen ? 'md:ml-64' : 'md:ml-20'"
                 class="flex-1 flex flex-col min-h-screen transition-all duration-300 ease-in-out">
                
                {{-- Top Breadcrumb Bar --}}
                <div class="bg-white border-b border-slate-200/70 px-6 lg:px-8 py-3.5 flex items-center justify-between sticky top-0 z-20">
                    <div class="flex items-center gap-2 text-xs font-medium">
                        <span class="text-slate-400">ConTract</span>
                        <span class="text-slate-300">&rsaquo;</span>
                        <span class="text-slate-900 font-bold">
                            @if(request()->routeIs('dashboard')) Dashboard
                            @elseif(request()->routeIs('campaigns.*')) Campaigns
                            @elseif(request()->routeIs('contents.*')) Daftar Konten
                            @elseif(request()->routeIs('equipments.*')) Alat Produksi
                            @elseif(request()->routeIs('loans.*')) Transaksi Peminjaman
                            @else Pengaturan @endif
                        </span>
                    </div>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-700">
                        <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span>
                        {{ \Carbon\Carbon::now()->translatedFormat('d M Y') }}
                    </span>
                </div>

                @isset($header)
                    <header class="bg-white/60 border-b border-slate-200/60">
                        <div class="max-w-7xl mx-auto py-4 px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <main class="flex-1">
                    {{ $slot }}
                </main>
            </div>

        </div>
    </body>
</html>