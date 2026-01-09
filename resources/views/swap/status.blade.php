<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Transaksi #{{ $trade->id }}</title>
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

    <div class="container mx-auto px-4 md:px-6 py-6 md:py-10">

        <div class="flex flex-col md:flex-row justify-between items-center mb-8 md:mb-10 gap-4 text-center md:text-left">
            <h1 class="text-xl md:text-2xl font-bold text-gray-800">TRANSAKSI #{{ $trade->id }}</h1>

            @php
            $statusColors = [
            'pending' => 'bg-yellow-100 text-yellow-700',
            'approved' => 'bg-blue-100 text-blue-700',
            'shipping' => 'bg-purple-100 text-purple-700',
            'completed' => 'bg-green-100 text-green-700',
            'rejected' => 'bg-red-100 text-red-700',
            ];
            $statusLabels = [
            'pending' => 'MENUNGGU RESPON',
            'approved' => 'DISETUJUI (SIAP KIRIM)',
            'shipping' => 'DALAM PENGIRIMAN',
            'completed' => 'SELESAI',
            'rejected' => 'DITOLAK',
            ];
            @endphp
            <span class="{{ $statusColors[$trade->status] ?? 'bg-gray-100' }} px-4 md:px-6 py-1.5 md:py-2 rounded-full font-bold text-xs md:text-sm tracking-wide">
                {{ $statusLabels[$trade->status] ?? strtoupper($trade->status) }}
            </span>
        </div>

        @if($trade->status == 'pending')
        <div class="max-w-3xl mx-auto bg-white border border-yellow-200 rounded-xl p-6 md:p-10 text-center shadow-sm">
            <div class="w-16 h-16 md:w-20 md:h-20 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4 md:mb-6">
                <svg class="w-8 h-8 md:w-10 md:h-10 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>

            <h2 class="text-xl md:text-2xl font-bold text-gray-900 mb-2">Menunggu Persetujuan</h2>
            <p class="text-sm md:text-base text-gray-600 mb-6 md:mb-8 px-2">
                Permintaan sedang ditinjau oleh <span class="font-bold text-gray-800">{{ $trade->receiver->name }}</span>.
                <br class="hidden md:block"> Anda akan mendapat notifikasi setelah direspon.
            </p>

            <div class="flex justify-center items-center gap-4 md:gap-8 opacity-75">
                <div class="text-center">
                    <img src="{{ asset('storage/' . $trade->offeredProduct->image_path) }}" class="w-12 h-12 md:w-16 md:h-16 object-cover rounded-md mx-auto border mb-2">
                    <p class="text-[10px] md:text-xs font-bold truncate w-20 md:w-auto mx-auto">{{ $trade->offeredProduct->name }}</p>
                    <p class="text-[8px] md:text-[10px] text-gray-500">Barang Anda</p>
                </div>

                <svg class="w-5 h-5 md:w-6 md:h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                </svg>

                <div class="text-center">
                    <img src="{{ asset('storage/' . $trade->requestedProduct->image_path) }}" class="w-12 h-12 md:w-16 md:h-16 object-cover rounded-md mx-auto border mb-2">
                    <p class="text-[10px] md:text-xs font-bold truncate w-20 md:w-auto mx-auto">{{ $trade->requestedProduct->name }}</p>
                    <p class="text-[8px] md:text-[10px] text-gray-500">Barang Target</p>
                </div>
            </div>

            <a href="{{ route('swap.index') }}" class="mt-8 inline-block text-blue-600 text-sm font-bold hover:underline">
                &larr; Kembali ke Swap Zone
            </a>
        </div>

        @elseif($trade->status == 'rejected')
        <div class="bg-red-50 border border-red-200 rounded-xl p-8 md:p-10 text-center max-w-2xl mx-auto shadow-sm">
            <div class="w-16 h-16 md:w-20 md:h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 md:w-10 md:h-10 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </div>
            <h2 class="text-xl md:text-2xl font-bold text-gray-900 mb-2">Penukaran Ditolak</h2>
            <p class="text-sm md:text-base text-gray-600 mb-6">Maaf, pemilik barang memilih untuk menolak tawaran ini.</p>
            <a href="{{ route('swap.index') }}" class="inline-block bg-red-600 hover:bg-red-700 text-white font-bold py-2.5 px-6 md:py-3 md:px-8 text-sm rounded-lg transition shadow-md">
                Cari Barang Lain
            </a>
        </div>

        @else

        <div class="max-w-4xl mx-auto mb-8 md:mb-12 px-2">
            <div class="flex items-center justify-between relative">
                <div class="absolute left-0 top-1/2 transform -translate-y-1/2 w-full h-0.5 md:h-1 bg-gray-200 -z-10"></div>

                <div class="flex flex-col items-center bg-gray-50 px-2 md:px-4">
                    <div class="w-8 h-8 md:w-10 md:h-10 text-sm md:text-base rounded-full flex items-center justify-center font-bold text-white bg-[#65d752]">1</div>
                    <span class="text-[10px] md:text-xs font-bold mt-2 text-gray-600">Disetujui</span>
                </div>

                <div class="flex flex-col items-center bg-gray-50 px-2 md:px-4">
                    <div class="w-8 h-8 md:w-10 md:h-10 text-sm md:text-base rounded-full flex items-center justify-center font-bold text-white 
                        {{ in_array($trade->status, ['shipping', 'completed']) ? 'bg-[#65d752]' : 'bg-gray-300' }}">2</div>
                    <span class="text-[10px] md:text-xs font-bold mt-2 text-gray-600">Dikirim</span>
                </div>

                <div class="flex flex-col items-center bg-gray-50 px-2 md:px-4">
                    <div class="w-8 h-8 md:w-10 md:h-10 text-sm md:text-base rounded-full flex items-center justify-center font-bold text-white 
                        {{ $trade->status == 'completed' ? 'bg-[#65d752]' : 'bg-gray-300' }}">3</div>
                    <span class="text-[10px] md:text-xs font-bold mt-2 text-gray-600">Selesai</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8 max-w-6xl mx-auto">

            @php
            $myId = auth()->id();
            $imRequester = ($myId == $trade->requester_id);

            $myProduct = $imRequester ? $trade->offeredProduct : $trade->requestedProduct;
            $myProof = $imRequester ? $trade->requester_shipping_proof : $trade->receiver_shipping_proof;

            $partnerProduct = $imRequester ? $trade->requestedProduct : $trade->offeredProduct;
            $partnerProof = $imRequester ? $trade->receiver_shipping_proof : $trade->requester_shipping_proof;
            $iConfirmed = $imRequester ? $trade->requester_receipt_confirmed : $trade->receiver_receipt_confirmed;
            @endphp

            <div class="bg-white border border-gray-200 rounded-xl p-4 md:p-6 shadow-sm h-full flex flex-col">
                <h3 class="font-bold text-gray-800 border-b pb-3 mb-4 flex items-center gap-2 text-sm md:text-base">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                    </svg>
                    Barang Anda (Dikirim)
                </h3>

                <div class="flex gap-3 md:gap-4 mb-6">
                    <img src="{{ asset('storage/' . $myProduct->image_path) }}" class="w-20 h-20 md:w-24 md:h-24 object-cover rounded-lg bg-gray-100 border">
                    <div>
                        <h4 class="font-bold text-base md:text-lg text-gray-900">{{ $myProduct->name }}</h4>
                        <p class="text-xs font-bold text-blue-600 bg-blue-50 inline-block px-2 py-1 rounded mb-1">Milik Anda</p>
                        <p class="text-xs text-gray-500 leading-tight">Kirim ke alamat partner.</p>
                    </div>
                </div>

                <div class="mt-auto">
                    @if($myProof)
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                        <p class="text-xs font-bold text-green-700 mb-2">✓ Bukti Kirim Terupload</p>
                        <a href="{{ asset('storage/' . $myProof) }}" target="_blank">
                            <img src="{{ asset('storage/' . $myProof) }}" class="w-full h-24 md:h-32 object-cover rounded-md hover:opacity-90 transition">
                        </a>
                        <p class="text-[10px] text-gray-500 mt-2 text-center">Menunggu konfirmasi partner.</p>
                    </div>
                    @else
                    <form action="{{ route('swap.resi', $trade->id) }}" method="POST" enctype="multipart/form-data" class="bg-gray-50 p-4 rounded-lg border border-dashed border-gray-300">
                        @csrf
                        <label class="block mb-2 text-xs md:text-sm font-bold text-gray-700">Upload Resi / Bukti Packing</label>
                        <input type="file" name="shipping_proof" class="block w-full text-xs text-gray-500 file:mr-2 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100" required>
                        <button type="submit" class="w-full mt-3 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 rounded-lg transition shadow-md text-xs md:text-sm">
                            Kirim Bukti
                        </button>
                    </form>
                    @endif
                </div>
            </div>

            <div class="bg-white border border-gray-200 rounded-xl p-4 md:p-6 shadow-sm h-full flex flex-col">
                <h3 class="font-bold text-gray-800 border-b pb-3 mb-4 flex items-center gap-2 text-sm md:text-base">
                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    Barang Masuk (Diterima)
                </h3>

                <div class="flex gap-3 md:gap-4 mb-6">
                    <img src="{{ asset('storage/' . $partnerProduct->image_path) }}" class="w-20 h-20 md:w-24 md:h-24 object-cover rounded-lg bg-gray-100 border">
                    <div>
                        <h4 class="font-bold text-base md:text-lg text-gray-900">{{ $partnerProduct->name }}</h4>
                        <p class="text-xs font-bold text-orange-600 bg-orange-50 inline-block px-2 py-1 rounded mb-1">Milik Partner</p>
                        <p class="text-xs text-gray-500 leading-tight">Tunggu sampai di tempat Anda.</p>
                    </div>
                </div>

                <div class="mt-auto">
                    @if($partnerProof)
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-4">
                        <p class="text-xs font-bold text-yellow-700 mb-2">Partner Sudah Mengirim!</p>
                        <a href="{{ asset('storage/' . $partnerProof) }}" target="_blank" class="text-xs text-blue-600 underline flex items-center gap-1">
                            Lihat Bukti Resi Partner
                        </a>
                    </div>

                    @if($iConfirmed)
                    <div class="bg-green-100 text-green-700 p-3 rounded-lg text-center font-bold text-xs md:text-sm">
                        ✓ Anda Sudah Konfirmasi Terima
                    </div>
                    @else
                    <form action="{{ route('swap.confirm', $trade->id) }}" method="POST">
                        @csrf
                        <button type="submit" onclick="return confirm('Pastikan barang sudah sampai. Lanjutkan?')" class="w-full bg-[#65d752] hover:bg-green-600 text-white font-bold py-2.5 rounded-lg shadow-md transition text-xs md:text-sm flex items-center justify-center gap-2">
                            Saya Sudah Terima Barang
                        </button>
                    </form>
                    @endif

                    @else
                    <div class="bg-gray-100 p-4 rounded-lg text-center border border-gray-200">
                        <p class="text-xs text-gray-500 font-medium">Menunggu partner kirim...</p>
                        <div class="animate-pulse h-1.5 bg-gray-300 rounded mt-2 w-1/2 mx-auto"></div>
                    </div>
                    @endif
                </div>
            </div>

        </div>

        @if($trade->status == 'completed')
        <div class="max-w-4xl mx-auto mt-8 md:mt-12 bg-green-50 border border-green-200 rounded-xl p-6 md:p-8 text-center shadow-lg">
            <h2 class="text-xl md:text-2xl font-bold text-green-800 mb-2">Transaksi Selesai! ✓</h2>
            <p class="text-sm md:text-base text-green-700 mb-6">Kedua belah pihak telah menerima barang.</p>
            <a href="{{ route('home') }}" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 font-bold text-sm">Ke Beranda</a>
        </div>
        @endif

        @endif
    </div>

    @include('components.footer')

</body>

</html>