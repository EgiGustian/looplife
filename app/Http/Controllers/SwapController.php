<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Trade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SwapController extends Controller
{
    public function index()
    {
        // 1. Ambil semua kategori untuk Sidebar
        $categories = Category::all();

        // 2. Ambil produk khusus tipe 'swap' (Tukar)
        // latest() agar barang baru muncul paling atas
        $products = Product::where('type', 'swap')->latest()->get();

        return view('swap.index', compact('categories', 'products'));
    }

    // Menampilkan Halaman Detail Produk
    public function show($id)
    {
        // 1. Ambil data produk berdasarkan ID, sekalian ambil data user (penjual)-nya
        $product = Product::with('user')->findOrFail($id);

        // 2. Ambil barang lain dari penjual yang SAMA (kecuali barang yang sedang dilihat)
        $moreFromSeller = Product::where('user_id', $product->user_id)
            ->where('id', '!=', $id)
            ->where('type', 'swap')
            ->latest()
            ->take(4)
            ->get();

        return view('swap.show', compact('product', 'moreFromSeller'));
    }

    // Menampilkan Halaman Checkout
    public function checkout($id)
    {
        $product = Product::with('user')->findOrFail($id);

        // Simulasi hitungan biaya
        $ongkir = 10000;
        $asuransi = 300;
        $total = $product->price + $ongkir + $asuransi;

        return view('swap.checkout', compact('product', 'ongkir', 'asuransi', 'total'));
    }

    // 1. Memproses Form Checkout
    public function processCheckout(Request $request, $id)
    {
        // Disini harusnya ada logika simpan transaksi ke database
        // Tapi untuk prototype, kita langsung redirect ke halaman pembayaran saja
        // Kita kirim metode pembayaran yang dipilih lewat session

        $paymentMethod = $request->input('payment', 'QRIS'); // Default QRIS jika tidak ada

        return redirect()->route('payment.show', ['id' => $id, 'method' => $paymentMethod]);
    }

    // 2. Menampilkan Halaman Pembayaran
    public function showPayment(Request $request, $id)
    {
        $product = Product::with('user')->findOrFail($id);

        // Ambil metode pembayaran dari URL/Session, default QRIS
        $method = $request->query('method', 'QRIS');

        // Simulasi Hitungan (Sama seperti checkout)
        $ongkir = 10000;
        $asuransi = 300;
        $total = $product->price + $ongkir + $asuransi;

        // Data Mockup Alamat (Sesuai Gambar)
        $buyer = [
            'name' => Auth::user()->name ?? 'Fauzi Yazid Abdullah',
            'phone' => '087719037363',
            'address' => 'Jl. Raya Conggeang Sumedang, Conggeang, Kabupaten Sumedang, Jawa Barat, 45391',
            'note' => '(Rt 03/Rw 03, di samping bank mandiri)'
        ];

        return view('swap.payment', compact('product', 'method', 'ongkir', 'asuransi', 'total', 'buyer'));
    }

    // 1. TAMPILKAN HALAMAN PILIH BARANG (Konfirmasi)
    public function trade($id)
    {
        // Barang orang lain yang mau kita ambil (Target)
        $targetProduct = Product::with('user')->findOrFail($id);

        // Ambil daftar barang milik KITA SENDIRI untuk ditawarkan
        // Syarat: Milik user login, Tipe 'swap', dan Status 'available'
        $myProducts = Product::where('user_id', Auth::id())
            ->where('type', 'swap')
            ->where('status', 'available')
            ->get();

        return view('swap.trade', compact('targetProduct', 'myProducts'));
    }

    // 2. PROSES SIMPAN KE DATABASE
    public function storeTrade(Request $request, $id)
    {
        // Validasi: Pastikan user memilih salah satu barangnya
        $request->validate([
            'offered_product_id' => 'required|exists:products,id',
        ]);

        $targetProduct = Product::findOrFail($id);

        // Simpan data ke tabel 'trades'
        $trade = Trade::create([
            'requester_id' => Auth::id(),              // Kita
            'receiver_id' => $targetProduct->user_id,  // Pemilik barang target
            'requested_product_id' => $targetProduct->id, // Barang target
            'offered_product_id' => $request->offered_product_id, // Barang kita
            'status' => 'pending', // Status awal menunggu persetujuan
        ]);

        // Redirect ke halaman status
        return redirect()->route('swap.status', $trade->id);
    }

    // 3. TAMPILKAN HALAMAN STATUS
    public function statusTrade($tradeId)
    {
        $trade = Trade::with(['requestedProduct', 'offeredProduct', 'receiver'])->findOrFail($tradeId);
        return view('swap.status', compact('trade'));
    }

    // Di dalam class SwapController

    // Proses Terima atau Tolak Tawaran
    public function respondOffer(Request $request, $tradeId)
    {
        $request->validate([
            'action' => 'required|in:accept,reject'
        ]);

        // Pastikan yang akses adalah Pemilik Barang Target (Receiver)
        $trade = Trade::where('id', $tradeId)
            ->where('receiver_id', Auth::id())
            ->firstOrFail();

        if ($request->action == 'accept') {
            // 1. Ubah Status jadi Approved
            $trade->update(['status' => 'approved']);

            // 2. (Opsional) Ubah status barang jadi 'booked' agar tidak laku 2x
            // $trade->requestedProduct->update(['status' => 'booked']);
            // $trade->offeredProduct->update(['status' => 'booked']);

            // Redirect ke halaman status transaksi
            return redirect()->route('swap.status', $trade->id)->with('success', 'Tawaran diterima! Transaksi dimulai.');
        } else {
            // 1. Ubah Status jadi Rejected
            $trade->update(['status' => 'rejected']);

            // Redirect kembali ke halaman Profil (Daftar Tawaran)
            return back()->with('info', 'Tawaran telah ditolak.');
        }
    }

    // Tambahkan di SwapController.php

    // 6. PROSES UPLOAD RESI
    public function uploadResi(Request $request, $tradeId)
    {
        $request->validate([
            'shipping_proof' => 'required|image|max:2048', // Maks 2MB
        ]);

        $trade = Trade::findOrFail($tradeId);
        $userId = Auth::id();

        // Upload Gambar
        $path = $request->file('shipping_proof')->store('shipping_proofs', 'public');

        // Cek siapa yang upload (Pengaju atau Penerima)
        if ($userId == $trade->requester_id) {
            $trade->update(['requester_shipping_proof' => $path]);
        } elseif ($userId == $trade->receiver_id) {
            $trade->update(['receiver_shipping_proof' => $path]);
        }

        // Cek Logika: Jika KEDUANYA sudah upload resi, ubah status jadi 'shipping'
        if ($trade->requester_shipping_proof && $trade->receiver_shipping_proof) {
            $trade->update(['status' => 'shipping']);
        }

        return back()->with('success', 'Bukti pengiriman berhasil diupload!');
    }

    // 7. PROSES KONFIRMASI TERIMA BARANG
    public function confirmReceipt($tradeId)
    {
        $trade = Trade::findOrFail($tradeId);
        $userId = Auth::id();

        // Cek siapa yang konfirmasi
        if ($userId == $trade->requester_id) {
            $trade->update(['requester_receipt_confirmed' => true]);
        } elseif ($userId == $trade->receiver_id) {
            $trade->update(['receiver_receipt_confirmed' => true]);
        }

        // Cek Logika: Jika KEDUANYA sudah konfirmasi terima, ubah status jadi 'completed'
        // (Kita refresh data trade dulu untuk ambil nilai terbaru)
        $trade->refresh();

        if ($trade->requester_receipt_confirmed && $trade->receiver_receipt_confirmed) {
            $trade->update(['status' => 'completed']);

            // Opsional: Barang statusnya diubah jadi 'sold' / 'swapped'
            $trade->offeredProduct->update(['status' => 'swapped']);
            $trade->requestedProduct->update(['status' => 'swapped']);
        }

        return back()->with('success', 'Barang berhasil dikonfirmasi!');
    }
}
