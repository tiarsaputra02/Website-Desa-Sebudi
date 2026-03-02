<?php

namespace App\Http\Controllers;
use App\Models\FamilyHead;
use App\Models\JenisSurat;
use App\Models\Village;
use App\Models\citizen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FamilyHeadSebudiController extends Controller
{
    public function index()
    {
        $family = FamilyHead::with('village')
            ->orderBy('created_at', 'desc')
            ->where('wilayah_id',2)
            ->get();
        return view('family.sebudi.index', compact('family'));
    }

   public function create()
    {
       $village = Village::all();
       return view('family.sebudi.create',compact('village'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_kk' => ['required', 'digits:16', 'numeric', 'unique:family_heads,no_kk'],
            'kepala_keluarga' => ['required', 'string', 'max:255'],
            'wilayah_id' => ['required', 'exists:villages,id'],
            'photo_kk' => ['required', 'mimes:pdf','max:2048']
        ]);

        $photoPath = $request->file('photo_kk')->store('kk_photos', 'public');


        FamilyHead::create([
            'no_kk' => $request->no_kk,
            'kepala_keluarga' => $request->kepala_keluarga,
            'wilayah_id' => $request->wilayah_id,
            'photo_kk' => $photoPath,
        ]);

        return redirect()->route('sebudi.index')->with('success','Data Kepala_Keluarga Baru Berhasil Di Tambahkan');
    }

    public function edit($id)
    {

    $family = FamilyHead::findOrFail($id); // ambil data berdasarkan ID

    return view('family.sebudi.edit', compact('family'));
    }

    public function update(Request $request, $id)
    {
    $family = FamilyHead::findOrFail($id);

    $validated = $request->validate([
        'no_kk' => "required|digits:16|numeric|unique:family_heads,no_kk,{$family->id}",
        'kepala_keluarga' => 'required|string|max:255',
        'photo_kk' => 'nullable|mimes:pdf|max:5120', // max 5MB misal
    ]);

    // UPDATE FIELD BIASA
    $family->no_kk = $validated['no_kk'];
    $family->kepala_keluarga = $validated['kepala_keluarga'];

    // HANDLE UPLOAD PDF (jika ada)
    if ($request->hasFile('photo_kk')) {

        // Hapus file lama kalau ada
        if ($family->photo_kk && Storage::disk('public')->exists($family->photo_kk)) {
            Storage::disk('public')->delete($family->photo_kk);
        }

        // Simpan file baru ke storage/app/public/kk_photos
        $photoPath = $request->file('photo_kk')->store('kk_photos', 'public');

        // Simpan path baru ke model
        $family->photo_kk = $photoPath;
    }

    // Simpan perubahan
    $family->save();
    return redirect()->route('sebudi.index')->with('success', 'Data kepala keluarga berhasil Di Perbarui.');
    }

    public function destroy($id)
    {
        $family = FamilyHead::findOrFail($id);

        if ($family->photo_kk && Storage::disk('public')->exists($family->photo_kk)) {
            Storage::disk('public')->delete($family->photo_kk);
        }

        $family->delete();
        return redirect()->route('sebudi.index')->with('success', 'Data kepala keluarga berhasil Di Hapus.');

    }

    public function show($id)
    {
        $family = FamilyHead::with(['citizen','surat'])->findOrFail($id);
        $jenis_surat = JenisSurat::all();
        return view('family.sebudi.show',compact('family','jenis_surat'));

    }
}
