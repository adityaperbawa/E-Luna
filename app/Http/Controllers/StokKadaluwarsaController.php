<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Support\Carbon;

class StokKadaluwarsaController extends Controller
{
    // Tampilkan list stok kadaluwarsa


    public function index()
    {
        $barangs = Barang::with('sumber', 'kategori')
            ->whereNotNull('tanggal_kadaluwarsa')
            ->get()
            ->map(function ($barang) {
                $expireDate = Carbon::parse($barang->tanggal_kadaluwarsa);
                $today = Carbon::today();
                $selisih = $today->diffInDays($expireDate, false); // false agar bisa minus
    
                $barang->expire = $selisih; // Bisa -1, 0, +3 dst
                return $barang;
            });

        return view('penyimpanan.barang.stok_kadaluwarsa', compact('barangs'));
    }


    // Detail barang kadaluwarsa
    public function show($id)
    {
        $barang = Barang::with('sumber', 'kategori')->findOrFail($id);
        return view('penyimpanan.barang.detail_kadaluwarsa', compact('barang'));
    }

    // Simpan catatan/status kadaluwarsa (via AJAX)
    public function showStatus($id)
    {
        $barang = Barang::findOrFail($id);
        return view('penyimpanan.barang.status', compact('barang'));

    }

    public function storeStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|max:255',
        ]);

        $barang = Barang::findOrFail($id);
        $barang->status = $request->status;
        $barang->save();

        return response()->json(['message' => 'Status berhasil disimpan.']);
    }
}
