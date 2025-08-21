<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use App\Models\Kategori;
use Illuminate\Http\Request;

class GudangController extends Controller
{
    public function index()
    {
        $gudangs = Gudang::with('kategori')->get(); // Pastikan relasi `kategori` betul
        return view('pengaturan.gudang.gudang', compact('gudangs'));
    }


    public function create()
    {
        $kategoris = Kategori::all();
        return view('pengaturan.gudang.form_tambah_gudang', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'blok' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'keterangan' => 'required|string',
        ]);

        $kategori = Kategori::findOrFail($request->kategori_id);

        $qrContent = "Blok: {$request->blok} | Kategori: {$kategori->nama_kategori} | Keterangan: {$request->keterangan}";

        Gudang::create([
            'qr_code' => $qrContent,
            'blok' => $request->blok,
            'kategori_id' => $request->kategori_id,
            'keterangan' => $request->keterangan
        ]);


        return response()->json(['success' => true, 'message' => 'Gudang berhasil ditambahkan.']);
    }

    public function edit($id)
    {
        $gudang = Gudang::findOrFail($id);
        $kategoris = Kategori::all();
        return view('pengaturan.gudang.form_edit_gudang', compact('gudang', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'blok' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'keterangan' => 'required|string',
        ]);

        $gudang = Gudang::findOrFail($id);
        $kategori = Kategori::findOrFail($request->kategori_id);

        $qrContent = "Blok: {$request->blok} | Kategori: {$kategori->nama_kategori} | Keterangan: {$request->keterangan}";

        $gudang->update([
            'qr_code' => $qrContent,
            'blok' => $request->blok,
            'kategori_id' => $request->kategori_id,
            'keterangan' => $request->keterangan
        ]);


        return response()->json(['success' => true, 'message' => 'Gudang berhasil diupdate.']);
    }

    public function destroy($id)
    {
        Gudang::destroy($id);
        return response()->json(['success' => true, 'message' => 'Gudang berhasil dihapus.']);
    }
}
