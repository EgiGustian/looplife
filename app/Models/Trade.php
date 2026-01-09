<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    protected $guarded = [];

    // Relasi ke Pengaju (Kamu)
    public function requester() {
        return $this->belongsTo(User::class, 'requester_id');
    }

    // Relasi ke Penerima (Budi)
    public function receiver() {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    // Relasi ke Barang Target (Sepatu Nike)
    public function requestedProduct() {
        return $this->belongsTo(Product::class, 'requested_product_id');
    }

    // Relasi ke Barang Tawaran (Jam Tangan)
    public function offeredProduct() {
        return $this->belongsTo(Product::class, 'offered_product_id');
    }
}