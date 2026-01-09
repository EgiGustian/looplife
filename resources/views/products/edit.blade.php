<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Barang - LoopLife</title>
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

  <div class="container mx-auto px-6 py-10 max-w-2xl">

    <a href="{{ route('profile.index') }}" class="flex items-center text-gray-500 hover:text-green-600 mb-4 transition text-sm">
      <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
      </svg>
      Batal & Kembali
    </a>

    <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Barang</h2>

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-xl shadow-md border border-gray-100">
      @csrf
      @method('PUT') <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2">Nama Barang</label>
        <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-green-500 transition" required>
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2">Kategori</label>
        <select name="category_id" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-green-500 transition bg-white">
          @foreach($categories as $category)
          <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
            {{ $category->name }}
          </option>
          @endforeach
        </select>
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2">Mau diapakan barang ini?</label>
        <select name="type" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-green-500 transition bg-white">
          <option value="swap" {{ $product->type == 'swap' ? 'selected' : '' }}>Tukar (Barter)</option>
          <option value="sell" {{ $product->type == 'sell' ? 'selected' : '' }}>Jual</option>
          <option value="donation" {{ $product->type == 'donation' ? 'selected' : '' }}>Donasi</option>
        </select>
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2">Kondisi Barang</label>
        <div class="flex gap-6">
          <label class="flex items-center gap-2 cursor-pointer">
            <input type="radio" name="condition" value="used" {{ $product->condition == 'used' ? 'checked' : '' }} class="text-green-600 focus:ring-green-500">
            <span>Bekas</span>
          </label>
          <label class="flex items-center gap-2 cursor-pointer">
            <input type="radio" name="condition" value="new" {{ $product->condition == 'new' ? 'checked' : '' }} class="text-green-600 focus:ring-green-500">
            <span>Baru (Masih Segel)</span>
          </label>
        </div>
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2">Harga / Estimasi Nilai (Rp)</label>
        <input type="number" name="price" value="{{ old('price', $product->price) }}" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-green-500 transition">
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2">Deskripsi & Minus</label>
        <textarea name="description" rows="4" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-green-500 transition" required>{{ old('description', $product->description) }}</textarea>
      </div>

      <div class="mb-8">
        <label class="block text-gray-700 text-sm font-bold mb-2">Ganti Foto Barang</label>

        <div class="flex items-center gap-4 mb-3 p-3 bg-gray-50 rounded-lg border border-dashed border-gray-300">
          <img src="{{ asset('storage/' . $product->image_path) }}" class="w-16 h-16 object-cover rounded-md border border-gray-200">
          <span class="text-xs text-gray-500">Foto saat ini. Biarkan input kosong jika tidak ingin mengubah.</span>
        </div>

        <input type="file" name="image" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 cursor-pointer transition">
      </div>

      <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 rounded-lg hover:bg-blue-700 transition shadow-md transform active:scale-95">
        Simpan Perubahan
      </button>
    </form>
  </div>

</body>

</html>