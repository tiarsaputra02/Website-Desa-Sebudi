<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\Models\JenisSurat;
use Illuminate\Http\Request;

class JenisSuratController extends Controller
{
    public function index()
    {
        $jenisSurat = JenisSurat::orderBy('id', 'desc')->get();
        return view('jenis_surat.index', compact('jenisSurat'));
    }

    /**
     * Form tambah jenis surat
     */
    public function create()
    {
        return view('jenis_surat.create');
    }

    /**
     * Simpan jenis surat baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_surat' => 'required',
            'nama_surat' => 'required|string|max:255',
            'template_file' => 'nullable|file|mimes:docx,html',
            'aktif' => 'nullable|boolean',
        ]);

        $data = $request->only('kode_surat', 'nama_surat', 'aktif');

        // Upload template kalau ada
        if ($request->hasFile('template_file')) {
            $path = $request->file('template_file')->store('templates');
            $data['template_path'] = $path;
        }

        JenisSurat::create($data);

        return redirect()->route('jenis-surat.index')
                         ->with('success', 'Jenis Surat berhasil ditambahkan');
    }

    /**
     * Form edit jenis surat
     */
    public function edit(JenisSurat $jenis_surat)
    {
        return view('jenis_surat.edit', compact('jenis_surat'));
    }

    /**
     * Update jenis surat
     */
    public function update(Request $request, JenisSurat $jenis_surat)
    {
        $request->validate([
            'kode_surat' => 'required',
            'nama_surat' => 'required|string|max:255',
            'template_file' => 'nullable|file|mimes:docx,html',
            'aktif' => 'nullable|boolean',
        ]);

        $data = $request->only('kode_surat', 'nama_surat', 'aktif');

        // Upload template baru kalau ada
        if ($request->hasFile('template_file')) {
            // hapus template lama kalau ada
            if ($jenis_surat->template_path) {
                Storage::delete($jenis_surat->template_path);
            }
            $path = $request->file('template_file')->store('templates');
            $data['template_path'] = $path;
        }

        $jenis_surat->update($data);

        return redirect()->route('jenis-surat.index')
                         ->with('success', 'Jenis Surat berhasil diupdate');
    }

    /**
     * Hapus jenis surat
     */
    public function destroy(JenisSurat $jenis_surat)
    {
        // hapus template kalau ada
        if ($jenis_surat->template_path) {
            Storage::delete($jenis_surat->template_path);
        }

        $jenis_surat->delete();

        return redirect()->route('jenis-surat.index')
                         ->with('success', 'Jenis Surat berhasil dihapus');
    }
}
