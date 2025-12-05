<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empeloyee;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{

    public function index()
    {
        $user = User::all();
        return view('user.index', compact('user'));
    }
    public function create()
    {
        $employe = Empeloyee::all();
        return view('user.create', compact('employe'));
    }
    public function store(Request $request)
    {
    // Validasi data
    $validated = $request->validate([
        'employe_id' => 'required|integer',
        'name'        => 'required|string|max:255',
        'email'       => 'required|email|unique:users,email',
        'password'    => 'required|string|min:6',
    ]);

    // Simpan user baru
    User::create([
        'employe_id' => $validated['employe_id'],
        'name'        => $validated['name'],
        'email'       => $validated['email'],
        'password'    => Hash::make($validated['password']), // penting!
    ]);

    return redirect()->route('user.index')->with('success', 'User berhasil dibuat!');
    }
    public function edit($id)
    {
        $user = User::findOrfail($id);

        return view('user.edit', compact('user'));
    }
    public function update(Request $request, $id)
    {
          $request->validate([
        'password' => 'required|min:6|confirmed',
    ]);

         $user = User::findOrFail($id);

        $user->update([
        'password' => Hash::make($request->password),

        ]);
    return redirect()->route('user.index')->with('success', 'User berhasil diupdate!');
    }
    public function destroy($id)
    {
        $user = User::findOrfail($id);
        $user->delete();
    return redirect()->route('user.index')->with('success', 'User berhasil dihapus!');
    }
}
