<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EducationLevel;

class EducationController extends Controller
{
   public function index()
    {
        $education = EducationLevel::all();
        return view('education.index',compact('education'));
    }

    public function create()
    {
        return view('education.create');
    }

    public function store(Request $request)
    {
        $request->validate([
        'strata_pendidikan' => 'required|string|max:255'
        ]);

        EducationLevel::create($request->all());
        return redirect()->route('education.index')->with('success','Data Pendidikan Baru Berhasil Ditambahkan');

    }

    public function edit($id)
    {
        $education = EducationLevel::findOrfail($id);

        return view('education.edit', compact('education'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
        'strata_pendidikan' => 'required|string|max:255',
        ]);

        $education = Educationlevel::findOrfail($id);
        $education->update($request->all());
        return redirect()->route('education.index')->with('success','Berhasil Mengubah Data Pendidikan');
    }

    public function destroy($id)
    {
        $education = EducationLevel::findOrfail($id);
        $education->delete();

        return redirect()->route('education.index')->with('success','Berhasil Menghapus Pendidikan');

    }
}
