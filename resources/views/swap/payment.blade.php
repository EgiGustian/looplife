<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pembayaran - LoopLife</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>

<body class="bg-gray-50 text-gray-800">

  @include('components.navbar')

  <div class="container mx-auto px-4 md:px-6 py-6 md:py-8">

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">

      <div>
        <h2 class="text-xl md:text-2xl font-bold mb-4 md:mb-6 text-gray-900">Pembayaran {{ $method }}</h2>

        <div class="bg-white border border-gray-200 rounded-xl p-5 md:p-8 text-center shadow-sm">
          <p class="text-gray-500 text-sm md:text-base mb-1">Total Pembayaran</p>
          <p class="text-2xl md:text-3xl font-bold text-[#65d752] mb-6">Rp {{ number_format($total, 0, ',', '.') }}</p>

          <div class="flex justify-center mb-6">
            <div class="bg-white p-2 border border-gray-200 rounded-lg shadow-sm">
              <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=LoopLife-Transaction-{{ $product->id }}" alt="QRIS Code" class="w-40 h-40 md:w-48 md:h-48">
            </div>
          </div>

          <div class="text-left space-y-3 mb-6 border-b border-gray-100 pb-6">
            <p class="font-bold text-gray-800 text-sm md:text-base">Detail Pembayaran</p>
            <div class="flex justify-between text-xs md:text-sm text-gray-500">
              <span>Total Harga:</span>
              <span class="font-medium text-gray-700">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between text-xs md:text-sm text-gray-500">
              <span>Total Ongkos Kirim:</span>
              <span class="font-medium text-gray-700">Rp {{ number_format($ongkir, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between text-xs md:text-sm text-gray-500">
              <span>Total Asuransi:</span>
              <span class="font-medium text-gray-700">Rp {{ number_format($asuransi, 0, ',', '.') }}</span>
            </div>
          </div>

          <div class="flex justify-between items-center mb-8 bg-gray-50 p-4 rounded-lg">
            <div class="text-left">
              <p class="text-xs text-gray-500 mb-1">Status</p>
              <p class="font-bold text-yellow-600 text-sm uppercase bg-yellow-100 px-2 py-1 rounded inline-block">PENDING</p>
            </div>
            <div class="text-right">
              <p class="text-xs text-gray-500 mb-1">Batas Waktu</p>
              <p class="font-bold text-gray-800 text-lg md:text-xl font-mono">00:10:40</p>
            </div>
          </div>

          <div class="flex flex-col md:flex-row gap-3 md:gap-4">
            <button class="flex-1 border border-[#65d752] text-[#65d752] font-bold py-3 rounded-lg hover:bg-green-50 transition text-sm md:text-base">
              Bagikan Kode QRIS
            </button>
            <button class="flex-1 bg-[#65d752] text-white font-bold py-3 rounded-lg hover:bg-green-600 transition shadow-md text-sm md:text-base">
              Saya Sudah Bayar
            </button>
          </div>

        </div>
      </div>

      <div>
        <h2 class="text-xl md:text-2xl font-bold mb-4 md:mb-6 text-gray-900">Detail Pesanan</h2>

        <div class="bg-white border border-gray-200 rounded-xl p-4 md:p-6 shadow-sm mb-6 flex flex-col md:flex-row gap-4 md:gap-6">
          <img src="{{ asset('storage/' . $product->image_path) }}" class="w-full md:w-32 h-48 md:h-32 object-cover rounded-md border border-gray-100">

          <div class="flex-1">
            <h3 class="font-bold text-lg text-gray-900 uppercase mb-3">{{ $product->name }}</h3>

            <div class="bg-gray-50 border border-gray-100 rounded-lg p-3 md:p-4">
              <h4 class="font-bold text-xs md:text-sm text-gray-800 mb-2 border-b border-gray-200 pb-2">Spesifikasi Barang</h4>
              <ul class="text-xs text-gray-600 space-y-1.5">
                <li class="flex justify-between"><span>Kondisi:</span> <span class="font-semibold">{{ ucfirst($product->condition) }}</span></li>
                <li class="flex justify-between"><span>Kategori:</span> <span class="font-semibold">{{ $product->category->name ?? '-' }}</span></li>
                <li class="mt-1 text-gray-500 line-clamp-2 italic">"{{ Str::limit($product->description, 60) }}"</li>
              </ul>
            </div>
          </div>
        </div>

        <div class="mb-6 md:mb-8">
          <h4 class="font-bold text-sm md:text-base text-gray-800 mb-2">Alamat Pengiriman</h4>
          <div class="bg-white border border-gray-200 rounded-xl p-4 md:p-5 shadow-sm">
            <div class="flex items-center gap-2 mb-2">
              <span class="bg-green-100 text-green-700 text-[10px] font-bold px-2 py-0.5 rounded">Rumah</span>
            </div>
            <p class="font-bold text-sm text-gray-900">{{ $buyer['name'] }}</p>
            <p class="text-xs text-gray-500 mb-2">{{ $buyer['phone'] }}</p>
            <p class="text-sm text-gray-600 leading-relaxed border-t border-gray-100 pt-2 mt-2">
              {{ $buyer['address'] }}
            </p>
            @if($buyer['note'])
            <p class="text-xs text-gray-500 mt-2 italic">Catatan: "{{ $buyer['note'] }}"</p>
            @endif
          </div>
        </div>

        <div class="flex flex-col md:flex-row gap-3 md:gap-4">
          <button class="flex-1 bg-white border border-gray-200 text-gray-700 font-bold py-3 rounded-lg hover:border-[#65d752] hover:text-[#65d752] transition flex items-center justify-center gap-2 shadow-sm text-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
            </svg>
            Chat Penjual
          </button>
          <button class="flex-1 bg-white border border-gray-200 text-gray-700 font-bold py-3 rounded-lg hover:border-[#65d752] hover:text-[#65d752] transition flex items-center justify-center gap-2 shadow-sm text-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
            </svg>
            Lihat Pesanan
          </button>
        </div>

      </div>

    </div>

  </div>

  @include('components.footer')

</body>

</html>