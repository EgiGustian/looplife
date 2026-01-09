<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil Saya - LoopLife</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>

<body class="bg-gray-50 text-gray-800">

  @include('components.navbar')

  <div class="container mx-auto px-6 py-8"
    x-data="{ activeTab: '{{ count($incomingOffers) > 0 ? 'offers' : 'etalase' }}' }">

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

      <div class="lg:col-span-1">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 text-center sticky top-24">
          <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=65d752&color=fff&size=128"
            class="w-24 h-24 rounded-full border-4 border-white shadow-md mx-auto mb-4">
          <h2 class="text-lg font-bold text-gray-900">{{ $user->name }}</h2>
          <p class="text-sm text-gray-500 mb-4">{{ '@'.$user->username ?? 'user' }}</p>

          <div class="bg-green-50 rounded-lg p-3 mb-6 border border-green-100">
            <p class="text-xs text-gray-500 mb-1">Saldo LoopPay</p>
            <p class="text-xl font-bold text-green-600">Rp 1.500.000</p>
          </div>

          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="w-full flex items-center justify-center gap-2 px-4 py-2 text-sm text-red-600 bg-red-50 rounded-lg hover:bg-red-100 transition">
              Keluar
            </button>
          </form>
        </div>
      </div>

      <div class="lg:col-span-3">

        <div class="flex border-b border-gray-200 mb-6 overflow-x-auto">
          <button @click="activeTab = 'offers'"
            :class="activeTab === 'offers' ? 'border-b-2 border-green-500 text-green-600' : 'text-gray-500 hover:text-gray-700'"
            class="px-6 py-3 text-sm font-bold transition flex items-center gap-2 whitespace-nowrap relative">
            Penawaran Masuk

            @if($incomingOffers->count() > 0)
            <span class="absolute top-2 right-2 flex h-3 w-3">
              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
              <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
            </span>
            <span class="bg-red-100 text-red-600 text-[10px] px-2 py-0.5 rounded-full ml-1">
              {{ $incomingOffers->count() }}
            </span>
            @endif
          </button>

          <button @click="activeTab = 'etalase'"
            :class="activeTab === 'etalase' ? 'border-b-2 border-green-500 text-green-600' : 'text-gray-500 hover:text-gray-700'"
            class="px-6 py-3 text-sm font-bold transition whitespace-nowrap">
            Etalase Toko
          </button>

          <button @click="activeTab = 'riwayat'"
            :class="activeTab === 'riwayat' ? 'border-b-2 border-green-500 text-green-600' : 'text-gray-500 hover:text-gray-700'"
            class="px-6 py-3 text-sm font-bold transition whitespace-nowrap">
            Riwayat Transaksi
          </button>
        </div>

        <div x-show="activeTab === 'offers'" x-transition.opacity>

          @if(session('success'))
          <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4 text-sm">{{ session('success') }}</div>
          @endif

          <div class="space-y-4">
            @forelse($incomingOffers as $trade)
            <div class="bg-white border border-green-200 rounded-xl p-5 shadow-sm relative overflow-hidden">
              <div class="absolute top-0 right-0 bg-yellow-400 text-white text-[10px] font-bold px-3 py-1 rounded-bl-lg">
                MENUNGGU RESPON
              </div>

              <div class="flex flex-col md:flex-row gap-6 items-center">

                <div class="flex items-center gap-3 w-full md:w-auto">
                  <img src="https://ui-avatars.com/api/?name={{ urlencode($trade->requester->name) }}" class="w-10 h-10 rounded-full">
                  <div>
                    <p class="text-xs text-gray-500">Penawaran dari:</p>
                    <p class="font-bold text-sm">{{ $trade->requester->name }}</p>
                  </div>
                </div>

                <div class="flex-1 flex items-center justify-center gap-4 bg-gray-50 p-3 rounded-lg w-full">
                  <div class="text-center">
                    <img src="{{ asset('storage/' . $trade->offeredProduct->image_path) }}" class="w-16 h-16 object-cover rounded-md mx-auto mb-1 border border-green-300">
                    <p class="text-xs font-bold text-green-700 truncate w-24">{{ $trade->offeredProduct->name }}</p>
                    <p class="text-[10px] text-gray-500">Milik Dia</p>
                  </div>

                  <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                  </svg>

                  <div class="text-center">
                    <img src="{{ asset('storage/' . $trade->requestedProduct->image_path) }}" class="w-16 h-16 object-cover rounded-md mx-auto mb-1 border border-gray-300">
                    <p class="text-xs font-bold text-gray-800 truncate w-24">{{ $trade->requestedProduct->name }}</p>
                    <p class="text-[10px] text-gray-500">Milik Kamu</p>
                  </div>
                </div>

              </div>

              <div class="mt-4 flex justify-end gap-3 border-t border-gray-100 pt-4">
                <form action="{{ route('swap.respond', $trade->id) }}" method="POST">
                  @csrf
                  <input type="hidden" name="action" value="reject">
                  <button type="submit" class="px-4 py-2 rounded-lg border border-red-200 text-red-600 text-xs font-bold hover:bg-red-50 transition">
                    Tolak
                  </button>
                </form>

                <form action="{{ route('swap.respond', $trade->id) }}" method="POST">
                  @csrf
                  <input type="hidden" name="action" value="accept">
                  <button type="submit" class="px-6 py-2 rounded-lg bg-[#65d752] text-white text-xs font-bold hover:bg-green-600 transition shadow-md">
                    Terima Tawaran
                  </button>
                </form>
              </div>
            </div>
            @empty
            <div class="text-center py-10 bg-white rounded-xl border border-dashed border-gray-300">
              <p class="text-gray-500 text-sm">Tidak ada penawaran masuk saat ini.</p>
            </div>
            @endforelse
          </div>
        </div>

        <div x-show="activeTab === 'etalase'" style="display: none;" x-transition.opacity>
          <div class="lg:col-span-3">

            <div class="flex justify-between items-center mb-6">
              <h3 class="font-bold text-gray-800 text-lg">Etalase Toko</h3>
              <a href="{{ route('products.create') }}" class="bg-[#65d752] hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg shadow-sm flex items-center gap-2 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Barang
              </a>
            </div>

            @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
              {{ session('success') }}
            </div>
            @endif

            <div class="grid grid-cols-2 md:grid-cols-3 gap-6">

              @forelse($myProducts as $product)
              <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden group relative hover:shadow-md transition">

                <div class="h-48 bg-gray-100 relative">
                  <img src="{{ asset('storage/' . $product->image_path) }}" class="w-full h-full object-cover">
                  <span class="absolute top-2 right-2 bg-green-500 text-white text-[10px] px-2 py-1 rounded-full shadow">
                    {{ ucfirst($product->status) }}
                  </span>
                </div>

                <div class="p-4">
                  <h4 class="font-bold text-gray-800 truncate">{{ $product->name }}</h4>
                  <p class="text-green-600 font-bold text-sm mt-1">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>

                @if($product->status == 'available')
                <div class="absolute top-2 left-2 flex gap-2 opacity-0 group-hover:opacity-100 transition duration-300">

                  <a href="{{ route('products.edit', $product->id) }}" class="bg-white text-blue-500 p-2 rounded-full shadow hover:bg-blue-50 transition" title="Edit">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                    </svg>
                  </a>

                  <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Hapus barang ini permanen?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-white text-red-500 p-2 rounded-full shadow hover:bg-red-50 transition" title="Hapus">
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                      </svg>
                    </button>
                  </form>

                </div>
                @endif

              </div>
              @empty
              <div class="col-span-full text-center py-10">
                <p class="text-gray-500">Belum ada barang. Klik tombol "Tambah Barang" di atas!</p>
              </div>
              @endforelse

            </div>
          </div>
        </div>

        <div x-show="activeTab === 'riwayat'" style="display: none;" x-transition.opacity>
          <div class="space-y-3">
            @forelse($transactions as $trx)
            <div class="bg-white border border-gray-200 p-4 rounded-lg flex justify-between items-center">
              <div>
                <span class="text-xs font-bold px-2 py-1 rounded {{ $trx->status == 'approved' ? 'bg-green-100 text-green-700' : 'bg-gray-100' }}">
                  {{ strtoupper($trx->status) }}
                </span>
                <p class="text-sm font-bold mt-2">{{ $trx->offeredProduct->name ?? '-' }} <span class="text-gray-400 mx-1">↔</span> {{ $trx->requestedProduct->name ?? '-' }}</p>
              </div>
              <a href="{{ route('swap.status', $trx->id) }}" class="text-xs text-blue-500 underline">Lihat</a>
            </div>
            @empty
            <p class="text-center text-sm text-gray-400 py-10">Belum ada transaksi.</p>
            @endforelse
          </div>
        </div>

      </div>
    </div>
  </div>

  @include('components.footer')

</body>

</html>