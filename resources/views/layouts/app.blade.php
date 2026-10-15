<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Inventaris Alat Kesehatan Medis')</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        medical: {
                            50: '#f0fdfa',
                            100: '#ccfbf1',
                            200: '#99f6e4',
                            500: '#14b8a6',
                            600: '#0d9488',
                            700: '#0f766e',
                            800: '#115e59',
                            900: '#134e4a',
                            950: '#042f2e',
                        },
                        dark: {
                            bg: '#0b1329',
                            card: '#1e293b',
                            border: '#334155',
                            text: '#f8fafc',
                            muted: '#94a3b8'
                        }
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #0b1329;
            color: #f8fafc;
        }
        .glass-card {
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
        .glass-card-hover {
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .glass-card-hover:hover {
            transform: translateY(-3px);
            border-color: rgba(20, 184, 166, 0.3);
            box-shadow: 0 12px 30px -10px rgba(20, 184, 166, 0.15);
        }
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(15, 23, 42, 0.6);
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(51, 65, 85, 0.8);
            border-radius: 9999px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(20, 184, 166, 0.6);
        }
        .nav-item-active {
            background: linear-gradient(90deg, rgba(20, 184, 166, 0.15) 0%, rgba(20, 184, 166, 0.05) 100%);
            border-left: 3px solid #14b8a6;
            color: #2dd4bf !important;
            font-weight: 700;
        }
    </style>
    @stack('styles')
</head>
<body class="min-h-screen bg-[#0b1329] text-slate-100 flex custom-scrollbar antialiased">

    <!-- Mobile Sidebar Backdrop Overlay -->
    <div id="sidebar-backdrop" onclick="toggleSidebar()" class="fixed inset-0 z-40 bg-slate-950/80 backdrop-blur-sm hidden lg:hidden"></div>

    <!-- Left Sidebar Navbar -->
    <aside id="sidebar-nav" class="fixed top-0 bottom-0 left-0 z-50 w-64 lg:w-72 bg-slate-900/95 backdrop-blur-xl border-r border-slate-800/80 flex flex-col transition-transform duration-300 transform -translate-x-full lg:translate-x-0">
        
        <!-- Sidebar Brand Logo Header -->
        <div class="h-20 px-6 flex items-center justify-between border-b border-slate-800/80">
            <a href="{{ route('alkes.index') }}" class="flex items-center gap-3 group">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-teal-500 to-cyan-400 p-0.5 shadow-lg shadow-teal-500/20 group-hover:scale-105 transition-transform">
                    <div class="w-full h-full bg-slate-950 rounded-[10px] flex items-center justify-center">
                        <i class="fa-solid fa-heart-pulse text-xl text-cyan-400 animate-pulse"></i>
                    </div>
                </div>
                <div>
                    <div class="flex items-center gap-1.5">
                        <span class="font-extrabold text-lg tracking-tight text-white group-hover:text-cyan-400 transition-colors">MediCare<span class="text-teal-400">Alkes</span></span>
                    </div>
                    <p class="text-[11px] text-slate-400 font-medium">Logistik & Aset Medis</p>
                </div>
            </a>
            <button onclick="toggleSidebar()" class="lg:hidden text-slate-400 hover:text-white p-1">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>

        <!-- Sidebar Navigation Menu Items -->
        <div class="flex-1 overflow-y-auto px-4 py-6 space-y-6 custom-scrollbar">
            
            <!-- Menu Utama -->
            <div>
                <span class="text-[10px] font-extrabold uppercase tracking-wider text-slate-500 px-3 mb-2 block">Menu Utama</span>
                <nav class="space-y-1">
                    <a href="{{ route('alkes.index') }}" 
                       class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-300 hover:text-white hover:bg-slate-800/60 transition-all {{ request()->routeIs('alkes.index') && !request()->has('category') && !request()->has('condition') ? 'nav-item-active' : '' }}">
                        <i class="fa-solid fa-chart-pie text-sm text-teal-400 w-5"></i>
                        <span>Dashboard & Katalog</span>
                    </a>

                    <a href="{{ route('alkes.create') }}" 
                       class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-300 hover:text-white hover:bg-slate-800/60 transition-all {{ request()->routeIs('alkes.create') ? 'nav-item-active' : '' }}">
                        <i class="fa-solid fa-circle-plus text-sm text-cyan-400 w-5"></i>
                        <span>Tambah Alat Medis</span>
                    </a>
                </nav>
            </div>

            <!-- Filter Kategori Alat -->
            <div>
                <span class="text-[10px] font-extrabold uppercase tracking-wider text-slate-500 px-3 mb-2 block">Kategori Medis</span>
                <nav class="space-y-1">
                    <a href="{{ route('alkes.index', ['category' => 'Diagnostic']) }}" 
                       class="flex items-center justify-between px-3.5 py-2 rounded-xl text-xs text-slate-300 hover:text-white hover:bg-slate-800/60 transition-all {{ request('category') == 'Diagnostic' ? 'nav-item-active' : '' }}">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-stethoscope text-sm text-sky-400 w-5"></i>
                            <span>Diagnostic</span>
                        </div>
                    </a>

                    <a href="{{ route('alkes.index', ['category' => 'Life Support']) }}" 
                       class="flex items-center justify-between px-3.5 py-2 rounded-xl text-xs text-slate-300 hover:text-white hover:bg-slate-800/60 transition-all {{ request('category') == 'Life Support' ? 'nav-item-active' : '' }}">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-lungs-virus text-sm text-rose-400 w-5"></i>
                            <span>Life Support & ICU</span>
                        </div>
                    </a>

                    <a href="{{ route('alkes.index', ['category' => 'Monitoring']) }}" 
                       class="flex items-center justify-between px-3.5 py-2 rounded-xl text-xs text-slate-300 hover:text-white hover:bg-slate-800/60 transition-all {{ request('category') == 'Monitoring' ? 'nav-item-active' : '' }}">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-wave-square text-sm text-emerald-400 w-5"></i>
                            <span>Monitoring</span>
                        </div>
                    </a>

                    <a href="{{ route('alkes.index', ['category' => 'Surgical']) }}" 
                       class="flex items-center justify-between px-3.5 py-2 rounded-xl text-xs text-slate-300 hover:text-white hover:bg-slate-800/60 transition-all {{ request('category') == 'Surgical' ? 'nav-item-active' : '' }}">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-syringe text-sm text-amber-400 w-5"></i>
                            <span>Surgical (Bedah)</span>
                        </div>
                    </a>

                    <a href="{{ route('alkes.index', ['category' => 'Sterilization']) }}" 
                       class="flex items-center justify-between px-3.5 py-2 rounded-xl text-xs text-slate-300 hover:text-white hover:bg-slate-800/60 transition-all {{ request('category') == 'Sterilization' ? 'nav-item-active' : '' }}">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-pump-medical text-sm text-indigo-400 w-5"></i>
                            <span>Sterilisasi & CSSD</span>
                        </div>
                    </a>
                </nav>
            </div>

            <!-- Status & Pemeliharaan -->
            <div>
                <span class="text-[10px] font-extrabold uppercase tracking-wider text-slate-500 px-3 mb-2 block">Pemeliharaan & Kalibrasi</span>
                <nav class="space-y-1">
                    <a href="{{ route('alkes.index', ['condition' => 'Perlu Perbaikan']) }}" 
                       class="flex items-center justify-between px-3.5 py-2 rounded-xl text-xs text-slate-300 hover:text-white hover:bg-slate-800/60 transition-all {{ request('condition') == 'Perlu Perbaikan' ? 'nav-item-active' : '' }}">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-screwdriver-wrench text-sm text-amber-400 w-5"></i>
                            <span>Perlu Perbaikan</span>
                        </div>
                    </a>

                    <a href="{{ route('alkes.index', ['condition' => 'Kalibrasi']) }}" 
                       class="flex items-center justify-between px-3.5 py-2 rounded-xl text-xs text-slate-300 hover:text-white hover:bg-slate-800/60 transition-all {{ request('condition') == 'Kalibrasi' ? 'nav-item-active' : '' }}">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-sliders text-sm text-sky-400 w-5"></i>
                            <span>Jadwal Kalibrasi</span>
                        </div>
                    </a>

                    <a href="{{ route('alkes.index', ['condition' => 'Rusak']) }}" 
                       class="flex items-center justify-between px-3.5 py-2 rounded-xl text-xs text-slate-300 hover:text-white hover:bg-slate-800/60 transition-all {{ request('condition') == 'Rusak' ? 'nav-item-active' : '' }}">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-circle-exclamation text-sm text-rose-400 w-5"></i>
                            <span>Kondisi Rusak</span>
                        </div>
                    </a>
                </nav>
            </div>

        </div>

        <!-- Sidebar Bottom Footer Card -->
        <div class="p-4 border-t border-slate-800/80">
            <div class="p-3.5 rounded-2xl bg-gradient-to-br from-slate-950 to-slate-900 border border-slate-800 flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-teal-500/10 border border-teal-500/20 flex items-center justify-center text-teal-400 shrink-0">
                    <i class="fa-solid fa-user-doctor text-lg"></i>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-bold text-white truncate">Petugas Logistik</p>
                    <p class="text-[10px] text-slate-400 truncate">RS Medika Utama</p>
                </div>
            </div>
        </div>

    </aside>

    <!-- Right Main Content Area -->
    <div class="flex-1 flex flex-col min-w-0 lg:pl-72">
        
        <!-- Top Navbar Header -->
        <header class="sticky top-0 z-30 h-20 bg-slate-900/90 backdrop-blur-md border-b border-slate-800/80 px-4 sm:px-6 lg:px-8 flex items-center justify-between shadow-lg">
            
            <div class="flex items-center gap-4">
                <!-- Mobile Sidebar Toggle -->
                <button onclick="toggleSidebar()" class="lg:hidden p-2 rounded-xl bg-slate-800 text-slate-300 hover:text-white border border-slate-700">
                    <i class="fa-solid fa-bars text-lg"></i>
                </button>

                <div class="hidden sm:flex items-center gap-2 text-xs text-slate-400">
                    <i class="fa-solid fa-hospital-user text-teal-400"></i>
                    <span class="font-semibold text-slate-200">Sistem Informasi Manajemen Alat Kesehatan</span>
                </div>
            </div>

            <!-- Top Header Right Controls -->
            <div class="flex items-center gap-4">
                
                <div class="hidden md:flex items-center gap-2 text-xs text-slate-400 bg-slate-800/60 px-3 py-1.5 rounded-xl border border-slate-700/60">
                    <i class="fa-regular fa-clock text-cyan-400"></i>
                    <span>{{ date('d M Y') }}</span>
                </div>

                <a href="{{ route('alkes.create') }}" 
                   class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gradient-to-r from-teal-500 to-cyan-500 hover:from-teal-400 hover:to-cyan-400 text-slate-950 font-bold text-xs shadow-lg shadow-teal-500/20 transition-all active:scale-95">
                    <i class="fa-solid fa-plus"></i>
                    <span class="hidden sm:inline">Tambah Alat Medis</span>
                </a>

            </div>

        </header>

        <!-- Main Body Content -->
        <main class="flex-1 p-4 sm:p-6 lg:p-8 max-w-7xl w-full mx-auto">
            
            <!-- Flash Messages -->
            @if(session('success'))
                <div class="mb-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-300 flex items-start justify-between gap-3 shadow-lg shadow-emerald-500/5 animate-fade-in" id="alert-success">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-emerald-500/20 flex items-center justify-center text-emerald-400 shrink-0">
                            <i class="fa-solid fa-circle-check text-lg"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-sm text-emerald-200">Berhasil!</h4>
                            <p class="text-xs text-emerald-300/90">{{ session('success') }}</p>
                        </div>
                    </div>
                    <button onclick="document.getElementById('alert-success').remove()" class="text-emerald-400/60 hover:text-emerald-300 p-1">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 rounded-xl bg-rose-500/10 border border-rose-500/30 text-rose-300 flex items-start justify-between gap-3 shadow-lg shadow-rose-500/5 animate-fade-in" id="alert-error">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-rose-500/20 flex items-center justify-center text-rose-400 shrink-0">
                            <i class="fa-solid fa-triangle-exclamation text-lg"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-sm text-rose-200">Terjadi Kesalahan</h4>
                            <p class="text-xs text-rose-300/90">{{ session('error') }}</p>
                        </div>
                    </div>
                    <button onclick="document.getElementById('alert-error').remove()" class="text-rose-400/60 hover:text-rose-300 p-1">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 p-4 rounded-xl bg-rose-500/10 border border-rose-500/30 text-rose-300 shadow-lg" id="alert-validation">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-8 h-8 rounded-lg bg-rose-500/20 flex items-center justify-center text-rose-400 shrink-0">
                            <i class="fa-solid fa-circle-exclamation text-lg"></i>
                        </div>
                        <h4 class="font-bold text-sm text-rose-200">Harap periksa form inputan Anda:</h4>
                    </div>
                    <ul class="list-disc list-inside text-xs space-y-1 pl-11 text-rose-300/90">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="mt-auto bg-slate-950 border-t border-slate-800/80 py-6 text-center text-xs text-slate-500 px-4 sm:px-6">
            <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-shield-halved text-teal-500"></i>
                    <span>MediCare Alkes System &copy; {{ date('Y') }} - Hak Cipta Dilindungi</span>
                </div>
                <div class="flex items-center gap-6">
                    <span class="hover:text-slate-400 transition-colors cursor-pointer"><i class="fa-solid fa-notes-medical mr-1"></i> Standar Kemenkes RI</span>
                    <span class="hover:text-slate-400 transition-colors cursor-pointer"><i class="fa-solid fa-circle-info mr-1"></i> Bantuan Logistik</span>
                </div>
            </div>
        </footer>

    </div>

    <!-- Script Sidebar Toggle -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar-nav');
            const backdrop = document.getElementById('sidebar-backdrop');
            
            sidebar.classList.toggle('-translate-x-full');
            backdrop.classList.toggle('hidden');
        }
    </script>

    @stack('scripts')
</body>
</html>
