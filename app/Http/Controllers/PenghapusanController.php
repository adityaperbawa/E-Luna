<?php

namespace App\Http\Controllers;

use App\Models\Penghapusan;
use Illuminate\Http\Request;

class PenghapusanController extends Controller
{
    public function index()
    {
        $penghapusans = Penghapusan::latest()->get();
        return view('fitur.penghapusan.penghapusan', compact('penghapusans'));
    }

    public function create()
    {
        return view('fitur.penghapusan.form_tambah_penghapusan');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string',
            'tanggal' => 'required|date',
            'keterangan' => 'required|string'
        ]);

        Penghapusan::create($validated);
        return response()->json(['success' => true, 'message' => 'Data berhasil ditambahkan']);
    }

    public function edit($id)
    {
        $penghapusan = Penghapusan::findOrFail($id);
        return view('fitur.penghapusan.form_edit_penghapusan', compact('penghapusan'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'judul' => 'required|string',
            'tanggal' => 'required|date',
            'keterangan' => 'required|string'
        ]);

        $penghapusan = Penghapusan::findOrFail($id);
        $penghapusan->update($validated);

        return response()->json(['success' => true, 'message' => 'Data berhasil diperbarui']);
    }

    public function destroy($id)
    {
        $penghapusan = Penghapusan::findOrFail($id);
        $penghapusan->delete();

        return response()->json(['success' => true, 'message' => 'Data berhasil dihapus']);
    }

    public function show($id)
    {
        $penghapusan = Penghapusan::findOrFail($id);
        return view('fitur.penghapusan.rincian', compact('penghapusan'));
    }
}
