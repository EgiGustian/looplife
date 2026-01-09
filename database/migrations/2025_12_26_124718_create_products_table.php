<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Primary Key (otomatis bigInteger & Auto Increment)

            // Foreign Key (Menghubungkan ke tabel User & Category)
            // Pastikan tabel users & categories sudah ada sebelum migrate ini
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained();

            // Data Barang
            $table->string('name'); // Varchar
            $table->text('description'); // Text panjang
            $table->decimal('price', 10, 2)->nullable(); // Angka desimal, boleh kosong
            $table->string('image_path'); // Menyimpan link/nama file gambar

            // Pilihan (Enum)
            $table->enum('type', ['swap', 'sell', 'donation']);
            $table->enum('condition', ['new', 'used']);
            $table->string('status')->default('available');

            $table->timestamps(); // Otomatis buat kolom created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
