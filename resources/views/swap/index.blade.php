<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Swap Zone - LoopLife</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        /* Styling Details Summary Desktop */
        details>summary {
            list-style: none;
        }

        details>summary::-webkit-details-marker {
            display: none;
        }

        /* Hides Scrollbar for Mobile Categories but allows scrolling */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }
    </style>
</head>

<body class="bg-white text-gray-800">

    @include('components.navbar')

    <main class="container mx-auto px-4 md:px-6 py-6">

        <div class="hidden md:flex text-xs text-gray-500 mb-6 gap-2">
            <span class="font-bold text-gray-700">Pencarian Populer :</span>
            <span>Pakaian > Elektronik > Kendaraan > Properti</span>
        </div>

        <div class="flex flex-col md:flex-row gap-8">

            <aside class="hidden md:block w-64 shrink-0">
                <div class="border border-gray-200 rounded-lg overflow-hidden sticky top-24">
                    <div class="bg-white p-4 border-b border-gray-200">
                        <h3 class="font-bold text-lg text-gray-800">Kategori</h3>
                    </div>

                    <details class="group border-b border-gray-100" open>
                        <summary class="flex justify-between items-center font-medium cursor-pointer list-none p-4 hover:bg-gray-50 transition">
                            <span>Elektronik</span>
                            <span class="transition group-open:rotate-180">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </span>
                        </summary>
                        <div class="text-gray-600 text-sm px-4 pb-4 pl-6 space-y-2">
                            <a href="#" class="block hover:text-[#65d752] transition">Handphone</a>
                            <a href="#" class="block hover:text-[#65d752] transition">Laptop</a>
                            <a href="#" class="block hover:text-[#65d752] transition">Monitor</a>
                        </div>
                    </details>

                    <details class="group border-b border-gray-100">
                        <summary class="flex justify-between items-center font-medium cursor-pointer list-none p-4 hover:bg-gray-50 transition">
                            <span>Pakaian</span>
                            <span class="transition group-open:rotate-180">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </span>
                        </summary>
                        <div class="text-gray-600 text-sm px-4 pb-4 pl-6 space-y-2">
                            <a href="#" class="block hover:text-[#65d752] transition">Pria</a>
                            <a href="#" class="block hover:text-[#65d752] transition">Wanita</a>
                        </div>
                    </details>

                    <details class="group border-b border-gray-100">
                        <summary class="flex justify-between items-center font-medium cursor-pointer list-none p-4 hover:bg-gray-50 transition">
                            <span>Kendaraan</span>
                            <span class="transition group-open:rotate-180">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </span>
                        </summary>
                        <div class="text-gray-600 text-sm px-4 pb-4 pl-6 space-y-2">
                            <a href="#" class="block hover:text-[#65d752] transition">Motor</a>
                            <a href="#" class="block hover:text-[#65d752] transition">Mobil</a>
                        </div>
                    </details>

                    <div class="p-4 text-center">
                        <a href="#" class="text-sm font-bold text-[#65d752] hover:underline">Reset Filter</a>
                    </div>
                </div>
            </aside>

            <div class="flex-1 w-full">

                <div class="md:hidden mb-6">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="font-bold text-gray-800">Kategori Populer</h3>
                        <a href="#" class="text-xs text-[#65d752] font-semibold">Lihat Semua</a>
                    </div>

                    <div class="flex gap-3 overflow-x-auto pb-2 no-scrollbar scroll-smooth">
                        <a href="#" class="flex-shrink-0 bg-[#65d752] text-white px-5 py-2 rounded-full text-sm font-bold shadow-md shadow-green-200 whitespace-nowrap">
                            Semua
                        </a>
                        <a href="#" class="flex-shrink-0 bg-white border border-gray-200 text-gray-600 px-5 py-2 rounded-full text-sm font-medium whitespace-nowrap hover:border-[#65d752] hover:text-[#65d752] transition">
                            Elektronik
                        </a>
                        <a href="#" class="flex-shrink-0 bg-white border border-gray-200 text-gray-600 px-5 py-2 rounded-full text-sm font-medium whitespace-nowrap hover:border-[#65d752] hover:text-[#65d752] transition">
                            Pakaian
                        </a>
                        <a href="#" class="flex-shrink-0 bg-white border border-gray-200 text-gray-600 px-5 py-2 rounded-full text-sm font-medium whitespace-nowrap hover:border-[#65d752] hover:text-[#65d752] transition">
                            Kendaraan
                        </a>
                        <a href="#" class="flex-shrink-0 bg-white border border-gray-200 text-gray-600 px-5 py-2 rounded-full text-sm font-medium whitespace-nowrap hover:border-[#65d752] hover:text-[#65d752] transition">
                            Hobi
                        </a>
                        <a href="#" class="flex-shrink-0 bg-white border border-gray-200 text-gray-600 px-5 py-2 rounded-full text-sm font-medium whitespace-nowrap hover:border-[#65d752] hover:text-[#65d752] transition">
                            Properti
                        </a>
                    </div>
                </div>


                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-gray-800">Teratas</h2>
                    <button class="md:hidden text-gray-500 flex items-center gap-1 text-sm border border-gray-200 px-3 py-1 rounded-lg">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                        </svg>
                        Filter
                    </button>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
                    @forelse($products as $product)
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition overflow-hidden border border-gray-100 group flex flex-col h-full">

                        <a href="{{ route('swap.show', $product->id) }}" class="block flex-1 flex flex-col">

                            <div class="h-40 md:h-48 overflow-hidden bg-gray-100 relative">
                                <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">

                                <div class="absolute top-2 left-2 bg-green-500 text-white text-[10px] px-2 py-1 rounded-full uppercase font-bold shadow-sm">
                                    {{ $product->condition }}
                                </div>
                            </div>

                            <div class="p-3 md:p-4 flex flex-col flex-1">
                                <h3 class="font-bold text-gray-800 text-sm mb-1 truncate uppercase group-hover:text-[#65d752] transition">{{ $product->name }}</h3>
                                <p class="text-xs text-gray-500 mb-2">{{ $product->category->name ?? 'Kategori Umum' }}</p>

                                <div class="mt-auto flex justify-between items-center">
                                    <span class="font-bold text-[#65d752] text-sm">Rp. {{ number_format($product->price, 0, ',', '.') }}</span>
                                    <span class="text-[10px] text-gray-400">Bandung</span>
                                </div>
                            </div>

                        </a>
                    </div>
                    @empty
                    <div class="col-span-full text-center py-20 bg-gray-50 rounded-lg border border-dashed border-gray-300">
                        <p class="text-gray-500">Belum ada barang di Swap Zone.</p>
                    </div>
                    @endforelse
                </div>

            </div>
        </div>
    </main>

    @include('components.footer')

</body>

</html>