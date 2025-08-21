<?php

namespace App\Http\Controllers;

use App\Models\Sumber;
use Illuminate\Http\Request;

class SumberController extends Controller
{
    public function index()
    {
        $sumbers = Sumber::all();
        return view('pengaturan.sumber.sumber', compact('sumbers'));
    }

    public function form()
    {
        return view('pengaturan.sumber.form_tambah_sumber');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_sumber' => 'required|string|max:255',
            'kode' => 'required|string|max:100|unique:sumbers,kode',
        ]);

        Sumber::create($validated);
        return response()->json(['success' => true]);
    }

    public function edit($id)
    {
        $sumber = Sumber::findOrFail($id);
        return view('pengaturan.sumber.form_edit_sumber', compact('sumber'));
    }

    public function update(Request $request, $id)
    {
        $sumber = Sumber::findOrFail($id);
        $validated = $request->validate([
            'nama_sumber' => 'required|string|max:255',
            'kode' => 'required|string|max:100|unique:sumbers,kode,' . $id,
        ]);
        $sumber->update($validated);
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        Sumber::destroy($id);
        return response()->json(['success' => true]);
    }

    public function partial()
    {
        $sumbers = Sumber::all();
        return view('pengaturan.sumber.sumber', compact('sumbers'));
    }
}
