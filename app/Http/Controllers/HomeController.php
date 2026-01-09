<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // <--- PENTING: Jangan lupa import Model Product

class HomeController extends Controller
{
    public function index()
    {
        // 1. Mengambil data untuk "Barang Populer"
        // Kita ambil 3 barang terbaru saja sebagai contoh
        $popularItems = Product::latest()->take(3)->get();

        // 2. Mengambil data untuk "Swap Zone"
        // Kita ambil semua barang yang tipenya 'swap' (Tukar)
        $swapItems = Product::where('type', 'swap')->latest()->get();

        // 3. Data Repair Services
        // Karena kita BELUM membuat tabel/model untuk Repair, 
        // kita biarkan data dummy ini dulu agar tidak error.
        $repairServices = [
            ['name' => 'Loop Fix Repair', 'location' => 'Bandung', 'rating' => 5, 'image' => 'https://via.placeholder.com/300x200?text=Repair1'],
            ['name' => 'Tech Repair', 'location' => 'Jakarta', 'rating' => 4.8, 'image' => 'https://via.placeholder.com/300x200?text=Repair2'],
            ['name' => 'King Garage', 'location' => 'Sumedang', 'rating' => 5, 'image' => 'https://via.placeholder.com/300x200?text=Garage'],
        ];

        return view('dashboard', compact('popularItems', 'swapItems', 'repairServices'));
    }
}