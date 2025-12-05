<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BpjsMember;
use App\Models\Citizen;
class BpjsMemberPuraController extends Controller
{
    public function index()
    {
       $bpjs_member = BpjsMember::all();
        return view('bpjs.pura.index',compact('bpjs_member'));
    }

    public function create()
    {
        $citizen = Citizen::all()->where('wilayah_id', 8);
        return view('bpjs.pura.create',compact('citizen'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'warga_id' => 'required|integer',
            'jenis_bpjs' => 'required|string',
            'kategori' => 'required|string',
            'status' => 'required|string',
            'nomor_kartu'
        ]);

        BpjsMember::create($validatedData);
        return redirect()->route('bpjs.pura.index')->with('succes', 'Data Bpjs Berhasil Ditambahkan');

    }
}
