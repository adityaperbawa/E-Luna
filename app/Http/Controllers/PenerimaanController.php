<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PLogpal;
use App\Models\Barang;

class PenerimaanController extends Controller
{
    public function index()
    {
        $penerimaans = PLogpal::all();
        $barangs = Barang::all();

        return view('pelaporan.penerimaan.index', compact('penerimaans', 'barangs'));
    }

    public function detail($id)
    {
        $penerimaan = PLogpal::with('usulan')->findOrFail($id);
        return view('pelaporan.penerimaan.detail', compact('penerimaan'));
    }

}
