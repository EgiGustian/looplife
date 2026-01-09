<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Trade;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 1. Barang Saya
        $myProducts = Product::where('user_id', $user->id)
            ->where('status', 'available') // <--- PASTIKAN BARIS INI ADA
            ->latest()
            ->get();

        // 2. Riwayat Transaksi
        $transactions = Trade::with(['offeredProduct', 'requestedProduct'])
            ->where(function ($q) use ($user) {
                $q->where('requester_id', $user->id)
                    ->orWhere('receiver_id', $user->id);
            })
            ->latest()
            ->get();

        // 3. [BARU] Penawaran Masuk (Incoming Offers)
        // Mencari trade dimana User login adalah PENERIMA dan statusnya masih PENDING
        $incomingOffers = Trade::with(['requester', 'offeredProduct', 'requestedProduct'])
            ->where('receiver_id', $user->id)
            ->where('status', 'pending')
            ->latest()
            ->get();

        return view('profile.index', compact('user', 'myProducts', 'transactions', 'incomingOffers'));
    }
}
