<?php

// app/Http/Controllers/PengirimanBarangController.php
namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\InputPengiriman;
use App\Models\PengirimanBarang;
use Illuminate\Http\Request;

class PengirimanBarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();
        $surat = InputPengiriman::select('id', 'no_surat')->get();
        return view('pendistribusian.pengiriman_barang.pengiriman_barang', compact('barangs', 'surat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_data' => 'required|array',
            'barang_data.*.id' => 'exists:barangs,id',
            'barang_data.*.jumlah' => 'integer|min:1',
            'pengiriman_id' => 'nullable|exists:pengirimans,id',
        ]);

        $updatedStok = [];

        foreach ($request->barang_data as $item) {
            $barang = Barang::find($item['id']);
            if ($item['jumlah'] > $barang->stok) {
                return response()->json([
                    'message' => "Stok barang {$barang->nama_barang} tidak mencukupi!"
                ], 422);
            }
        }

        foreach ($request->barang_data as $item) {
            $barang = Barang::find($item['id']);

            PengirimanBarang::create([
                'barang_id' => $barang->id,
                'pengiriman_id' => $request->pengiriman_id,
                'jumlah' => $item['jumlah'],
                'status' => 'dikirim',
            ]);

            $barang->stok -= $item['jumlah'];
            $barang->save();

            $updatedStok[] = [
                'id' => $barang->id,
                'stok' => $barang->stok
            ];
        }

        return response()->json([
            'message' => 'Pengiriman berhasil disimpan!',
            'updated_stok' => $updatedStok
        ]);
    }

}

