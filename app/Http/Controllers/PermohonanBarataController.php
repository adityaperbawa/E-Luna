<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PermohonanBarata;
use App\Models\Tujuan;
use Illuminate\Support\Facades\Storage;

class PermohonanBarataController extends Controller
{
    public function index()
    {
        $permohonans = PermohonanBarata::with('tujuan')->latest()->get();
        return view('pendistribusian.permohonan_barata.permohonan', compact('permohonans'));
    }

    public function create()
    {
        $tujuans = Tujuan::all();
        return view('pendistribusian.permohonan_barata.form_tambah_permohonan', compact('tujuans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tujuan_id' => 'required',
            'tanggal_kejadian' => 'required|date',
            'kejadian' => 'required',
            'no_surat' => 'required',
            'dokumen' => ['nullable', 'file', 'mimes:pdf,doc,docx,jpg,jpeg,png', 'max:5120'],
        ]);

        $data = $request->only(['tujuan_id', 'tanggal_kejadian', 'kejadian', 'no_surat']);

        if ($request->hasFile('dokumen')) {
            $file = $request->file('dokumen');
            $path = $file->store('dokumen_barata', 'public');
            $data['dokumen'] = $path;
            $data['status'] = 'Belum Diproses';
        }


        PermohonanBarata::create($data);

        return response()->json(['message' => 'Data berhasil disimpan']);
    }


    public function edit($id)
    {
        $permohonan = PermohonanBarata::findOrFail($id);
        $tujuans = Tujuan::all();
        return view('pendistribusian.permohonan_barata.form_edit_permohonan', compact('permohonan', 'tujuans'));
    }

    public function update(Request $request, $id)
    {
        $permohonan = PermohonanBarata::findOrFail($id);

        $validated = $request->validate([
            'tujuan_id' => 'required|exists:tujuans,id',
            'tanggal_kejadian' => 'required|date',
            'kejadian' => 'required|string',
            'no_surat' => 'required|string',
            'dokumen' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('dokumen')) {
            // Hapus file lama jika ada
            if ($permohonan->dokumen && Storage::exists($permohonan->dokumen)) {
                Storage::delete($permohonan->dokumen);
            }
            $validated['dokumen'] = $request->file('dokumen')->store('dokumen/barata');
        }

        $permohonan->update($validated);

        return response()->json(['message' => 'Data berhasil diperbarui']);
    }

    public function destroy($id)
    {
        $permohonan = PermohonanBarata::findOrFail($id);
        if ($permohonan->dokumen && Storage::exists($permohonan->dokumen)) {
            Storage::delete($permohonan->dokumen);
        }
        $permohonan->delete();

        return response()->json(['message' => 'Data berhasil dihapus']);
    }

    public function show($id)
    {
        $permohonan = PermohonanBarata::with('tujuan')->findOrFail($id);
        return view('pendistribusian.permohonan_barata.rincian', compact('permohonan'));
    }

    public function setuju($id)
    {
        $permohonan = PermohonanBarata::findOrFail($id);
        $permohonan->update(['status' => 'disetujui']);
        return response()->json(['message' => 'Permohonan disetujui']);
    }

    public function tolak($id)
    {
        $permohonan = PermohonanBarata::findOrFail($id);
        $permohonan->update(['status' => 'ditolak']);
        return response()->json(['message' => 'Permohonan ditolak']);
    }
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:disetujui,ditolak',
        ]);

        $permohonan = PermohonanBarata::findOrFail($id);

        // Cegah perubahan status jika sudah pernah diputuskan
        if (in_array($permohonan->status, ['disetujui', 'ditolak'])) {
            return response()->json([
                'success' => false,
                'message' => 'Status sudah ditetapkan dan tidak bisa diubah lagi.'
            ], 400);
        }

        $permohonan->status = $request->status;
        $permohonan->save();

        return response()->json(['success' => true, 'message' => 'Status berhasil diperbarui.']);
    }

}
