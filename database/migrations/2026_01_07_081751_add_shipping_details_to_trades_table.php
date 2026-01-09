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
        Schema::table('trades', function (Blueprint $table) {
            // Bukti kirim (Foto Resi/Packing)
            $table->string('requester_shipping_proof')->nullable()->after('status');
            $table->string('receiver_shipping_proof')->nullable()->after('requester_shipping_proof');

            // Konfirmasi Barang Diterima (Boolean)
            $table->boolean('requester_receipt_confirmed')->default(false)->after('receiver_shipping_proof');
            $table->boolean('receiver_receipt_confirmed')->default(false)->after('requester_receipt_confirmed');
        });
    }

    public function down(): void
    {
        Schema::table('trades', function (Blueprint $table) {
            $table->dropColumn([
                'requester_shipping_proof',
                'receiver_shipping_proof',
                'requester_receipt_confirmed',
                'receiver_receipt_confirmed'
            ]);
        });
    }
};
