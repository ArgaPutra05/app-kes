@extends('layouts.app')

@section('title', 'Katalog & Inventaris Alat Kesehatan Medis')

@section('content')
<div class="space-y-8">

    <!-- Top Dashboard Header & Stat Cards -->
    <div>
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
            <div>
                <h1 class="text-2xl font-extrabold text-white tracking-tight flex items-center gap-3">
                    <i class="fa-solid fa-stethoscope text-teal-400"></i>
                    <span>Katalog Alat Kesehatan Medis</span>
                </h1>
                <p class="text-sm text-slate-400 mt-1">Kelola dan pantau kondisi, stok, serta pengadaan alat medis rumah sakit.</p>
            </div>
        </div>

        <!-- Metric Stat Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            
            <!-- Card 1: Total Jenis Alat -->
            <div class="glass-card rounded-2xl p-5 relative overflow-hidden group">
                <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-teal-500/10 rounded-full blur-xl group-hover:bg-teal-500/20 transition-all"></div>
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">Total Jenis Alat</span>
                    <div class="w-10 h-10 rounded-xl bg-teal-500/10 border border-teal-500/20 flex items-center justify-center text-teal-400">
                        <i class="fa-solid fa-boxes-stacked text-lg"></i>
                    </div>
                </div>
                <div class="text-3xl font-black text-white tracking-tight">{{ number_format($stats['total_types']) }} <span class="text-xs font-medium text-slate-400">tipe</span></div>
                <div class="mt-2 text-xs text-teal-400/80 flex items-center gap-1">
                    <i class="fa-solid fa-circle-check text-[10px]"></i>
                    <span>Terdaftar dalam sistem</span>
                </div>
            </div>

            <!-- Card 2: Total Unit Stok -->
            <div class="glass-card rounded-2xl p-5 relative overflow-hidden group">
                <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-cyan-500/10 rounded-full blur-xl group-hover:bg-cyan-500/20 transition-all"></div>
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">Total Unit Stok</span>
                    <div class="w-10 h-10 rounded-xl bg-cyan-500/10 border border-cyan-500/20 flex items-center justify-center text-cyan-400">
                        <i class="fa-solid fa-cubes text-lg"></i>
                    </div>
                </div>
                <div class="text-3xl font-black text-white tracking-tight">{{ number_format($stats['total_stock']) }} <span class="text-xs font-medium text-slate-400">unit</span></div>
                <div class="mt-2 text-xs text-cyan-400/80 flex items-center gap-1">
                    <i class="fa-solid fa-warehouse text-[10px]"></i>
                    <span>Tersedia di ruangan/gudang</span>
                </div>
            </div>

            <!-- Card 3: Total Nilai Aset -->
            <div class="glass-card rounded-2xl p-5 relative overflow-hidden group">
                <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-indigo-500/10 rounded-full blur-xl group-hover:bg-indigo-500/20 transition-all"></div>
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">Total Estimasi Aset</span>
                    <div class="w-10 h-10 rounded-xl bg-indigo-500/10 border border-indigo-500/20 flex items-center justify-center text-indigo-400">
                        <i class="fa-solid fa-sack-dollar text-lg"></i>
                    </div>
                </div>
                <div class="text-2xl font-black text-white tracking-tight truncate">Rp {{ number_format($stats['total_asset_value'], 0, ',', '.') }}</div>
                <div class="mt-2 text-xs text-indigo-400/80 flex items-center gap-1">
                    <i class="fa-solid fa-chart-line text-[10px]"></i>
                    <span>Kalkulasi nilai invest medis</span>
                </div>
            </div>

            <!-- Card 4: Status Kondisi -->
            <div class="glass-card rounded-2xl p-5 relative overflow-hidden group">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">Status Kondisi</span>
                    <div class="w-10 h-10 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-400">
                        <i class="fa-solid fa-heart-pulse text-lg"></i>
                    </div>
                </div>
                <div class="flex items-center gap-3 text-xs mt-1">
                    <span class="px-2 py-1 rounded-lg bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 font-semibold">
                        {{ $stats['good_condition'] }} Baik
                    </span>
                    <span class="px-2 py-1 rounded-lg bg-amber-500/10 text-amber-400 border border-amber-500/20 font-semibold">
                        {{ $stats['needs_repair'] }} Perbaikan/Kalibrasi
                    </span>
                    <span class="px-2 py-1 rounded-lg bg-rose-500/10 text-rose-400 border border-rose-500/20 font-semibold">
                        {{ $stats['broken'] }} Rusak
                    </span>
                </div>
            </div>

        </div>
    </div>

    <!-- Filter & Search Toolbar Card -->
    <div class="glass-card rounded-2xl p-5">
        <form action="{{ route('alkes.index') }}" method="GET" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-3">
                
                <!-- Search Input -->
                <div class="md:col-span-4 relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <i class="fa-solid fa-magnifying-glass text-sm"></i>
                    </div>
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}" 
                           placeholder="Cari nama alat, kode, merk, lokasi..." 
                           class="w-full pl-10 pr-4 py-2.5 rounded-xl bg-slate-900/80 border border-slate-700/80 text-white placeholder-slate-500 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/50 focus:border-teal-500 transition-all">
                </div>

                <!-- Category Filter -->
                <div class="md:col-span-2">
                    <select name="category" 
                            class="w-full px-3 py-2.5 rounded-xl bg-slate-900/80 border border-slate-700/80 text-white text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/50 focus:border-teal-500 transition-all">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Condition Filter -->
                <div class="md:col-span-2">
                    <select name="condition" 
                            class="w-full px-3 py-2.5 rounded-xl bg-slate-900/80 border border-slate-700/80 text-white text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/50 focus:border-teal-500 transition-all">
                        <option value="">Semua Kondisi</option>
                        @foreach($conditions as $cond)
                            <option value="{{ $cond }}" {{ request('condition') == $cond ? 'selected' : '' }}>{{ $cond }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Location Filter -->
                <div class="md:col-span-2">
                    <select name="location" 
                            class="w-full px-3 py-2.5 rounded-xl bg-slate-900/80 border border-slate-700/80 text-white text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/50 focus:border-teal-500 transition-all">
                        <option value="">Semua Lokasi</option>
                        @foreach($locations as $loc)
                            <option value="{{ $loc }}" {{ request('location') == $loc ? 'selected' : '' }}>{{ $loc }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Buttons -->
                <div class="md:col-span-2 flex items-center gap-2">
                    <button type="submit" class="flex-1 py-2.5 px-4 bg-teal-600 hover:bg-teal-500 text-white font-semibold text-sm rounded-xl transition-colors shadow-lg shadow-teal-600/20 flex items-center justify-center gap-2">
                        <i class="fa-solid fa-filter text-xs"></i>
                        <span>Filter</span>
                    </button>
                    
                    @if(request()->anyFilled(['search', 'category', 'condition', 'location', 'sort_by']))
                        <a href="{{ route('alkes.index') }}" title="Reset Filter" class="p-2.5 bg-slate-800 hover:bg-slate-700 text-slate-400 hover:text-white rounded-xl transition-colors">
                            <i class="fa-solid fa-rotate-left"></i>
                        </a>
                    @endif
                </div>

            </div>

            <div class="flex flex-wrap items-center justify-between gap-3 pt-3 border-t border-slate-800/80 text-xs text-slate-400">
                <div class="flex items-center gap-2">
                    <span>Urutkan:</span>
                    <select name="sort_by" onchange="this.form.submit()" class="bg-slate-900 border border-slate-700 rounded-lg text-xs px-2 py-1 text-slate-300 focus:outline-none">
                        <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Terbaru</option>
                        <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>Nama Alat (A-Z)</option>
                        <option value="stock" {{ request('sort_by') == 'stock' ? 'selected' : '' }}>Stok</option>
                        <option value="price" {{ request('sort_by') == 'price' ? 'selected' : '' }}>Harga</option>
                    </select>
                </div>

                <div class="flex items-center gap-2">
                    <span>Tampilan:</span>
                    <button type="button" onclick="switchView('grid')" id="btn-view-grid" class="p-1.5 rounded-lg bg-teal-500/20 text-teal-400 border border-teal-500/30">
                        <i class="fa-solid fa-border-all"></i> Card Grid
                    </button>
                    <button type="button" onclick="switchView('table')" id="btn-view-table" class="p-1.5 rounded-lg bg-slate-800 text-slate-400 border border-slate-700 hover:text-white">
                        <i class="fa-solid fa-list"></i> Tabel Data
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Grid View Section -->
    <div id="view-grid-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($equipments as $equipment)
            <div class="glass-card glass-card-hover rounded-2xl overflow-hidden flex flex-col justify-between group">
                
                <div>
                    <!-- Image & Badge Header -->
                    <div class="relative h-48 bg-slate-950/80 overflow-hidden flex items-center justify-center border-b border-slate-800">
                        @if($equipment->image_url)
                            <img src="{{ $equipment->image_url }}" alt="{{ $equipment->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="flex flex-col items-center justify-center text-slate-600 gap-2">
                                <div class="w-16 h-16 rounded-2xl bg-slate-900 flex items-center justify-center border border-slate-800 text-teal-500/60">
                                    <i class="fa-solid font-bold fa-notes-medical text-3xl"></i>
                                </div>
                                <span class="text-[11px] font-mono tracking-wider uppercase text-slate-500">Foto Tidak Tersedia</span>
                            </div>
                        @endif

                        <!-- Top Floating Badges -->
                        <div class="absolute top-3 left-3 flex flex-wrap items-center gap-1.5">
                            <span class="px-2.5 py-1 rounded-lg bg-slate-950/80 backdrop-blur-md text-cyan-400 font-mono text-[11px] font-bold border border-cyan-500/30 shadow-md">
                                {{ $equipment->code }}
                            </span>
                            <span class="px-2.5 py-1 rounded-lg bg-slate-950/80 backdrop-blur-md text-slate-300 text-[11px] font-medium border border-slate-700/80">
                                {{ $equipment->category }}
                            </span>
                        </div>

                        <div class="absolute top-3 right-3">
                            <span class="px-2.5 py-1 rounded-full text-[11px] font-bold border backdrop-blur-md shadow-md {{ $equipment->condition_badge_class }}">
                                <i class="fa-solid fa-circle text-[7px] mr-1"></i>{{ $equipment->condition }}
                            </span>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="p-5 space-y-3">
                        <div>
                            <h3 class="font-bold text-base text-white group-hover:text-teal-400 transition-colors line-clamp-1">
                                {{ $equipment->name }}
                            </h3>
                            <p class="text-xs text-slate-400 mt-0.5 flex items-center gap-2">
                                <span><i class="fa-solid fa-industry text-teal-500/80 mr-1"></i>{{ $equipment->brand ?? 'Tanpa Merk' }}</span>
                                @if($equipment->model_number)
                                    <span>• Tipe: {{ $equipment->model_number }}</span>
                                @endif
                            </p>
                        </div>

                        <p class="text-xs text-slate-400/90 line-clamp-2 min-h-[32px]">
                            {{ $equipment->description ?? 'Tidak ada deskripsi spesifikasi tambahan.' }}
                        </p>

                        <div class="pt-3 border-t border-slate-800/80 grid grid-cols-2 gap-2 text-xs">
                            <div class="bg-slate-900/60 p-2.5 rounded-xl border border-slate-800">
                                <span class="text-[10px] uppercase font-medium text-slate-500 block mb-0.5">Lokasi</span>
                                <span class="font-semibold text-slate-300 truncate block">
                                    <i class="fa-solid fa-location-dot text-teal-400 mr-1"></i>{{ $equipment->location }}
                                </span>
                            </div>

                            <div class="bg-slate-900/60 p-2.5 rounded-xl border border-slate-800">
                                <span class="text-[10px] uppercase font-medium text-slate-500 block mb-0.5">Jumlah Stok</span>
                                <span class="font-bold text-white flex items-center gap-1.5">
                                    <i class="fa-solid fa-box-archive text-cyan-400"></i>
                                    <span class="{{ $equipment->stock <= 2 ? 'text-rose-400 font-extrabold' : '' }}">{{ $equipment->stock }} Unit</span>
                                </span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-1">
                            <div>
                                <span class="text-[10px] uppercase font-medium text-slate-500 block">Harga Satuan</span>
                                <span class="text-sm font-extrabold text-emerald-400">{{ $equipment->formatted_price }}</span>
                            </div>
                            @if($equipment->purchase_date)
                                <div class="text-right">
                                    <span class="text-[10px] uppercase font-medium text-slate-500 block">Pengadaan</span>
                                    <span class="text-xs font-medium text-slate-400">{{ $equipment->purchase_date->format('d M Y') }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Card Actions Footer -->
                <div class="p-4 bg-slate-950/40 border-t border-slate-800/80 flex items-center justify-between gap-2">
                    <button onclick="openDetailModal({{ $equipment->id }})" 
                            class="flex-1 py-2 px-3 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 hover:text-white font-medium text-xs transition-colors flex items-center justify-center gap-1.5">
                        <i class="fa-solid fa-eye text-teal-400"></i>
                        <span>Detail</span>
                    </button>

                    <a href="{{ route('alkes.edit', $equipment->id) }}" 
                       class="flex-1 py-2 px-3 rounded-xl bg-amber-500/10 hover:bg-amber-500/20 text-amber-300 border border-amber-500/20 font-medium text-xs transition-colors flex items-center justify-center gap-1.5">
                        <i class="fa-solid fa-pen-to-square"></i>
                        <span>Edit</span>
                    </a>

                    <button onclick="confirmDelete({{ $equipment->id }}, '{{ addslashes($equipment->name) }}')" 
                            class="py-2 px-3 rounded-xl bg-rose-500/10 hover:bg-rose-500/20 text-rose-400 border border-rose-500/20 font-medium text-xs transition-colors">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </div>

            </div>
        @empty
            <div class="col-span-full glass-card rounded-2xl p-12 text-center my-6">
                <div class="w-16 h-16 rounded-full bg-slate-800 flex items-center justify-center text-slate-500 mx-auto mb-4">
                    <i class="fa-solid fa-folder-open text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-white mb-1">Data Alat Kesehatan Tidak Ditemukan</h3>
                <p class="text-xs text-slate-400 max-w-md mx-auto mb-6">Tidak ada data alat kesehatan yang sesuai dengan kriteria pencarian atau filter yang Anda pilih.</p>
                <a href="{{ route('alkes.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-teal-600 hover:bg-teal-500 text-white font-semibold text-sm transition-colors shadow-lg shadow-teal-600/20">
                    <i class="fa-solid fa-plus"></i>
                    <span>Tambah Alat Medis Baru</span>
                </a>
            </div>
        @endforelse
    </div>

    <!-- Table View Section (Hidden by default) -->
    <div id="view-table-container" class="hidden glass-card rounded-2xl overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-300">
                <thead class="bg-slate-900/90 text-xs font-semibold text-slate-400 uppercase tracking-wider border-b border-slate-800">
                    <tr>
                        <th class="py-4 px-4">Alat Kesehatan</th>
                        <th class="py-4 px-4">Kode & Kategori</th>
                        <th class="py-4 px-4">Lokasi</th>
                        <th class="py-4 px-4">Kondisi</th>
                        <th class="py-4 px-4">Stok</th>
                        <th class="py-4 px-4">Harga Satuan</th>
                        <th class="py-4 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/80">
                    @forelse($equipments as $equipment)
                        <tr class="hover:bg-slate-800/40 transition-colors">
                            <td class="py-3 px-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-slate-950 overflow-hidden shrink-0 border border-slate-800 flex items-center justify-center text-teal-400">
                                        @if($equipment->image_url)
                                            <img src="{{ $equipment->image_url }}" alt="{{ $equipment->name }}" class="w-full h-full object-cover">
                                        @else
                                            <i class="fa-solid fa-suitcase-medical"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="font-bold text-white hover:text-teal-400 transition-colors cursor-pointer" onclick="openDetailModal({{ $equipment->id }})">
                                            {{ $equipment->name }}
                                        </div>
                                        <div class="text-xs text-slate-400">
                                            {{ $equipment->brand ?? 'Tanpa Merk' }} {{ $equipment->model_number ? '('.$equipment->model_number.')' : '' }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <span class="font-mono text-xs font-bold text-cyan-400 block">{{ $equipment->code }}</span>
                                <span class="text-xs text-slate-400">{{ $equipment->category }}</span>
                            </td>
                            <td class="py-3 px-4 text-xs text-slate-300">
                                <i class="fa-solid fa-location-dot text-teal-400 mr-1"></i>{{ $equipment->location }}
                            </td>
                            <td class="py-3 px-4">
                                <span class="px-2.5 py-1 rounded-full text-xs font-bold border inline-block {{ $equipment->condition_badge_class }}">
                                    {{ $equipment->condition }}
                                </span>
                            </td>
                            <td class="py-3 px-4 font-bold text-white">
                                <span class="{{ $equipment->stock <= 2 ? 'text-rose-400' : '' }}">{{ $equipment->stock }} Unit</span>
                            </td>
                            <td class="py-3 px-4 font-bold text-emerald-400 text-xs">
                                {{ $equipment->formatted_price }}
                            </td>
                            <td class="py-3 px-4 text-center">
                                <div class="flex items-center justify-center gap-1.5">
                                    <button onclick="openDetailModal({{ $equipment->id }})" title="Detail" class="p-2 rounded-lg bg-slate-800 hover:bg-slate-700 text-teal-400">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                    <a href="{{ route('alkes.edit', $equipment->id) }}" title="Edit" class="p-2 rounded-lg bg-amber-500/10 hover:bg-amber-500/20 text-amber-300 border border-amber-500/20">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <button onclick="confirmDelete({{ $equipment->id }}, '{{ addslashes($equipment->name) }}')" title="Hapus" class="p-2 rounded-lg bg-rose-500/10 hover:bg-rose-500/20 text-rose-400 border border-rose-500/20">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-8 text-center text-slate-500">Data alat kesehatan tidak ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination Links -->
    <div class="mt-6">
        {{ $equipments->links() }}
    </div>

</div>

<!-- Modal Detail Alat Medis -->
<div id="detailModal" class="fixed inset-0 z-50 bg-slate-950/80 backdrop-blur-md hidden items-center justify-center p-4">
    <div class="glass-card rounded-2xl max-w-2xl w-full p-6 shadow-2xl relative border border-slate-700 animate-fade-in max-h-[90vh] overflow-y-auto custom-scrollbar">
        <button onclick="closeDetailModal()" class="absolute top-4 right-4 text-slate-400 hover:text-white p-2">
            <i class="fa-solid fa-xmark text-xl"></i>
        </button>
        
        <div id="modalLoading" class="py-12 text-center text-slate-400">
            <i class="fa-solid fa-circle-notch fa-spin text-3xl text-teal-400 mb-3"></i>
            <p class="text-xs">Memuat detail alat kesehatan...</p>
        </div>

        <div id="modalContent" class="hidden space-y-6">
            <div class="flex items-start gap-4 pb-4 border-b border-slate-800">
                <div id="modalImageContainer" class="w-24 h-24 rounded-xl bg-slate-950 overflow-hidden shrink-0 border border-slate-800 flex items-center justify-center text-teal-400 text-3xl">
                </div>
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <span id="modalCode" class="font-mono text-xs font-bold text-cyan-400 px-2 py-0.5 rounded bg-cyan-500/10 border border-cyan-500/20"></span>
                        <span id="modalCategory" class="text-xs text-slate-400 px-2 py-0.5 rounded bg-slate-800"></span>
                    </div>
                    <h2 id="modalName" class="text-xl font-bold text-white"></h2>
                    <p id="modalBrandModel" class="text-xs text-slate-400 mt-1"></p>
                </div>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 text-xs">
                <div class="bg-slate-900/80 p-3 rounded-xl border border-slate-800">
                    <span class="text-slate-500 block mb-0.5">Kondisi Alat</span>
                    <span id="modalCondition" class="font-bold"></span>
                </div>
                <div class="bg-slate-900/80 p-3 rounded-xl border border-slate-800">
                    <span class="text-slate-500 block mb-0.5">Jumlah Stok</span>
                    <span id="modalStock" class="font-bold text-white"></span>
                </div>
                <div class="bg-slate-900/80 p-3 rounded-xl border border-slate-800">
                    <span class="text-slate-500 block mb-0.5">Harga Satuan</span>
                    <span id="modalPrice" class="font-bold text-emerald-400"></span>
                </div>
                <div class="bg-slate-900/80 p-3 rounded-xl border border-slate-800">
                    <span class="text-slate-500 block mb-0.5">Lokasi Ruangan</span>
                    <span id="modalLocation" class="font-bold text-slate-300"></span>
                </div>
                <div class="bg-slate-900/80 p-3 rounded-xl border border-slate-800">
                    <span class="text-slate-500 block mb-0.5">Nomor Seri (S/N)</span>
                    <span id="modalSerialNumber" class="font-mono text-slate-300"></span>
                </div>
                <div class="bg-slate-900/80 p-3 rounded-xl border border-slate-800">
                    <span class="text-slate-500 block mb-0.5">Tanggal Pengadaan</span>
                    <span id="modalPurchaseDate" class="font-medium text-slate-300"></span>
                </div>
            </div>

            <div>
                <h4 class="font-bold text-xs uppercase tracking-wider text-slate-400 mb-2">Deskripsi & Spesifikasi</h4>
                <p id="modalDescription" class="text-xs text-slate-300 leading-relaxed bg-slate-900/60 p-4 rounded-xl border border-slate-800 whitespace-pre-line"></p>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-slate-800">
                <a id="modalEditBtn" href="#" class="px-4 py-2 rounded-xl bg-amber-500/10 hover:bg-amber-500/20 text-amber-300 border border-amber-500/20 font-semibold text-xs transition-colors flex items-center gap-1.5">
                    <i class="fa-solid fa-pen-to-square"></i> Edit Data
                </a>
                <button onclick="closeDetailModal()" class="px-4 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-semibold">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div id="deleteModal" class="fixed inset-0 z-50 bg-slate-950/80 backdrop-blur-md hidden items-center justify-center p-4">
    <div class="glass-card rounded-2xl max-w-md w-full p-6 shadow-2xl relative border border-rose-500/30 text-center animate-fade-in">
        <div class="w-16 h-16 rounded-full bg-rose-500/10 border border-rose-500/20 text-rose-400 flex items-center justify-center text-2xl mx-auto mb-4">
            <i class="fa-solid fa-triangle-exclamation"></i>
        </div>
        <h3 class="text-lg font-bold text-white mb-2">Konfirmasi Hapus Alat</h3>
        <p class="text-xs text-slate-400 mb-6">
            Apakah Anda yakin ingin menghapus data alat medis <span id="deleteEquipmentName" class="font-bold text-rose-300"></span>? Tindakan ini tidak dapat dibatalkan.
        </p>
        
        <form id="deleteForm" method="POST" action="">
            @csrf
            @method('DELETE')
            <div class="flex items-center justify-center gap-3">
                <button type="button" onclick="closeDeleteModal()" class="px-4 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-semibold transition-colors flex-1">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2.5 rounded-xl bg-rose-600 hover:bg-rose-500 text-white text-xs font-bold transition-colors flex-1 shadow-lg shadow-rose-600/20">
                    Ya, Hapus Data
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function switchView(mode) {
        const grid = document.getElementById('view-grid-container');
        const table = document.getElementById('view-table-container');
        const btnGrid = document.getElementById('btn-view-grid');
        const btnTable = document.getElementById('btn-view-table');

        if (mode === 'grid') {
            grid.classList.remove('hidden');
            table.classList.add('hidden');
            btnGrid.className = 'p-1.5 rounded-lg bg-teal-500/20 text-teal-400 border border-teal-500/30';
            btnTable.className = 'p-1.5 rounded-lg bg-slate-800 text-slate-400 border border-slate-700 hover:text-white';
        } else {
            grid.classList.add('hidden');
            table.classList.remove('hidden');
            btnTable.className = 'p-1.5 rounded-lg bg-teal-500/20 text-teal-400 border border-teal-500/30';
            btnGrid.className = 'p-1.5 rounded-lg bg-slate-800 text-slate-400 border border-slate-700 hover:text-white';
        }
    }

    function openDetailModal(id) {
        const modal = document.getElementById('detailModal');
        const loading = document.getElementById('modalLoading');
        const content = document.getElementById('modalContent');
        
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        loading.classList.remove('hidden');
        content.classList.add('hidden');

        fetch(`/alkes/${id}`, {
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(res => res.json())
        .then(res => {
            if (res.success) {
                const data = res.data;
                document.getElementById('modalCode').innerText = data.code;
                document.getElementById('modalCategory').innerText = data.category;
                document.getElementById('modalName').innerText = data.name;
                document.getElementById('modalBrandModel').innerText = `Merk: ${data.brand || '-'} | Tipe: ${data.model_number || '-'}`;
                
                document.getElementById('modalCondition').innerText = data.condition;
                document.getElementById('modalCondition').className = `px-2 py-0.5 rounded text-xs border ${res.condition_badge}`;
                
                document.getElementById('modalStock').innerText = `${data.stock} Unit`;
                document.getElementById('modalPrice').innerText = res.formatted_price;
                document.getElementById('modalLocation').innerText = data.location;
                document.getElementById('modalSerialNumber').innerText = data.serial_number || 'T/A';
                document.getElementById('modalPurchaseDate').innerText = data.purchase_date ? new Date(data.purchase_date).toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' }) : 'T/A';
                document.getElementById('modalDescription').innerText = data.description || 'Tidak ada spesifikasi tambahan.';
                
                const imgContainer = document.getElementById('modalImageContainer');
                if (res.image_url) {
                    imgContainer.innerHTML = `<img src="${res.image_url}" class="w-full h-full object-cover">`;
                } else {
                    imgContainer.innerHTML = `<i class="fa-solid fa-notes-medical"></i>`;
                }

                document.getElementById('modalEditBtn').href = `/alkes/${data.id}/edit`;

                loading.classList.add('hidden');
                content.classList.remove('hidden');
            }
        })
        .catch(err => {
            alert('Gagal memuat detail data.');
            closeDetailModal();
        });
    }

    function closeDetailModal() {
        const modal = document.getElementById('detailModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    function confirmDelete(id, name) {
        document.getElementById('deleteEquipmentName').innerText = `"${name}"`;
        document.getElementById('deleteForm').action = `/alkes/${id}`;
        const modal = document.getElementById('deleteModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>
@endpush
