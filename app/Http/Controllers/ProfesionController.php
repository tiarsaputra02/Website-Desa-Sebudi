<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profesion;

class ProfesionController extends Controller
{
   public function index()
    {
        $profesion = Profesion::all();
        return view('profesion.index',compact('profesion'));
    }

    public function create()
    {
        return view('profesion.create');
    }

    public function store(Request $request)
    {
        $request->validate([
        'pekerjaan' => 'required|string|max:255'
        ]);

        Profesion::create($request->all());
        return redirect()->route('profesion.index')->with('success','Data pekerjaan Baru Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $profesion = Profesion::findOrfail($id);

        return view('profesion.edit', compact('profesion'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
        'pekerjaan' => 'required|string|max:255',
        ]);

        $profesion = Profesion::findOrfail($id);
        $profesion->update($request->all());
        return redirect()->route('profesion.index')->with('success','Berhasil Mengubah Data pekerjaan');
    }
    public function destroy($id)
    {
        $profesion = Profesion::findOrfail($id);
        $profesion->delete();

        return redirect()->route('profesion.index')->with('success','Berhasil Menghapus pekerjaan');

    }
}
