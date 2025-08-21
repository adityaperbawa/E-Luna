<?php

namespace App\Http\Controllers;

use App\Models\LokasiBarang;
use App\Models\Barang;
use App\Models\Gudang;
use App\Models\Kategori;
use Illuminate\Http\Request;

class LokasiBarangController extends Controller
{
    public function index()
    {
        $lokasis = LokasiBarang::with(['barang', 'gudang'])->get();
        return view('penyimpanan.lokasi.lokasi', compact('lokasis'));
    }

    public function create()
    {
        $gudangs = Gudang::all();
        $kategoris = Kategori::all();
        $barangs = Barang::all();
        return view('penyimpanan.lokasi.form_tambah_lokasi', compact('gudangs', 'kategoris', 'barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'gudang_id' => 'required|exists:gudangs,id',
            'barangs' => 'required|array|min:1',
            'barangs.*.id' => 'required|exists:barangs,id',
            'barangs.*.stok' => 'required|integer|min:1',
            'barangs.*.catatan' => 'nullable|string',
        ]);

        $errors = [];

        foreach ($request->barangs as $barangInput) {
            $barang = Barang::find($barangInput['id']);
            $jumlahMasuk = (int) $barangInput['stok'];

            if ($jumlahMasuk > $barang->stok) {
                $errors[] = "Stok untuk <strong>{$barang->nama_barang}</strong> melebihi stok tersedia ({$barang->stok})";
            }
        }

        if (!empty($errors)) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi stok gagal.',
                'errors' => ['stok' => $errors]
            ], 422);
        }

        foreach ($request->barangs as $barang) {
            LokasiBarang::create([
                'gudang_id' => $request->gudang_id,
                'barang_id' => $barang['id'],
                'stok' => $barang['stok'],
                'catatan' => $barang['catatan'] ?? null,
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Data lokasi barang berhasil disimpan']);
    }



    public function edit($id)
    {
        $lokasi = LokasiBarang::findOrFail($id);
        $gudangs = Gudang::all();
        $barangs = Barang::all(); // tampilkan semua barang untuk edit
        return view('penyimpanan.lokasi.form_edit_lokasi', compact('lokasi', 'gudangs', 'barangs'));
    }

    public function update(Request $request, $id)
    {
        $lokasi = LokasiBarang::findOrFail($id);

        $validated = $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'gudang_id' => 'required|exists:gudangs,id',
            'stok' => 'required|integer|min:1',
            'catatan' => 'nullable|string',
        ]);

        // Ambil data barang yang ingin diupdate
        $barang = Barang::find($validated['barang_id']);

        // Hitung total stok lokasi untuk barang ini, kecuali lokasi yang sedang diedit
        $stokSudahDipakai = LokasiBarang::where('barang_id', $validated['barang_id'])
            ->where('id', '!=', $id)
            ->sum('stok');

        $stokMaksimal = $barang->stok - $stokSudahDipakai;

        if ($validated['stok'] > $stokMaksimal) {
            return response()->json([
                'success' => false,
                'message' => "Stok melebihi batas maksimal. Sisa stok tersedia hanya {$stokMaksimal}",
                'errors' => [
                    'stok' => [
                        "Stok untuk <strong>{$barang->nama_barang}</strong> tidak boleh melebihi sisa stok ({$stokMaksimal})"
                    ]
                ]
            ], 422);
        }

        $lokasi->update($validated);

        return response()->json(['success' => true, 'message' => 'Data lokasi barang berhasil diupdate']);
    }


    public function destroy($id)
    {
        LokasiBarang::destroy($id);
        return response()->json(['success' => true, 'message' => 'Data lokasi barang berhasil dihapus']);
    }

    // Ajax untuk ambil barang berdasarkan kategori
    public function getBarangByKategori($kategori_id)
    {
        $barangs = Barang::where('kategori_id', $kategori_id)->get();
        return response()->json($barangs);
    }
}
