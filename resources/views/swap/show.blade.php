<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - LoopLife</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">

    @include('components.navbar')

    <main class="container mx-auto px-4 md:px-6 py-4 md:py-8">

        <nav class="text-[10px] md:text-xs text-gray-500 mb-4 md:mb-6 flex flex-wrap items-center gap-1">
            <a href="{{ route('home') }}" class="hover:text-[#65d752] transition">Home</a>
            <span>/</span>
            <a href="{{ route('swap.index') }}" class="hover:text-[#65d752] transition">Swap Zone</a>
            <span>/</span>
            <span class="text-gray-800 font-semibold truncate max-w-[150px] md:max-w-none">{{ $product->name }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-10">

            <div class="lg:col-span-4 space-y-3 md:space-y-4">
                <div class="border border-gray-200 rounded-xl overflow-hidden p-1 bg-white shadow-sm">
                    <img src="{{ asset('storage/' . $product->image_path) }}" class="w-full h-auto aspect-square object-cover rounded-lg">
                </div>
                
                <div class="grid grid-cols-3 gap-2">
                    <div class="border border-[#65d752] rounded-lg p-1 cursor-pointer bg-white">
                        <img src="{{ asset('storage/' . $product->image_path) }}" class="w-full h-14 md:h-16 object-cover rounded">
                    </div>
                    <div class="border border-gray-200 rounded-lg p-1 cursor-pointer opacity-60 hover:opacity-100 bg-white transition">
                        <img src="{{ asset('storage/' . $product->image_path) }}" class="w-full h-14 md:h-16 object-cover rounded">
                    </div>
                    <div class="border border-gray-200 rounded-lg p-1 cursor-pointer opacity-60 hover:opacity-100 bg-white transition">
                        <img src="{{ asset('storage/' . $product->image_path) }}" class="w-full h-14 md:h-16 object-cover rounded">
                    </div>
                </div>
            </div>

            <div class="lg:col-span-5 flex flex-col h-full">
                
                <div class="bg-white p-4 md:p-0 rounded-xl md:rounded-none shadow-sm md:shadow-none mb-4 md:mb-0">
                    <h1 class="text-xl md:text-2xl font-bold text-gray-900 uppercase mb-2 leading-tight">{{ $product->name }}</h1>

                    <div class="flex items-center gap-3 mb-4 md:mb-6 border-b border-gray-100 md:border-none pb-3 md:pb-0">
                        <span class="text-2xl md:text-3xl font-bold text-[#65d752]">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        <span class="bg-red-100 text-red-600 text-[10px] md:text-xs font-bold px-2 py-1 rounded-full uppercase tracking-wider">Hot Item</span>
                    </div>

                    <div class="flex items-center justify-between border border-gray-100 bg-gray-50 rounded-lg p-3 md:p-4 mb-6">
                        <div class="flex items-center gap-3">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($product->user->name ?? 'User') }}" class="w-10 h-10 md:w-12 md:h-12 rounded-full border border-gray-200 bg-white">
                            <div>
                                <p class="font-bold text-sm md:text-base text-gray-900">{{ $product->user->name ?? 'Penjual' }}</p>
                                <div class="flex items-center text-yellow-400 text-xs gap-1">
                                    <span>★★★★☆</span> 
                                    <span class="text-gray-400 font-medium">(3.2)</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex gap-2">
                             <button class="bg-white border border-gray-200 text-gray-600 text-xs px-3 py-2 rounded-lg font-bold hover:bg-gray-50 transition shadow-sm">Chat</button>
                        </div>
                    </div>
                </div>

                <div x-data="{ tab: 'detail' }" class="mb-8 bg-white md:bg-transparent p-4 md:p-0 rounded-xl shadow-sm md:shadow-none">
                    <div class="flex border border-gray-200 bg-gray-50 rounded-lg overflow-hidden mb-4 text-xs md:text-sm font-medium text-center">
                        <button @click="tab = 'detail'" :class="tab === 'detail' ? 'bg-white text-gray-900 font-bold shadow-sm' : 'text-gray-500 hover:text-gray-700'" class="flex-1 py-2.5 transition">Detail</button>
                        <button @click="tab = 'spek'" :class="tab === 'spek' ? 'bg-white text-gray-900 font-bold shadow-sm' : 'text-gray-500 hover:text-gray-700'" class="flex-1 py-2.5 transition">Spesifikasi</button>
                    </div>

                    <div class="min-h-[150px]">
                        <div x-show="tab === 'detail'" class="text-sm text-gray-600 space-y-3 animate-fade-in">
                            <div class="flex gap-2">
                                <span class="font-bold text-gray-800">Kondisi:</span>
                                <span class="bg-blue-100 text-blue-700 text-[10px] px-2 py-0.5 rounded font-bold uppercase">{{ ucfirst($product->condition) }}</span>
                            </div>
                            <div>
                                <strong class="block text-gray-800 mb-1">Deskripsi:</strong>
                                <p class="leading-relaxed whitespace-pre-line">{{ $product->description }}</p>
                            </div>
                        </div>
                        <div x-show="tab === 'spek'" class="text-sm text-gray-600 space-y-2 animate-fade-in" style="display: none;">
                            <div class="grid grid-cols-2 gap-y-2">
                                <span class="text-gray-500">Kategori:</span>
                                <span class="font-medium text-gray-900">{{ $product->category->name ?? '-' }}</span>
                                
                                <span class="text-gray-500">Tipe Transaksi:</span>
                                <span class="font-medium text-gray-900">{{ ucfirst($product->type) }}</span>
                                
                                <span class="text-gray-500">Stok:</span>
                                <span class="font-medium text-gray-900">1 Tersedia</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-3">
                <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm lg:sticky lg:top-24">
                    
                    <h3 class="font-bold text-gray-800 mb-4 text-center lg:text-left">Atur Transaksi</h3>

                    <div class="space-y-3 mb-6">
                        <a href="{{ route('swap.checkout', $product->id) }}" class="block w-full text-center bg-white border-2 border-[#65d752] text-[#65d752] hover:bg-green-50 font-bold py-2.5 rounded-lg transition">
                            Beli Langsung
                        </a>

                        <a href="{{ route('swap.trade', $product->id) }}" class="flex items-center justify-center gap-2 w-full text-center bg-[#65d752] hover:bg-green-600 text-white font-bold py-3 rounded-lg shadow-md transition transform active:scale-95">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                            Ajukan Tukar (Barter)
                        </a>

                        <button class="w-full text-gray-500 text-sm font-medium hover:text-[#65d752] py-2">
                            + Masukkan Keranjang
                        </button>
                    </div>

                    <div class="flex justify-between border-t border-gray-100 pt-4 px-2">
                        <button class="flex flex-col items-center gap-1 text-gray-400 hover:text-[#65d752] transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                            <span class="text-[10px]">Chat</span>
                        </button>
                        <button class="flex flex-col items-center gap-1 text-gray-400 hover:text-red-500 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                            <span class="text-[10px]">Wishlist</span>
                        </button>
                        <button class="flex flex-col items-center gap-1 text-gray-400 hover:text-blue-500 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
                            <span class="text-[10px]">Share</span>
                        </button>
                    </div>
                </div>
            </div>

        </div>

        <div class="mt-12 md:mt-16">
            <div class="flex items-center justify-between mb-4 md:mb-6">
                <h3 class="text-lg md:text-xl font-bold text-gray-900">Lainnya dari Penjual</h3>
                <a href="#" class="text-sm font-bold text-[#65d752] hover:underline">Lihat Semua</a>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
                @forelse($moreFromSeller as $item)
                <a href="{{ route('swap.show', $item->id) }}" class="block group bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition overflow-hidden">
                    <div class="h-36 md:h-48 bg-gray-100 overflow-hidden relative">
                        <img src="{{ asset('storage/' . $item->image_path) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    </div>
                    <div class="p-3">
                        <h4 class="font-bold text-gray-800 text-xs md:text-sm mb-1 truncate">{{ $item->name }}</h4>
                        <p class="text-[10px] text-gray-500 mb-2">{{ $item->category->name ?? 'Umum' }}</p>
                        <p class="font-bold text-[#65d752] text-sm md:text-base">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                    </div>
                </a>
                @empty
                <div class="col-span-full text-center py-10 bg-white rounded-xl border border-dashed border-gray-300">
                    <p class="text-gray-400 text-sm">Tidak ada barang lain dari penjual ini.</p>
                </div>
                @endforelse
            </div>
        </div>

    </main>

    @include('components.footer')

</body>
</html>