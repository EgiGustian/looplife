<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Pastikan semua nama kolom ini ada di database kamu
    protected $fillable = [
        'user_id',
        'category_id',
        'name',
        'description',
        'price',
        'image_path',
        'type',       // swap, sell, donation
        'condition',  // new, used
        'status',     // available, swapped
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
