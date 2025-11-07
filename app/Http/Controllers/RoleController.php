<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
class RoleController extends Controller
{
    public function index()
    {
        $role = Role::all();
        return view('role.index', compact('role'));
    }

    public function create()
    {
        return view('role.create');
    }

    public function store(Request $request)
    {
        $request->validate([
        'title' => 'required|string|max:255'
        ]);

        Role::create($request->all());
        return redirect()->route('role.index')->with('success','Data Jenis Admin Baru Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $role = Role::findOrfail($id);

        return view('role.edit', compact('role'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
        'title' => 'required|string|max:255',
        ]);

        $role = Role::findOrfail($id);
        $role->update($request->all());
        return redirect()->route('role.index')->with('success','Berhasil Mengubah Data Jenis Admin');
    }

    public function destroy($id)
    {
        $role = Role::findOrfail($id);
        $role->delete();

        return redirect()->route('role.index')->with('success','Berhasil Menghapus Jenis Admin');

    }
}
