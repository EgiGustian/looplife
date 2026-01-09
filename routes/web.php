<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SwapController;
use App\Http\Controllers\ProfileController;


// Route::get('/dashboard', function () {
//     return view('dashboard');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [HomeController::class, 'index'])->name('home');

// Route untuk menampilkan halaman form
Route::get('/upload-barang', [ProductController::class, 'create'])->name('products.create');

// Route untuk memproses data form (POST method)
Route::post('/upload-barang', [ProductController::class, 'store'])->name('products.store');

// Route Guest (Hanya bisa diakses jika BELUM login)
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});
// Route Auth (Hanya bisa diakses jika SUDAH login)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route ke Halaman Swap Zone
Route::get('/swap', [SwapController::class, 'index'])->name('swap.index');
// Halaman Detail Produk
Route::get('/swap/{id}', [SwapController::class, 'show'])->name('swap.show');

Route::middleware(['auth'])->group(function () {
    // Route untuk Halaman Checkout (Beli)
    Route::get('/swap/{id}/checkout', [SwapController::class, 'checkout'])->name('swap.checkout');
    // Proses data dari Checkout (Form Submit)
    Route::post('/swap/{id}/process', [SwapController::class, 'processCheckout'])->name('swap.process');
});

// Halaman Pembayaran (Tampilan QRIS/Detail)
Route::get('/payment/{id}', [SwapController::class, 'showPayment'])->name('payment.show');

// Routes untuk fitur Trade (Tukar)
Route::middleware(['auth'])->group(function () {
    // Menampilkan halaman pilih barang
    Route::get('/swap/{id}/trade', [SwapController::class, 'trade'])->name('swap.trade');
    // Memproses pengajuan (Saat tombol 'Ajukan' diklik)
    Route::post('/swap/{id}/trade', [SwapController::class, 'storeTrade'])->name('swap.store');
    // Menampilkan halaman status
    Route::get('/swap/status/{tradeId}', [SwapController::class, 'statusTrade'])->name('swap.status');
    // Proses Terima/Tolak Tawaran (Action Only)
    Route::post('/swap/offers/{tradeId}', [SwapController::class, 'respondOffer'])->name('swap.respond');
    // Route Upload Resi
    Route::post('/swap/resi/{tradeId}', [SwapController::class, 'uploadResi'])->name('swap.resi');
    // Route Konfirmasi Terima Barang
    Route::post('/swap/confirm/{tradeId}', [SwapController::class, 'confirmReceipt'])->name('swap.confirm');
});

Route::middleware(['auth'])->group(function () {

    // 1. READ (Halaman Profil Utama)
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');

    // 2. CREATE (Tambah Barang)
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');

    // 3. UPDATE (Edit Barang)
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');

    // 4. DELETE (Hapus Barang)
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
});
