<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                    Data <span class="text-indigo-600 dark:text-indigo-500">Wali Murid</span>
                </h2>
                <p class="text-sm text-slate-500 mt-1 font-medium">Kelola informasi orang tua/wali untuk pengiriman notifikasi Telegram.</p>
            </div>
            <a href="{{ route('parents.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-2xl text-xs font-black uppercase tracking-widest transition-all shadow-lg shadow-indigo-600/20 flex items-center space-x-2 w-max">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                <span>Tambah Wali Baru</span>
            </a>
        </div>
    </x-slot>

    <!-- Alert Messages -->
    @if(session('success'))
    <div class="mb-8 p-4 bg-green-500/10 border border-green-500/20 rounded-2xl flex items-center space-x-3 transition-all duration-300">
        <div class="h-8 w-8 rounded-lg bg-green-500/20 flex items-center justify-center text-green-600 dark:text-green-500">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        </div>
        <p class="text-sm font-bold text-green-700 dark:text-green-400 uppercase tracking-widest">{{ session('success') }}</p>
    </div>
    @endif

    @if(session('error'))
    <div class="mb-8 p-4 bg-rose-500/10 border border-rose-500/20 rounded-2xl flex items-center space-x-3 transition-all duration-300">
        <div class="h-8 w-8 rounded-lg bg-rose-500/20 flex items-center justify-center text-rose-600 dark:text-rose-500">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </div>
        <p class="text-sm font-bold text-rose-700 dark:text-rose-400 uppercase tracking-widest">{{ session('error') }}</p>
    </div>
    @endif

    <!-- Search Section -->
    <div class="bg-white dark:bg-[#1e293b] rounded-3xl border border-slate-200 dark:border-slate-700/50 shadow-sm mb-8 overflow-hidden transition-all duration-300">
        <div class="p-6">
            <form action="{{ route('parents.index') }}" method="GET" class="flex flex-wrap gap-4 items-center justify-between">
                <div class="relative w-full sm:w-[500px]">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400 dark:text-slate-500">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berdasarkan Nama, No. HP, atau Telegram ID..." 
                        class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl pl-10 pr-4 py-3 text-sm text-slate-700 dark:text-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 dark:focus:ring-indigo-500/30 placeholder-slate-400 dark:placeholder-slate-600 transition-all font-medium">
                </div>
                <div class="flex space-x-2">
                    <button type="submit" class="px-8 py-3 bg-indigo-600 text-white rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-600/20">Cari Wali</button>
                    @if(request('search'))
                        <a href="{{ route('parents.index') }}" class="px-5 py-3 bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl text-xs font-black text-slate-500 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-700 hover:text-slate-900 dark:hover:text-white transition-all uppercase tracking-widest">Reset</a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Data Table Container -->
    <div class="bg-white dark:bg-[#1e293b] rounded-[2rem] border border-slate-200 dark:border-slate-700/50 shadow-xl overflow-hidden transition-all duration-300">
        <div class="table-responsive">
            <table class="w-full text-left">
                <thead class="bg-slate-50 dark:bg-slate-800/40 border-b border-slate-200 dark:border-slate-700/50">
                    <tr class="text-slate-400 dark:text-slate-500 text-[10px] font-black uppercase tracking-[0.2em]">
                        <th class="px-8 py-5">Nama Wali</th>
                        <th class="px-8 py-5">Kontak (HP/Telegram)</th>
                        <th class="px-8 py-5">Alamat</th>
                        <th class="px-8 py-5">Jumlah Siswa</th>
                        <th class="px-8 py-5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800/50">
                    @forelse($parents as $parent)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/40 transition-all group">
                        <td class="px-8 py-6">
                            <span class="text-sm font-bold text-slate-900 dark:text-white block transition-all duration-300">{{ $parent->name }}</span>
                        </td>
                        <td class="px-8 py-6">
                            <div class="flex flex-col space-y-1">
                                <span class="text-sm text-slate-600 dark:text-slate-300 transition-all duration-300">{{ $parent->phone }}</span>
                                <code class="text-[10px] text-indigo-600 dark:text-indigo-400 font-black bg-indigo-50 dark:bg-indigo-500/10 px-2 py-0.5 rounded-lg border border-indigo-100 dark:border-indigo-500/20 w-max transition-all duration-300">ID: {{ $parent->telegram_id ?: '-' }}</code>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <span class="text-xs text-slate-400 dark:text-slate-500 limit-2-lines transition-all duration-300">{{ $parent->address ?: 'Belum diisi' }}</span>
                        </td>
                        <td class="px-8 py-6">
                            <span class="inline-flex px-3 py-1 rounded-lg bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-[10px] font-black text-indigo-600 dark:text-indigo-400 uppercase tracking-widest transition-all duration-300">{{ $parent->students_count }} Siswa</span>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <div class="flex justify-end space-x-1 opacity-100 md:opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="{{ route('parents.edit', $parent->id) }}" title="Edit Data" class="h-9 w-9 flex items-center justify-center bg-slate-100 dark:bg-slate-800 hover:bg-indigo-500/10 dark:hover:bg-indigo-500/20 text-slate-500 dark:text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 rounded-xl border border-slate-200 dark:border-slate-700 transition-all">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </a>
                                <form action="{{ route('parents.destroy', $parent->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data wali ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Hapus Data" class="h-9 w-9 flex items-center justify-center bg-slate-100 dark:bg-slate-800 hover:bg-rose-500/10 dark:hover:bg-rose-500/20 text-slate-500 dark:text-slate-400 hover:text-rose-600 dark:hover:text-rose-400 rounded-xl border border-slate-200 dark:border-slate-700 transition-all">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-20 text-center">
                            <div class="flex flex-col items-center">
                                <div class="h-16 w-16 rounded-2xl bg-slate-50 dark:bg-slate-800 flex items-center justify-center text-slate-400 dark:text-slate-600 mb-4 border border-slate-200 dark:border-slate-700/50 transition-all duration-300">
                                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                </div>
                                <h4 class="text-slate-900 dark:text-white font-black uppercase tracking-widest mb-1 transition-all duration-300">Belum Ada Data Wali</h4>
                                <p class="text-slate-400 dark:text-slate-500 text-sm transition-all duration-300">Klik tombol "Tambah Wali Baru" untuk mulai memasukkan data.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($parents->hasPages())
        <div class="px-8 py-6 border-t border-slate-200 dark:border-slate-800/50 bg-slate-50 dark:bg-slate-800/10 transition-all duration-300">
            {{ $parents->appends(request()->query())->links() }}
        </div>
        @endif
    </div>
</x-app-layout>
