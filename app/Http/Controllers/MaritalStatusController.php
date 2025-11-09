<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MaritalStatus;

class MaritalStatusController extends Controller
{
    //
   public function index()
    {
        $maritalstatus = MaritalStatus::all();
        return view('marital.index',compact('maritalstatus'));
    }

    public function create()
    {
        return view('marital.create');
    }

    public function store(Request $request)
    {
        $request->validate([
        'status_pernikahan' => 'required|string|max:255'
        ]);

        Maritalstatus::create($request->all());
        return redirect()->route('marital.index')->with('success','Data Perkawinan Baru Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $maritalstatus = MaritalStatus::findOrfail($id);

        return view('marital.edit', compact('maritalstatus'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
        'status_pernikahan' => 'required|string|max:255',
        ]);

        $maritalstatus = MaritalStatus::findOrfail($id);
        $maritalstatus->update($request->all());
        return redirect()->route('marital.index')->with('success','Berhasil Mengubah Data Perkawinan');
    }
    public function destroy($id)
    {
        $maritalstatus = MaritalStatus::findOrfail($id);
        $maritalstatus->delete();

        return redirect()->route('marital.index')->with('success','Berhasil Menghapus Perkawinan');

    }
}
