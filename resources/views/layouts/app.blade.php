<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <script>
            if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        </script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    </head>
    <body class="font-sans antialiased bg-slate-50 dark:bg-[#0f172a] text-slate-900 dark:text-slate-200" 
          x-data="{ 
            showHelp: false, 
            darkMode: localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches),
            toggleTheme() {
                this.darkMode = !this.darkMode;
                if (this.darkMode) {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                }
            }
          }">
        <div class="flex min-h-screen">
            <!-- Sidebar -->
            <aside class="w-64 bg-white dark:bg-[#1e293b] border-r border-slate-200 dark:border-slate-700/50 flex-shrink-0 fixed h-full z-20 transition-all duration-300">
                <div class="p-6">
                    <div class="flex items-center space-x-3">
                        <div class="h-10 w-10 rounded-xl bg-indigo-500 flex items-center justify-center shadow-lg shadow-indigo-500/20">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        </div>
                        <span class="text-xl font-bold tracking-tight text-slate-900 dark:text-white">SILS <span class="text-xs text-slate-400">v1.1</span></span>
                    </div>
                </div>

                <nav class="mt-4 px-4 space-y-6 text-slate-400">
                    <div>
                        <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 mb-4 ml-4">Navigasi Utama</p>
                        <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 border border-indigo-500/20 shadow-sm' : 'text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-slate-200 border border-transparent' }}">
                            <div class="h-8 w-8 rounded-lg flex items-center justify-center {{ request()->routeIs('dashboard') ? 'bg-indigo-500/10' : 'bg-slate-100 dark:bg-slate-800' }}">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                            </div>
                            <span class="font-bold text-sm">Monitor Live</span>
                        </a>
                    </div>

                    <div>
                        <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 mb-4 ml-4">Database Sekolah</p>
                        <div class="space-y-1">
                            <a href="{{ route('attendances.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('attendances.index') ? 'bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 border border-indigo-500/20 shadow-sm' : 'text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-slate-200 border border-transparent' }}">
                                <div class="h-8 w-8 rounded-lg flex items-center justify-center {{ request()->routeIs('attendances.index') ? 'bg-indigo-500/10' : 'bg-slate-100 dark:bg-slate-800' }}">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                                </div>
                                <span class="font-bold text-sm">Rekap Presensi</span>
                            </a>
                            <a href="{{ route('students.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('students.*') ? 'bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 border border-indigo-500/20 shadow-sm' : 'text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-slate-200 border border-transparent' }}">
                                <div class="h-8 w-8 rounded-lg flex items-center justify-center {{ request()->routeIs('students.*') ? 'bg-indigo-500/10' : 'bg-slate-100 dark:bg-slate-800' }}">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                </div>
                                <span class="font-bold text-sm">Data Siswa</span>
                            </a>
                            <a href="{{ route('parents.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('parents.*') ? 'bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 border border-indigo-500/20 shadow-sm' : 'text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-slate-200 border border-transparent' }}">
                                <div class="h-8 w-8 rounded-lg flex items-center justify-center {{ request()->routeIs('parents.*') ? 'bg-indigo-500/10' : 'bg-slate-100 dark:bg-slate-800' }}">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                </div>
                                <span class="font-bold text-sm">Data Wali</span>
                            </a>
                        </div>
                    </div>

                    <div class="pt-4 mt-4 border-t border-slate-700/30 mx-4">
                        <button @click="showHelp = true" class="w-full text-left bg-indigo-500/5 rounded-2xl p-4 border border-indigo-500/10 hover:bg-indigo-500/10 transition-all group">
                            <p class="text-[10px] font-black text-indigo-400 uppercase tracking-widest mb-1 group-hover:text-indigo-300">Butuh Bantuan?</p>
                            <p class="text-[11px] text-slate-500 leading-relaxed font-medium">Klik di sini atau icon bantuan untuk panduan sistem.</p>
                        </button>
                    </div>
                </nav>

                <div class="absolute bottom-0 w-full p-4 space-y-2">
                    <!-- Theme Toggle -->
                    <button @click="toggleTheme()" class="w-full flex items-center justify-between px-4 py-3 rounded-2xl bg-slate-100 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700/50 group transition-all">
                        <span class="text-[10px] font-black uppercase tracking-widest text-slate-500 dark:text-slate-400">Tema <span x-text="darkMode ? 'Gelap' : 'Terang'"></span></span>
                        <div class="h-6 w-10 bg-slate-200 dark:bg-slate-700 rounded-full relative transition-colors p-1">
                            <div class="h-4 w-4 rounded-full bg-white shadow-sm transition-all duration-300 transform" :class="darkMode ? 'translate-x-4 bg-indigo-500' : 'translate-x-0 bg-amber-400'"></div>
                        </div>
                    </button>

                    <div class="bg-slate-100 dark:bg-slate-800/50 rounded-2xl p-4 border border-slate-200 dark:border-slate-700/50">
                        <div class="flex items-center space-x-3">
                            <div class="h-8 w-8 rounded-full bg-slate-200 dark:bg-slate-700 flex items-center justify-center text-xs font-bold text-indigo-600 dark:text-indigo-400">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-slate-900 dark:text-white truncate">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-slate-500 truncate">Administrator</p>
                            </div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-slate-400 hover:text-rose-500 transition-colors">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Main Content -->
            <div class="flex-1 ml-64 min-h-screen relative">
                <!-- Top Header (Optional) -->
                @isset($header)
                    <header class="bg-white/80 dark:bg-[#0f172a]/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-800/50 sticky top-0 z-10 px-8 py-6">
                        {{ $header }}
                    </header>
                @endisset

                <!-- Page Content -->
                <main class="p-8 pb-24">
                    {{ $slot }}
                </main>

                <!-- Floating Help Button -->
                <button @click="showHelp = true" class="fixed bottom-8 right-8 h-14 w-14 rounded-full bg-indigo-600 hover:bg-indigo-500 text-white shadow-2xl shadow-indigo-500/40 flex items-center justify-center transition-all hover:scale-110 active:scale-95 z-30 border-4 border-[#0f172a]">
                    <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </button>
            </div>
        </div>

        <!-- Help Modal Overlay -->
        <div x-show="showHelp" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 dark:bg-black/80 backdrop-blur-sm" x-cloak>
            <!-- Modal Content -->
            <div @click.away="showHelp = false" class="bg-white dark:bg-[#1e293b] w-full max-w-2xl rounded-[2.5rem] border border-slate-200 dark:border-slate-700 shadow-2xl overflow-hidden" x-show="showHelp" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="scale-95 translate-y-4" x-transition:enter-end="scale-100 translate-y-0">
                <div class="px-8 py-6 bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-700 flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="h-10 w-10 rounded-xl bg-indigo-600/10 dark:bg-indigo-500/20 flex items-center justify-center text-indigo-600 dark:text-indigo-400">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5S19.832 5.477 21 6.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        </div>
                        <h2 class="text-xl font-black text-slate-900 dark:text-white uppercase tracking-tight">Panduan <span class="text-indigo-600 dark:text-indigo-400">Penggunaan</span></h2>
                    </div>
                    <button @click="showHelp = false" class="text-slate-500 hover:text-white transition-colors">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                <div class="p-8 max-h-[70vh] overflow-y-auto custom-scrollbar">
                    <div class="space-y-8">
                        <!-- Monitor Live -->
                        <div class="flex space-x-4">
                            <div class="h-8 w-8 rounded-lg bg-indigo-500/10 text-indigo-400 flex-shrink-0 flex items-center justify-center font-black">1</div>
                            <div>
                                <h4 class="text-slate-900 dark:text-white font-bold mb-1">Monitor Live</h4>
                                <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed">Gunakan menu ini untuk memantau kehadiran secara real-time. Setiap kali siswa melakukan tap kartu pada alat RFID, data akan muncul otomatis di baris paling atas tanpa perlu refresh halaman.</p>
                            </div>
                        </div>
                        <!-- Data Siswa -->
                        <div class="flex space-x-4">
                            <div class="h-8 w-8 rounded-lg bg-indigo-500/10 text-indigo-400 flex-shrink-0 flex items-center justify-center font-black">2</div>
                            <div>
                                <h4 class="text-slate-900 dark:text-white font-bold mb-1">Data Siswa & Kartu RFID</h4>
                                <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed">Daftarkan siswa baru di menu "Data Siswa". Pastikan **RFID UID** dimasukkan dengan benar agar kartu dapat dikenali oleh sistem saat proses scanning berlangsung.</p>
                            </div>
                        </div>
                        <!-- Data Wali -->
                        <div class="flex space-x-4">
                            <div class="h-8 w-8 rounded-lg bg-indigo-500/10 text-indigo-400 flex-shrink-0 flex items-center justify-center font-black">3</div>
                            <div>
                                <h4 class="text-slate-900 dark:text-white font-bold mb-1">Data Wali & Notifikasi</h4>
                                <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed">Kelola data orang tua/wali murid untuk integrasi notifikasi Telegram. Anda dapat mencari wali berdasarkan nama orang tua maupun nama anaknya (siswa) untuk kemudahan navigasi.</p>
                            </div>
                        </div>
                        <!-- Rekap Presensi -->
                        <div class="flex space-x-4">
                            <div class="h-8 w-8 rounded-lg bg-indigo-500/10 text-indigo-400 flex-shrink-0 flex items-center justify-center font-black">4</div>
                            <div>
                                <h4 class="text-slate-900 dark:text-white font-bold mb-1">Rekap & Laporan CSV</h4>
                                <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed">Menu ini menyimpan seluruh riwayat kehadiran. Gunakan filter tanggal untuk mencari laporan masa lalu dan klik **"Download Laporan"** untuk mendapatkan file CSV yang bisa dibuka di Excel.</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-10 p-5 bg-indigo-500/5 dark:bg-indigo-500/5 rounded-2xl border border-indigo-500/10 dark:border-indigo-500/10">
                        <div class="flex items-center space-x-3 mb-2">
                            <svg class="h-5 w-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span class="text-xs font-black text-slate-900 dark:text-white uppercase tracking-widest">Tips Admin</span>
                        </div>
                        <p class="text-[13px] text-slate-500 dark:text-slate-500 leading-relaxed font-medium">Jika alat RFID tidak sinkron, pastikan koneksi internet stabil dan status di dashboard menunjukkan <span class="text-green-600 dark:text-green-500 font-bold uppercase tracking-widest">Sistem Terhubung</span>.</p>
                    </div>
                </div>
                <div class="px-8 py-6 bg-slate-50 dark:bg-slate-800/30 border-t border-slate-200 dark:border-slate-700 flex justify-end">
                    <button @click="showHelp = false" class="bg-indigo-600 hover:bg-indigo-500 text-white px-8 py-3 rounded-2xl text-xs font-black uppercase tracking-widest transition-all">Tutup Panduan</button>
                </div>
            </div>
        </div>

        <style>
            [x-cloak] { display: none !important; }
            .custom-scrollbar::-webkit-scrollbar { width: 6px; }
            .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
            .custom-scrollbar::-webkit-scrollbar-thumb { background: #334155; border-radius: 10px; }
            .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #475569; }
        </style>
    </body>
</html>
