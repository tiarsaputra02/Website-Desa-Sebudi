<?php

namespace App\Http\Controllers;
use App\Models\FamilyHead;
use App\Models\JenisSurat;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Surat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Citizen;
use PhpOffice\PhpWord\TemplateProcessor;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    private function bulanRomawi($bulan)
{
    $romawi = [
        1 => 'I', 2 => 'II', 3 => 'III',
        4 => 'IV', 5 => 'V', 6 => 'VI',
        7 => 'VII', 8 => 'VIII', 9 => 'IX',
        10 => 'X', 11 => 'XI', 12 => 'XII'
    ];

    return $romawi[$bulan];
}

    public function create($familyId, $jenisId, Request $request)
    {
    $redirect = $request->get('redirect');

    $family = FamilyHead::with([
        'citizen.villages',
        'citizen.religion'
    ])->findOrFail($familyId);
    $jenis = JenisSurat::findOrFail($jenisId);
    // Ambil kepala keluarga (ayah)
    $ayah = $family->citizen
        ->where('status_keluarga', 'Kepala Keluarga')
        ->first();
    $village = $ayah->villages;
        $alamatAyah = implode(', ', array_filter([
        $village?->nama_wilayah,
        $village?->desa ? 'Desa ' . $village->desa : null,
        $village?->kecamatan ? 'Kecamatan ' . $village->kecamatan : null,
        $village?->kabupaten ? 'Kabupaten ' . $village->kabupaten : null,
        $village?->provinsi ? 'Provinsi ' . $village->provinsi : null,
        ]));
    
    $agamaAyah  = $ayah?->religion?->agama;

    return view('surat.create', compact(
        'family',
        'jenis',
        'redirect',
        'agamaAyah',
        'alamatAyah'
    ));
    }

    public function store(Request $request, FamilyHead $family, JenisSurat $jenis)
    {
// ======================
    // VALIDASI UMUM
    // ======================
    $rules = [];

    switch ($jenis->slug) {
        case 'surat-keterangan-kelahiran':
            $rules = [
                'nama_anak' => 'nullable',
                'tanggal_lahir_anak' => 'nullable',
                'jam_lahir' => 'nullable',
                'ayah_id' => 'nullable',
                'ibu_id' => 'nullable',
            ];
            break;

        case 'surat-keterangan-belum-penah-kawin':
            $rules = [
                'pemohon_id' => 'nullable', // pilih warga dari family head
            ];
            break;
    }

    $request->validate($rules);
    return DB::transaction(function () use ($request, $family, $jenis) {
if ($jenis->slug === 'surat-keterangan-kelahiran') {
        $ayah = Citizen::with('villages')->findOrFail($request->ayah_id);

        $village = $ayah->villages;
        $alamatAyah = implode(', ', array_filter([
        $village?->nama_wilayah,
        $village?->desa ? 'Desa ' . $village->desa : null,
        $village?->kecamatan ? 'Kecamatan ' . $village->kecamatan : null,
        $village?->kabupaten ? 'Kabupaten ' . $village->kabupaten : null,
        $village?->provinsi ? 'Provinsi ' . $village->provinsi : null,
        ]));

        $ibu = Citizen::with('villages')->findOrFail($request->ibu_id);

        $village = $ibu->villages;
        $alamatIbu = implode(', ', array_filter([
        $village?->nama_wilayah,
        $village?->desa ? 'Desa ' . $village->desa : null,
        $village?->kecamatan ? 'Kecamatan ' . $village->kecamatan : null,
        $village?->kabupaten ? 'Kabupaten ' . $village->kabupaten : null,
        $village?->provinsi ? 'Provinsi ' . $village->provinsi : null,
        ]));

        $tanggalLahir = Carbon::parse($request->tanggal_lahir_anak);
        $tanggalLahir->locale('id');
        $hariLahir = $tanggalLahir->translatedFormat('l'); // Senin, Selasa, dst
        // Tanggal
        $tanggalLahirAnak = $tanggalLahir->format('d'); // 01, 02, dst

        // Bulan (nama)
        $bulanLahir = $tanggalLahir->translatedFormat('F'); // Januari, Februari, dst
        // Tahun
        $tahunLahir = $tanggalLahir->format('Y'); // 2026

        $tanggalSurat = Carbon::now();
        $tanggalSurat->locale('id');
        // Hari
        $hari = $tanggalSurat->translatedFormat('l'); // Senin, Selasa, Rabu, dst

        // Tanggal (angka)
        $tanggal = $tanggalSurat->format('d'); // 01, 02, 15, dst

        // Bulan (nama)
        $bulanNama = $tanggalSurat->translatedFormat('F'); // Januari, Februari, dst

        // Bulan (romawi)
        $bulanRomawi = $this->bulanRomawi($tanggalSurat->month); // I, II, III, dst

        // Tahun
        $tahun = $tanggalSurat->format('Y');

        // ======================
        // GENERATE NOMOR SURAT
        // ======================
$lastSurat = Surat::whereYear('created_at', $tanggalSurat->year)
    ->lockForUpdate()
    ->count();

        $nomorUrut = $request->no_surat;

        $bulanRomawi = $this->bulanRomawi($tanggalSurat->month);

        $nomorSurat = $jenis->kode_surat
            . '/' . $nomorUrut
            . '/SBD/'
            . $bulanRomawi
            . '/'
            . $tanggalSurat->year;


        // ======================
        // LOAD TEMPLATE DARI DATABASE
        // ======================

        $templatePath = storage_path('app/private/' . $jenis->template_path);
if (!file_exists($templatePath)) {
    abort(404, 'Template tidak ditemukan.');
}
$template = new TemplateProcessor($templatePath);
        // ======================
        // SET DATA UMUM SURAT
        // ======================

        $template->setValue('nomorsurat', $nomorSurat);
        $template->setValue('tanggal_surat', $tanggalSurat->format('d-m-Y'));
        $template->setValue('hari', $hari);
        $template->setValue('tanggal', $tanggal);
        $template->setValue('bulan', $bulanNama); 
        $template->setValue('tahun', $tahun);

        // ======================
        // KHUSUS SURAT KELAHIRAN
        // ======================

        if ($jenis->nama_surat === 'Surat Keterangan Kelahiran') {

            $template->setValue('nama_anak', $request->nama_anak);
            $template->setValue('jenis_kelamin_anak', $request->jenis_kelamin_anak);
            $template->setValue('tempat_lahir_anak', $request->tempat_lahir_anak);
            $template->setValue('tanggal_lahir_anak', $tanggalLahir->format('d-m-Y'));
            $template->setValue('jam_lahir', $request->jam_lahir);
            $template->setValue('agama_anak', $request->agama_anak);
            $template->setValue('alamat_anak', $request->alamat_anak);
            $template->setValue('hari_lahir', $hariLahir);
            $template->setValue('tanggal_lahir_anggka',$tanggalLahir->format('d-m-Y'));
            $template->setValue('bulan_lahir', $bulanLahir);
            $template->setValue('tahun_lahir', $tahunLahir);

            $template->setValue('nama_ayah', $ayah->nama_lengkap);
            $template->setValue('tempat_lahir_ayah', $ayah->tempat_lahir);
            $template->setValue('tanggal_lahir_ayah', $ayah->tanggal_lahir);
            $tanggalLahirAyah = Carbon::parse($ayah->tanggal_lahir);
            $umurAyah = $tanggalLahirAyah->age;
            $template->setValue('usia_ayah', $umurAyah);
            $template->setValue('agama_ayah', $ayah->religion->agama ?? '-');
            $template->setValue('pekerjaan_ayah', $ayah->profesion->pekerjaan ?? '-');
            $template->setValue('alamat_ayah', $alamatAyah);


            $template->setValue('nama_lengkap_ibu', $ibu->nama_lengkap);
            $template->setValue('tempat_lahir_ibu', $ibu->tempat_lahir);
            $template->setValue('tanggal_lahir_ibu', $ibu->tanggal_lahir);
            $tanggalLahirIbu = Carbon::parse($ibu->tanggal_lahir);
            $umurIbu = $tanggalLahirIbu->age;
            $template->setValue('usia_ibu', $umurIbu);
            $template->setValue('agama_ibu', $ibu->religion->agama ?? '-');
            $template->setValue('pekerjaan_ibu', $ibu->profesion->pekerjaan ?? '-');
            $template->setValue('alamat_ibu', $alamatIbu);

        }
}
if ($jenis->slug === 'surat-keterangan-belum-pernah-kawin') {

        $tanggalSurat = Carbon::now();
        $tanggalSurat->locale('id');

        $lastSurat = Surat::whereYear('created_at', $tanggalSurat->year)
        ->lockForUpdate()
        ->count();

        $nomorUrut = $request->no_surat;

        $bulanRomawi = $this->bulanRomawi($tanggalSurat->month);

        $nomorSurat = $jenis->kode_surat
            . '/' . $nomorUrut
            . '/SBD/'
            . $bulanRomawi
            . '/'
            . 'Pem';
        $templatePath = storage_path('app/private/' . $jenis->template_path);
        if (!file_exists($templatePath)) {
        abort(404, 'Template tidak ditemukan.');
        }
        $template = new TemplateProcessor($templatePath);
        // ======================
        // SET DATA UMUM SURAT
        // ======================

        $template->setValue('kodesurat', $nomorSurat);
        $template->setValue('tanggal_surat', $tanggalSurat->format('d-m-Y'));

    $pemohon = Citizen::findOrFail($request->pemohon_id);
            $village = $pemohon->villages;
            $alamatPemohon = implode(', ', array_filter([
                $village?->nama_wilayah,
                $village?->desa ? 'Desa ' . $village->desa : null,
                $village?->kecamatan ? 'Kecamatan ' . $village->kecamatan : null,
                $village?->kabupaten ? 'Kabupaten ' . $village->kabupaten : null,
                $village?->provinsi ? 'Provinsi ' . $village->provinsi : null,
            ]));

            $template->setValue('nama', $pemohon->nama_lengkap);
            $template->setValue('tempat_lahir', $pemohon->tempat_lahir);
            $template->setValue('jenis_kelamin', $pemohon->jenis_kelamin);
            $template->setValue('pekerjaan', $pemohon->profesion->pekerjaan);
            $template->setValue('tanggal_lahir', $pemohon->tanggal_lahir);
            $template->setValue('nik', $pemohon->nik);
            $template->setValue('agama', $pemohon->religion->agama ?? '-');
            $template->setValue('alamat', $alamatPemohon);
}
        
   // ======================
        // SIMPAN FILE SURAT
        // ======================
        $fileName = 'surat_' . str_replace(' ', '_', $jenis->slug) . '_' . time() . '.docx';
        $directory = 'generated';
        $relativePath = $directory . '/' . $fileName;
        $fullPath = storage_path('app/public/' . $relativePath);

        if (!file_exists(storage_path('app/public/' . $directory))) {
            mkdir(storage_path('app/public/' . $directory), 0755, true);
        }

        $template->saveAs($fullPath);

        $namaPihak = match ($jenis->slug) {
        'surat-keterangan-kelahiran'   => $request->nama_anak,
        'surat-keterangan-belum-pernah-kawin' => $pemohon->nama_lengkap,
        default => '-',
        };

        // ======================
        // SIMPAN DATA SURAT KE DATABASE
        // ======================
        Surat::create([
            'jenis_surat_id' => $jenis->id,
            'nama_surat' =>$namaPihak,
            'family_id' => $family->id,
            'nomor_surat' => $nomorSurat,
            'tanggal_surat' => $tanggalSurat,
            'file_path' => $relativePath,
        ]);

        $redirectRoute = $request->get('redirect');

        return redirect()
            ->route($redirectRoute, $family->id)
            ->with('success', 'Surat berhasil dibuat dengan nomor: ' . $nomorSurat);
    });
}

    public function destroy(Surat $surat)
{
    // hapus file jika ada
    if ($surat->file_path && Storage::disk('public')->exists($surat->file_path)) {
        Storage::disk('public')->delete($surat->file_path);
    }

    $surat->delete();

    return redirect()
        ->back()
        ->with('success', 'Surat berhasil dihapus.');
}
    public function SuratKeluar()
    {
        $surat = Surat::orderBy('created_at', 'desc')->paginate(10);
        return view('surat.index',compact('surat'));
    }

}
