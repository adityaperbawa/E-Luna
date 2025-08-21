<?php

namespace App\Http\Controllers;

use App\Models\RencanaAlokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RencanaAlokasiController extends Controller
{
    public function index()
    {
        $data = RencanaAlokasi::all();
        return view('penyimpanan.rencana.rencana', compact('data'));
    }

    public function create()
    {
        return view('penyimpanan.rencana.form_tambah_rencana');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_surat' => 'required|string',
            'tanggal' => 'required|date',
            'tahun' => 'required|digits:4',
            'dokumen' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        ]);

        $dokumenPath = $request->file('dokumen')->store('dokumen_alokasi', 'public');

        RencanaAlokasi::create([
            'no_surat' => $validated['no_surat'],
            'tanggal' => $validated['tanggal'],
            'tahun' => $validated['tahun'],
            'dokumen' => $dokumenPath,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Rencana alokasi berhasil disimpan.'
        ]);
    }
    public function edit($id)
    {
        $rencana = RencanaAlokasi::findOrFail($id);
        return view('penyimpanan.rencana.form_edit_rencana', compact('rencana'));
    }

    public function update(Request $request, $id)
    {
        $rencana = RencanaAlokasi::findOrFail($id);

        $validated = $request->validate([
            'no_surat' => 'required|string',
            'tanggal' => 'required|date',
            'tahun' => 'required|digits:4',
            'dokumen' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('dokumen')) {
            if ($rencana->dokumen && Storage::exists($rencana->dokumen)) {
                Storage::delete($rencana->dokumen);
            }
            $validated['dokumen'] = $request->file('dokumen')->store('dokumen_alokasi');
        }

        $rencana->update($validated);

        return response()->json(['success' => true, 'message' => 'Data berhasil diupdate']);
    }

    public function setStatus($id, Request $request)
    {
        $request->validate([
            'status' => 'required|in:disetujui,ditolak',
        ]);

        $rencana = RencanaAlokasi::findOrFail($id);

        // Cegah ubah status jika sudah disetujui / ditolak
        if (in_array($rencana->status, ['disetujui', 'ditolak'])) {
            return response()->json([
                'success' => false,
                'message' => 'Status sudah ditetapkan dan tidak bisa diubah lagi.'
            ], 400);
        }

        $rencana->status = $request->status;
        $rencana->save();

        return response()->json(['success' => true, 'message' => 'Status diperbarui']);
    }

    public function destroy($id)
    {
        $data = RencanaAlokasi::findOrFail($id);
        if ($data->dokumen && Storage::exists($data->dokumen)) {
            Storage::delete($data->dokumen);
        }
        $data->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus.'
        ]);

    }
}
