<header x-data="{ mobileMenuOpen: false, searchOpen: false }" class="bg-white shadow-sm sticky top-0 z-50 border-b border-gray-100 font-sans">

  <div class="container mx-auto px-4 md:px-6 py-4">
    <div class="flex items-center justify-between gap-4">

      <a href="{{ route('home') }}" class="flex items-center gap-2 shrink-0">
        <img src="{{ asset('img/Logo_Looplife.png') }}" alt="LoopLife Logo" class="w-8 h-8">
        <span class="text-xl md:text-2xl font-bold text-[#65d752] hidden sm:block">LoopLife</span>
      </a>

      <div class="hidden md:block flex-1 mx-4 lg:mx-10">
        <div class="relative">
          <input type="text" placeholder="Cari di LoopLife..." class="w-full border border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-[#65d752] transition">
          <svg class="w-5 h-5 absolute right-3 top-2.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
          </svg>
        </div>
      </div>

      <div class="flex items-center gap-3 md:gap-6 shrink-0">

        <button @click="searchOpen = !searchOpen" class="md:hidden text-gray-600 hover:text-[#65d752]">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
          </svg>
        </button>

        <button class="text-gray-600 hover:text-[#65d752]">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
          </svg>
        </button>

        <button class="hidden sm:block text-gray-600 hover:text-[#65d752]">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
          </svg>
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
              <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=65d752&color=fff" class="w-8 h-8 md:w-9 md:h-9 rounded-full border border-gray-200">
            </button>
            <div x-show="open" @click.outside="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50 border border-gray-100" style="display: none;">
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

        <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-gray-600 focus:outline-none ml-2">
          <svg x-show="!mobileMenuOpen" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
          </svg>
          <svg x-show="mobileMenuOpen" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>
    </div>

    <div x-show="searchOpen" class="md:hidden mt-4 pb-2" style="display: none;">
      <div class="relative">
        <input type="text" placeholder="Cari di LoopLife..." class="w-full border border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-[#65d752]">
        <button class="absolute right-3 top-2.5 text-gray-400">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
          </svg>
        </button>
      </div>
    </div>
  </div>

  <div class="hidden md:block container mx-auto px-6 py-3 border-t border-gray-100">
    <div class="flex gap-8 text-sm font-medium text-gray-600">
      <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-[#65d752] border-b-2 border-[#65d752] pb-1' : 'hover:text-[#65d752]' }}">Dashboard</a>
      <a href="{{ route('swap.index') }}" class="{{ request()->routeIs('swap.*') ? 'text-[#65d752] border-b-2 border-[#65d752] pb-1' : 'hover:text-[#65d752]' }}">Swap Zone</a>
      <a href="#" class="hover:text-[#65d752]">Repair</a>
      <a href="#" class="hover:text-[#65d752]">Donation</a>
      <a href="#" class="hover:text-[#65d752]">Komunitas</a>
      <a href="#" class="hover:text-[#65d752]">EcoPoint</a>
    </div>
  </div>

  <div x-show="mobileMenuOpen" class="md:hidden border-t border-gray-100 bg-white" style="display: none;">
    <div class="px-6 py-4 flex flex-col gap-4 text-gray-600 font-medium">
      <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-[#65d752]' : '' }}">Dashboard</a>
      <a href="{{ route('swap.index') }}" class="{{ request()->routeIs('swap.*') ? 'text-[#65d752]' : '' }}">Swap Zone</a>
      <a href="#">Repair</a>
      <a href="#">Donation</a>
    </div>
  </div>
</header>