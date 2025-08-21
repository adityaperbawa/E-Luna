<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\InputPengiriman;
use Illuminate\Http\Request;

class PersediaanController extends Controller
{
    public function index()
    {
        // Ambil semua barang
        $barang = Barang::all();

        // Data persediaan
        $persediaan = $barang->map(function ($b) {
            return [
                'id'            => $b->id,
                'nama_barang'   => $b->nama_barang,
                'kode_barang'   => $b->kode_barang,
                'stok_akhir'    => $b->stok,
                'satuan'        => $b->satuan,
                'tanggal_masuk' => $b->created_at?->format('d-m-Y'),
                'tanggal_keluar'=> $b->updated_at?->format('d-m-Y'),
            ];
        });

        return view('pelaporan.persediaan.index', compact('persediaan'));
    }


}
