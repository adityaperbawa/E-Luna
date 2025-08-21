<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        // Render view lengkap, misal halaman lengkap atau partial
        return view('pengaturan.pengguna.pengguna', compact('users'));
    }
    public function partial()
{
    $users = User::all();
    return view('pengaturan.pengguna.pengguna', compact('users'));
}

    public function form()
    {
        return view('pengaturan.pengguna.form_tambah_pengguna');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'jabatan' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6', // tambahkan validasi password
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'Operator'; // set default role

        User::create($validated);

        return response()->json(['success' => true]);
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('pengaturan.pengguna.form_edit_pengguna', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'jabatan' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6', // boleh kosong jika tidak diubah
        ]);

        // Jika password diisi, hash dan update
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']); // jangan ubah password
        }

        $user->update($validated);

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}


