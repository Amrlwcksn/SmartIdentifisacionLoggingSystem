<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                    Selamat Datang, <span class="text-indigo-600 dark:text-indigo-400">{{ Auth::user()->name }}!</span>
                </h2>
                <p class="text-sm text-slate-500 mt-1 font-medium">Sistem pemantauan kehadiran real-time sudah siap digunakan.</p>
            </div>
            <div class="flex items-center space-x-3">
                <div id="status-badge" class="flex items-center space-x-3 rounded-2xl bg-white dark:bg-slate-800/80 px-5 py-2.5 text-xs font-black text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-slate-700/50 shadow-sm backdrop-blur-sm">
                    <div class="relative flex h-2.5 w-2.5">
                        <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-green-600 dark:bg-green-500 opacity-20"></span>
                        <span class="relative inline-flex h-2.5 w-2.5 rounded-full bg-green-600 dark:bg-green-500"></span>
                    </div>
                    <span class="uppercase tracking-widest">Sistem Terhubung</span>
                </div>
            </div>
        </div>
    </x-slot>

    <div x-data="attendanceFeed()">
        <!-- Welcome Insight Card -->
        <div class="bg-gradient-to-r from-indigo-600 to-indigo-800 rounded-[2rem] p-8 mb-8 shadow-xl shadow-indigo-900/20 relative overflow-hidden group">
            <div class="absolute right-0 top-0 opacity-10 group-hover:scale-110 transition-transform duration-700">
                <svg class="h-64 w-64 -mr-16 -mt-16 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm4.59-12.42L10 14.17l-2.59-2.58L6 13l4 4 8-8z"/></svg>
            </div>
            <div class="relative z-10 max-w-2xl">
                <h3 class="text-2xl font-black text-white mb-2 tracking-tight">Apa yang terjadi hari ini?</h3>
                <p class="text-indigo-100 text-sm font-medium leading-relaxed opacity-90">
                    Dashboard ini menampilkan aktivitas tap kartu RFID oleh siswa secara langsung. Klik menu <strong>Rekap Presensi</strong> untuk melihat laporan harian yang lebih detail.
                </p>
                <div class="mt-6 flex space-x-3">
                    <a href="{{ route('attendances.index') }}" class="bg-white/20 hover:bg-white/30 text-white text-xs font-black px-5 py-2.5 rounded-xl backdrop-blur-md transition-all uppercase tracking-widest border border-white/10">Lihat Rekap</a>
                    <a href="{{ route('students.index') }}" class="bg-indigo-500/30 hover:bg-indigo-500/50 text-white text-xs font-black px-5 py-2.5 rounded-xl backdrop-blur-md transition-all uppercase tracking-widest border border-white/5">Kelola Siswa</a>
                </div>
            </div>
        </div>

        <!-- Metric Section -->
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-4 mb-8">
            <div class="bg-white dark:bg-[#1e293b] rounded-3xl border border-slate-200 dark:border-slate-700/50 p-6 shadow-sm transition-all duration-300">
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 dark:text-slate-500 mb-4">Total Peserta Didik</p>
                <div class="flex items-end justify-between">
                    <div>
                        <h3 class="text-4xl font-black text-slate-900 dark:text-white leading-none">{{ $totalStudents }}</h3>
                        <p class="text-xs text-slate-400 dark:text-slate-500 font-bold mt-2 uppercase tracking-tighter">Siswa Terdaftar</p>
                    </div>
                    <div class="h-12 w-12 rounded-2xl bg-indigo-50 dark:bg-indigo-500/10 border border-indigo-100 dark:border-indigo-500/20 flex items-center justify-center text-indigo-600 dark:text-indigo-400">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-[#1e293b] rounded-3xl border border-slate-200 dark:border-slate-700/50 p-6 shadow-sm transition-all duration-300">
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 dark:text-slate-500 mb-4">Status Kehadiran</p>
                <div class="flex items-end justify-between">
                    <div>
                        <h3 class="text-4xl font-black text-green-600 dark:text-green-400 leading-none" x-text="stats.present">{{ $presentToday }}</h3>
                        <p class="text-xs text-slate-400 dark:text-slate-500 font-bold mt-2 uppercase tracking-tighter">Siswa Sudah Hadir</p>
                    </div>
                    <div class="h-12 w-12 rounded-2xl bg-green-50 dark:bg-green-500/10 border border-green-100 dark:border-green-500/20 flex items-center justify-center text-green-600 dark:text-green-400">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-[#1e293b] rounded-3xl border border-slate-200 dark:border-slate-700/50 p-6 shadow-sm transition-all duration-300">
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 dark:text-slate-500 mb-4">Siswa Belum Absen</p>
                <div class="flex items-end justify-between">
                    <div>
                        <h3 class="text-4xl font-black text-rose-600 dark:text-rose-400 leading-none" x-text="stats.registered - scannedIds.length">{{ $absentToday }}</h3>
                        <p class="text-xs text-slate-400 dark:text-slate-500 font-bold mt-2 uppercase tracking-tighter">Dalam Penantian</p>
                    </div>
                    <div class="h-12 w-12 rounded-2xl bg-rose-50 dark:bg-rose-500/10 border border-rose-100 dark:border-rose-500/20 flex items-center justify-center text-rose-600 dark:text-rose-400">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-[#1e293b] rounded-3xl border border-slate-200 dark:border-slate-700/50 p-6 shadow-sm flex flex-col justify-center transition-all duration-300">
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 dark:text-slate-500 mb-2">Waktu & Tanggal</p>
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-3xl font-black text-indigo-600 dark:text-indigo-400 leading-none font-mono" x-text="currentTime">--:--:--</h3>
                        <p class="text-[11px] text-slate-400 dark:text-slate-500 font-black mt-2 uppercase tracking-widest" x-text="currentDate">-- --- ----</p>
                    </div>
                    <div class="h-12 w-12 rounded-2xl bg-indigo-50 dark:bg-indigo-500/10 border border-indigo-100 dark:border-indigo-500/20 flex items-center justify-center text-indigo-600 dark:text-indigo-400">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Feed Section -->
        <div class="flex items-center space-x-4 mb-6">
            <h4 class="text-lg font-black text-slate-900 dark:text-white uppercase tracking-wider flex-shrink-0">Aktivitas Terbaru</h4>
            <div class="h-[1px] bg-slate-200 dark:bg-slate-800 w-full"></div>
        </div>

        <div class="bg-white dark:bg-[#1e293b] rounded-[2rem] border border-slate-200 dark:border-slate-700/50 shadow-xl overflow-hidden transition-all duration-300">
            <div class="table-responsive">
                <table class="w-full text-left">
                    <thead class="bg-slate-50 dark:bg-slate-800/40 border-b border-slate-200 dark:border-slate-700/50">
                        <tr class="text-slate-400 dark:text-slate-500 text-[10px] font-black uppercase tracking-[0.2em]">
                            <th class="px-8 py-5">Identitas Siswa</th>
                            <th class="px-8 py-5">NIS & RFID</th>
                            <th class="px-8 py-5">Kelas</th>
                            <th class="px-8 py-5">Waktu Tap</th>
                            <th class="px-8 py-5 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800/50 text-slate-600 dark:text-slate-300">
                        <template x-for="(entry, index) in list" :key="entry.id">
                            <tr class="group transition-all duration-300 hover:bg-slate-50 dark:hover:bg-slate-800/40"
                                :class="index === 0 ? 'bg-indigo-500/[0.03] border-l-4 border-l-indigo-600 dark:border-l-indigo-500' : 'border-l-4 border-l-transparent'">
                                <td class="px-8 py-6">
                                    <div class="flex items-center">
                                        <div class="h-12 w-12 rounded-2xl bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 flex items-center justify-center text-indigo-600 dark:text-indigo-400 font-black shadow-inner transition-all duration-300">
                                            <span x-text="entry.student ? entry.student.name.charAt(0) : '?'"></span>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-[15px] font-bold text-slate-900 dark:text-white mb-0.5" x-text="entry.student ? entry.student.name : 'Unknown'"></div>
                                            <div class="text-[11px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-tighter" x-text="entry.student && entry.student.parent ? 'Wali: ' + entry.student.parent.name : 'Wali: -'"></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex flex-col space-y-1">
                                        <span class="text-xs font-mono font-bold text-slate-500 dark:text-slate-400" x-text="entry.student ? entry.student.nis : '-'"></span>
                                        <span class="text-[10px] text-slate-400 dark:text-slate-600 font-bold uppercase" x-text="entry.student ? 'RFID: ' + (entry.student.uid || '-') : 'RFID: -'"></span>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="inline-flex items-center px-4 py-1.5 rounded-xl bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700/50 text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest transition-all duration-300" x-text="entry.student ? entry.student.class : '-'"></span>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex items-center space-x-3">
                                         <span class="text-[15px] font-black text-slate-900 dark:text-white font-mono" x-text="formatTime(entry.created_at)"></span>
                                         <span class="h-1.5 w-1.5 rounded-full bg-indigo-600 dark:bg-indigo-500 animate-pulse"></span>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    <span class="inline-flex items-center px-5 py-2 rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-sm border" 
                                          :class="{
                                              'bg-green-500/10 border-green-500/20 text-green-500': entry.status === 'hadir',
                                              'bg-amber-500/10 border-amber-500/20 text-amber-500': entry.status === 'telat',
                                              'bg-indigo-500/10 border-indigo-500/20 text-indigo-400': entry.status === 'sakit',
                                              'bg-sky-500/10 border-sky-500/20 text-sky-400': entry.status === 'izin',
                                              'bg-rose-500/10 border-rose-500/20 text-rose-500': entry.status === 'alpa'
                                          }"
                                          x-text="(entry.status || 'hadir').toUpperCase()"></span>
                                </td>
                            </tr>
                        </template>
                        <tr x-show="list.length === 0">
                            <td colspan="5" class="px-8 py-32 text-center">
                                <div class="max-w-md mx-auto">
                                    <div class="h-24 w-24 rounded-[2rem] bg-indigo-500/5 dark:bg-indigo-500/5 border border-indigo-100 dark:border-indigo-500/10 flex items-center justify-center text-indigo-400/50 mx-auto mb-8 animate-bounce mt-4">
                                        <svg class="h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A10.003 10.003 0 0012 3m0 18a10.003 10.003 0 01-3.143-5.433m.931-11.458A10.002 10.002 0 0112 3m0 18c3.517 0 6.799-1.009 9.571-2.753m-2.04-3.44l-.09.054A10.003 10.003 0 0021 12m0 0h-3m3 0a10.003 10.003 0 01-5.433 3.143m11.458-.931A10.002 10.002 0 0121 12m-9 1v-4m0 0L9 12m3-3l3 3"></path></svg>
                                    </div>
                                    <h5 class="text-xl font-black text-slate-900 dark:text-white mb-2 tracking-tight uppercase">Menunggu Aktivitas Pertama</h5>
                                    <p class="text-slate-400 dark:text-slate-500 text-sm font-medium">Sistem sedang memantau pembaca RFID. Rekapan akan muncul di sini secara otomatis saat siswa melakukan tap kartu.</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- Scripting for Real-time Updates -->
    <script>
        function attendanceFeed() {
            return {
                list: @json($attendances),
                scannedIds: @json($scannedStudentIds),
                stats: {
                    present: {{ $presentToday }},
                    registered: {{ $totalStudents }}
                },
                currentTime: '',
                currentDate: '',
                
                init() {
                    // Start clock
                    this.updateTime();
                    setInterval(() => this.updateTime(), 1000);

                    // Listen for Real-time Events
                    setTimeout(() => {
                        window.Echo.channel('attendance-channel')
                            .listen('.attendance.scanned', (e) => {
                                console.log('Attendance Scanned:', e);
                                
                                // Check if student already scanned today (using separate state with string comparison for robustness)
                                const studentId = String(e.attendance.student_id);
                                if (!this.scannedIds.map(String).includes(studentId)) {
                                    this.scannedIds.push(studentId);
                                    
                                    // Only increment "Present" stat if status is hadir or telat
                                    if (e.attendance.status === 'hadir' || e.attendance.status === 'telat') {
                                        this.stats.present++;
                                    }
                                }

                                // Check if student currently visible in the limited list to avoid duplicates in the UI
                                const visibleIndex = this.list.findIndex(item => item.id === e.attendance.id);
                                if (visibleIndex !== -1) {
                                    this.list.splice(visibleIndex, 1);
                                }

                                // Add to list (at the top)
                                this.list.unshift(e.attendance);
                                
                                // Limit visible list to 15 entries
                                if (this.list.length > 15) this.list.pop();
                            });
                    }, 500);
                },

                updateTime() {
                    const now = new Date();
                    this.currentTime = now.toLocaleTimeString('en-US', { hour12: false, hour: '2-digit', minute: '2-digit', second: '2-digit' });
                    this.currentDate = now.toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' });
                },

                formatTime(dateString) {
                    const date = new Date(dateString);
                    if (isNaN(date.getTime())) return '-';
                    return date.toLocaleTimeString('en-US', { hour12: false, hour: '2-digit', minute: '2-digit', second: '2-digit' });
                }
            }
        }
    </script>

    <style>
        .animate-pulse-slow {
            animation: pulse-slow 3s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        @keyframes pulse-slow {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.8; }
        }
    </style>
</x-app-layout>
