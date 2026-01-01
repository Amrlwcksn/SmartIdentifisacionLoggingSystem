<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                    Rekap <span class="text-indigo-600 dark:text-indigo-500">Presensi</span>
                </h2>
                <p class="text-sm text-slate-500 mt-1 font-medium">Laporan riwayat kehadiran seluruh siswa secara terperinci.</p>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('attendances.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-2xl text-xs font-black uppercase tracking-widest shadow-lg shadow-indigo-600/20 transition-all flex items-center space-x-2">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    <span>Input Manual</span>
                </a>
                <a href="{{ request()->fullUrlWithQuery(['export' => 1]) }}" class="bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700 text-slate-600 dark:text-slate-300 px-6 py-3 rounded-2xl text-xs font-black uppercase tracking-widest border border-slate-200 dark:border-slate-700 transition-all flex items-center space-x-2">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    <span>Download Laporan</span>
                </a>
            </div>
        </div>
    </x-slot>

    <!-- Success Message -->
    @if(session('success'))
    <div class="mb-8 p-4 bg-green-50 dark:bg-green-500/10 border border-green-200 dark:border-green-500/20 rounded-2xl flex items-center space-x-3 transition-all duration-300">
        <div class="h-8 w-8 rounded-lg bg-green-100 dark:bg-green-500/20 flex items-center justify-center text-green-600 dark:text-green-500">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        </div>
        <p class="text-sm font-bold text-green-700 dark:text-green-400 uppercase tracking-widest">{{ session('success') }}</p>
    </div>
    @endif

    <!-- Filters Section -->
    <div class="bg-white dark:bg-[#1e293b] rounded-3xl border border-slate-200 dark:border-slate-700/50 shadow-sm mb-8 overflow-hidden transition-all duration-300">
        <div class="px-8 py-4 bg-slate-50 dark:bg-slate-800/30 border-b border-slate-200 dark:border-slate-700/50 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex items-center space-x-2">
                <div class="h-2 w-2 rounded-full bg-amber-500"></div>
                <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 dark:text-slate-400">Pencarian & Filter Rekap</h3>
            </div>
            <p class="text-[11px] text-slate-400 dark:text-slate-500 font-bold uppercase tracking-tighter italic">Total Records: {{ $attendances->total() }}</p>
        </div>
        <div class="p-6">
            <form action="{{ route('attendances.index') }}" method="GET" class="flex flex-wrap gap-6 items-end">
                <div class="flex flex-col space-y-2">
                    <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Rentang Tanggal</label>
                    <input type="date" name="date" value="{{ request('date') }}" class="bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl px-5 py-3 text-sm text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-indigo-500/30 dark:focus:ring-indigo-500/30 transition-all font-medium">
                </div>
                <div class="flex flex-col space-y-2 flex-grow sm:max-w-md">
                    <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Cari Nama Siswa / NIS</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400 dark:text-slate-500">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </span>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Masukkan Nama atau NIS..." class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl pl-10 pr-4 py-3 text-sm text-slate-700 dark:text-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 dark:focus:ring-indigo-500/30 placeholder-slate-400 dark:placeholder-slate-600 transition-all font-medium">
                    </div>
                </div>
                <div class="flex space-x-2">
                    <button type="submit" class="px-6 py-3 bg-indigo-600 text-white rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-600/20">Terapkan Filter</button>
                    @if(request('date') || request('search'))
                        <a href="{{ route('attendances.index') }}" class="px-5 py-3 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl text-xs font-black text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700 hover:text-slate-900 dark:hover:text-white transition-all uppercase tracking-widest">Reset</a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Attendance History Table -->
    <div class="bg-white dark:bg-[#1e293b] rounded-[2rem] border border-slate-200 dark:border-slate-700/50 shadow-xl overflow-hidden transition-all duration-300">
        <div class="table-responsive">
            <table class="w-full text-left">
                <thead class="bg-slate-50 dark:bg-slate-800/40 border-b border-slate-200 dark:border-slate-700/50 transition-all duration-300">
                    <tr class="text-slate-500 dark:text-slate-500 text-[10px] font-black uppercase tracking-[0.2em]">
                        <th class="px-8 py-5">Siswa</th>
                        <th class="px-8 py-5">Kelas</th>
                        <th class="px-8 py-5">Tanggal Absen</th>
                        <th class="px-8 py-5">Waktu Tap</th>
                        <th class="px-8 py-5 text-center">Status</th>
                        <th class="px-8 py-5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800/50 transition-all duration-300">
                    @forelse($attendances as $record)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/40 transition-all group">
                        <td class="px-8 py-6">
                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-[0.9rem] bg-indigo-50 dark:bg-indigo-500/10 border border-indigo-100 dark:border-indigo-500/20 flex items-center justify-center text-indigo-600 dark:text-indigo-400 font-black shadow-inner">
                                    {{ substr($record->student->name, 0, 1) }}
                                </div>
                                <div class="ml-4">
                                    <span class="text-sm font-bold text-slate-900 dark:text-white block">{{ $record->student->name }}</span>
                                    <span class="text-[10px] text-slate-400 dark:text-slate-600 font-black uppercase tracking-tighter">{{ $record->student->nis }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <span class="inline-flex px-3 py-1 rounded-lg bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest">{{ $record->student->class }}</span>
                        </td>
                        <td class="px-8 py-6">
                            <div class="flex flex-col">
                                <span class="text-sm font-bold text-slate-700 dark:text-slate-300">{{ \Carbon\Carbon::parse($record->date)->isoFormat('LL') }}</span>
                                <span class="text-[10px] text-slate-400 dark:text-slate-600 font-black uppercase tracking-tighter">{{ \Carbon\Carbon::parse($record->date)->isoFormat('dddd') }}</span>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <div class="flex items-center space-x-3 text-slate-900 dark:text-white font-mono font-black">
                                <div class="h-8 w-8 rounded-lg bg-amber-50 dark:bg-amber-500/10 flex items-center justify-center text-amber-600 dark:text-amber-500 border border-amber-100 dark:border-amber-500/20">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <span class="text-lg">{{ $record->created_at->format('H:i:s') }}</span>
                            </div>
                        </td>
                        <td class="px-8 py-6 text-center">
                            @if($record->status == 'hadir')
                                <span class="inline-flex items-center px-5 py-2 rounded-2xl bg-green-50 dark:bg-green-500/10 border border-green-100 dark:border-green-500/20 text-[10px] font-black text-green-600 dark:text-green-500 uppercase tracking-widest shadow-sm">HADIR</span>
                            @elseif($record->status == 'telat')
                                <span class="inline-flex items-center px-5 py-2 rounded-2xl bg-amber-50 dark:bg-amber-500/10 border border-amber-100 dark:border-amber-500/20 text-[10px] font-black text-amber-600 dark:text-amber-500 uppercase tracking-widest shadow-sm">TELAT</span>
                            @elseif($record->status == 'sakit')
                                <span class="inline-flex items-center px-5 py-2 rounded-2xl bg-indigo-50 dark:bg-indigo-500/10 border border-indigo-100 dark:border-indigo-500/20 text-[10px] font-black text-indigo-600 dark:text-indigo-500 uppercase tracking-widest shadow-sm">SAKIT</span>
                            @elseif($record->status == 'izin')
                                <span class="inline-flex items-center px-5 py-2 rounded-2xl bg-sky-50 dark:bg-sky-500/10 border border-sky-100 dark:border-sky-500/20 text-[10px] font-black text-sky-600 dark:text-sky-500 uppercase tracking-widest shadow-sm">IZIN</span>
                            @else
                                <span class="inline-flex items-center px-5 py-2 rounded-2xl bg-rose-50 dark:bg-rose-500/10 border border-rose-100 dark:border-rose-500/20 text-[10px] font-black text-rose-600 dark:text-rose-500 uppercase tracking-widest shadow-sm">ALPA</span>
                            @endif
                        </td>
                        <td class="px-8 py-6 text-right">
                            <form action="{{ route('attendances.destroy', $record->id) }}" method="POST" onsubmit="return confirm('Hapus catatan presensi ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="opacity-10 md:opacity-0 group-hover:opacity-100 text-slate-500 hover:text-rose-500 transition-all">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-8 py-20 text-center">
                            <div class="flex flex-col items-center">
                                <div class="h-16 w-16 rounded-2xl bg-slate-50 dark:bg-slate-800 flex items-center justify-center text-slate-400 dark:text-slate-600 mb-4 border border-slate-200 dark:border-slate-700/50 transition-all duration-300">
                                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                                </div>
                                <h4 class="text-slate-900 dark:text-white font-black uppercase tracking-widest mb-1 transition-all duration-300">Tidak Ada Riwayat</h4>
                                <p class="text-slate-500 text-sm">Belum ada aktivitas presensi yang tercatat untuk kriteria ini.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($attendances->hasPages())
        <div class="px-6 py-6 border-t border-slate-100 dark:border-slate-800/50 bg-slate-50/50 dark:bg-slate-800/10 transition-all duration-300">
            {{ $attendances->appends(request()->query())->links() }}
        </div>
        @endif
    </div>
</x-app-layout>
