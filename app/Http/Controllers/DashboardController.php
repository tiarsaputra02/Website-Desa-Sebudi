<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Citizen;
use App\Models\FamilyHead;
use App\Models\Religion;
use App\Models\BpjsMember;
class DashboardController extends Controller
{
    public function index(Request $request)
    {

    if ($request->tahun === null) {
        $tahun = 2025;
    }else {
    $tahun = $request->tahun;
    }
    // Daftar tahun otomatis dari data citizen
    $listTahun = Citizen::selectRaw('YEAR(created_at) as tahun')
                ->groupBy('tahun')
                ->orderBy('tahun', 'desc')
                ->pluck('tahun');
    // Hitung jumlah warga sesuai tahun yang dipilih
    $queryCitizen = Citizen::query();

    if ($tahun) {
        $queryCitizen->whereYear('created_at','<=', $tahun);
    }
    $queryCitizen->where('status_hidup','Hidup');
    $totalWarga = $queryCitizen->count();

    //Hitung Jumlah Kepala Keluarga
    $queryFamilyHead = FamilyHead::query();
    if ($tahun) {
        $queryFamilyHead->whereYear('created_at','<=', $tahun);
    }
    $totalKepalaKeluarga = $queryFamilyHead->count();

    //Hitung Jumlah Jenis Kelamin
    $queryJenisKelamin  = Citizen::query();

    if ($tahun) {
        $queryJenisKelamin->whereYear('created_at','<=',$tahun);
    }

    $queryJenisKelamin->where('status_hidup','Hidup');
    $laki_laki = $queryJenisKelamin->clone()->where('jenis_kelamin','Laki-Laki')->count();
    $perempuan = $queryJenisKelamin->clone()->where('jenis_kelamin','Perempuan')->count();
    $data_kelamin = [$laki_laki, $perempuan];
    $jenis_kelamin = ['Laki-Laki', 'Perempuan'];
    $totalJenisKelamin = $laki_laki + $perempuan;

    //Hitung Jumlah Agama
    $queryReligion = Citizen::with('religion')
    ->select(
        'religions.agama',
        DB::raw('COUNT(citizens.id) as total')
    )
    ->join('religions', 'citizens.agama_id', '=', 'religions.id')
    ->where('citizens.status_hidup', 'Hidup')
    ->whereDate('citizens.created_at', '<=', $tahun . '-12-31')
    ->groupBy('religions.agama')
    ->get();
    $chartReligionLebel = $queryReligion->pluck('agama');
    $chartReligionData  = $queryReligion->pluck('total');
    $totalReligion = $chartReligionData->sum();

    //Hitung Jumlah Pekerjaan
    $jumlahPekerjaan = DB::table('citizens')
    ->join('profesions', 'citizens.pekerjaan_id', '=', 'profesions.id')
    ->select(
        'profesions.pekerjaan',
        DB::raw('COUNT(citizens.id) as total')
    )
    ->where('citizens.status_hidup', 'Hidup')      // filter hidup
    ->whereYear('citizens.created_at','<=', $tahun)     // filter tahun
    ->groupBy('profesions.pekerjaan')
    ->get();

    $chartProfesionLebel = $jumlahPekerjaan->pluck('pekerjaan');
    $chartProfesionData = $jumlahPekerjaan->pluck('total');
    $totalProfesion = $chartProfesionData->sum();

    //Hitung Jumlah Pendidikan
    $jumlahPendidikan = DB::table('citizens')
    ->join('education_levels', 'citizens.pendidikan_id', '=', 'education_levels.id')
    ->select(
        'education_levels.strata_pendidikan',
        DB::raw('COUNT(citizens.id) as total')
    )
    ->where('citizens.status_hidup', 'Hidup')      // filter hidup
    ->whereYear('citizens.created_at','<=', $tahun)     // filter tahun
    ->groupBy('education_levels.strata_pendidikan')
    ->get();

    $chartEducationLevelsLebel = $jumlahPendidikan->pluck('strata_pendidikan');
    $chartEducationLevelsData = $jumlahPendidikan->pluck('total');
    $totalEducationLevels = $chartEducationLevelsData->sum();

    //Hitung Jumlah Status Perkawinan
    $jumlahPerkawinan = DB::table('citizens')
    ->join('marital_statuses', 'citizens.perkawinan_id', '=', 'marital_statuses.id')
    ->select(
        'marital_statuses.status_pernikahan',
        DB::raw('COUNT(citizens.id) as total')
    )
    ->where('citizens.status_hidup', 'Hidup')      // filter hidup
    ->whereYear('citizens.created_at','<=', $tahun)     // filter tahun
    ->groupBy('marital_statuses.status_pernikahan')
    ->get();

    $chartMaritalStatusLebel = $jumlahPerkawinan->pluck('status_pernikahan');
    $chartMaritalStatusData = $jumlahPerkawinan->pluck('total');
    $totalMaritalStatus = $chartMaritalStatusData->sum();

    //Hitung Jumlah Warga  Berdasarkan Umur
    $umur = DB::table('citizens')
     ->select([
        DB::raw("SUM(CASE
            WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) <= 0 THEN 1
            ELSE 0 END) AS bayi"),

        DB::raw("SUM(CASE
            WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 1 AND 5 THEN 1
            ELSE 0 END) AS balita"),

        DB::raw("SUM(CASE
            WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 6 AND 12 THEN 1
            ELSE 0 END) AS anak"),

        DB::raw("SUM(CASE
            WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 13 AND 17 THEN 1
            ELSE 0 END) AS remaja"),

        DB::raw("SUM(CASE
            WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 18 AND 55 THEN 1
            ELSE 0 END) AS dewasa"),

        DB::raw("SUM(CASE
            WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) >= 56 THEN 1
            ELSE 0 END) AS lansia"),
    ])
    ->when($request->tahun, function ($q) use ($request) {
        $q->whereYear('created_at','<=', $request->tahun);
    })
    ->where('status_hidup', 'Hidup')
    ->first();

    $umurBayi = $umur->bayi;
    $umurBalita = $umur->balita;
    $umurAnak = $umur->anak;
    $umurRemaja = $umur->remaja;
    $umurDewasa = $umur->dewasa;
    $umurLansia = $umur->lansia;
    $totalUmur = $umurBayi + $umurBalita + $umurAnak + $umurRemaja + $umurDewasa + $umurLansia;

    //Hirung Jumlah Warga  Berdasarkan Bantuan
    $jumlahBantuan = DB::table('citizens')
    ->join('assistance_types', 'citizens.bantuan_id', '=', 'assistance_types.id')
    ->select(
        'assistance_types.jenis_bantuan',
        DB::raw('COUNT(citizens.id) as total')
    )
    ->where('citizens.status_hidup', 'Hidup')      // filter hidup
    ->whereYear('citizens.created_at','<=', $tahun)     // filter tahun
    ->groupBy('assistance_types.jenis_bantuan')
    ->get();

    $chartAssistanceLebel = $jumlahBantuan->pluck('jenis_bantuan');
    $chartAssistanceData = $jumlahBantuan->pluck('total');
    $totalAssistance = $chartAssistanceData->sum();
    $queryAssistance =  Citizen::query();
    if ($tahun) {
        $queryAssistance->whereYear('created_at','<=', $tahun);
    }
    $tanpa_bantuan = $queryAssistance->where('status_hidup','hidup')->where('bantuan_id',null)->count();

    //Hitung Jumlah Data BPJS
    $queryJenis = BpjsMember::join('citizens', 'bpjs_members.warga_id', '=', 'citizens.id')
    ->whereYear('citizens.created_at', $tahun)
    ->select(
        'bpjs_members.jenis_bpjs',
        DB::raw('COUNT(bpjs_members.warga_id) as total')
    )
    ->where('status','Active')
    ->groupBy('bpjs_members.jenis_bpjs')
    ->get();

    $queryKategori = BpjsMember::join('citizens', 'bpjs_members.warga_id', '=', 'citizens.id')
    ->whereYear('citizens.created_at', $tahun)
    ->select(
        'bpjs_members.kategori',
        DB::raw('COUNT(bpjs_members.warga_id) as total')
    )
    ->where('status','Active')
    ->groupBy('bpjs_members.kategori')
    ->get();
    $chartJenisBpjsLabel = $queryJenis->pluck('jenis_bpjs');
    $chartJenisBpjsData = $queryJenis->pluck('total');
    $totalJenisBpjs= $chartJenisBpjsData->sum();
    $totalKategoriBpjs= $queryKategori->pluck('total')->sum();

    return view('dashboard.index',compact(
            'totalWarga',
            'listTahun',
            'totalKepalaKeluarga',
            'data_kelamin',
            'jenis_kelamin',
            'totalJenisKelamin',
            'laki_laki',
            'perempuan',
            'jumlahPekerjaan',
            'chartProfesionData',
            'chartProfesionLebel',
            'totalProfesion',
            'jumlahPendidikan',
            'chartEducationLevelsLebel',
            'chartEducationLevelsData',
            'totalEducationLevels',
            'jumlahPerkawinan',
            'chartMaritalStatusLebel',
            'chartMaritalStatusData',
            'totalMaritalStatus',
            'queryReligion',
            'chartReligionData',
            'chartReligionLebel',
            'totalReligion',
            'umur',
            'totalUmur',
            'tahun',
            'chartAssistanceLebel',
            'chartAssistanceData',
            'totalAssistance',
            'tanpa_bantuan',
            'jumlahBantuan',
            'queryJenis',
            'totalJenisBpjs',
            'totalKategoriBpjs',
            'queryKategori',
            'chartJenisBpjsLabel',
            'chartJenisBpjsData'));

    }

    public function pura(Request $request)
    {
    if ($request->tahun === null) {
        $tahun = 2025;
    }else {
    $tahun = $request->tahun;
    }
    // Daftar tahun otomatis dari data citizen
    $listTahun = Citizen::selectRaw('YEAR(created_at) as tahun')
                ->groupBy('tahun')
                ->orderBy('tahun', 'desc')
                ->pluck('tahun');
    // Hitung jumlah warga sesuai tahun yang dipilih
    $queryCitizen = Citizen::query();

    if ($tahun) {
        $queryCitizen->whereYear('created_at','<=', $tahun);
    }
    $queryCitizen->where('wilayah_id', 8);
    $queryCitizen->where('status_hidup','Hidup');
    $totalWarga = $queryCitizen->count();

    //Hitung Jumlah Kepala Keluarga
    $queryFamilyHead = FamilyHead::query();
    if ($tahun) {
        $queryFamilyHead->whereYear('created_at','<=', $tahun);
    }
    $queryFamilyHead->where('wilayah_id', 8);
    $totalKepalaKeluarga = $queryFamilyHead->count();

    //Hitung Jumlah Jenis Kelamin Banjar Pura
    $queryJenisKelamin  = Citizen::query();

    if ($tahun) {
        $queryJenisKelamin->whereYear('created_at','<=',$tahun);
    }

    $queryJenisKelamin->where('status_hidup','Hidup');
    $queryJenisKelamin->where('wilayah_id',8);
    $laki_laki = $queryJenisKelamin->clone()->where('jenis_kelamin','Laki-Laki')->count();
    $perempuan = $queryJenisKelamin->clone()->where('jenis_kelamin','Perempuan')->count();
    $data_kelamin = [$laki_laki, $perempuan];
    $jenis_kelamin = ['Laki-Laki', 'Perempuan'];
    $totalJenisKelamin = $laki_laki + $perempuan;

    //Hitung Jumlah Agama Banjar Pura
    $queryReligion = Citizen::with('religion')
    ->select(
        'religions.agama',
        DB::raw('COUNT(citizens.id) as total')
    )
    ->join('religions', 'citizens.agama_id', '=', 'religions.id')
    ->where('citizens.wilayah_id', 8)
    ->where('citizens.status_hidup', 'Hidup')
    ->whereDate('citizens.created_at', '<=', $tahun . '-12-31')
    ->groupBy('religions.agama')
    ->get();
    $chartReligionLebel = $queryReligion->pluck('agama');
    $chartReligionData  = $queryReligion->pluck('total');
    $totalReligion = $chartReligionData->sum();

    //Hitung Jumlah Pekerjaan Banjar Pura
    $jumlahPekerjaan = DB::table('citizens')
    ->join('profesions', 'citizens.pekerjaan_id', '=', 'profesions.id')
    ->select(
        'profesions.pekerjaan',
        DB::raw('COUNT(citizens.id) as total')
    )
    ->where('citizens.wilayah_id', 8)              // filter wilayah
    ->where('citizens.status_hidup', 'Hidup')      // filter hidup
    ->whereYear('citizens.created_at','<=', $tahun)     // filter tahun
    ->groupBy('profesions.pekerjaan')
    ->get();

    $chartProfesionLebel = $jumlahPekerjaan->pluck('pekerjaan');
    $chartProfesionData = $jumlahPekerjaan->pluck('total');
    $totalProfesion = $chartProfesionData->sum();

    //Hitung Jumlah Pendidikan Banjar Pura
    $jumlahPendidikan = DB::table('citizens')
    ->join('education_levels', 'citizens.pendidikan_id', '=', 'education_levels.id')
    ->select(
        'education_levels.strata_pendidikan',
        DB::raw('COUNT(citizens.id) as total')
    )
    ->where('citizens.wilayah_id', 8)              // filter wilayah
    ->where('citizens.status_hidup', 'Hidup')      // filter hidup
    ->whereYear('citizens.created_at','<=', $tahun)     // filter tahun
    ->groupBy('education_levels.strata_pendidikan')
    ->get();

    $chartEducationLevelsLebel = $jumlahPendidikan->pluck('strata_pendidikan');
    $chartEducationLevelsData = $jumlahPendidikan->pluck('total');
    $totalEducationLevels = $chartEducationLevelsData->sum();

    //Hitung Jumlah Status Perkawinan Banjar Pura
    $jumlahPerkawinan = DB::table('citizens')
    ->join('marital_statuses', 'citizens.perkawinan_id', '=', 'marital_statuses.id')
    ->select(
        'marital_statuses.status_pernikahan',
        DB::raw('COUNT(citizens.id) as total')
    )
    ->where('citizens.wilayah_id', 8)              // filter wilayah
    ->where('citizens.status_hidup', 'Hidup')      // filter hidup
    ->whereYear('citizens.created_at','<=', $tahun)     // filter tahun
    ->groupBy('marital_statuses.status_pernikahan')
    ->get();

    $chartMaritalStatusLebel = $jumlahPerkawinan->pluck('status_pernikahan');
    $chartMaritalStatusData = $jumlahPerkawinan->pluck('total');
    $totalMaritalStatus = $chartMaritalStatusData->sum();

    //Hitung Jumlah Warga Banjar Pura Berdasarkan Umur
    $umur = DB::table('citizens')
     ->select([
        DB::raw("SUM(CASE
            WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) <= 0 THEN 1
            ELSE 0 END) AS bayi"),

        DB::raw("SUM(CASE
            WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 1 AND 5 THEN 1
            ELSE 0 END) AS balita"),

        DB::raw("SUM(CASE
            WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 6 AND 12 THEN 1
            ELSE 0 END) AS anak"),

        DB::raw("SUM(CASE
            WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 13 AND 17 THEN 1
            ELSE 0 END) AS remaja"),

        DB::raw("SUM(CASE
            WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 18 AND 55 THEN 1
            ELSE 0 END) AS dewasa"),

        DB::raw("SUM(CASE
            WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) >= 56 THEN 1
            ELSE 0 END) AS lansia"),
    ])
    ->when($request->tahun, function ($q) use ($request) {
        $q->whereYear('created_at','<=', $request->tahun);
    })
    ->where('wilayah_id', 8)
    ->where('status_hidup', 'Hidup')
    ->first();

    $umurBayi = $umur->bayi;
    $umurBalita = $umur->balita;
    $umurAnak = $umur->anak;
    $umurRemaja = $umur->remaja;
    $umurDewasa = $umur->dewasa;
    $umurLansia = $umur->lansia;
    $totalUmur = $umurBayi + $umurBalita + $umurAnak + $umurRemaja + $umurDewasa + $umurLansia;
    //Hirung Jumlah Warga Banjar Dinas Pura Berdasarkan Bantuan
    $jumlahBantuan = DB::table('citizens')
    ->join('assistance_types', 'citizens.bantuan_id', '=', 'assistance_types.id')
    ->select(
        'assistance_types.jenis_bantuan',
        DB::raw('COUNT(citizens.id) as total')
    )
    ->where('citizens.wilayah_id', 8)              // filter wilayah
    ->where('citizens.status_hidup', 'Hidup')      // filter hidup
    ->whereYear('citizens.created_at','<=', $tahun)     // filter tahun
    ->groupBy('assistance_types.jenis_bantuan')
    ->get();

    $chartAssistanceLebel = $jumlahBantuan->pluck('jenis_bantuan');
    $chartAssistanceData = $jumlahBantuan->pluck('total');
    $totalAssistance = $chartAssistanceData->sum();
    $queryAssistance =  Citizen::query();
    if ($tahun) {
        $queryAssistance->whereYear('created_at','<=', $tahun);
    }
    $tanpa_bantuan = $queryAssistance->where('wilayah_id',8)->where('status_hidup','hidup')->where('bantuan_id',null)->count();

    //Hitung Jumlah Data BPJS Banjar Dinas Pura
    $queryJenis = BpjsMember::join('citizens', 'bpjs_members.warga_id', '=', 'citizens.id')
    ->whereYear('citizens.created_at', $tahun)
    ->select(
        'bpjs_members.jenis_bpjs',
        DB::raw('COUNT(bpjs_members.warga_id) as total')
    )
    ->where('status','Active')
    ->where('citizens.wilayah_id',8)
    ->groupBy('bpjs_members.jenis_bpjs')
    ->get();

    $queryKategori = BpjsMember::join('citizens', 'bpjs_members.warga_id', '=', 'citizens.id')
    ->whereYear('citizens.created_at', $tahun)
    ->select(
        'bpjs_members.kategori',
        DB::raw('COUNT(bpjs_members.warga_id) as total')
    )
    ->where('status','Active')
    ->where('citizens.wilayah_id',8)
    ->groupBy('bpjs_members.kategori')
    ->get();
    $chartJenisBpjsLabel = $queryJenis->pluck('jenis_bpjs');
    $chartJenisBpjsData = $queryJenis->pluck('total');
    $totalJenisBpjs= $chartJenisBpjsData->sum();
    $totalKategoriBpjs= $queryKategori->pluck('total')->sum();

    return view('dashboard.pura.index',compact(
            'totalWarga',
            'listTahun',
            'totalKepalaKeluarga',
            'data_kelamin',
            'jenis_kelamin',
            'totalJenisKelamin',
            'laki_laki',
            'perempuan',
            'jumlahPekerjaan',
            'chartProfesionData',
            'chartProfesionLebel',
            'totalProfesion',
            'jumlahPendidikan',
            'chartEducationLevelsLebel',
            'chartEducationLevelsData',
            'totalEducationLevels',
            'jumlahPerkawinan',
            'chartMaritalStatusLebel',
            'chartMaritalStatusData',
            'totalMaritalStatus',
            'queryReligion',
            'chartReligionData',
            'chartReligionLebel',
            'totalReligion',
            'umur',
            'totalUmur',
            'tahun',
            'chartAssistanceLebel',
            'chartAssistanceData',
            'totalAssistance',
            'tanpa_bantuan',
            'jumlahBantuan',
            'queryJenis',
            'totalJenisBpjs',
            'totalKategoriBpjs',
            'queryKategori',
            'chartJenisBpjsLabel',
            'chartJenisBpjsData'));

    }

    //WILAYAH SORGA
    public function sorga(Request $request)
    {
    if ($request->tahun === null) {
        $tahun = 2025;
    }else {
    $tahun = $request->tahun;
    }
    // Daftar tahun otomatis dari data citizen
    $listTahun = Citizen::selectRaw('YEAR(created_at) as tahun')
                ->groupBy('tahun')
                ->orderBy('tahun', 'desc')
                ->pluck('tahun');
    // Hitung jumlah warga sesuai tahun yang dipilih
    $queryCitizen = Citizen::query();

    if ($tahun) {
        $queryCitizen->whereYear('created_at','<=', $tahun);
    }
    $queryCitizen->where('wilayah_id', 1);
    $queryCitizen->where('status_hidup','Hidup');
    $totalWarga = $queryCitizen->count();

    //Hitung Jumlah Kepala Keluarga
    $queryFamilyHead = FamilyHead::query();
    if ($tahun) {
        $queryFamilyHead->whereYear('created_at','<=', $tahun);
    }
    $queryFamilyHead->where('wilayah_id', 1);
    $totalKepalaKeluarga = $queryFamilyHead->count();

    //Hitung Jumlah Jenis Kelamin Banjar Sorga
    $queryJenisKelamin  = Citizen::query();

    if ($tahun) {
        $queryJenisKelamin->whereYear('created_at','<=',$tahun);
    }

    $queryJenisKelamin->where('status_hidup','Hidup');
    $queryJenisKelamin->where('wilayah_id',1);
    $laki_laki = $queryJenisKelamin->clone()->where('jenis_kelamin','Laki-Laki')->count();
    $perempuan = $queryJenisKelamin->clone()->where('jenis_kelamin','Perempuan')->count();
    $data_kelamin = [$laki_laki, $perempuan];
    $jenis_kelamin = ['Laki-Laki', 'Perempuan'];
    $totalJenisKelamin = $laki_laki + $perempuan;

    //Hitung Jumlah Agama Banjar Sorga
    $queryReligion = Citizen::with('religion')
    ->select(
        'religions.agama',
        DB::raw('COUNT(citizens.id) as total')
    )
    ->join('religions', 'citizens.agama_id', '=', 'religions.id')
    ->where('citizens.wilayah_id', 1)
    ->where('citizens.status_hidup', 'Hidup')
    ->whereDate('citizens.created_at', '<=', $tahun . '-12-31')
    ->groupBy('religions.agama')
    ->get();
    $chartReligionLebel = $queryReligion->pluck('agama');
    $chartReligionData  = $queryReligion->pluck('total');
    $totalReligion = $chartReligionData->sum();

    //Hitung Jumlah Pekerjaan Banjar Sorga
    $jumlahPekerjaan = DB::table('citizens')
    ->join('profesions', 'citizens.pekerjaan_id', '=', 'profesions.id')
    ->select(
        'profesions.pekerjaan',
        DB::raw('COUNT(citizens.id) as total')
    )
    ->where('citizens.wilayah_id', 1)              // filter wilayah
    ->where('citizens.status_hidup', 'Hidup')      // filter hidup
    ->whereYear('citizens.created_at','<=', $tahun)     // filter tahun
    ->groupBy('profesions.pekerjaan')
    ->get();

    $chartProfesionLebel = $jumlahPekerjaan->pluck('pekerjaan');
    $chartProfesionData = $jumlahPekerjaan->pluck('total');
    $totalProfesion = $chartProfesionData->sum();

    //Hitung Jumlah Pendidikan Banjar Sorga
    $jumlahPendidikan = DB::table('citizens')
    ->join('education_levels', 'citizens.pendidikan_id', '=', 'education_levels.id')
    ->select(
        'education_levels.strata_pendidikan',
        DB::raw('COUNT(citizens.id) as total')
    )
    ->where('citizens.wilayah_id', 1)              // filter wilayah
    ->where('citizens.status_hidup', 'Hidup')      // filter hidup
    ->whereYear('citizens.created_at','<=', $tahun)     // filter tahun
    ->groupBy('education_levels.strata_pendidikan')
    ->get();

    $chartEducationLevelsLebel = $jumlahPendidikan->pluck('strata_pendidikan');
    $chartEducationLevelsData = $jumlahPendidikan->pluck('total');
    $totalEducationLevels = $chartEducationLevelsData->sum();

    //Hitung Jumlah Status Perkawinan Banjar Sorga
    $jumlahPerkawinan = DB::table('citizens')
    ->join('marital_statuses', 'citizens.perkawinan_id', '=', 'marital_statuses.id')
    ->select(
        'marital_statuses.status_pernikahan',
        DB::raw('COUNT(citizens.id) as total')
    )
    ->where('citizens.wilayah_id', 1)              // filter wilayah
    ->where('citizens.status_hidup', 'Hidup')      // filter hidup
    ->whereYear('citizens.created_at','<=', $tahun)     // filter tahun
    ->groupBy('marital_statuses.status_pernikahan')
    ->get();

    $chartMaritalStatusLebel = $jumlahPerkawinan->pluck('status_pernikahan');
    $chartMaritalStatusData = $jumlahPerkawinan->pluck('total');
    $totalMaritalStatus = $chartMaritalStatusData->sum();

    //Hitung Jumlah Warga Banjar Sorga Berdasarkan Umur
    $umur = DB::table('citizens')
     ->select([
        DB::raw("SUM(CASE
            WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) <= 0 THEN 1
            ELSE 0 END) AS bayi"),

        DB::raw("SUM(CASE
            WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 1 AND 5 THEN 1
            ELSE 0 END) AS balita"),

        DB::raw("SUM(CASE
            WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 6 AND 12 THEN 1
            ELSE 0 END) AS anak"),

        DB::raw("SUM(CASE
            WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 13 AND 17 THEN 1
            ELSE 0 END) AS remaja"),

        DB::raw("SUM(CASE
            WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 18 AND 55 THEN 1
            ELSE 0 END) AS dewasa"),

        DB::raw("SUM(CASE
            WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) >= 56 THEN 1
            ELSE 0 END) AS lansia"),
    ])
    ->when($request->tahun, function ($q) use ($request) {
        $q->whereYear('created_at','<=', $request->tahun);
    })
    ->where('wilayah_id', 1)
    ->where('status_hidup', 'Hidup')
    ->first();

    $umurBayi = $umur->bayi;
    $umurBalita = $umur->balita;
    $umurAnak = $umur->anak;
    $umurRemaja = $umur->remaja;
    $umurDewasa = $umur->dewasa;
    $umurLansia = $umur->lansia;
    $totalUmur = $umurBayi + $umurBalita + $umurAnak + $umurRemaja + $umurDewasa + $umurLansia;
    //Hirung Jumlah Warga Banjar Dinas Sorga Berdasarkan Bantuan
    $jumlahBantuan = DB::table('citizens')
    ->join('assistance_types', 'citizens.bantuan_id', '=', 'assistance_types.id')
    ->select(
        'assistance_types.jenis_bantuan',
        DB::raw('COUNT(citizens.id) as total')
    )
    ->where('citizens.wilayah_id', 1)              // filter wilayah
    ->where('citizens.status_hidup', 'Hidup')      // filter hidup
    ->whereYear('citizens.created_at','<=', $tahun)     // filter tahun
    ->groupBy('assistance_types.jenis_bantuan')
    ->get();

    $chartAssistanceLebel = $jumlahBantuan->pluck('jenis_bantuan');
    $chartAssistanceData = $jumlahBantuan->pluck('total');
    $totalAssistance = $chartAssistanceData->sum();
    $queryAssistance =  Citizen::query();
    if ($tahun) {
        $queryAssistance->whereYear('created_at','<=', $tahun);
    }
    $tanpa_bantuan = $queryAssistance->where('wilayah_id',1)->where('status_hidup','hidup')->where('bantuan_id',null)->count();

    //Hitung Jumlah Data BPJS Banjar Dinas Sorga
    $queryJenis = BpjsMember::join('citizens', 'bpjs_members.warga_id', '=', 'citizens.id')
    ->whereYear('citizens.created_at', $tahun)
    ->select(
        'bpjs_members.jenis_bpjs',
        DB::raw('COUNT(bpjs_members.warga_id) as total')
    )
    ->where('status','Active')
    ->where('citizens.wilayah_id',1)
    ->groupBy('bpjs_members.jenis_bpjs')
    ->get();

    $queryKategori = BpjsMember::join('citizens', 'bpjs_members.warga_id', '=', 'citizens.id')
    ->whereYear('citizens.created_at', $tahun)
    ->select(
        'bpjs_members.kategori',
        DB::raw('COUNT(bpjs_members.warga_id) as total')
    )
    ->where('status','Active')
    ->where('citizens.wilayah_id',1)
    ->groupBy('bpjs_members.kategori')
    ->get();
    $chartJenisBpjsLabel = $queryJenis->pluck('jenis_bpjs');
    $chartJenisBpjsData = $queryJenis->pluck('total');
    $totalJenisBpjs= $chartJenisBpjsData->sum();
    $totalKategoriBpjs= $queryKategori->pluck('total')->sum();

    return view('dashboard.sorga.index',compact(
            'totalWarga',
            'listTahun',
            'totalKepalaKeluarga',
            'data_kelamin',
            'jenis_kelamin',
            'totalJenisKelamin',
            'laki_laki',
            'perempuan',
            'jumlahPekerjaan',
            'chartProfesionData',
            'chartProfesionLebel',
            'totalProfesion',
            'jumlahPendidikan',
            'chartEducationLevelsLebel',
            'chartEducationLevelsData',
            'totalEducationLevels',
            'jumlahPerkawinan',
            'chartMaritalStatusLebel',
            'chartMaritalStatusData',
            'totalMaritalStatus',
            'queryReligion',
            'chartReligionData',
            'chartReligionLebel',
            'totalReligion',
            'umur',
            'totalUmur',
            'tahun',
            'chartAssistanceLebel',
            'chartAssistanceData',
            'totalAssistance',
            'tanpa_bantuan',
            'jumlahBantuan',
            'queryJenis',
            'totalJenisBpjs',
            'totalKategoriBpjs',
            'queryKategori',
            'chartJenisBpjsLabel',
            'chartJenisBpjsData'));

    }
    //Banjar Badeg Dukuh
    public function dukuh(Request $request)
    {
    if ($request->tahun === null) {
        $tahun = 2025;
    }else {
    $tahun = $request->tahun;
    }
    // Daftar tahun otomatis dari data citizen
    $listTahun = Citizen::selectRaw('YEAR(created_at) as tahun')
                ->groupBy('tahun')
                ->orderBy('tahun', 'desc')
                ->pluck('tahun');
    // Hitung jumlah warga sesuai tahun yang dipilih
    $queryCitizen = Citizen::query();

    if ($tahun) {
        $queryCitizen->whereYear('created_at','<=', $tahun);
    }
    $queryCitizen->where('wilayah_id', 3);
    $queryCitizen->where('status_hidup','Hidup');
    $totalWarga = $queryCitizen->count();

    //Hitung Jumlah Kepala Keluarga
    $queryFamilyHead = FamilyHead::query();
    if ($tahun) {
        $queryFamilyHead->whereYear('created_at','<=', $tahun);
    }
    $queryFamilyHead->where('wilayah_id', 3);
    $totalKepalaKeluarga = $queryFamilyHead->count();

    //Hitung Jumlah Jenis Kelamin Banjar Badeg Dukuh
    $queryJenisKelamin  = Citizen::query();

    if ($tahun) {
        $queryJenisKelamin->whereYear('created_at','<=',$tahun);
    }

    $queryJenisKelamin->where('status_hidup','Hidup');
    $queryJenisKelamin->where('wilayah_id',3);
    $laki_laki = $queryJenisKelamin->clone()->where('jenis_kelamin','Laki-Laki')->count();
    $perempuan = $queryJenisKelamin->clone()->where('jenis_kelamin','Perempuan')->count();
    $data_kelamin = [$laki_laki, $perempuan];
    $jenis_kelamin = ['Laki-Laki', 'Perempuan'];
    $totalJenisKelamin = $laki_laki + $perempuan;

    //Hitung Jumlah Agama Banjar Badeg Dukuh
    $queryReligion = Citizen::with('religion')
    ->select(
        'religions.agama',
        DB::raw('COUNT(citizens.id) as total')
    )
    ->join('religions', 'citizens.agama_id', '=', 'religions.id')
    ->where('citizens.wilayah_id', 3)
    ->where('citizens.status_hidup', 'Hidup')
    ->whereDate('citizens.created_at', '<=', $tahun . '-12-31')
    ->groupBy('religions.agama')
    ->get();
    $chartReligionLebel = $queryReligion->pluck('agama');
    $chartReligionData  = $queryReligion->pluck('total');
    $totalReligion = $chartReligionData->sum();

    //Hitung Jumlah Pekerjaan Banjar Badeg Dukuh
    $jumlahPekerjaan = DB::table('citizens')
    ->join('profesions', 'citizens.pekerjaan_id', '=', 'profesions.id')
    ->select(
        'profesions.pekerjaan',
        DB::raw('COUNT(citizens.id) as total')
    )
    ->where('citizens.wilayah_id', 3)              // filter wilayah
    ->where('citizens.status_hidup', 'Hidup')      // filter hidup
    ->whereYear('citizens.created_at','<=', $tahun)     // filter tahun
    ->groupBy('profesions.pekerjaan')
    ->get();

    $chartProfesionLebel = $jumlahPekerjaan->pluck('pekerjaan');
    $chartProfesionData = $jumlahPekerjaan->pluck('total');
    $totalProfesion = $chartProfesionData->sum();

    //Hitung Jumlah Pendidikan Banjar Badeg Dukuh
    $jumlahPendidikan = DB::table('citizens')
    ->join('education_levels', 'citizens.pendidikan_id', '=', 'education_levels.id')
    ->select(
        'education_levels.strata_pendidikan',
        DB::raw('COUNT(citizens.id) as total')
    )
    ->where('citizens.wilayah_id', 3)              // filter wilayah
    ->where('citizens.status_hidup', 'Hidup')      // filter hidup
    ->whereYear('citizens.created_at','<=', $tahun)     // filter tahun
    ->groupBy('education_levels.strata_pendidikan')
    ->get();

    $chartEducationLevelsLebel = $jumlahPendidikan->pluck('strata_pendidikan');
    $chartEducationLevelsData = $jumlahPendidikan->pluck('total');
    $totalEducationLevels = $chartEducationLevelsData->sum();

    //Hitung Jumlah Status Perkawinan Banjar Badeg Dukuh
    $jumlahPerkawinan = DB::table('citizens')
    ->join('marital_statuses', 'citizens.perkawinan_id', '=', 'marital_statuses.id')
    ->select(
        'marital_statuses.status_pernikahan',
        DB::raw('COUNT(citizens.id) as total')
    )
    ->where('citizens.wilayah_id', 3)              // filter wilayah
    ->where('citizens.status_hidup', 'Hidup')      // filter hidup
    ->whereYear('citizens.created_at','<=', $tahun)     // filter tahun
    ->groupBy('marital_statuses.status_pernikahan')
    ->get();

    $chartMaritalStatusLebel = $jumlahPerkawinan->pluck('status_pernikahan');
    $chartMaritalStatusData = $jumlahPerkawinan->pluck('total');
    $totalMaritalStatus = $chartMaritalStatusData->sum();

    //Hitung Jumlah Warga Banjar Badeg Dukuh Berdasarkan Umur
    $umur = DB::table('citizens')
     ->select([
        DB::raw("SUM(CASE
            WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) <= 0 THEN 1
            ELSE 0 END) AS bayi"),

        DB::raw("SUM(CASE
            WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 1 AND 5 THEN 1
            ELSE 0 END) AS balita"),

        DB::raw("SUM(CASE
            WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 6 AND 12 THEN 1
            ELSE 0 END) AS anak"),

        DB::raw("SUM(CASE
            WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 13 AND 17 THEN 1
            ELSE 0 END) AS remaja"),

        DB::raw("SUM(CASE
            WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 18 AND 55 THEN 1
            ELSE 0 END) AS dewasa"),

        DB::raw("SUM(CASE
            WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) >= 56 THEN 1
            ELSE 0 END) AS lansia"),
    ])
    ->when($request->tahun, function ($q) use ($request) {
        $q->whereYear('created_at','<=', $request->tahun);
    })
    ->where('wilayah_id', 3)
    ->where('status_hidup', 'Hidup')
    ->first();

    $umurBayi = $umur->bayi;
    $umurBalita = $umur->balita;
    $umurAnak = $umur->anak;
    $umurRemaja = $umur->remaja;
    $umurDewasa = $umur->dewasa;
    $umurLansia = $umur->lansia;
    $totalUmur = $umurBayi + $umurBalita + $umurAnak + $umurRemaja + $umurDewasa + $umurLansia;

    //Hirung Jumlah Warga Banjar Dinas Badeg Dukuh Berdasarkan Bantuan
    $jumlahBantuan = DB::table('citizens')
    ->join('assistance_types', 'citizens.bantuan_id', '=', 'assistance_types.id')
    ->select(
        'assistance_types.jenis_bantuan',
        DB::raw('COUNT(citizens.id) as total')
    )
    ->where('citizens.wilayah_id', 3)              // filter wilayah
    ->where('citizens.status_hidup', 'Hidup')      // filter hidup
    ->whereYear('citizens.created_at','<=', $tahun)     // filter tahun
    ->groupBy('assistance_types.jenis_bantuan')
    ->get();

    $chartAssistanceLebel = $jumlahBantuan->pluck('jenis_bantuan');
    $chartAssistanceData = $jumlahBantuan->pluck('total');
    $totalAssistance = $chartAssistanceData->sum();
    $queryAssistance =  Citizen::query();
    if ($tahun) {
        $queryAssistance->whereYear('created_at','<=', $tahun);
    }
    $tanpa_bantuan = $queryAssistance->where('wilayah_id',3)->where('status_hidup','hidup')->where('bantuan_id',null)->count();

    //Hitung Jumlah Data BPJS Banjar Dinas Badeg Dukuh
    $queryJenis = BpjsMember::join('citizens', 'bpjs_members.warga_id', '=', 'citizens.id')
    ->whereYear('citizens.created_at', $tahun)
    ->select(
        'bpjs_members.jenis_bpjs',
        DB::raw('COUNT(bpjs_members.warga_id) as total')
    )
    ->where('status','Active')
    ->where('citizens.wilayah_id',3)
    ->groupBy('bpjs_members.jenis_bpjs')
    ->get();

    $queryKategori = BpjsMember::join('citizens', 'bpjs_members.warga_id', '=', 'citizens.id')
    ->whereYear('citizens.created_at', $tahun)
    ->select(
        'bpjs_members.kategori',
        DB::raw('COUNT(bpjs_members.warga_id) as total')
    )
    ->where('status','Active')
    ->where('citizens.wilayah_id',3)
    ->groupBy('bpjs_members.kategori')
    ->get();
    $chartJenisBpjsLabel = $queryJenis->pluck('jenis_bpjs');
    $chartJenisBpjsData = $queryJenis->pluck('total');
    $totalJenisBpjs= $chartJenisBpjsData->sum();
    $totalKategoriBpjs= $queryKategori->pluck('total')->sum();

    return view('dashboard.dukuh.index',compact(
            'totalWarga',
            'listTahun',
            'totalKepalaKeluarga',
            'data_kelamin',
            'jenis_kelamin',
            'totalJenisKelamin',
            'laki_laki',
            'perempuan',
            'jumlahPekerjaan',
            'chartProfesionData',
            'chartProfesionLebel',
            'totalProfesion',
            'jumlahPendidikan',
            'chartEducationLevelsLebel',
            'chartEducationLevelsData',
            'totalEducationLevels',
            'jumlahPerkawinan',
            'chartMaritalStatusLebel',
            'chartMaritalStatusData',
            'totalMaritalStatus',
            'queryReligion',
            'chartReligionData',
            'chartReligionLebel',
            'totalReligion',
            'umur',
            'totalUmur',
            'tahun',
            'chartAssistanceLebel',
            'chartAssistanceData',
            'totalAssistance',
            'tanpa_bantuan',
            'jumlahBantuan',
            'queryJenis',
            'totalJenisBpjs',
            'totalKategoriBpjs',
            'queryKategori',
            'chartJenisBpjsLabel',
            'chartJenisBpjsData'));

    }

}
