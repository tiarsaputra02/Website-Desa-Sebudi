<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Citizen;
use App\Models\FamilyHead;
use App\Models\Religion;
use App\Models\BpjsMember;
class FrontEndController extends Controller
{
    public function index()
    {

    $tahun = 2025;
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


    return view('frontend.index',compact(
            'totalWarga',
            'totalKepalaKeluarga',
            'data_kelamin',
            'jenis_kelamin',
            'totalJenisKelamin',
            'laki_laki',
            'perempuan',
            ));
    }
}
