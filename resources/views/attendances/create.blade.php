<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight uppercase">Input <span class="text-indigo-600 dark:text-indigo-400">Presensi Manual</span></h2>
                <p class="text-sm text-slate-500 mt-1 font-medium">Gunakan form ini untuk mencatat siswa yang Izin, Sakit, atau Alpa.</p>
            </div>
            <a href="{{ route('attendances.index') }}" class="group flex items-center space-x-2 bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700 text-slate-600 dark:text-slate-300 px-5 py-2.5 rounded-2xl transition-all border border-slate-200 dark:border-slate-700/50">
                <svg class="h-5 w-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                <span class="text-xs font-black uppercase tracking-widest">Kembali</span>
            </a>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto">
        @if(session('error'))
            <div class="mb-6 bg-rose-50 dark:bg-rose-500/10 border border-rose-200 dark:border-rose-500/20 text-rose-600 dark:text-rose-500 px-6 py-4 rounded-2xl flex items-center space-x-3 transition-all duration-300">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="text-sm font-bold">{{ session('error') }}</span>
            </div>
        @endif

        <div class="bg-white dark:bg-[#1e293b] rounded-[2.5rem] border border-slate-200 dark:border-slate-700/50 shadow-2xl overflow-hidden transition-all duration-300">
            <div class="p-8 md:p-12">
                <form action="{{ route('attendances.store') }}" method="POST" class="space-y-8">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Siswa -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] ml-1">Pilih Peserta Didik</label>
                            <div class="relative group">
                                <select name="student_id" required class="w-full bg-slate-50 dark:bg-slate-900/50 border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-white px-5 py-4 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 dark:focus:border-indigo-500 transition-all appearance-none cursor-pointer">
                                    <option value="" disabled selected>-- Pilih Siswa --</option>
                                    @foreach($students as $student)
                                        <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                            {{ $student->name }} ({{ $student->nis }}) - {{ $student->class }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400 dark:text-slate-500">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                            @error('student_id') <p class="text-rose-500 text-[10px] font-bold mt-1 ml-1 uppercase">{{ $message }}</p> @enderror
                        </div>

                        <!-- Tanggal -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] ml-1">Tanggal Presensi</label>
                            <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}" required 
                                class="w-full bg-slate-50 dark:bg-slate-900/50 border-slate-200 dark:border-slate-700/50 rounded-2xl text-slate-700 dark:text-white px-5 py-4 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 dark:focus:border-indigo-500 transition-all">
                            @error('date') <p class="text-rose-500 text-[10px] font-bold mt-1 ml-1 uppercase">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="space-y-4">
                        <label class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] ml-1">Status Kehadiran</label>
                        <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                            @foreach(['hadir' => 'Hadir', 'telat' => 'Telat', 'izin' => 'Izin', 'sakit' => 'Sakit', 'alpa' => 'Alpa'] as $val => $label)
                                <label class="relative cursor-pointer group">
                                    <input type="radio" name="status" value="{{ $val }}" class="peer sr-only" {{ old('status') == $val ? 'checked' : '' }} required>
                                    <div class="bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-2xl p-4 text-center transition-all peer-checked:bg-indigo-50 dark:peer-checked:bg-indigo-500/10 peer-checked:border-indigo-500/50 peer-checked:ring-2 peer-checked:ring-indigo-500/20 group-hover:bg-white dark:group-hover:bg-slate-800">
                                        <div class="text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest peer-checked:text-indigo-600 dark:peer-checked:text-indigo-400 group-hover:text-slate-900 dark:group-hover:text-slate-200" x-text="'{{ $label }}'">{{ $label }}</div>
                                    </div>
                                    <!-- Animated Indicator -->
                                    <div class="absolute -top-1 -right-1 h-3 w-3 bg-indigo-500 rounded-full scale-0 transition-transform peer-checked:scale-100 shadow-lg shadow-indigo-500/50 border-2 border-white dark:border-[#1e293b]"></div>
                                </label>
                            @endforeach
                        </div>
                        @error('status') <p class="text-rose-500 text-[10px] font-bold mt-1 ml-1 uppercase">{{ $message }}</p> @enderror
                    </div>

                    <div class="pt-6">
                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-black py-5 rounded-[1.5rem] shadow-xl shadow-indigo-500/20 transition-all hover:scale-[1.02] active:scale-[0.98] uppercase tracking-[0.2em] flex items-center justify-center space-x-3">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span>Simpan Presensi</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="mt-8 bg-indigo-50 dark:bg-indigo-500/5 border border-indigo-100 dark:border-indigo-500/10 rounded-3xl p-6 flex items-start space-x-4 transition-all duration-300">
            <div class="h-10 w-10 rounded-xl bg-indigo-100 dark:bg-indigo-500/20 flex items-center justify-center text-indigo-600 dark:text-indigo-400 shrink-0">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <h4 class="text-slate-900 dark:text-white font-bold text-sm mb-1 uppercase tracking-tight">Informasi Penting</h4>
                <p class="text-xs text-slate-600 dark:text-slate-500 leading-relaxed font-medium">Presensi manual yang Anda masukkan untuk hari ini akan langsung muncul di **Monitor Live Dashboard**. Selain itu, sistem akan **otomatis mengirim notifikasi ke Telegram Wali Murid** jika Chat ID sudah terdaftar di sistem.</p>
            </div>
        </div>
    </div>
</x-app-layout>
