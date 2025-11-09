<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Religion;
class ReligionController extends Controller
{
   public function index()
    {
        $religion = Religion::all();
        return view('religion.index',compact('religion'));
    }

    public function create()
    {
        return view('religion.create');
    }

    public function store(Request $request)
    {
        $request->validate([
        'agama' => 'required|string|max:255'
        ]);

        Religion::create($request->all());
        return redirect()->route('religion.index')->with('success','Data Agama Baru Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $religion = Religion::findOrfail($id);

        return view('religion.edit', compact('religion'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
        'agama' => 'required|string|max:255',
        ]);

        $religion = Religion::findOrfail($id);
        $religion->update($request->all());
        return redirect()->route('religion.index')->with('success','Berhasil Mengubah Data Agama');
    }
    public function destroy($id)
    {
        $religion = Religion::findOrfail($id);
        $religion->delete();

        return redirect()->route('religion.index')->with('success','Berhasil Menghapus Agama');

    }
}
