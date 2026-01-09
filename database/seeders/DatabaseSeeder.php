<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Kategori Dulu
        $cat1 = Category::create(['name' => 'Pakaian', 'slug' => 'pakaian', 'icon' => 'baju']);
        $cat2 = Category::create(['name' => 'Elektronik', 'slug' => 'elektronik', 'icon' => 'hp']);
        $cat3 = Category::create(['name' => 'Kendaraan', 'slug' => 'kendaraan', 'icon' => 'motor']);
        $cat4 = Category::create(['name' => 'Hobi', 'slug' => 'hobi', 'icon' => 'game']);

        // // 2. Buat User 1 (Egi - Sebagai Pengaju)
        // $user1 = User::create([
        //     'name' => 'Egi Gustian',
        //     'username' => 'egi',
        //     'email' => 'egi@looplife.com',
        //     'password' => Hash::make('password'), // Passwordnya 'password'
        // ]);

        // // 3. Buat User 2 (Fauzi - Sebagai Pemilik Barang Target)
        // $user2 = User::create([
        //     'name' => 'Fauzi Yazid',
        //     'username' => 'fauzi',
        //     'email' => 'fauzi@looplife.com',
        //     'password' => Hash::make('password'),
        // ]);

        // // 4. Buat Barang Milik Egi (Untuk ditawarkan)
        // Product::create([
        //     'user_id' => $user1->id,
        //     'category_id' => $cat1->id,
        //     'name' => 'Jam Tangan Casio Bekas',
        //     'description' => 'Masih mulus, baterai baru ganti.',
        //     'price' => 500000,
        //     'image_path' => 'products/dummy_jam.jpg', // Pastikan ada gambar dummy atau biarkan broken image dulu gpp
        //     'type' => 'swap',
        //     'condition' => 'used',
        //     'status' => 'available',
        // ]);

        // // 5. Buat Barang Milik Fauzi (Target yang mau diambil Egi)
        // Product::create([
        //     'user_id' => $user2->id,
        //     'category_id' => $cat1->id,
        //     'name' => 'Sepatu Nike Air Jordan',
        //     'description' => 'Ukuran 42, baru dipakai 2 kali.',
        //     'price' => 1200000,
        //     'image_path' => 'products/dummy_sepatu.jpg',
        //     'type' => 'swap',
        //     'condition' => 'used',
        //     'status' => 'available',
        // ]);
    }
}
