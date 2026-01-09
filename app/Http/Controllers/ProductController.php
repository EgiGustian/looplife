<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // 1. TAMPILKAN FORM CREATE
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    // 2. PROSES SIMPAN (STORE)
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id', // Pastikan kategori ada di DB
            'type' => 'required|in:swap,sell,donation',
            'condition' => 'required|in:new,used',
            'price' => 'nullable|numeric', // Boleh kosong jika donasi
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Maks 2MB
        ]);

        // 2. Proses Upload Gambar
        // Gambar akan disimpan di folder: storage/app/public/products
        $imagePath = $request->file('image')->store('products', 'public');

        // 3. Simpan ke Database
        Product::create([
            'user_id' => Auth::id(), // Ambil ID user yang sedang login
            'category_id' => $request->category_id,
            'name' => $request->name,
            'type' => $request->type,
            'condition' => $request->condition,
            'price' => $request->price ?? 0, // Jika harga kosong, isi 0
            'description' => $request->description,
            'image_path' => $imagePath,
            'status' => 'available', // Status default saat baru upload
        ]);

        // 4. Redirect kembali dengan pesan sukses
        return redirect()->route('profile.index')->with('success', 'Barang berhasil diupload ke LoopLife!');
    }

    // 3. TAMPILKAN FORM EDIT
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        // Keamanan: Cek apakah ini barang milik user yang login?
        if ($product->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak');
        }

        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    // 4. PROSES UPDATE
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if ($product->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
        ]);

        $data = $request->only(['name', 'price', 'description', 'condition', 'category_id', 'type']);

        // Cek jika ada gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if ($product->image_path && Storage::exists('public/' . $product->image_path)) {
                Storage::delete('public/' . $product->image_path);
            }
            $data['image_path'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('profile.index')->with('success', 'Barang berhasil diperbarui!');
    }

    // 5. PROSES DELETE
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->user_id !== Auth::id()) {
            abort(403);
        }

        // Hapus gambar fisik
        if ($product->image_path && Storage::exists('public/' . $product->image_path)) {
            Storage::delete('public/' . $product->image_path);
        }

        $product->delete();

        return redirect()->route('profile.index')->with('success', 'Barang berhasil dihapus!');
    }
}
