@extends('layouts.app')

@section('title', 'Detail - ' . $equipment->name)

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Header Breadcrumb -->
    <div class="flex items-center justify-between">
        <div>
            <div class="flex items-center gap-2 text-xs text-slate-400 mb-1">
                <a href="{{ route('alkes.index') }}" class="hover:text-teal-400 transition-colors">Katalog Alkes</a>
                <i class="fa-solid fa-chevron-right text-[10px]"></i>
                <span class="text-slate-200">Detail Alat</span>
            </div>
            <h1 class="text-2xl font-extrabold text-white tracking-tight flex items-center gap-3">
                <i class="fa-solid fa-file-medical text-cyan-400"></i>
                <span>Spesifikasi & Inventaris Alat</span>
            </h1>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('alkes.edit', $equipment->id) }}" class="px-4 py-2 rounded-xl bg-amber-500/10 hover:bg-amber-500/20 text-amber-300 border border-amber-500/20 font-semibold text-xs transition-colors flex items-center gap-2">
                <i class="fa-solid fa-pen-to-square"></i>
                <span>Edit</span>
            </a>
            <a href="{{ route('alkes.index') }}" class="px-4 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 font-semibold text-xs transition-colors flex items-center gap-2">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Kembali</span>
            </a>
        </div>
    </div>

    <!-- Detail Card -->
    <div class="glass-card rounded-2xl p-6 sm:p-8 shadow-xl space-y-6">
        
        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row items-start gap-6 pb-6 border-b border-slate-800">
            <div class="w-32 h-32 rounded-2xl bg-slate-950 overflow-hidden shrink-0 border border-slate-800 flex items-center justify-center text-teal-400 text-4xl shadow-inner">
                @if($equipment->image_url)
                    <img src="{{ $equipment->image_url }}" alt="{{ $equipment->name }}" class="w-full h-full object-cover">
                @else
                    <i class="fa-solid fa-notes-medical"></i>
                @endif
            </div>

            <div class="flex-grow space-y-2">
                <div class="flex flex-wrap items-center gap-2">
                    <span class="font-mono text-xs font-bold text-cyan-400 px-3 py-1 rounded-lg bg-cyan-500/10 border border-cyan-500/20">
                        {{ $equipment->code }}
                    </span>
                    <span class="text-xs text-slate-300 px-3 py-1 rounded-lg bg-slate-800">
                        {{ $equipment->category }}
                    </span>
                    <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $equipment->condition_badge_class }}">
                        <i class="fa-solid fa-circle text-[7px] mr-1"></i>{{ $equipment->condition }}
                    </span>
                </div>

                <h2 class="text-2xl font-bold text-white tracking-tight">{{ $equipment->name }}</h2>
                
                <p class="text-xs text-slate-400 flex flex-wrap items-center gap-4">
                    <span><i class="fa-solid fa-industry text-teal-400 mr-1.5"></i>Merk: <strong class="text-slate-200">{{ $equipment->brand ?? 'Tanpa Merk' }}</strong></span>
                    <span><i class="fa-solid fa-barcode text-cyan-400 mr-1.5"></i>Tipe: <strong class="text-slate-200">{{ $equipment->model_number ?? '-' }}</strong></span>
                </p>
            </div>
        </div>

        <!-- Specifications Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            <div class="bg-slate-900/80 p-4 rounded-xl border border-slate-800/80">
                <span class="text-[10px] uppercase font-bold text-slate-500 tracking-wider block mb-1">Jumlah Stok</span>
                <span class="text-lg font-bold text-white flex items-center gap-2">
                    <i class="fa-solid fa-boxes-stacked text-cyan-400 text-sm"></i>
                    <span>{{ $equipment->stock }} Unit</span>
                </span>
            </div>

            <div class="bg-slate-900/80 p-4 rounded-xl border border-slate-800/80">
                <span class="text-[10px] uppercase font-bold text-slate-500 tracking-wider block mb-1">Harga Satuan</span>
                <span class="text-lg font-bold text-emerald-400 flex items-center gap-2">
                    <span>{{ $equipment->formatted_price }}</span>
                </span>
            </div>

            <div class="bg-slate-900/80 p-4 rounded-xl border border-slate-800/80">
                <span class="text-[10px] uppercase font-bold text-slate-500 tracking-wider block mb-1">Lokasi Penyimpanan</span>
                <span class="text-sm font-semibold text-slate-200 truncate block mt-1">
                    <i class="fa-solid fa-location-dot text-teal-400 mr-1.5"></i>{{ $equipment->location }}
                </span>
            </div>

            <div class="bg-slate-900/80 p-4 rounded-xl border border-slate-800/80">
                <span class="text-[10px] uppercase font-bold text-slate-500 tracking-wider block mb-1">Nomor Seri (S/N)</span>
                <span class="text-xs font-mono font-semibold text-slate-300 block mt-1">
                    {{ $equipment->serial_number ?? 'Tidak Tercatat' }}
                </span>
            </div>
        </div>

        <!-- Description Box -->
        <div>
            <h4 class="font-bold text-xs uppercase tracking-wider text-slate-400 mb-2">Deskripsi Spesifikasi & Catatan</h4>
            <div class="bg-slate-900/60 p-5 rounded-2xl border border-slate-800/80 text-sm text-slate-300 leading-relaxed whitespace-pre-line">
                {{ $equipment->description ?? 'Tidak ada deskripsi spesifikasi tambahan.' }}
            </div>
        </div>

        <!-- Additional Metadata -->
        <div class="pt-4 border-t border-slate-800 flex flex-wrap items-center justify-between text-xs text-slate-500 gap-2">
            <div>
                <span>Tanggal Pengadaan: </span>
                <strong class="text-slate-400">{{ $equipment->purchase_date ? $equipment->purchase_date->format('d F Y') : '-' }}</strong>
            </div>
            <div>
                <span>Terakhir Diperbarui: </span>
                <strong class="text-slate-400">{{ $equipment->updated_at->diffForHumans() }}</strong>
            </div>
        </div>

    </div>

</div>
@endsection
