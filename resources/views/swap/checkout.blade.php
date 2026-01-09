<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - LoopLife</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Poppins', sans-serif; } </style>
</head>
<body class="bg-gray-50 text-gray-800">

    @include('components.navbar')

    <div class="container mx-auto px-4 md:px-6 py-6 md:py-8">
        
        <nav class="text-[10px] md:text-xs text-gray-500 mb-6 flex flex-wrap items-center gap-1">
            <a href="{{ route('home') }}" class="hover:text-[#65d752] transition">Home</a>
            <span>/</span>
            <a href="{{ route('swap.index') }}" class="hover:text-[#65d752] transition">Swap Zone</a>
            <span>/</span>
            <a href="{{ route('swap.show', $product->id) }}" class="hover:text-[#65d752] transition truncate max-w-[100px] md:max-w-none">{{ $product->name }}</a>
            <span>/</span>
            <span class="text-gray-800 font-semibold">Checkout</span>
        </nav>

        <h1 class="text-xl md:text-2xl font-bold mb-6 text-gray-900">Checkout Barang</h1>

        <form action="{{ route('swap.process', $product->id) }}" method="POST">
            @csrf 
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
                
                <div class="lg:col-span-2 space-y-6">
                    
                    <div class="bg-white border border-gray-200 rounded-xl p-5 md:p-6 shadow-sm flex justify-between items-start gap-4">
                        <div>
                            <h3 class="font-bold text-gray-900 mb-2 text-sm md:text-base uppercase tracking-wide">Alamat Pengiriman</h3>
                            <div class="text-gray-600 text-xs md:text-sm leading-relaxed">
                                <p class="font-semibold text-gray-800 mb-1">{{ Auth::user()->name }}</p>
                                <p>Jln. Anggrek, Kec. Sumedang, Kab. Sumedang</p>
                                <p class="text-gray-400 mt-1">0812-xxxx-xxxx</p>
                            </div>
                        </div>
                        <button type="button" class="text-gray-400 hover:text-[#65d752] transition p-2 hover:bg-gray-50 rounded-full shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                        </button>
                    </div>

                    <div class="bg-white border border-gray-200 rounded-xl p-5 md:p-6 shadow-sm flex flex-col md:flex-row gap-6">
                        <div class="w-full md:w-32 h-48 md:h-32 bg-gray-100 rounded-lg overflow-hidden shrink-0">
                            <img src="{{ asset('storage/' . $product->image_path) }}" class="w-full h-full object-cover">
                        </div>
                        
                        <div class="flex-1">
                            <div class="flex flex-col md:flex-row justify-between items-start mb-3 gap-2">
                                <h3 class="font-bold text-lg text-gray-900 uppercase leading-tight">{{ $product->name }}</h3>
                                <span class="text-sm font-bold text-[#65d752] bg-green-50 px-2 py-1 rounded">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            </div>
                            
                            <div class="border border-gray-100 rounded-lg p-3 bg-gray-50 text-xs text-gray-600 space-y-1.5">
                                <p class="font-bold text-gray-800 mb-1 border-b border-gray-200 pb-1">Spesifikasi Singkat</p>
                                <div class="grid grid-cols-2 gap-2">
                                    <p><span class="text-gray-400">Kondisi:</span> {{ ucfirst($product->condition) }}</p>
                                    <p><span class="text-gray-400">Kategori:</span> {{ $product->category->name ?? '-' }}</p>
                                </div>
                                <p class="pt-1 text-gray-500 line-clamp-2">"{{ Str::limit($product->description, 80) }}"</p>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="lg:col-span-1">
                    <div class="bg-white border border-gray-200 rounded-xl p-5 md:p-6 shadow-sm lg:sticky lg:top-24">
                        
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-bold text-gray-900">Metode Pembayaran</h3>
                            <a href="#" class="text-xs text-[#65d752] font-bold hover:underline">Ubah</a>
                        </div>

                        <div class="space-y-3 mb-6">
                            <label class="flex items-center justify-between p-3 border border-gray-200 rounded-lg cursor-pointer hover:border-[#65d752] hover:bg-green-50 transition group">
                                <div class="flex items-center gap-3">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/7/72/Logo_dana_blue.svg" class="h-5 w-auto">
                                    <span class="text-sm font-medium group-hover:text-[#65d752]">Dana</span>
                                </div>
                                <input type="radio" name="payment" value="Dana" class="text-[#65d752] focus:ring-[#65d752]">
                            </label>

                            <label class="flex items-center justify-between p-3 border border-gray-200 rounded-lg cursor-pointer hover:border-[#65d752] hover:bg-green-50 transition group">
                                <div class="flex items-center gap-3">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/8/86/Gopay_logo.svg" class="h-5 w-auto">
                                    <span class="text-sm font-medium group-hover:text-[#65d752]">GoPay</span>
                                </div>
                                <input type="radio" name="payment" value="GoPay" class="text-[#65d752] focus:ring-[#65d752]">
                            </label>

                            <label class="flex items-center justify-between p-3 border border-[#65d752] bg-green-50 rounded-lg cursor-pointer">
                                <div class="flex items-center gap-3">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d7/QRIS_logo.svg/1200px-QRIS_logo.svg.png" class="h-5 w-auto">
                                    <span class="text-sm font-bold text-[#65d752]">QRIS</span>
                                </div>
                                <input type="radio" name="payment" value="QRIS" checked class="text-[#65d752] focus:ring-[#65d752]">
                            </label>
                        </div>

                        <div class="border-t border-dashed border-gray-200 pt-4 mb-6">
                            <h3 class="font-bold text-gray-900 mb-3 text-sm">Ringkasan Biaya</h3>
                            <div class="space-y-2 text-sm text-gray-600">
                                <div class="flex justify-between">
                                    <span>Harga Barang</span>
                                    <span>Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Ongkos Kirim</span>
                                    <span>Rp {{ number_format($ongkir, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Asuransi</span>
                                    <span>Rp {{ number_format($asuransi, 0, ',', '.') }}</span>
                                </div>
                            </div>
                            
                            <div class="flex justify-between text-base font-bold text-gray-900 border-t border-gray-200 mt-4 pt-3">
                                <span>Total Tagihan</span>
                                <span class="text-[#65d752]">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <div class="flex gap-3 items-center">
                            <button type="button" class="flex flex-col items-center justify-center w-12 h-12 rounded-lg border border-gray-200 text-gray-400 hover:text-[#65d752] hover:border-[#65d752] transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                            </button>
                            <button type="submit" class="flex-1 bg-[#65d752] hover:bg-green-600 text-white font-bold py-3 rounded-lg shadow-md transition transform active:scale-95 flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                Bayar Sekarang
                            </button>
                        </div>

                    </div>
                </div>

            </div>
        </form>
    </div>
    
    @include('components.footer')

</body>
</html>