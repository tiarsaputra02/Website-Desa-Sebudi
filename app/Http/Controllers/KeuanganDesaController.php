<?php

namespace App\Http\Controllers;

use App\Models\Apbdes;
use App\Models\TahunAnggaran;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KeuanganDesaController extends Controller
{
    /**
     * Tampilkan daftar tahun + APBDes
     */
    public function index()
    {
        $tahun = TahunAnggaran::with('apbdes')->orderBy('tahun', 'desc')->get();
        return view('keuangan.index', compact('tahun'));
    }

    /**
     * Form tambah / edit APBDes
     */
    public function create()
    {
        $tahun = TahunAnggaran::orderBy('tahun', 'desc')->get();
        return view('keuangan.create', compact('tahun'));
    }

    /**
     * Simpan tahun + APBDes sekaligus
     */
    public function store(Request $request)
    {
        $request->validate([
            'tahun_id' => 'nullable|exists:tahun_anggaran,id',
            'tahun_baru' => 'nullable|integer|unique:tahun_anggaran,tahun',
            'status' => ['required', Rule::in(['aktif','arsip'])],
            'total_pendapatan' => 'required|numeric|min:0',
            'total_belanja' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string',
        ]);

        // 1️⃣ Handle Tahun
        if ($request->tahun_baru) {
            $tahun = TahunAnggaran::create([
                'tahun' => $request->tahun_baru,
                'status' => $request->status,
            ]);
        } else {
            $tahun = TahunAnggaran::findOrFail($request->tahun_id);

            // Update status jika perlu
            $tahun->update([
                'status' => $request->status
            ]);
        }

        // 2️⃣ Cek APBDes dobel
        if (Apbdes::where('tahun_id', $tahun->id)->exists()) {
            return redirect()->back()->withErrors(['tahun_id' => 'APBDes untuk tahun ini sudah ada']);
        }

        // 3️⃣ Simpan APBDes
        Apbdes::create([
            'tahun_id' => $tahun->id,
            'total_pendapatan' => $request->total_pendapatan,
            'total_belanja' => $request->total_belanja,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('keuangan.index')->with('success', 'Data APBDes berhasil disimpan');
    }

    /**
 * Form edit APBDes
 */
public function edit(Apbdes $apbdes)
{
    $tahun = TahunAnggaran::orderBy('tahun', 'desc')->get();
    return view('keuangan.edit', compact('apbdes', 'tahun'));
}

/**
 * Update APBDes + Tahun
 */
public function update(Request $request, Apbdes $apbdes)
{
    $request->validate([
        'tahun_id' => 'nullable|exists:tahun_anggaran,id',
        'tahun_baru' => 'nullable|integer|unique:tahun_anggaran,tahun,' . ($request->tahun_id ?? 'null'),
        'status' => ['required', Rule::in(['aktif','arsip'])],
        'total_pendapatan' => 'required|numeric|min:0',
        'total_belanja' => 'required|numeric|min:0',
        'keterangan' => 'nullable|string',
    ]);

    // 1️⃣ Handle Tahun
    if ($request->tahun_baru) {
        $tahun = TahunAnggaran::create([
            'tahun' => $request->tahun_baru,
            'status' => $request->status,
        ]);
    } else {
        $tahun = TahunAnggaran::findOrFail($request->tahun_id);
        $tahun->update([
            'status' => $request->status
        ]);
    }

    // 2️⃣ Update APBDes
    $apbdes->update([
        'tahun_id' => $tahun->id,
        'total_pendapatan' => $request->total_pendapatan,
        'total_belanja' => $request->total_belanja,
        'keterangan' => $request->keterangan,
    ]);

    return redirect()->route('keuangan.index')->with('success', 'Data APBDes berhasil diperbarui');
}

    /**
     * Hapus APBDes + tahun jika perlu
     */
    public function destroy(Apbdes $apbdes)
    {
        $apbdes->delete();
        return redirect()->route('keuangan.index')->with('success', 'Data APBDes berhasil dihapus');
    }
}

