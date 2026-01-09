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
        Schema::create('trades', function (Blueprint $table) {
        $table->id();
        $table->foreignId('requester_id')->constrained('users'); // User 1 (Kamu)
        $table->foreignId('receiver_id')->constrained('users');  // User 2 (Pemilik Barang)
        $table->foreignId('requested_product_id')->constrained('products'); // Barang User 2
        $table->foreignId('offered_product_id')->constrained('products');   // Barang User 1
        $table->enum('status', ['pending', 'approved', 'shipping', 'completed', 'rejected'])->default('pending');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trades');
    }
};
