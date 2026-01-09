<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Masuk - LoopLife</title>
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
      <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?q=80&w=2574&auto=format&fit=crop"
        class="absolute inset-0 w-full h-full object-cover opacity-60">

      <div class="absolute inset-0 bg-linear-to-t from-green-900/80 to-transparent"></div>

      <div class="relative z-10 px-16 text-white text-center">
        <div class="mb-6 flex justify-center">
          <div class="w-16 h-16 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center border border-white/30">
            <span class="text-3xl">♻️</span>
          </div>
        </div>
        <h2 class="text-4xl font-bold mb-4 leading-tight">Berikan Barangmu <br>Kesempatan Kedua.</h2>
        <p class="text-white/80 text-lg font-light">Bergabunglah dengan gerakan ekonomi sirkular. Kurangi limbah, perbanyak manfaat.</p>
      </div>
    </div>

    <div class="w-full lg:w-1/2 flex flex-col justify-center items-center p-8 bg-white h-full overflow-y-auto">

      <div class="w-full max-w-md">
        <div class="flex justify-center lg:justify-start mb-8">
          <a href="{{ route('home') }}" class="flex items-center gap-2">
            <img src="{{ asset('img/Logo_Looplife.png') }}" class="w-7 h-7">
            <span class="text-xl md:text-2xl font-bold text-green-looplife hidden sm:block">LoopLife</span>
          </a>
        </div>

        <div class="mb-8">
          <h1 class="text-3xl font-bold text-gray-900 mb-2">Selamat Datang!</h1>
          <p class="text-gray-500">Masuk untuk mulai menukar atau mendonasikan barang.</p>
        </div>

        @if ($errors->any())
        <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-100 flex gap-3 items-start">
          <svg class="w-5 h-5 text-red-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
          </svg>
          <p class="text-sm text-red-600 font-medium">{{ $errors->first() }}</p>
        </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="space-y-5">
          @csrf

          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Username</label>
            <input type="text" name="username"
              class="w-full px-5 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:bg-white focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition duration-200 outline-none"
              placeholder="Contoh: egi_gustian" required>
          </div>

          <div>
            <div class="flex justify-between items-center mb-2">
              <label class="block text-sm font-semibold text-gray-700">Password</label>
              <a href="#" class="text-sm text-green-600 hover:text-green-700 font-medium">Lupa Password?</a>
            </div>
            <input type="password" name="password"
              class="w-full px-5 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 focus:bg-white focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition duration-200 outline-none"
              placeholder="••••••••" required>
          </div>

          <button type="submit" class="w-full bg-[#65d752] hover:bg-green-600 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-green-500/30 transition transform active:scale-[0.98]">
            Masuk Sekarang
          </button>
        </form>

        <div class="my-8 flex items-center gap-4">
          <div class="h-px bg-gray-200 flex-1"></div>
          <span class="text-xs text-gray-400 font-medium uppercase">Atau masuk dengan</span>
          <div class="h-px bg-gray-200 flex-1"></div>
        </div>

        <div class="grid grid-cols-2 gap-4">
          <button class="flex items-center justify-center gap-2 py-2.5 border border-gray-200 rounded-xl hover:bg-gray-50 transition">
            <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-5 h-5">
            <span class="text-sm font-medium text-gray-600">Google</span>
          </button>
          <button class="flex items-center justify-center gap-2 py-2.5 border border-gray-200 rounded-xl hover:bg-gray-50 transition">
            <img src="https://www.svgrepo.com/show/475647/facebook-color.svg" class="w-5 h-5">
            <span class="text-sm font-medium text-gray-600">Facebook</span>
          </button>
        </div>

        <p class="text-center mt-8 text-gray-600">
          Belum punya akun?
          <a href="{{ route('register') }}" class="text-[#65d752] font-bold hover:underline">Daftar Gratis</a>
        </p>
      </div>
    </div>
  </div>
</body>

</html>