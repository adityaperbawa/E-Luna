<?php

namespace App\Http\Controllers;

use App\Models\UsulanLogpal;
use App\Models\Sumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UsulanLogpalController extends Controller
{
    public function index()
    {
        $sumbers = Sumber::all();
        $usulanLogpals = UsulanLogpal::with('sumberData')->latest()->get();
        return view('penerimaan.usulan.usulan', compact('sumbers', 'usulanLogpals'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'no_surat' => 'required|string',
            'tanggal_surat' => 'required|date',
            'tahun_anggaran' => 'required|string',
            'sumber_id' => 'required|exists:sumbers,id',
            'dokumen' => 'required|file|mimes:pdf,docx,doc,jpg,jpeg,png|max:2048',
        ]);

        $file = $request->file('dokumen');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/dokumen'), $fileName);

        UsulanLogpal::create([
            'no_surat' => $request->no_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'tahun_anggaran' => $request->tahun_anggaran,
            'sumber_id' => $request->sumber_id,
            'dokumen' => $fileName,
        ]);

        return response()->json(['message' => 'Usulan Logpal berhasil disimpan.']);
    }

    public function edit($id)
    {
        $data = UsulanLogpal::findOrFail($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $usulan = UsulanLogpal::findOrFail($id);

        $request->validate([
            'no_surat' => 'required|string',
            'tanggal_surat' => 'required|date',
            'tahun_anggaran' => 'required|string',
            'sumber_id' => 'required|exists:sumbers,id',
            'dokumen' => 'nullable|file|mimes:pdf,docx,doc,jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['no_surat', 'tanggal_surat', 'tahun_anggaran']);
        $data['sumber_id'] = $request->sumber_id;


        // Jika file baru diunggah
        if ($request->hasFile('dokumen')) {
            $file = $request->file('dokumen');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/dokumen'), $fileName);

            // Hapus file lama jika ada
            $oldPath = public_path('uploads/dokumen/' . $usulan->dokumen);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }

            $data['dokumen'] = $fileName;
        }

        $usulan->update($data);

        return response()->json(['message' => 'Usulan Logpal berhasil diperbarui.']);
    }

    public function destroy($id)
    {
        $usulan = UsulanLogpal::findOrFail($id);

        // Hapus file jika ada
        $filePath = public_path('uploads/dokumen/' . $usulan->dokumen);
        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        $usulan->delete();

        return response()->json(['message' => 'Data berhasil dihapus.']);
    }
}
