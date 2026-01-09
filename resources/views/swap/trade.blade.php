<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Konfirmasi Penukaran - LoopLife</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>

<body class="bg-gray-50 text-gray-800">

  @include('components.navbar')

  <div class="container mx-auto px-4 md:px-6 py-6 md:py-8" x-data="{ selectedId: null, selectedName: '' }">

    <div class="mb-6">
      <a href="{{ route('swap.show', $targetProduct->id) }}" class="text-xs text-gray-500 hover:text-green-600 flex items-center gap-1 mb-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
        Kembali ke Detail
      </a>
      <h1 class="text-xl md:text-2xl font-bold text-gray-900">Konfirmasi Tukar Barang</h1>
    </div>

    <form action="{{ route('swap.store', $targetProduct->id) }}" method="POST">
      @csrf

      <input type="hidden" name="offered_product_id" :value="selectedId">

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8">

        <div class="bg-white border border-gray-200 rounded-xl p-5 md:p-6 shadow-sm h-fit">
          <h3 class="font-bold text-gray-900 mb-4 border-b border-gray-100 pb-2 text-sm md:text-base">BARANG YANG ANDA INGINKAN</h3>

          <div class="flex flex-col sm:flex-row gap-4 md:gap-6">
            <img src="{{ asset('storage/' . $targetProduct->image_path) }}" class="w-full h-48 sm:w-32 sm:h-32 object-cover rounded-lg bg-gray-100 border border-gray-100">

            <div class="flex-1">
              <h4 class="font-bold text-lg md:text-xl uppercase leading-tight mb-1">{{ $targetProduct->name }}</h4>
              <p class="text-xs md:text-sm text-gray-500 mb-2">Pemilik: <span class="font-semibold text-gray-800">{{ $targetProduct->user->name }}</span></p>

              <div class="inline-flex flex-col gap-1">
                <span class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Kondisi</span>
                <span class="text-xs font-bold bg-gray-100 text-gray-700 px-2 py-1 rounded w-fit">
                  {{ ucfirst($targetProduct->condition) }}
                </span>
              </div>

              <div class="mt-3 text-sm font-bold text-[#65d752]">
                Estimasi Harga: Rp {{ number_format($targetProduct->price, 0, ',', '.') }}
              </div>
            </div>
          </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-xl p-5 md:p-6 shadow-sm flex flex-col h-[500px] md:h-auto">
          <h3 class="font-bold text-gray-900 mb-4 border-b border-gray-100 pb-2 text-sm md:text-base">PILIH BARANG ANDA UNTUK DITUKAR</h3>

          <div class="relative mb-4">
            <input type="text" placeholder="Cari barang Anda..." class="w-full border border-gray-300 rounded-lg pl-10 pr-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#65d752] transition">
            <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
          </div>

          <div class="flex-1 overflow-y-auto space-y-3 pr-1 md:pr-2 custom-scrollbar">
            @forelse($myProducts as $item)
            <div @click="selectedId = {{ $item->id }}; selectedName = '{{ $item->name }}'"
              class="flex items-center justify-between p-3 border rounded-lg cursor-pointer transition group hover:border-[#65d752]"
              :class="selectedId == {{ $item->id }} ? 'border-[#65d752] bg-green-50 ring-1 ring-[#65d752]' : 'border-gray-200 hover:bg-gray-50'">

              <div class="flex items-center gap-3 overflow-hidden">
                <img src="{{ asset('storage/' . $item->image_path) }}" class="w-12 h-12 object-cover rounded bg-gray-100 shrink-0">
                <div class="min-w-0">
                  <p class="font-bold text-sm truncate pr-2 group-hover:text-[#65d752] transition">{{ $item->name }}</p>
                  <p class="text-xs text-gray-500">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                </div>
              </div>

              <div class="w-5 h-5 rounded-full border flex items-center justify-center shrink-0"
                :class="selectedId == {{ $item->id }} ? 'border-[#65d752] bg-[#65d752]' : 'border-gray-300'">
                <svg x-show="selectedId == {{ $item->id }}" class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
              </div>
            </div>
            @empty
            <div class="h-full flex flex-col items-center justify-center text-center text-gray-400 py-10">
              <div class="bg-gray-100 p-4 rounded-full mb-3">
                <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                </svg>
              </div>
              <p class="text-sm">Anda belum memiliki barang tipe 'Swap'.</p>
              <a href="{{ route('products.create') }}" class="text-[#65d752] font-bold text-sm hover:underline mt-2">Upload Barang Dulu</a>
            </div>
            @endforelse
          </div>
        </div>

      </div>

      <div class="mt-8 border border-green-200 bg-green-50 rounded-xl p-5 md:p-6 flex flex-col md:flex-row items-center justify-between gap-4 shadow-sm"
        x-show="selectedId != null"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform translate-y-4"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        style="display: none;">

        <div class="w-full md:w-auto text-center md:text-left">
          <h4 class="font-bold text-gray-800 text-sm md:text-base">Ringkasan Penukaran</h4>
          <div class="flex items-center justify-center md:justify-start gap-2 mt-1 text-xs md:text-sm bg-white px-3 py-1.5 rounded-lg border border-green-100 inline-flex">
            <span class="font-bold text-gray-900 max-w-[100px] truncate">{{ $targetProduct->name }}</span>
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
            </svg>
            <span class="font-bold text-[#65d752] max-w-[100px] truncate" x-text="selectedName"></span>
          </div>
        </div>

        <button type="submit" class="w-full md:w-auto bg-[#65d752] hover:bg-green-600 text-white font-bold px-8 py-3 rounded-lg shadow-md transition transform active:scale-95 flex items-center justify-center gap-2">
          <span>AJUKAN PENUKARAN</span>
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
          </svg>
        </button>
      </div>

    </form>
  </div>

</body>

</html>