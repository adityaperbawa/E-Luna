<?php

namespace App\Http\Controllers;

use App\Models\Permohonan;
use App\Models\Tujuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class PermohonanController extends Controller
{
    /* ------------------------------------------------------------
     *  LIST
     * ---------------------------------------------------------- */
    public function index()
    {
        $permohonans = Permohonan::with('tujuan')->latest()->get();

        return view(
            'pendistribusian.permohonan_kabkota.permohonan',
            compact('permohonans')
        );
    }

    /* ------------------------------------------------------------
     *  FORM TAMBAH
     * ---------------------------------------------------------- */
    public function create()
    {
        $tujuans = Tujuan::orderBy('kab_kota')->get();

        return view(
            'pendistribusian.permohonan_kabkota.form_tambah_permohonan',
            compact('tujuans')
        );
    }

    /* ------------------------------------------------------------
     *  STORE
     * ---------------------------------------------------------- */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tujuan_id'     => ['required', Rule::exists('tujuans', 'id')],
            'no_surat'      => ['required', 'string', 'max:255', 'regex:/\/+/'],
            'tanggal_surat' => ['required', 'date'],
            'tahun_surat'   => ['nullable', 'digits:4'],
            'keperluan'        => ['required', 'string'],
            'dokumen'       => ['required', 'file', 'mimes:pdf,doc,docx,jpg,jpeg,png', 'max:5120'],
        ]);

        /* Isi tahun_surat otomatis jika kosong */
        if (empty($validated['tahun_surat'])) {
            $validated['tahun_surat'] = Carbon::parse($validated['tanggal_surat'])->year;
        }

        /* Upload dokumen */
        $validated['dokumen'] = $request->file('dokumen')
                                        ->store('dokumen_permohonan', 'public');

        $permohonan = Permohonan::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Permohonan berhasil disimpan.',
            'data'    => $permohonan->load('tujuan'),
        ]);
    }

    /* ------------------------------------------------------------
     *  RINCIAN
     * ---------------------------------------------------------- */
    public function show(Permohonan $permohonan)
    {
        return view(
            'pendistribusian.permohonan_kabkota.rincian',
            compact('permohonan')
        );
    }

    /* ------------------------------------------------------------
     *  FORM EDIT
     * ---------------------------------------------------------- */
    public function edit(Permohonan $permohonan)
    {
        $tujuans = Tujuan::orderBy('kab_kota')->get();

        return view(
            'pendistribusian.permohonan_kabkota.form_edit_permohonan',
            compact('permohonan', 'tujuans')
        );
    }

    /* ------------------------------------------------------------
     *  UPDATE
     * ---------------------------------------------------------- */
    public function update(Request $request, Permohonan $permohonan)
    {
        $validated = $request->validate([
            'tujuan_id'     => ['required', Rule::exists('tujuans', 'id')],
            'no_surat'      => ['required', 'string', 'max:255', 'regex:/\/+/'],
            'tanggal_surat' => ['required', 'date'],
            'tahun_surat'   => ['nullable', 'digits:4'],
            'keperluan'        => ['required', 'string'],
            'dokumen'       => ['nullable', 'file', 'mimes:pdf,doc,docx,jpg,jpeg,png', 'max:5120'],
        ]);

        if (empty($validated['tahun_surat'])) {
            $validated['tahun_surat'] = Carbon::parse($validated['tanggal_surat'])->year;
        }

        /* Jika upload dokumen baru – hapus lama */
        if ($request->hasFile('dokumen')) {

            if ($permohonan->dokumen &&
                Storage::disk('public')->exists($permohonan->dokumen)) {
                Storage::disk('public')->delete($permohonan->dokumen);
            }

            $validated['dokumen'] = $request->file('dokumen')
                                            ->store('dokumen_permohonan', 'public');
        }

        $permohonan->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Permohonan berhasil diupdate.',
            'data'    => $permohonan->load('tujuan'),
        ]);
    }

    /* ------------------------------------------------------------
     *  DELETE
     * ---------------------------------------------------------- */
    public function destroy(Permohonan $permohonan)
    {
        if ($permohonan->dokumen &&
            Storage::disk('public')->exists($permohonan->dokumen)) {
            Storage::disk('public')->delete($permohonan->dokumen);
        }

        $permohonan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Permohonan berhasil dihapus.',
        ]);
    }
}
