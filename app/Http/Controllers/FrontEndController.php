<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Citizen;
use App\Models\FamilyHead;
use App\Models\Religion;
use App\Models\BpjsMember;
use App\Models\SuratDesa;
use App\Models\Village;
use App\Models\News;
use App\Models\Apbdes;
use Carbon\Carbon;
class FrontEndController extends Controller
{
    public function index()
    {

    $queryCitizen = Citizen::query();

    $queryCitizen->where('status_hidup','Hidup');
    $totalWarga = $queryCitizen->count();

    //Hitung Jumlah Kepala Keluarga
    $queryFamilyHead = FamilyHead::query();
    $totalKepalaKeluarga = $queryFamilyHead->count();

    //Hitung Jumlah Jenis Kelamin
    $queryJenisKelamin  = Citizen::query();


    $queryJenisKelamin->where('status_hidup','Hidup');
    $laki_laki = $queryJenisKelamin->clone()->where('jenis_kelamin','Laki-Laki')->count();
    $perempuan = $queryJenisKelamin->clone()->where('jenis_kelamin','Perempuan')->count();
    $data_kelamin = [$laki_laki, $perempuan];
    $jenis_kelamin = ['Laki-Laki', 'Perempuan'];
    $totalJenisKelamin = $laki_laki + $perempuan;
    $news = News::latest()->take(3)->get();
    $jumlahBantuan = DB::table('citizens')
    ->join('assistance_types', 'citizens.bantuan_id', '=', 'assistance_types.id')
    ->select(
        'assistance_types.jenis_bantuan',
        DB::raw('COUNT(citizens.id) as total')
    )
    ->where('citizens.status_hidup', 'Hidup')      // filter hidup
    ->groupBy('assistance_types.jenis_bantuan')
    ->get();
    $totalBantuan = $jumlahBantuan->pluck('total')->sum();
    //

    $queryAssistance =  Citizen::query();
    $tanpa_bantuan = $queryAssistance->where('status_hidup','hidup')
                                     ->where('bantuan_id',null)->count();

    $apbdesAktif = Apbdes::with('tahun')
    ->whereHas('tahun', fn ($q) => $q->where('status', 'aktif'))
    ->latest()
    ->first();

    return view('frontend.index',compact(
            'totalWarga',
            'totalKepalaKeluarga',
            'data_kelamin',
            'jenis_kelamin',
            'totalJenisKelamin',
            'laki_laki',
            'perempuan',
            'news',
            'totalBantuan',
            'tanpa_bantuan',
            'apbdesAktif',
            ));
    }

    public function data(Request $request)
{
    // Dropdown wilayah
    $wilayahList = Village::all();

    // Daftar tahun dari tabel citizens
    $listTahun = Citizen::selectRaw('YEAR(created_at) as tahun')
        ->groupBy('tahun')
        ->orderBy('tahun','desc')
        ->pluck('tahun');

    // Parameter filter
    $wilayah = $request->wilayah ?? 0;
    $tahun   = $request->tahun ?? date('Y');

    // Query dasar citizens hidup sampai tahun yang dipilih
    $query = Citizen::query()
        ->where('status_hidup','Hidup')
        ->whereYear('created_at','<=',$tahun);

    if ($wilayah != 0) {
        $query->where('wilayah_id', $wilayah);
    }
    //
    //jumlah warga kk dan dengan bantuan dan tampa bantuan
    //
    //total warga
    $queryCitizen = Citizen::query();
    $queryCitizen->where('status_hidup','Hidup')
        ->whereYear('created_at','<=', $tahun)
        ->when($wilayah != 0, function($q) use ($wilayah) {
            $q->where('citizens.wilayah_id', $wilayah);
        });

    $banjar = $wilayah == 0
    ? 'Desa Sebudi'
    : (Village::where('id', $wilayah)->first()->nama_wilayah ?? 'Tidak Ditemukan');
    $totalWarga = $queryCitizen->count();

    //total kk
    $queryFamilyHead = FamilyHead::query();
    $queryFamilyHead
        ->whereYear('created_at','<=', $tahun)
        ->when($wilayah != 0, function($q) use ($wilayah) {
            $q->where('family_heads.wilayah_id', $wilayah);
        });

    $totalkepalakeluarga = $queryFamilyHead->count();
    //
    // Statistik jenis kelamin
    $pria   = (clone $query)->where('jenis_kelamin','Laki-Laki')->count();
    $wanita = (clone $query)->where('jenis_kelamin','Perempuan')->count();

    $statistik = [
        'pria'   => $pria,
        'wanita' => $wanita,
        'total'  => $pria + $wanita,
    ];

    // Statistik pekerjaan (chart pekerjaan)
    $jumlahPekerjaan = DB::table('citizens')
        ->join('profesions', 'citizens.pekerjaan_id', '=', 'profesions.id')
        ->select(
            'profesions.pekerjaan',
            DB::raw('COUNT(citizens.id) as total')
        )
        ->where('citizens.status_hidup', 'Hidup')
        ->whereYear('citizens.created_at','<=', $tahun)
        ->when($wilayah != 0, function($q) use ($wilayah) {
            $q->where('citizens.wilayah_id', $wilayah);
        })
        ->groupBy('profesions.pekerjaan')
        ->get();

    // Ambil data untuk JS
    $pekerjaanStat = $jumlahPekerjaan->map(function($item) {
        return [
            'pekerjaan' => $item->pekerjaan,
            'jumlah' => $item->total
        ];
    });

    $totalProfesion = $pekerjaanStat->sum('jumlah');

    // Statistik Agama (chart Agama)
    $jumlahAgama = Citizen::with('religion')
    ->select(
        'religions.agama',
        DB::raw('COUNT(citizens.id) as total')
    )
    ->join('religions', 'citizens.agama_id', '=', 'religions.id')
    ->where('citizens.status_hidup', 'Hidup')
    ->whereYear('citizens.created_at','<=', $tahun)
    ->when($wilayah != 0, function($q) use ($wilayah) {
            $q->where('citizens.wilayah_id', $wilayah);
        })
    ->groupBy('religions.agama')
    ->get();
    // Ambil data untuk JS
    $agamaStat = $jumlahAgama->map(function($item) {
        return [
            'agama' => $item->agama,
            'jumlah' => $item->total
        ];
    });

    $totalAgama = $agamaStat->sum('jumlah');
    //chart bantuan

    $jumlahBantuan = DB::table('citizens')
    ->join('assistance_types', 'citizens.bantuan_id', '=', 'assistance_types.id')
    ->select(
        'assistance_types.jenis_bantuan',
        DB::raw('COUNT(citizens.id) as total')
    )
    ->where('citizens.status_hidup', 'Hidup')      // filter hidup
    ->whereYear('citizens.created_at','<=', $tahun)     // filter tahun
    ->when($wilayah != 0, function($q) use ($wilayah) {
            $q->where('citizens.wilayah_id', $wilayah);
        })
    ->groupBy('assistance_types.jenis_bantuan')
    ->get();
    $totalBantuan = $jumlahBantuan->pluck('total')->sum();
    //
    // Ambil data untuk JS
    $bantuanStat = $jumlahBantuan->map(function($item) {
        return [
            'jenis_bantuan' => $item->jenis_bantuan,
            'jumlah' => $item->total
        ];
    });

    $queryAssistance =  Citizen::query();
    if ($tahun) {
        $queryAssistance->whereYear('created_at','<=', $tahun);
    }
    $tanpa_bantuan = $queryAssistance->where('status_hidup','hidup')
                                     ->when($wilayah != 0, function($q) use ($wilayah) {
                                     $q->where('citizens.wilayah_id', $wilayah);
                                      })
                                     ->where('bantuan_id',null)->count();

    //
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
    ->when($wilayah != 0, function($q) use ($wilayah) {
            $q->where('citizens.wilayah_id', $wilayah);
        })

    ->whereYear('citizens.created_at','<=', $tahun)     // filter tahun
    ->where('status_hidup', 'Hidup')
    ->first();

    $umurStat = collect((array) $umur)->map(function ($value, $key) {
    return [
        'kategori' => ucfirst($key),
        'jumlah'   => (int) $value
    ];
    })->values();


    //Hitung Jumlah Warga  Berdasarkan Pendidikan
    $jumlahPendidikan = DB::table('citizens')
    ->join('education_levels', 'citizens.pendidikan_id', '=', 'education_levels.id')
    ->select(
        'education_levels.strata_pendidikan',
        DB::raw('COUNT(citizens.id) as total')
    )
    ->where('citizens.status_hidup', 'Hidup')      // filter hidup
    ->when($wilayah != 0, function($q) use ($wilayah) {
            $q->where('citizens.wilayah_id', $wilayah);
        })
    ->whereYear('citizens.created_at','<=', $tahun)     // filter tahun
    ->groupBy('education_levels.strata_pendidikan')
    ->get();

    $pendidikanStat = $jumlahPendidikan->map(function($item) {
        return [
            'strata_pendidikan' => $item->strata_pendidikan,
            'jumlah' => $item->total
        ];
    });

    //Hitung Jumlah Berdasarkan Perkawinan
    $jumlahPerkawinan = DB::table('citizens')
    ->join('marital_statuses', 'citizens.perkawinan_id', '=', 'marital_statuses.id')
    ->select(
        'marital_statuses.status_pernikahan',
        DB::raw('COUNT(citizens.id) as total')
    )
    ->when($wilayah != 0, function($q) use ($wilayah) {
            $q->where('citizens.wilayah_id', $wilayah);
        })
    ->where('citizens.status_hidup', 'Hidup')      // filter hidup
    ->whereYear('citizens.created_at','<=', $tahun)     // filter tahun
    ->groupBy('marital_statuses.status_pernikahan')
    ->get();

    $perkawinanStat = $jumlahPerkawinan->map(function($item) {
        return [
            'status_pernikahan' => $item->status_pernikahan,
            'jumlah' => $item->total
        ];
    });

    //Hitung Jumlah Berdasarkan BPJS
    $queryJenis = BpjsMember::join('citizens', 'bpjs_members.warga_id', '=', 'citizens.id')
    ->whereYear('citizens.created_at', $tahun)
    ->select(
        'bpjs_members.jenis_bpjs',
        DB::raw('COUNT(bpjs_members.warga_id) as total')
    )
    ->when($wilayah != 0, function($q) use ($wilayah) {
            $q->where('citizens.wilayah_id', $wilayah);
        })
    ->where('status','Active')
    ->groupBy('bpjs_members.jenis_bpjs')
    ->get();

    $queryKategori = BpjsMember::join('citizens', 'bpjs_members.warga_id', '=', 'citizens.id')
    ->whereYear('citizens.created_at', $tahun)
    ->select(
        'bpjs_members.kategori',
        DB::raw('COUNT(bpjs_members.warga_id) as total')
    )
    ->when($wilayah != 0, function($q) use ($wilayah) {
            $q->where('citizens.wilayah_id', $wilayah);
        })
    ->where('status','Active')
    ->groupBy('bpjs_members.kategori')
    ->get();

    $jenisbpjsStat = $queryJenis->map(function($item) {
        return [
            'jenis_bpjs' => $item->jenis_bpjs,
            'jumlah' => $item->total
        ];
    });

    $kategoribpjsStat = $queryKategori->map(function($item) {
        return [
            'kategori' => $item->kategori,
            'jumlah' => $item->total
        ];
    });
    // Kirim ke Blade
    return view('frontend.data', [
        'wilayah'   => $wilayahList,
        'listTahun' => $listTahun,
        'selectedWilayah' => $wilayah,
        'selectedTahun'   => $tahun,
        'statistik'       => $statistik,
        'pekerjaanStat'   => $pekerjaanStat,
        'totalProfesion'  => $totalProfesion,
        'agamaStat'       => $agamaStat,
        'totalAgama'      => $totalAgama,
        'totalWarga'      => $totalWarga,
        'totalKepalaKeluarga' =>$totalkepalakeluarga,
        'banjar'          =>$banjar,
        'bantuanStat'     =>$bantuanStat,
        'tanpa_bantuan'   =>$tanpa_bantuan,
        'totalBantuan'    =>$totalBantuan,
        'umurStat'        =>$umurStat,
        'pendidikanStat'  =>$pendidikanStat,
        'perkawinanStat'  =>$perkawinanStat,
        'jenisbpjsStat'  =>$jenisbpjsStat,
        'kategoribpjsStat'  =>$kategoribpjsStat,
    ]);
}
    public function show($slug)
    {

    $news = News::where('slug', $slug)->firstOrFail();
    $news->increment('views');


    $latestNews = News::orderBy('created_at', 'desc')
                  ->take(5)
                  ->get();

    return view('frontend.news.show', compact('news','latestNews'));
    }

    public function utama ()
    {
    $news = News::orderBy('created_at', 'desc')
        ->paginate(2);

    $latestNews = News::orderBy('created_at', 'desc')
                  ->take(5)
                  ->get();

    return view('frontend.news.index', compact('news','latestNews'));
    }

    public function profil ()
    {

    return view('frontend.profil');
    }

   public function suratdesa(Request $request)
{
    $kategori = $request->kategori;

    // Ambil tahun sekarang otomatis
    $tahunSekarang = Carbon::now()->year;

    $query = SuratDesa::where('tahun', $tahunSekarang);

    // Filter berdasarkan kategori saja
    if ($kategori) {
        $query->where('kategori', $kategori);
    }

    $surat = $query->latest()->get();

    $kategoriList = [
        'Peraturan Desa',
        'Keputusan Perbekel',
        'Pengumuman'
    ];

    return view('frontend.surat-desa', compact(
        'surat',
        'kategoriList',
        'kategori',
        'tahunSekarang'
    ));
}
    public function danadesa()
    {
    $apbdesAktif = Apbdes::with('tahun')
    ->whereHas('tahun', fn ($q) => $q->where('status', 'aktif'))
    ->latest()
    ->first();

    return view('frontend.dana-desa', compact(
        'apbdesAktif'

    ));

    }


}
