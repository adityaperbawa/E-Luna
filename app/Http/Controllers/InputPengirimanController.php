<?php

namespace App\Http\Controllers;

use App\Models\InputPengiriman;
use App\Models\Tujuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InputPengirimanController extends Controller
{
    public function index()
    {
        $pengirimen = InputPengiriman::with('tujuan')->latest()->get();
        return view('pendistribusian.input_pengiriman.pengiriman', compact('pengirimen'));
    }

    public function create()
    {
        $tujuans = Tujuan::all();
        return view('pendistribusian.input_pengiriman.form_tambah_pengiriman', compact('tujuans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_surat' => 'required|string',
            'tanggal_surat' => 'required|date',
            'tanggal_pengiriman' => 'required|date',
            'tujuan_id' => 'required|exists:tujuans,id',
            'lokasi_tujuan' => 'required|in:sama,tidak sama',
            'tahun' => 'required|numeric',
            'dokumen_bast' => 'nullable|file',
            'delivery_order' => 'nullable|file',
            'no_wa' => 'nullable|file',
            'stnk' => 'nullable|file',
            'sim_driver' => 'nullable|file',
            'foto_kendaraan' => 'nullable|file',
            'unloading' => 'nullable|file',
        ]);

        $dokumenFields = [
            'dokumen_bast',
            'delivery_order',
            'no_wa',
            'stnk',
            'sim_driver',
            'foto_kendaraan',
            'unloading'
        ];

        foreach ($dokumenFields as $field) {
            if ($request->hasFile($field)) {
                $validated[$field] = $request->file($field)->store('pengiriman', 'public');
            }
        }

        InputPengiriman::create($validated);

        return response()->json(['success' => true, 'message' => 'Pengiriman berhasil ditambahkan']);
    }

    public function edit($id)
    {
        $pengiriman = InputPengiriman::findOrFail($id);
        $tujuans = Tujuan::all();

        $dokumens = [
            'dokumen_bast' => 'Dokumen BAST Prov ke Kab/Kota',
            'delivery_order' => 'Delivery Order',
            'no_wa' => 'No WA',
            'stnk' => 'STNK',
            'sim_driver' => 'SIM Driver',
            'foto_kendaraan' => 'Foto Kendaraan',
            'unloading' => 'Foto/Video Unloading',
        ];

        return view('pendistribusian.input_pengiriman.form_edit_pengiriman', compact('pengiriman', 'tujuans', 'dokumens'));
    }

    public function update(Request $request, $id)
    {
        $pengiriman = InputPengiriman::findOrFail($id);

        $validated = $request->validate([
            'no_surat' => 'required|string',
            'tanggal_surat' => 'required|date',
            'tanggal_pengiriman' => 'required|date',
            'tujuan_id' => 'required|exists:tujuans,id',
            'lokasi_tujuan' => 'required|in:sama,tidak sama',
            'tahun' => 'required|numeric',
            'dokumen_bast' => 'nullable|file',
            'delivery_order' => 'nullable|file',
            'no_wa' => 'nullable|file',
            'stnk' => 'nullable|file',
            'sim_driver' => 'nullable|file',
            'foto_kendaraan' => 'nullable|file',
            'unloading' => 'nullable|file',
        ]);

        $dokumenFields = [
            'dokumen_bast',
            'delivery_order',
            'no_wa',
            'stnk',
            'sim_driver',
            'foto_kendaraan',
            'unloading'
        ];

        foreach ($dokumenFields as $field) {
            if ($request->hasFile($field)) {
                // Hapus file lama jika ada
                if ($pengiriman->$field) {
                    Storage::disk('public')->delete($pengiriman->$field);
                }
                $validated[$field] = $request->file($field)->store('pengiriman', 'public');
            }
        }

        $pengiriman->update($validated);

        return response()->json(['success' => true, 'message' => 'Data pengiriman berhasil diperbarui']);
    }

    public function destroy($id)
    {
        $pengiriman = InputPengiriman::findOrFail($id);

        $dokumenFields = [
            'dokumen_bast',
            'delivery_order',
            'no_wa',
            'stnk',
            'sim_driver',
            'foto_kendaraan',
            'unloading'
        ];

        foreach ($dokumenFields as $field) {
            if ($pengiriman->$field) {
                Storage::disk('public')->delete($pengiriman->$field);
            }
        }

        $pengiriman->delete();

        return response()->json(['success' => true, 'message' => 'Data pengiriman berhasil dihapus']);
    }

    public function show($id)
    {
        $pengiriman = InputPengiriman::with('tujuan')->findOrFail($id);

        $dokumens = [
            'dokumen_bast' => 'Dokumen BAST Prov ke Kab/Kota',
            'delivery_order' => 'Delivery Order',
            'no_wa' => 'No WA',
            'stnk' => 'STNK',
            'sim_driver' => 'SIM Driver',
            'foto_kendaraan' => 'Foto Kendaraan',
            'unloading' => 'Foto/Video Unloading',
        ];

        return view('pendistribusian.input_pengiriman.rincian', compact('pengiriman', 'dokumens'));
    }
}
