<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;


class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all();
        return view('pengaturan.kategori.kategori', compact('kategoris'));
    }

    public function form()
    {
        return view('pengaturan.kategori.form_tambah_kategori');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required',
            'kode' => 'required|unique:kategoris,kode',
        ]);

        Kategori::create($request->all());
        return response()->json(['success' => true]);
    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('pengaturan.kategori.form_edit_kategori', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->update($request->all());
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        Kategori::destroy($id);
        return response()->json(['success' => true]);
    }
}