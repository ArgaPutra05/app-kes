@extends('layouts.app')

@section('title', 'Tambah Alat Kesehatan Medis Baru')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Header Breadcrumb -->
    <div class="flex items-center justify-between">
        <div>
            <div class="flex items-center gap-2 text-xs text-slate-400 mb-1">
                <a href="{{ route('alkes.index') }}" class="hover:text-teal-400 transition-colors">Katalog Alkes</a>
                <i class="fa-solid fa-chevron-right text-[10px]"></i>
                <span class="text-slate-200">Tambah Baru</span>
            </div>
            <h1 class="text-2xl font-extrabold text-white tracking-tight flex items-center gap-3">
                <i class="fa-solid fa-circle-plus text-teal-400"></i>
                <span>Tambah Alat Kesehatan Medis</span>
            </h1>
        </div>

        <a href="{{ route('alkes.index') }}" class="px-4 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 font-semibold text-xs transition-colors flex items-center gap-2">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali</span>
        </a>
    </div>

    <!-- Main Form Card -->
    <div class="glass-card rounded-2xl p-6 sm:p-8 shadow-xl">
        <form action="{{ route('alkes.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <!-- Section 1: Informasi Utam & Identitas Alat -->
            <div>
                <div class="flex items-center gap-3 pb-3 mb-5 border-b border-slate-800">
                    <div class="w-8 h-8 rounded-lg bg-teal-500/10 text-teal-400 flex items-center justify-center font-bold text-sm">
                        1
                    </div>
                    <div>
                        <h3 class="font-bold text-base text-white">Informasi & Identitas Alat Medis</h3>
                        <p class="text-xs text-slate-400">Masukkan kode inventaris, nama alat, merk, serta kategori medis.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    
                    <!-- Kode Alat -->
                    <div>
                        <label for="code" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">
                            Kode Inventaris Alat <span class="text-rose-400">*</span>
                        </label>
                        <div class="relative">
                            <input type="text" 
                                   name="code" 
                                   id="code" 
                                   value="{{ old('code', $suggestedCode) }}" 
                                   required 
                                   placeholder="Contoh: ALK-2026-010" 
                                   class="w-full px-4 py-2.5 rounded-xl bg-slate-900/90 border border-slate-700 text-cyan-400 font-mono font-bold text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/50 focus:border-teal-500">
                        </div>
                        <p class="text-[11px] text-slate-500 mt-1">Kode unik identifikasi fisik alat di sistem inventaris.</p>
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label for="category" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">
                            Kategori Medis <span class="text-rose-400">*</span>
                        </label>
                        <select name="category" id="category" required class="w-full px-4 py-2.5 rounded-xl bg-slate-900/90 border border-slate-700 text-white text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/50 focus:border-teal-500">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Nama Alat -->
                    <div class="md:col-span-2">
                        <label for="name" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">
                            Nama Lengkap Alat Kesehatan <span class="text-rose-400">*</span>
                        </label>
                        <input type="text" 
                               name="name" 
                               id="name" 
                               value="{{ old('name') }}" 
                               required 
                               placeholder="Contoh: Patient Monitor Mindray uMEC 10" 
                               class="w-full px-4 py-2.5 rounded-xl bg-slate-900/90 border border-slate-700 text-white text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/50 focus:border-teal-500">
                    </div>

                    <!-- Merk / Brand -->
                    <div>
                        <label for="brand" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">
                            Merk / Produsen (Brand)
                        </label>
                        <input type="text" 
                               name="brand" 
                               id="brand" 
                               value="{{ old('brand') }}" 
                               placeholder="Contoh: Mindray, Philips, GE Healthcare" 
                               class="w-full px-4 py-2.5 rounded-xl bg-slate-900/90 border border-slate-700 text-white text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/50 focus:border-teal-500">
                    </div>

                    <!-- Model Number -->
                    <div>
                        <label for="model_number" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">
                            Tipe / Seri Model
                        </label>
                        <input type="text" 
                               name="model_number" 
                               id="model_number" 
                               value="{{ old('model_number') }}" 
                               placeholder="Contoh: uMEC 10 / MAC 2000" 
                               class="w-full px-4 py-2.5 rounded-xl bg-slate-900/90 border border-slate-700 text-white text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/50 focus:border-teal-500">
                    </div>

                    <!-- Serial Number -->
                    <div>
                        <label for="serial_number" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">
                            Nomor Seri (S/N)
                        </label>
                        <input type="text" 
                               name="serial_number" 
                               id="serial_number" 
                               value="{{ old('serial_number') }}" 
                               placeholder="Contoh: SN-99812-X" 
                               class="w-full px-4 py-2.5 rounded-xl bg-slate-900/90 border border-slate-700 text-white font-mono text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/50 focus:border-teal-500">
                    </div>

                </div>
            </div>

            <!-- Section 2: Inventaris, Lokasi & Kondisi -->
            <div>
                <div class="flex items-center gap-3 pb-3 mb-5 border-b border-slate-800">
                    <div class="w-8 h-8 rounded-lg bg-cyan-500/10 text-cyan-400 flex items-center justify-center font-bold text-sm">
                        2
                    </div>
                    <div>
                        <h3 class="font-bold text-base text-white">Stok, Lokasi & Status Alat</h3>
                        <p class="text-xs text-slate-400">Atur jumlah unit, lokasi penyimpanan di rumah sakit, serta kondisi fisik.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    
                    <!-- Stok -->
                    <div>
                        <label for="stock" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">
                            Jumlah Stok (Unit) <span class="text-rose-400">*</span>
                        </label>
                        <input type="number" 
                               name="stock" 
                               id="stock" 
                               min="0" 
                               value="{{ old('stock', 1) }}" 
                               required 
                               class="w-full px-4 py-2.5 rounded-xl bg-slate-900/90 border border-slate-700 text-white font-bold text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/50 focus:border-teal-500">
                    </div>

                    <!-- Harga Satuan -->
                    <div>
                        <label for="price" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">
                            Harga per Unit (IDR) <span class="text-rose-400">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 font-bold text-xs">Rp</span>
                            <input type="number" 
                                   name="price" 
                                   id="price" 
                                   min="0" 
                                   step="500" 
                                   value="{{ old('price', 0) }}" 
                                   required 
                                   class="w-full pl-10 pr-4 py-2.5 rounded-xl bg-slate-900/90 border border-slate-700 text-emerald-400 font-bold text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/50 focus:border-teal-500">
                        </div>
                    </div>

                    <!-- Lokasi Penyimpanan -->
                    <div>
                        <label for="location" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">
                            Lokasi Penyimpanan <span class="text-rose-400">*</span>
                        </label>
                        <input type="text" 
                               name="location" 
                               id="location" 
                               value="{{ old('location') }}" 
                               required 
                               placeholder="Contoh: Ruang ICU, Gudang Utama" 
                               class="w-full px-4 py-2.5 rounded-xl bg-slate-900/90 border border-slate-700 text-white text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/50 focus:border-teal-500">
                    </div>

                    <!-- Kondisi Alat -->
                    <div>
                        <label for="condition" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">
                            Kondisi Fisik / Fungsional <span class="text-rose-400">*</span>
                        </label>
                        <select name="condition" id="condition" required class="w-full px-4 py-2.5 rounded-xl bg-slate-900/90 border border-slate-700 text-white text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/50 focus:border-teal-500">
                            @foreach($conditions as $cond)
                                <option value="{{ $cond }}" {{ old('condition', 'Baik') == $cond ? 'selected' : '' }}>{{ $cond }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tanggal Pengadaan -->
                    <div>
                        <label for="purchase_date" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">
                            Tanggal Pengadaan / Beli
                        </label>
                        <input type="date" 
                               name="purchase_date" 
                               id="purchase_date" 
                               value="{{ old('purchase_date', date('Y-m-d')) }}" 
                               class="w-full px-4 py-2.5 rounded-xl bg-slate-900/90 border border-slate-700 text-white text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/50 focus:border-teal-500">
                    </div>

                </div>
            </div>

            <!-- Section 3: Media & Deskripsi Spesifikasi -->
            <div>
                <div class="flex items-center gap-3 pb-3 mb-5 border-b border-slate-800">
                    <div class="w-8 h-8 rounded-lg bg-indigo-500/10 text-indigo-400 flex items-center justify-center font-bold text-sm">
                        3
                    </div>
                    <div>
                        <h3 class="font-bold text-base text-white">Foto & Deskripsi Spesifikasi</h3>
                        <p class="text-xs text-slate-400">Unggah foto unit alat kesehatan serta catatan deskripsi teknis.</p>
                    </div>
                </div>

                <div class="space-y-5">
                    
                    <!-- Upload Foto -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">
                            Foto Alat Kesehatan (Opsional)
                        </label>
                        <div class="flex items-start gap-4">
                            <div id="imagePreviewContainer" class="w-24 h-24 rounded-2xl bg-slate-950 border border-slate-800 flex items-center justify-center text-slate-600 shrink-0 overflow-hidden">
                                <i class="fa-solid fa-camera text-2xl"></i>
                            </div>
                            <div class="flex-grow">
                                <input type="file" 
                                       name="image" 
                                       id="image" 
                                       accept="image/*" 
                                       onchange="previewImage(event)" 
                                       class="block w-full text-xs text-slate-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-teal-500/10 file:text-teal-400 hover:file:bg-teal-500/20 cursor-pointer">
                                <p class="text-[11px] text-slate-500 mt-1.5">Format file: JPG, PNG, WEBP. Maksimal ukuran file: 3 MB.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Deskripsi Spesifikasi -->
                    <div>
                        <label for="description" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">
                            Deskripsi Teknis & Spesifikasi Alat
                        </label>
                        <textarea name="description" 
                                  id="description" 
                                  rows="4" 
                                  placeholder="Masukkan rincian spesifikasi teknis, kelengkapan aksesoris, atau riwayat garansi alat..." 
                                  class="w-full px-4 py-3 rounded-xl bg-slate-900/90 border border-slate-700 text-white text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/50 focus:border-teal-500 custom-scrollbar">{{ old('description') }}</textarea>
                    </div>

                </div>
            </div>

            <!-- Submit Button Footer -->
            <div class="pt-4 border-t border-slate-800 flex items-center justify-end gap-3">
                <a href="{{ route('alkes.index') }}" class="px-5 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 font-semibold text-sm transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-teal-500 to-cyan-500 hover:from-teal-400 hover:to-cyan-400 text-slate-950 font-bold text-sm shadow-lg shadow-teal-500/25 transition-all active:scale-95 flex items-center gap-2">
                    <i class="fa-solid fa-floppy-disk"></i>
                    <span>Simpan Alat Medis</span>
                </button>
            </div>

        </form>
    </div>

</div>
@endsection

@push('scripts')
<script>
    function previewImage(event) {
        const input = event.target;
        const container = document.getElementById('imagePreviewContainer');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                container.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover">`;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
