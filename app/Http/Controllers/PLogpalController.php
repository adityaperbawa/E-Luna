<?php

namespace App\Http\Controllers;

use App\Models\PLogpal;
use App\Models\UsulanLogpal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PLogpalController extends Controller
{
    public function index()
    {
        $data = PLogpal::with('usulan')->latest()->get();
        return view('penerimaan.plogpal.plogpal', compact('data'));
    }

    public function create()
    {
        $usulans = UsulanLogpal::all();
        return view('penerimaan.plogpal.form_tambah_plogpal', compact('usulans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'penerimaan' => 'required|in:logistik,peralatan',
            'usulan_id' => 'nullable|exists:usulan_logpals,id',
            'no_surat_bast' => 'nullable|string',
            'tanggal_surat' => 'nullable|date',
            'tanggal_masuk' => 'nullable|date',
            'nama_pengirim' => 'nullable|string',
            'no_whatsapp' => 'nullable|string',
            'dokumen_bast' => 'nullable|file|max:2048',
            'delivery_order' => 'nullable|file|max:2048',
            'stnk' => 'nullable|file|max:2048',
            'sim_driver' => 'nullable|file|max:2048',
            'foto_kendaraan' => 'nullable|file|max:2048',
            'foto_unloading' => 'nullable|file|max:2048',
        ]);

        $data = $request->except([
            'dokumen_bast',
            'delivery_order',
            'stnk',
            'sim_driver',
            'foto_kendaraan',
            'foto_unloading'
        ]);

        // Handle uploads
        foreach ([
            'dokumen_bast',
            'delivery_order',
            'stnk',
            'sim_driver',
            'foto_kendaraan',
            'foto_unloading'
        ] as $fileField) {
            if ($request->hasFile($fileField)) {
                $file = $request->file($fileField);
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/plogpal'), $fileName);
                $data[$fileField] = $fileName;
            }
        }

        PLogpal::create($data);

        return redirect()->route('plogpal.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = PLogpal::findOrFail($id);
        $usulans = UsulanLogpal::all();
        return view('penerimaan.plogpal.form_edit_plogpal', compact('data', 'usulans'));
    }

    public function update(Request $request, $id)
    {
        $logpal = PLogpal::findOrFail($id);

        $validated = $request->validate([
            'penerimaan' => 'required|in:logistik,peralatan',
            'usulan_id' => 'nullable|exists:usulan_logpals,id',
            'no_surat_bast' => 'nullable|string',
            'tanggal_surat' => 'nullable|date',
            'tanggal_masuk' => 'nullable|date',
            'nama_pengirim' => 'nullable|string',
            'no_whatsapp' => 'nullable|string',
            'dokumen_bast' => 'nullable|file|max:2048',
            'delivery_order' => 'nullable|file|max:2048',
            'stnk' => 'nullable|file|max:2048',
            'sim_driver' => 'nullable|file|max:2048',
            'foto_kendaraan' => 'nullable|file|max:2048',
            'foto_unloading' => 'nullable|file|max:2048',
        ]);

        $data = $request->except([
            'dokumen_bast',
            'delivery_order',
            'stnk',
            'sim_driver',
            'foto_kendaraan',
            'foto_unloading'
        ]);

        // File update
        foreach ([
            'dokumen_bast',
            'delivery_order',
            'stnk',
            'sim_driver',
            'foto_kendaraan',
            'foto_unloading'
        ] as $fileField) {
            if ($request->hasFile($fileField)) {
                $oldFile = public_path('uploads/plogpal/' . $logpal->$fileField);
                if (File::exists($oldFile))
                    File::delete($oldFile);

                $file = $request->file($fileField);
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/plogpal'), $fileName);
                $data[$fileField] = $fileName;
            }
        }

        $logpal->update($data);

        return redirect()->route('plogpal.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $logpal = PLogpal::findOrFail($id);

        // Hapus file jika ada
        foreach ([
            'dokumen_bast',
            'delivery_order',
            'stnk',
            'sim_driver',
            'foto_kendaraan',
            'foto_unloading'
        ] as $fileField) {
            $filePath = public_path('uploads/plogpal/' . $logpal->$fileField);
            if ($logpal->$fileField && File::exists($filePath)) {
                File::delete($filePath);
            }
        }

        $logpal->delete();

        return response()->json(['success' => true, 'message' => 'Data berhasil dihapus']);
    }
    public function rincian($id)
    {
        $data = PLogpal::findOrFail($id);
        return view('penerimaan.plogpal.rincian', compact('data'));
    }


}
