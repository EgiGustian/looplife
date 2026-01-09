<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoopLife - Home</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">

    <header x-data="{ mobileMenuOpen: false, searchOpen: false }" class="bg-white shadow-sm sticky top-0 z-50 border-b border-gray-100 font-sans">
        
        <div class="container mx-auto px-4 md:px-6 py-4">
            <div class="flex items-center justify-between gap-4">
                
                <a href="{{ route('home') }}" class="flex items-center gap-2 flex-shrink-0">
                    <img src="{{ asset('img/Logo_Looplife.png') }}" alt="LoopLife Logo" class="w-8 h-8">
                    <span class="text-xl md:text-2xl font-bold text-[#65d752] hidden sm:block">LoopLife</span>
                </a>

                <div class="hidden md:block flex-1 mx-4 lg:mx-10">
                    <div class="relative">
                        <input type="text" placeholder="Cari barang, jasa repair, atau donasi..." class="w-full border border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-[#65d752] transition">
                        <svg class="w-5 h-5 absolute right-3 top-2.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>

                <div class="flex items-center gap-3 md:gap-6 flex-shrink-0">
                    
                    <button @click="searchOpen = !searchOpen" class="md:hidden text-gray-600 hover:text-[#65d752]">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>

                    <button class="text-gray-600 hover:text-[#65d752]">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </button>

                    <button class="hidden sm:block text-gray-600 hover:text-[#65d752]">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    </button>

                    <div class="flex items-center gap-2">
                        @guest
                            <div class="flex gap-2 text-xs md:text-sm">
                                <a href="{{ route('register') }}" class="px-3 py-1.5 border border-gray-300 rounded text-gray-700 hover:bg-gray-50 font-medium transition">Daftar</a>
                                <a href="{{ route('login') }}" class="px-3 py-1.5 border border-[#65d752] bg-[#65d752] text-white rounded hover:bg-green-600 font-medium transition">Login</a>
                            </div>
                        @endguest

                        @auth
                            <div x-data="{ open: false }" class="relative">
                                <button @click="open = !open" class="flex items-center gap-2 focus:outline-none">
                                    <span class="text-sm font-semibold text-gray-700 mr-1 hidden lg:block">Halo, {{ Auth::user()->name }}</span>
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=65d752&color=fff" class="w-8 h-8 md:w-9 md:h-9 rounded-full border border-gray-200 object-cover">
                                </button>
                                
                                <div x-show="open" @click.outside="open = false" x-transition class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50 border border-gray-100" style="display: none;">
                                    <div class="px-4 py-2 border-b border-gray-100 mb-1 lg:hidden">
                                        <p class="text-xs text-gray-500">Login sebagai</p>
                                        <p class="text-sm font-bold text-gray-800 truncate">{{ Auth::user()->name }}</p>
                                    </div>
                                    <a href="{{ route('profile.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50">Profil Saya</a>
                                    <a href="{{ route('products.create') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50">Upload Barang</a>
                                    <div class="border-t border-gray-100 my-1"></div>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">Keluar</button>
                                    </form>
                                </div>
                            </div>
                        @endauth
                    </div>

                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-gray-600 focus:outline-none ml-1">
                        <svg x-show="!mobileMenuOpen" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                        <svg x-show="mobileMenuOpen" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            </div>

            <div x-show="searchOpen" class="md:hidden mt-4 pb-2" style="display: none;">
                <div class="relative">
                    <input type="text" placeholder="Cari di LoopLife..." class="w-full border border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-[#65d752]">
                    <button class="absolute right-3 top-2.5 text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>
                </div>
            </div>
        </div>

        <div x-show="mobileMenuOpen" class="md:hidden border-t border-gray-100 bg-white" style="display: none;">
            <div class="px-6 py-4 flex flex-col gap-4 text-gray-600 font-medium">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-[#65d752] font-bold' : '' }}">Dashboard</a>
                <a href="{{ route('swap.index') }}" class="{{ request()->routeIs('swap.*') ? 'text-[#65d752] font-bold' : '' }}">Swap Zone</a>
                <a href="#">Repair</a>
                <a href="#">Donation</a>
                <a href="#">EcoPoint</a>
            </div>
        </div>
    </header>

    <div class="bg-gray-50 border-b border-gray-200">
        <div class="container mx-auto px-6 py-4">
            <div class="grid grid-cols-3 sm:grid-cols-5 md:flex md:justify-center md:gap-12 gap-y-6 gap-x-4">
                @php
                $navs = [
                    ['name' => 'Swap Zone', 'icon' => 'M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4', 'color' => 'text-[#65d752]', 'slug' => 'swap', 'route' => 'swap.index'],
                    ['name' => 'Repair', 'icon' => 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z', 'color' => 'text-orange-500', 'slug' => 'repair'],
                    ['name' => 'Donasi', 'icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z', 'color' => 'text-red-500', 'slug' => 'donasi'],
                    ['name' => 'EcoPoint', 'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'color' => 'text-yellow-500', 'slug' => 'ecopoint'],
                    ['name' => 'Komunitas', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z', 'color' => 'text-blue-500', 'slug' => 'komunitas'],
                ];
                @endphp

                @foreach($navs as $nav)
                    @php
                        $defaultSlug = isset($nav['slug']) ? $nav['slug'] : \Illuminate\Support\Str::slug($nav['name']);
                        $href = (isset($nav['route']) && \Illuminate\Support\Facades\Route::has($nav['route'])) 
                                ? route($nav['route']) 
                                : url('/' . $defaultSlug);
                    @endphp
                    <a href="{{ $href }}" class="flex flex-col items-center cursor-pointer group hover:scale-105 transition">
                        <div class="w-12 h-12 bg-white rounded-full shadow flex items-center justify-center mb-1 group-hover:bg-gray-100 border border-gray-100">
                            <svg class="w-6 h-6 {{ $nav['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $nav['icon'] }}"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-gray-700 text-center">{{ $nav['name'] }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <section class="container mx-auto px-6 py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-gradient-to-r from-green-400 to-[#65d752] rounded-2xl p-8 flex items-center justify-between shadow-lg text-white">
                <div>
                    <h2 class="text-2xl font-bold mb-2">LOOPLIFE</h2>
                    <p class="text-sm opacity-90 mb-4">Sirkulasi Barang Bekas<br>Aman & Terpercaya.</p>
                    <button class="bg-white text-[#65d752] px-4 py-2 rounded-full text-xs font-bold uppercase hover:bg-gray-100 shadow transition">Jelajahi Sekarang</button>
                </div>
                <div class="w-24 h-24 bg-white/20 rounded-full flex items-center justify-center">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                </div>
            </div>

            <div class="bg-gradient-to-r from-green-500 to-[#65d752] rounded-2xl p-8 flex items-center justify-between shadow-lg text-white">
                <div>
                    <h2 class="text-2xl font-bold mb-2">SWAP NOW</h2>
                    <p class="text-sm opacity-90 mb-4">Pusat Barang Bekas Berkualitas<br>Temukan barang unikmu disini.</p>
                    <button class="bg-white text-[#65d752] px-4 py-2 rounded-full text-xs font-bold uppercase hover:bg-gray-100 shadow transition">Mulai Sekarang</button>
                </div>
                <div class="w-24 h-24 bg-white/20 rounded-full flex items-center justify-center">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </section>

    <section class="container mx-auto px-6 py-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-bold text-gray-800">Barang Populer</h3>
            <a href="#" class="text-green-600 text-sm hover:underline">Lihat Semua ></a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($popularItems as $item)
            <div class="relative group cursor-pointer overflow-hidden rounded-xl shadow-lg h-48">
                <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-4">
                    <p class="text-white font-semibold">{{ $item->name }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <section class="container mx-auto px-6 py-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-bold text-gray-800">Hot Items Swap Zone</h3>
            <a href="{{ route('swap.index') }}" class="text-green-600 text-sm hover:underline">Lihat Semua ></a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
            @foreach($swapItems as $item)
            <div class="bg-white border border-gray-100 rounded-lg shadow-sm hover:shadow-md transition p-3">
                <div class="h-32 bg-gray-100 rounded-md mb-3 overflow-hidden">
                    <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->name }}" class="w-full h-full object-cover hover:scale-105 transition duration-500">
                </div>
                <h4 class="text-sm font-semibold text-gray-800 mb-1 truncate">{{ $item->name }}</h4>
                <p class="text-xs text-green-600 font-bold">
                    Rp {{ number_format($item->price, 0, ',', '.') }}
                </p>
                <div class="mt-2 flex justify-between items-center text-xs text-gray-400">
                    <span>{{ ucfirst($item->condition) }}</span>
                    <span>Bandung</span>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <section class="container mx-auto px-6 py-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-bold text-gray-800">Rekomendasi Repair</h3>
            <a href="#" class="text-[#65d752] text-sm hover:underline">Lihat Semua ></a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($repairServices as $service)
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition border border-gray-100">
                <img src="{{ $service['image'] }}" alt="{{ $service['name'] }}" class="w-full h-40 object-cover">
                <div class="p-4 text-center">
                    <div class="w-10 h-10 bg-gray-200 rounded-full mx-auto -mt-10 border-4 border-white overflow-hidden shadow-sm">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($service['name']) }}" class="w-full h-full">
                    </div>
                    <h4 class="font-bold text-gray-800 mt-2">{{ $service['name'] }}</h4>
                    <p class="text-xs text-gray-500 mb-2">{{ $service['location'] }}</p>
                    <div class="flex justify-center text-yellow-400 text-sm">
                        ★★★★★
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <section class="bg-green-50 py-10 mt-8">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Ayo Gabung LoopLife</h2>
            <p class="text-gray-600 mb-8 max-w-2xl mx-auto">Bergabunglah dengan ribuan pengguna LoopLife! Tukar, perbaiki, dan donasikan barangmu dengan aman dalam komunitas yang saling peduli.</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @for($i=0; $i<3; $i++) 
                <div class="bg-white p-6 rounded-lg shadow-sm text-left flex items-start gap-4 hover:shadow-md transition">
                    <div class="w-12 h-12 bg-gray-200 rounded-full shrink-0 overflow-hidden">
                         <img src="https://ui-avatars.com/api/?name=User+{{ $i }}&background=random" class="w-full h-full">
                    </div>
                    <div>
                        <h5 class="font-bold text-sm">Pengguna LoopLife</h5>
                        <div class="text-yellow-400 text-xs mb-1">★★★★★</div>
                        <p class="text-xs text-gray-500 line-clamp-2">"Aplikasi ini sangat membantu saya mengurangi limbah rumah tangga dengan cara yang menyenangkan!"</p>
                    </div>
                </div>
                @endfor
            </div>
        </div>
    </section>

    <footer class="bg-[#65d752] text-white pt-10 pb-6 mt-12">
        <div class="container mx-auto px-6 grid grid-cols-2 md:grid-cols-4 gap-8 mb-8">
            <div>
                <h4 class="font-bold mb-4">Popular Categories</h4>
                <ul class="text-sm space-y-2 text-green-100">
                    <li><a href="#" class="hover:text-white transition">Baju</a></li>
                    <li><a href="#" class="hover:text-white transition">Celana</a></li>
                    <li><a href="#" class="hover:text-white transition">Barang</a></li>
                    <li><a href="#" class="hover:text-white transition">Properti</a></li>
                    <li><a href="#" class="hover:text-white transition">Otomotif</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-4">Discover</h4>
                <ul class="text-sm space-y-2 text-green-100">
                    <li><a href="#" class="hover:text-white transition">Mulai Jualan</a></li>
                    <li><a href="#" class="hover:text-white transition">Cara Kerja</a></li>
                    <li><a href="#" class="hover:text-white transition">Thrifting</a></li>
                    <li><a href="#" class="hover:text-white transition">Komunitas</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-4">Help</h4>
                <ul class="text-sm space-y-2 text-green-100">
                    <li><a href="#" class="hover:text-white transition">FAQ</a></li>
                    <li><a href="#" class="hover:text-white transition">Contact</a></li>
                    <li><a href="#" class="hover:text-white transition">Collaboration</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-4">Download & Instal</h4>
                <div class="space-y-3">
                    <div class="bg-black text-white px-4 py-2 rounded flex items-center gap-2 w-36 cursor-pointer hover:bg-gray-800 transition">
                        <span class="text-xs font-bold">Google Play</span>
                    </div>
                    <div class="bg-black text-white px-4 py-2 rounded flex items-center gap-2 w-36 cursor-pointer hover:bg-gray-800 transition">
                        <span class="text-xs font-bold">App Store</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mx-auto px-6 border-t border-green-400 pt-6 text-center text-xs text-green-100">
            &copy; 2025 LoopLife Indonesia. All rights reserved.
        </div>
    </footer>

</body>
</html>