<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tujuan;

class TujuanController extends Controller
{
    public function index()
    {
        $tujuans = Tujuan::all();
        return view('pengaturan.tujuan.tujuan', compact('tujuans'));
    }

    public function create()
    {
        return view('pengaturan.tujuan.form_tambah_tujuan');
    }

    public function store(Request $request)
    {
        Tujuan::create($request->all());
        return response()->json(['success' => true]);
    }

    public function edit($id)
    {
        $tujuan = Tujuan::findOrFail($id);
        return view('pengaturan.tujuan.form_edit_tujuan', compact('tujuan'));
    }

    public function update(Request $request, $id)
    {
        $tujuan = Tujuan::findOrFail($id);
        $tujuan->update($request->all());
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        Tujuan::destroy($id);
        return response()->json(['success' => true]);
    }
}

