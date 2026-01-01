<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <nav aria-label="breadcrumb" class="mb-2">
                    <ol class="flex text-xs text-slate-500 uppercase tracking-widest font-bold">
                        <li class="after:content-['/'] after:mx-2 after:text-slate-700 pointer-events-none">Data Wali</li>
                        <li class="text-indigo-400">Tambah Baru</li>
                    </ol>
                </nav>
                <h2 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                    Tambah <span class="text-indigo-600 dark:text-indigo-500">Wali Murid Baru</span>
                </h2>
                <p class="text-sm text-slate-500 mt-1 font-medium">Lengkapi informasi kontak wali murid untuk sistem notifikasi.</p>
            </div>
            <a href="{{ route('parents.index') }}" class="bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700 text-slate-600 dark:text-slate-300 px-6 py-3 rounded-2xl text-xs font-black uppercase tracking-widest border border-slate-200 dark:border-slate-700 transition-all flex items-center space-x-2 w-max">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                <span>Kembali</span>
            </a>
        </div>
    </x-slot>

    <div class="max-w-4xl space-y-8">
        <div class="bg-white dark:bg-[#1e293b] rounded-[2rem] border border-slate-200 dark:border-slate-700/50 shadow-xl overflow-hidden transition-all duration-300">
            <div class="px-8 py-6 bg-slate-50 dark:bg-slate-800/30 border-b border-slate-200 dark:border-slate-700/50">
                <h3 class="text-sm font-black text-slate-900 dark:text-white uppercase tracking-wider">Formulir Data Wali</h3>
            </div>
            
            <form action="{{ route('parents.store') }}" method="POST" class="p-8">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-6">
                        <div>
                            <label for="name" class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-2 ml-1">Nama Lengkap Wali</label>
                            <input type="text" name="name" id="name" required value="{{ old('name') }}"
                                class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl px-5 py-3 text-sm text-slate-700 dark:text-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 dark:focus:ring-indigo-500/30 placeholder-slate-400 dark:placeholder-slate-600 transition-all font-medium @error('name') border-rose-500 @enderror"
                                placeholder="Masukkan nama...">
                            @error('name') <p class="text-rose-500 text-[10px] font-bold mt-2 ml-1 uppercase">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-2 ml-1">Nomor WhatsApp / HP</label>
                            <input type="text" name="phone" id="phone" required value="{{ old('phone') }}"
                                class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl px-5 py-3 text-sm text-slate-700 dark:text-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 dark:focus:ring-indigo-500/30 placeholder-slate-400 dark:placeholder-slate-600 transition-all font-medium @error('phone') border-rose-500 @enderror"
                                placeholder="Contoh: 08123456789">
                            @error('phone') <p class="text-rose-500 text-[10px] font-bold mt-2 ml-1 uppercase">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label for="telegram_id" class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-2 ml-1">Telegram Chat ID (Opsional)</label>
                            <input type="text" name="telegram_id" id="telegram_id" value="{{ old('telegram_id') }}"
                                class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl px-5 py-3 text-sm text-slate-700 dark:text-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 dark:focus:ring-indigo-500/30 placeholder-slate-400 dark:placeholder-slate-600 transition-all font-medium @error('telegram_id') border-rose-500 @enderror"
                                placeholder="Masukkan Chat ID Telegram">
                            @error('telegram_id') <p class="text-rose-500 text-[10px] font-bold mt-2 ml-1 uppercase">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="address" class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-2 ml-1">Alamat Lengkap</label>
                            <textarea name="address" id="address" rows="3"
                                class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl px-5 py-3 text-sm text-slate-700 dark:text-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 dark:focus:ring-indigo-500/30 placeholder-slate-400 dark:placeholder-slate-600 transition-all font-medium @error('address') border-rose-500 @enderror"
                                placeholder="Masukkan alamat tinggal...">{{ old('address') }}</textarea>
                            @error('address') <p class="text-rose-500 text-[10px] font-bold mt-2 ml-1 uppercase">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-12 flex items-center justify-end space-x-4">
                    <button type="reset" class="px-6 py-3 text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest hover:text-slate-900 dark:hover:text-white transition-all">Reset</button>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-4 rounded-2xl text-xs font-black uppercase tracking-widest transition-all shadow-lg shadow-indigo-600/20">Simpan Data Wali</button>
                </div>
            </form>
        </div>

        <!-- Helper Box -->
        <div class="bg-amber-50 dark:bg-amber-500/5 border border-amber-200 dark:border-amber-500/20 rounded-3xl p-8 flex items-start space-x-6 transition-all duration-300">
            <div class="h-12 w-12 rounded-2xl bg-amber-100 dark:bg-amber-500/10 flex items-center justify-center text-amber-600 dark:text-amber-500 shrink-0">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <h4 class="text-amber-600 dark:text-amber-500 font-black text-sm mb-2 uppercase tracking-tight">Bagaimana cara mendapatkan Telegram Chat ID?</h4>
                <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed font-medium mb-4">
                    Agar orang tua bisa menerima notifikasi otomatis, sistem memerlukan **Chat ID**. Ikuti langkah berikut:
                </p>
                <ul class="text-[11px] text-slate-500 dark:text-slate-500 space-y-2 font-bold uppercase tracking-tight transition-all duration-300">
                    <li class="flex items-center space-x-2">
                        <span class="h-1.5 w-1.5 rounded-full bg-amber-600 dark:bg-amber-500"></span>
                        <span class="text-slate-700 dark:text-slate-500">Cari bot <b>@SILS_Notification_Bot</b> di Telegram.</span>
                    </li>
                    <li class="flex items-center space-x-2">
                        <span class="h-1.5 w-1.5 rounded-full bg-amber-600 dark:bg-amber-500"></span>
                        <span class="text-slate-700 dark:text-slate-500">Kirim pesan /start ke bot tersebut.</span>
                    </li>
                    <li class="flex items-center space-x-2">
                        <span class="h-1.5 w-1.5 rounded-full bg-amber-600 dark:bg-amber-500"></span>
                        <span class="text-slate-700 dark:text-slate-500">Ketikan <b>"NIS Siswa"</b> di chat. Lalu sistem akan otomatis tertaut dengan telegram Wali</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
