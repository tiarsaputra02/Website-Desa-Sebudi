<?php

namespace App\Http\Controllers;

use App\Models\SuratDesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SuratDesaController extends Controller
{
    // ✅ INDEX
    public function index()
    {
        $surat = SuratDesa::latest()->get();
        return view('surat-desa.index', compact('surat'));
    }

    // ✅ CREATE
    public function create()
    {
        return view('surat-desa.create');
    }

    // ✅ STORE
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'kategori' => 'required',
            'tahun' => 'required|digits:4',
            'file' => 'required|mimes:pdf|max:20480'
        ]);

        $filePath = $request->file('file')
                            ->store('surat_desa', 'public');

        SuratDesa::create([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'tahun' => $request->tahun,
            'file' => $filePath
        ]);

        return redirect()
                ->route('SuratDesa.index')
                ->with('success', 'Surat berhasil diupload');
    }

    // ✅ EDIT
    public function edit($id)
    {
        $data = SuratDesa::findOrFail($id);
        return view('surat-desa.edit', compact('data'));
    }

    // ✅ UPDATE
    public function update(Request $request, $id)
    {
        $data = SuratDesa::findOrFail($id);

        $request->validate([
            'judul' => 'required|max:255',
            'kategori' => 'required',
            'tahun' => 'required|digits:4',
            'file' => 'nullable|mimes:pdf|max:4096'
        ]);

        if ($request->hasFile('file')) {

            // Hapus file lama
            if ($data->file && Storage::disk('public')->exists($data->file)) {
                Storage::disk('public')->delete($data->file);
            }

            $filePath = $request->file('file')
                                ->store('surat_desa', 'public');

            $data->file = $filePath;
        }

        $data->update([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'tahun' => $request->tahun,
        ]);

        return redirect()
                ->route('SuratDesa.index')
                ->with('success', 'Surat berhasil diperbarui');
    }

    // ✅ DELETE
    public function destroy($id)
    {
        $data = SuratDesa::findOrFail($id);

        if ($data->file && Storage::disk('public')->exists($data->file)) {
            Storage::disk('public')->delete($data->file);
        }

        $data->delete();

        return redirect()
                ->route('SuratDesa.index')
                ->with('success', 'Surat berhasil dihapus');
    }
}

