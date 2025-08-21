<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InputPengiriman; // model surat
use App\Models\PengirimanBarang; // model barang di surat
use Illuminate\Support\Facades\Response;

class PengeluaranController extends Controller
{
    public function index()
    {
        $surat = InputPengiriman::with('tujuan')->get();
        // Ambil barang yang tidak punya surat (input_pengiriman_id null)
        $barangTanpaSurat = PengirimanBarang::with('barang')
            ->whereNull('pengiriman_id')
            ->get();

        return view('pelaporan.pengeluaran.index', compact('surat', 'barangTanpaSurat'));
    }

    public function show($id)
    {
        $surat = InputPengiriman::with(['pengirimanBarang.barang'])->findOrFail($id);

        $barang = $surat->pengirimanBarang->map(function ($pb) {
            return [
                'nama_barang' => $pb->barang->nama_barang ?? '-',
                'kode_barang' => $pb->barang->kode_barang ?? '-',
                'jumlah' => $pb->jumlah,
                'satuan' => $pb->satuan ?? '-',
            ];
        });

        return response()->json($barang);
    }
}
