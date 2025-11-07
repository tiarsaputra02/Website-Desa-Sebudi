<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Village;
class VillagesController extends Controller
{
    public function index()
    {
        $village = Village::all();
        return view('village.index', compact('village'));
    }
    public function create()
    {
        return view('village.create');
    }

    public function store(Request $request)
    {
        $request->validate([
        'nama_wilayah' => 'required|string|max:255'
        ]);

        Village::create($request->all());
        return redirect()->route('village.index')->with('success','Data Banjar Baru Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $village = Village::findOrfail($id);

        return view('village.edit', compact('village'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
        'nama_wilayah' => 'required|string|max:255',
        ]);

        $village = Village::findOrfail($id);
        $village->update($request->all());
        return redirect()->route('village.index')->with('success','Berhasil Mengubah Data Wilayah');
    }

    public function destroy($id)
    {
        $village = Village::findOrfail($id);
        $village->delete();
        return redirect()->route('village.index')->with('success','Berhasil Menghapus Data Wilayah');
    }
}
