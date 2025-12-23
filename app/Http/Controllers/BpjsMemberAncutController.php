<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BpjsMember;
use App\Models\Citizen;

class BpjsMemberAncutController extends Controller
{
    public function index()
    {
       $bpjs_member = BpjsMember::whereHas('citizen', fn($q) =>
        $q->where('wilayah_id', 6)
        )->get();
        return view('bpjs.ancut.index',compact('bpjs_member'));
    }

    public function create($id)
    {
        $citizen = $id;
        $data = Citizen::find($id);
        $nama = $data->nama_lengkap;
        return view('bpjs.ancut.create',compact('citizen','nama'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'warga_id' => 'required|integer',
            'jenis_bpjs' => 'required|string',
            'kategori' => 'required|string',
            'status' => 'required|string',
            'nomor_kartu'=> 'nullable'
        ]);

        BpjsMember::create($validatedData);
        return redirect()->route('bpjs.ancut.index')->with('success', 'Data Bpjs Berhasil Ditambahkan');

    }
    public function edit($id)
    {
        $bpjs_member = BpjsMember::findOrfail($id);
        return view('bpjs.ancut.edit', compact('bpjs_member'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'warga_id' => 'required|integer',
            'jenis_bpjs' => 'required|string',
            'kategori' => 'required|string',
            'status' => 'required|string',
            'nomor_kartu'=> 'nullable'
        ]);

        $bpjs_member = BpjsMember::findOrfail($id);
        $bpjs_member->update($validated);
        return redirect()->route('bpjs.ancut.index')->with('success', 'Data Bpjs Berhasil Diperbaharui');
    }
    public function destroy($id)
    {
      $bpjs = BpjsMember::findOrfail($id);
      $bpjs->delete();

      return redirect()->route('bpjs.ancut.index')->with('success', 'Data Bpjs Berhasil Dihapus');
    }
}
