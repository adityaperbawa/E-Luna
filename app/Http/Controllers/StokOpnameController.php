<?php

namespace App\Http\Controllers;

use App\Models\StokOpname;
use Illuminate\Http\Request;

class StokOpnameController extends Controller
{
    public function index()
    {
        $stokOpnames = StokOpname::latest()->get();
        return view('fitur.stok_opname.stok_opname', compact('stokOpnames'));
    }

    public function create()
    {
        return view('fitur.stok_opname.form_tambah_stok_opname');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string',
            'tanggal' => 'required|date',
            'keterangan' => 'required|string',
        ]);

        StokOpname::create($request->all());

        return response()->json(['success' => true, 'message' => 'Stok opname berhasil ditambahkan']);
    }

    public function edit($id)
    {
        $stok = StokOpname::findOrFail($id);
        return view('fitur.stok_opname.form_edit_stok_opname', compact('stok'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string',
            'tanggal' => 'required|date',
            'keterangan' => 'required|string',
        ]);

        $stok = StokOpname::findOrFail($id);
        $stok->update($request->all());

        return response()->json(['success' => true, 'message' => 'Stok opname berhasil diperbarui']);
    }

    public function destroy($id)
    {
        $stok = StokOpname::findOrFail($id);
        $stok->delete();

        return response()->json(['success' => true, 'message' => 'Stok opname berhasil dihapus']);
    }
}
