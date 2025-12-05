<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssistanceTypes;
class AssistanceController extends Controller
{
   public function index()
    {
        $assistance  = AssistanceTypes::all();
        return view('assistance.index',compact('assistance'));
    }

   public function create()
    {
        return view('assistance.create');
    }

   public function store(Request $request)
    {
        $request->validate([
        'jenis_bantuan' => 'required|string|max:255'
        ]);
        AssistanceTypes::create($request->all());
        return redirect()->route('assistance.index')->with('success','Jenis Bantuan Baru Berhasil Di Tambah');
    }

    public function edit($id)
    {
        $assistance = AssistanceTypes::findOrfail($id);
        return view('assistance.edit',compact('assistance'));

    }
    public function update(Request $request,$id)
    {
        $request->validate([
        'jenis_bantuan' => 'required|string|max:255'
        ]);

        $assistance = AssistanceTypes::findOrfail($id);
        $assistance->update($request->all());
        return redirect()->route('assistance.index')->with('success','jenis Bantuan Berhasil Di Perbaharui');
    }
    public function destroy($id)
    {
        $assistance = AssistanceTypes::findOrfail($id);
        $assistance->delete();
        return redirect()->route('assistance.index')->with('success','jenis Bantuan Berhasil Di Hapus');

    }
}
