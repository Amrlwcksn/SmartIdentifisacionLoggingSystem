<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <nav aria-label="breadcrumb" class="mb-2">
                    <ol class="flex text-xs text-slate-500 uppercase tracking-widest font-bold">
                        <li class="after:content-['/'] after:mx-2 after:text-slate-700 pointer-events-none">Data Siswa</li>
                        <li class="text-indigo-400">Edit Data</li>
                    </ol>
                </nav>
                <h2 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                    Edit <span class="text-indigo-600 dark:text-indigo-500">Siswa</span>
                </h2>
                <p class="text-sm text-slate-500 mt-1 font-medium">Perbarui informasi untuk siswa: <strong>{{ $student->name }}</strong></p>
            </div>
            <a href="{{ route('students.index') }}" class="bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700 text-slate-600 dark:text-slate-300 px-6 py-3 rounded-2xl text-xs font-black uppercase tracking-widest border border-slate-200 dark:border-slate-700 transition-all flex items-center space-x-2 w-max">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                <span>Kembali</span>
            </a>
        </div>
    </x-slot>

    <div class="max-w-4xl">
        <div class="bg-white dark:bg-[#1e293b] rounded-[2rem] border border-slate-200 dark:border-slate-700/50 shadow-xl overflow-hidden transition-all duration-300">
            <div class="px-8 py-6 bg-slate-50 dark:bg-slate-800/30 border-b border-slate-200 dark:border-slate-700/50">
                <h3 class="text-sm font-black text-slate-900 dark:text-white uppercase tracking-wider">Formulir Perubahan Data</h3>
            </div>
            
            <form action="{{ route('students.update', $student->id) }}" method="POST" class="p-8">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Section 1: Identitas Sekolah -->
                    <div class="space-y-6">
                        <div>
                            <label for="name" class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-2 ml-1">Nama Lengkap Siswa</label>
                            <input type="text" name="name" id="name" required value="{{ old('name', $student->name) }}"
                                class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl px-5 py-3 text-sm text-slate-700 dark:text-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 dark:focus:ring-indigo-500/30 placeholder-slate-400 dark:placeholder-slate-600 transition-all font-medium @error('name') border-rose-500 @enderror"
                                placeholder="Masukkan nama lengkap...">
                            @error('name') <p class="text-rose-500 text-[10px] font-bold mt-2 ml-1 uppercase">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="nis" class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-2 ml-1">Nomor Induk Siswa (NIS)</label>
                            <input type="text" name="nis" id="nis" required value="{{ old('nis', $student->nis) }}"
                                class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl px-5 py-3 text-sm text-slate-700 dark:text-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 dark:focus:ring-indigo-500/30 placeholder-slate-400 dark:placeholder-slate-600 transition-all font-medium @error('nis') border-rose-500 @enderror"
                                placeholder="Contoh: 12345678">
                            @error('nis') <p class="text-rose-500 text-[10px] font-bold mt-2 ml-1 uppercase">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="class" class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-2 ml-1">Kelas / Rombel</label>
                            <input type="text" name="class" id="class" required value="{{ old('class', $student->class) }}"
                                class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl px-5 py-3 text-sm text-slate-700 dark:text-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 dark:focus:ring-indigo-500/30 placeholder-slate-400 dark:placeholder-slate-600 transition-all font-medium @error('class') border-rose-500 @enderror"
                                placeholder="Contoh: X RPL 1">
                            @error('class') <p class="text-rose-500 text-[10px] font-bold mt-2 ml-1 uppercase">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- Section 2: Identitas Perangkat & Wali -->
                    <div class="space-y-6">
                        <div>
                            <label for="uid" class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-2 ml-1">RFID UID (Opsional)</label>
                            <input type="text" name="uid" id="uid" value="{{ old('uid', $student->uid) }}"
                                class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl px-5 py-3 text-sm text-slate-700 dark:text-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 dark:focus:ring-indigo-500/30 placeholder-slate-400 dark:placeholder-slate-600 transition-all font-medium @error('uid') border-rose-500 @enderror"
                                placeholder="Kosongkan jika belum ada kartu">
                            @error('uid') <p class="text-rose-500 text-[10px] font-bold mt-2 ml-1 uppercase">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="parent_id" class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-2 ml-1">Pilih Orang Tua / Wali</label>
                            <select name="parent_id" id="parent_id" required
                                class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl px-5 py-3 text-sm text-slate-700 dark:text-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 dark:focus:ring-indigo-500/30 transition-all font-medium @error('parent_id') border-rose-500 @enderror">
                                @foreach($parents as $parent)
                                    <option value="{{ $parent->id }}" {{ old('parent_id', $student->parent_id) == $parent->id ? 'selected' : '' }}>{{ $parent->name }} ({{ $parent->phone }})</option>
                                @endforeach
                            </select>
                            @error('parent_id') <p class="text-rose-500 text-[10px] font-bold mt-2 ml-1 uppercase">{{ $message }}</p> @enderror
                            <div class="mt-4 p-4 bg-indigo-500/5 dark:bg-indigo-500/5 border border-indigo-100 dark:border-indigo-500/10 rounded-2xl transition-all duration-300">
                                <p class="text-[11px] text-slate-500 font-medium">Wali belum terdaftar? <a href="{{ route('parents.create') }}" class="text-indigo-600 dark:text-indigo-400 font-bold hover:underline">Tambah Wali Baru</a></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-12 flex items-center justify-end space-x-4">
                    <button type="reset" class="px-6 py-3 text-xs font-black text-slate-500 uppercase tracking-widest hover:text-white transition-all">Batalkan Perubahan</button>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-4 rounded-2xl text-xs font-black uppercase tracking-widest transition-all shadow-lg shadow-indigo-600/20">Perbarui Data Siswa</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
