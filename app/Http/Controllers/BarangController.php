<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Sumber;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BarangController extends Controller
{
    // Menampilkan daftar barang
    public function index()
    {
        $barangs = Barang::with(['kategori', 'sumber'])->get();
        return view('penyimpanan.barang.barang', compact('barangs'));
    }

    // Tampilkan form tambah barang
    public function create()
    {
        $kategoris = Kategori::all();
        $sumbers = Sumber::all();
        return view('penyimpanan.barang.form_tambah_barang', compact('kategoris', 'sumbers'));
    }

    // Simpan barang baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'kode_barang' => 'required|unique:barangs,kode_barang',
            'kategori_id' => 'required|exists:kategoris,id',
            'sumber_id' => 'required|exists:sumbers,id',
            'tahun_anggaran' => 'required|digits:4',
            'stok' => 'required|integer|min:1',
            'stok_minimum' => 'nullable|integer|min:0',
            'satuan' => 'required',
            'harga' => 'required|numeric|min:0',
            'tanggal_kadaluwarsa' => 'nullable|date',
            'kode_3' => 'nullable|string',
            'kode_4' => 'nullable|string',
            'kode_5' => 'nullable|string',
        ]);

        $total = $request->stok * $request->harga;

        Barang::create([
            'nama_barang' => $request->nama_barang,
            'kode_barang' => $request->kode_barang,
            'kode_3' => $request->kode_3,
            'kode_4' => $request->kode_4,
            'kode_5' => $request->kode_5,
            'kategori_id' => $request->kategori_id,
            'sumber_id' => $request->sumber_id,
            'tahun_anggaran' => $request->tahun_anggaran,
            'stok' => $request->stok,
            'stok_minimum' => $request->stok_minimum ?? 0,
            'satuan' => $request->satuan,
            'harga' => $request->harga,
            'total' => $total,
            'tanggal_kadaluwarsa' => $request->tanggal_kadaluwarsa,
        ]);

        return response()->json(['message' => 'Data barang berhasil disimpan']);
    }


    // Tampilkan form edit
    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        $kategoris = Kategori::all();
        $sumbers = Sumber::all();
        return view('penyimpanan.barang.form_edit_barang', compact('barang', 'kategoris', 'sumbers'));
    }

    // Update data barang
    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        $request->validate([
            'nama_barang' => 'required',
            'kode_barang' => 'required|unique:barangs,kode_barang,' . $id,
            'kategori_id' => 'required|exists:kategoris,id',
            'sumber_id' => 'required|exists:sumbers,id',
            'tahun_anggaran' => 'required|digits:4',
            'stok' => 'required|integer|min:1',
            'stok_minimum' => 'nullable|integer|min:0',
            'satuan' => 'required',
            'harga' => 'required|numeric|min:0',
            'tanggal_kadaluwarsa' => 'nullable|date',
            'kode_3' => 'nullable|string',
            'kode_4' => 'nullable|string',
            'kode_5' => 'nullable|string',
        ]);

        $total = $request->stok * $request->harga;

        $barang->update([
            'nama_barang' => $request->nama_barang,
            'kode_barang' => $request->kode_barang,
            'kode_3' => $request->kode_3,
            'kode_4' => $request->kode_4,
            'kode_5' => $request->kode_5,
            'kategori_id' => $request->kategori_id,
            'sumber_id' => $request->sumber_id,
            'tahun_anggaran' => $request->tahun_anggaran,
            'stok' => $request->stok,
            'satuan' => $request->satuan,
            'harga' => $request->harga,
            'total' => $total,
            'tanggal_kadaluwarsa' => $request->tanggal_kadaluwarsa,
        ]);

        return response()->json(['message' => 'Data barang berhasil diperbarui']);
    }


    // Hapus data barang
    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return response()->json(['message' => 'Data barang berhasil dihapus']);
    }
    public function stokMinimumView()
    {
        $barangs = Barang::all();
        return view('penyimpanan.barang.stok_minimum', compact('barangs'));
    }

    public function updateStokMinimum(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:barangs,id',
            'stok_minimum' => 'required|integer|min:0',
        ]);

        $barang = Barang::find($request->id);
        $barang->stok_minimum = $request->stok_minimum;
        $barang->save();

        return response()->json(['success' => true, 'message' => 'Stok minimum diperbarui.']);
    }
}
