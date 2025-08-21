<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\PLogpal;
use App\Models\UsulanLogpal;
use App\Models\InputPengiriman;
use App\Models\Permohonan;
use App\Models\PengirimanBarang;
use App\Models\Sumber;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Filter
        $sumberId = $request->input('sumber_id');
        $tahun    = $request->input('tahun_anggaran');

        // Usulan Logpal
        $usulanLogpalCount = UsulanLogpal::when($sumberId, fn($q) => $q->where('sumber_id', $sumberId))
            ->when($tahun, fn($q) => $q->where('tahun_anggaran', $tahun))
            ->count();

        // Penerimaan Logistik & Peralatan (contoh: kategori_id 1 = logistik, 2 = peralatan)
        $penerimaanLogistik = Barang::where('kategori_id', 1)
            ->when($sumberId, fn($q) => $q->where('sumber_id', $sumberId))
            ->when($tahun, fn($q) => $q->where('tahun_anggaran', $tahun))
            ->count();

        $penerimaanPeralatan = Barang::where('kategori_id', 2)
            ->when($sumberId, fn($q) => $q->where('sumber_id', $sumberId))
            ->when($tahun, fn($q) => $q->where('tahun_anggaran', $tahun))
            ->count();

        // Penyimpanan
        $totalStok   = Barang::sum('stok');
        $totalHarga  = Barang::sum('total');
        $stokExpSoon = Barang::where('tanggal_kadaluwarsa', '<=', now()->addMonth())->get();

        // Pendistribusian
        $permohonanCount = Permohonan::count();
        $suratPengiriman = InputPengiriman::count();
        $totalKirimBarang = PengirimanBarang::sum('jumlah');
        $totalHargaKirim  = PengirimanBarang::with('barang')->get()
            ->sum(fn($pb) => $pb->jumlah * ($pb->barang->harga ?? 0));

        // Data filter
        $sumberList = Sumber::all();
        $tahunList = Barang::select('tahun_anggaran')->distinct()->pluck('tahun_anggaran');

        return view('dashboard.index', compact(
            'usulanLogpalCount',
            'penerimaanLogistik',
            'penerimaanPeralatan',
            'totalStok',
            'totalHarga',
            'stokExpSoon',
            'permohonanCount',
            'suratPengiriman',
            'totalKirimBarang',
            'totalHargaKirim',
            'sumberList',
            'tahunList',
            'sumberId',
            'tahun'
        ));
    }
}
