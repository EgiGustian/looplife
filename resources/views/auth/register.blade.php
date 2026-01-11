<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar - LoopLife</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>

<body class="bg-gray-50 h-screen w-full overflow-hidden">

  <div class="flex w-full h-full">

    <div class="hidden lg:flex w-1/2 relative bg-gray-900 items-center justify-center overflow-hidden">
      <img src="https://images.unsplash.com/photo-1530122037265-a5f1f91d3b99?q=80&w=2574&auto=format&fit=crop"
        class="absolute inset-0 w-full h-full object-cover opacity-60">

      <div class="absolute inset-0 bg-linear-to-t from-emerald-900/90 to-transparent"></div>

      <div class="relative z-10 px-16 text-white text-center">
        <h2 class="text-4xl font-bold mb-4 leading-tight">Mulai Gaya Hidup <br>Baru Hari Ini.</h2>
        <p class="text-white/80 text-lg font-light">Satu langkah kecil untuk mendaftar, satu langkah besar untuk bumi yang lebih hijau.</p>

        <!-- <div class="mt-8 flex justify-center gap-4">
          <div class="text-center">
            <p class="text-2xl font-bold">10K+</p>
            <p class="text-xs text-white/60">Pengguna</p>
          </div>
          <div class="w-px bg-white/20 h-10"></div>
          <div class="text-center">
            <p class="text-2xl font-bold">50K+</p>
            <p class="text-xs text-white/60">Barang Ditukar</p>
          </div>
        </div> -->
      </div>
    </div>

    <div class="w-full lg:w-1/2 flex flex-col justify-center items-center p-8 bg-white h-full overflow-y-auto">

      <div class="w-full max-w-md my-auto py-4">

        <div class="flex justify-start mb-8">
          <a href="{{ route('home') }}" class="flex items-center gap-2">
            <img src="{{ asset('img/Logo_Looplife.png') }}" class="w-7 h-7">
            <span class="text-xl md:text-2xl font-bold text-green-looplife hidden sm:block">LoopLife</span>
          </a>
        </div>

        <div class="mb-8">
          <h1 class="text-3xl font-bold text-gray-900 mb-2">Buat Akun Baru</h1>
          <p class="text-gray-500">Lengkapi data diri Anda untuk bergabung.</p>
        </div>

        @if ($errors->any())
        <div style="background-color: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 20px; border: 1px solid #f5c6cb; border-radius: 5px;">
          <strong>Waduh! Ada masalah nih:</strong>
          <ul style="margin-top: 5px; padding-left: 20px;">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif

        <form action="{{ route('register') }}" method="POST" class="space-y-5">
          @csrf

          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
            <input type="text" name="name"
              class="w-full px-5 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:bg-white focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition outline-none"
              placeholder="Nama sesuai KTP" required>
          </div>

          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Username</label>
            <input type="text" name="username"
              class="w-full px-5 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:bg-white focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition outline-none"
              placeholder="username_unik" required>
          </div>


          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
              <input type="password" name="password"
                class="w-full px-5 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:bg-white focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition outline-none"
                placeholder="Min. 8 karakter" required>

              <!-- Pesan error password -->
              @error('password')
              <div style="color: red; font-size: 0.9em; margin-top: 5px;">
                {{ $message }}
              </div>
              @enderror
              
            </div>
            <div>
              <label class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi</label>
              <input type="password" name="password_confirmation"
                class="w-full px-5 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:bg-white focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition outline-none"
                placeholder="Ulangi password" required>
            </div>
          </div>

          <div class="flex items-start gap-3 mt-2">
            <input type="checkbox" id="terms" class="mt-1 w-4 h-4 text-green-600 rounded border-gray-300 focus:ring-green-500 cursor-pointer">
            <label for="terms" class="text-sm text-gray-500 leading-tight cursor-pointer">
              Saya setuju dengan <a href="#" class="text-[#65d752] font-bold hover:underline">Syarat & Ketentuan</a> serta <a href="#" class="text-[#65d752] font-bold hover:underline">Kebijakan Privasi</a>.
            </label>
          </div>

          <button type="submit" class="w-full bg-[#65d752] hover:bg-green-600 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-green-500/30 transition transform active:scale-[0.98]">
            Daftar Sekarang
          </button>
        </form>

        <p class="text-center mt-8 text-gray-600">
          Sudah punya akun?
          <a href="{{ route('login') }}" class="text-[#65d752] font-bold hover:underline">Masuk disini</a>
        </p>

      </div>
    </div>
  </div>
</body>

</html>