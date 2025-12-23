<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Citizen;
use App\Models\Village;
use App\Models\Religion;
use App\Models\Profesion;
use App\Models\MaritalStatus;
use App\Models\FamilyHead;
use App\Models\EducationLevel;
use App\Models\AssistanceTypes;
use Carbon\Carbon;

class CitizenSebudiController extends Controller
{
    //
    public function index($id)
    {
        $citizen = Citizen::where('wilayah_id', $id)->get();
        return view('citizen.sebudi.index',compact('citizen'));
    }

    public function create($id)
    {
       $village = Village::all();
       $religion = Religion::all();
       $profesion = Profesion::all();
       $maritalstatus = MaritalStatus::all();
       $familyhead = FamilyHead::findOrfail($id);
       $educationlevel = EducationLevel::all();
       $assistancetypes = AssistanceTypes::all();

        return view('citizen.sebudi.create',compact('village','religion','profesion','maritalstatus','familyhead','educationlevel','assistancetypes'));
    }

    public function store(Request $request)
    {
         $validatedData = $request->validate([
        'nama_lengkap'     => 'required|string|max:255',
        'nik'              => 'required|digits:16|unique:citizens,nik',
        'tempat_lahir'     => 'required|string|max:255',
        'tanggal_lahir'    => 'required|date',
        'jenis_kelamin'    => 'required|in:Laki-Laki,Perempuan',
        'kewarganegaraan'  => 'required|string|max:255',
        'status_keluarga'  => 'required',
        'ayah'             => 'required|string|max:255',
        'ibu'              => 'required|string|max:255',
        'status_hidup'     => 'required|in:Hidup,Mati',
        'wilayah_id'       => 'required|integer',
        'agama_id'         => 'required|integer',
        'pendidikan_id'    => 'required|integer',
        'kepala_keluarga'  => 'required|integer',
        'pekerjaan_id'     => 'required|integer',
        'perkawinan_id'    => 'required|integer',
        'bantuan_id'       => 'nullable|integer',
    ], [
        // 💬 Custom message Bahasa Indonesia
        'nama_lengkap.required'     => 'Nama warga wajib diisi.',
        'nik.required'              => 'Nomor Induk Kependudukan wajib diisi.',
        'nik.digits'                => 'Nomor Induk Kependudukan harus terdiri dari 16 digit.',
        'nik.unique'                => 'Nomor Induk Kependudukan sudah terdaftar.',
        'tempat_lahir.required'     => 'Tempat lahir wajib diisi.',
        'tanggal_lahir.required'    => 'Tanggal lahir wajib diisi.',
        'tanggal_lahir.date'        => 'Format tanggal lahir tidak valid.',
        'jenis_kelamin.required'    => 'Jenis kelamin wajib dipilih.',
        'kewarganegaraan.required'  => 'kewarganegaraan lengkap wajib diisi.',
        'status_keluarga.required'  => 'Status keluarga wajib dipilih.',
        'ayah.required'             => 'Nama ayah wajib diisi.',
        'ibu.required'              => 'Nama ibu wajib diisi.',
        'status_hidup.required'     => 'Status hidup wajib dipilih.',
        'wilayah_id.required'       => 'Wilayah wajib diisi.',
        'agama_id.required'         => 'Agama wajib dipilih.',
        'pendidikan_id.required'    => 'Pendidikan wajib dipilih.',
        'kepala_keluarga.required'  => 'Kepala keluarga wajib dipilih.',
        'pekerjaan_id.required'     => 'Pekerjaan wajib dipilih.',
        'perkawinan_id.required'    => 'Status perkawinan wajib dipilih.',
    ]);
         // ✅ Simpan data ke database
    \App\Models\Citizen::create([
        'nama_lengkap'    => strtoupper($validatedData['nama_lengkap']),
        'nik'             => $validatedData['nik'],
        'tempat_lahir'    => strtoupper($validatedData['tempat_lahir']),
        'tanggal_lahir'   => $validatedData['tanggal_lahir'],
        'jenis_kelamin'   => $validatedData['jenis_kelamin'],
        'kewarganegaraan' => $validatedData['kewarganegaraan'],
        'status_keluarga' => $validatedData['status_keluarga'],
        'ayah'            => strtoupper($validatedData['ayah']),
        'ibu'             => strtoupper($validatedData['ibu']),
        'status_hidup'    => $validatedData['status_hidup'],
        'wilayah_id'      => $validatedData['wilayah_id'],
        'agama_id'        => $validatedData['agama_id'],
        'pendidikan_id'   => $validatedData['pendidikan_id'],
        'kepala_keluarga' => $validatedData['kepala_keluarga'],
        'pekerjaan_id'    => $validatedData['pekerjaan_id'],
        'perkawinan_id'   => $validatedData['perkawinan_id'],
        'bantuan_id'      => $validatedData['bantuan_id'],
        ]);
        return redirect()->route('sebudi.show',$request->kepala_keluarga)->with('success','Data ( '. $request->nama_lengkap . ' ) Berhasil Di Tambahkan');
    }

    public function edit( $id)
    {
        $citizen = Citizen::findOrfail($id);
        $religion  = Religion::all();
        $educationlevel = EducationLevel::all();
        $profesion = Profesion::all();
        $maritalstatus = MaritalStatus::all();
        $assistancetypes = AssistanceTypes::all();
        return view('citizen.sebudi.edit',compact('citizen','religion','profesion','educationlevel','maritalstatus','assistancetypes'));
    }
    public function update(Request $request, $id)
    {
        $citizen = Citizen::findOrfail($id);
        $validatedData = $request->validate([
        'nama_lengkap'     => 'required|string|max:255',
        'nik'              => "required|digits:16|numeric|unique:citizens,nik,{$citizen->id}",
        'tempat_lahir'     => 'required|string|max:255',
        'tanggal_lahir'    => 'required|date',
        'jenis_kelamin'    => 'required|in:Laki-Laki,Perempuan',
        'status_keluarga'  => 'required',
        'ayah'             => 'required|string|max:255',
        'kewarganegaraan'  => 'required|string|max:255',
        'ibu'              => 'required|string|max:255',
        'status_hidup'     => 'required',
        'agama_id'         => 'required|integer',
        'pendidikan_id'    => 'required|integer',
        'kepala_keluarga'  => 'required|integer',
        'pekerjaan_id'     => 'required|integer',
        'perkawinan_id'    => 'required|integer',
        'bantuan_id'       => 'nullable|integer',
    ]);
        $validatedData['nama_lengkap'] = strtoupper($validatedData['nama_lengkap']);
        $validatedData['tempat_lahir'] = strtoupper($validatedData['tempat_lahir']);
        $validatedData['ayah'] = strtoupper($validatedData['ayah']);
        $validatedData['ibu'] = strtoupper($validatedData['ibu']);
        $citizen->update($validatedData);
        return redirect()->route('sebudi.show',$request->kepala_keluarga)->with('success','Data ( '. $request->nama_lengkap . ' ) Berhasil Di Perbaharui');

    }
    public function Show($id)
    {
        $citizen = Citizen::findOrfail($id);
        if ($citizen) {

           $birthdate = $citizen->tanggal_lahir ;

            $dateofbirth =  Carbon::parse($birthdate);

            $age = floor($dateofbirth->diffInYears(Carbon::now()));
            $age = round($dateofbirth->diffInYears(Carbon::now()),0);

        }
        $dateOfBirth = Carbon::createFromFormat('Y-m-d', $citizen->tanggal_lahir);
        $tanggal_lahir = $dateOfBirth->format('d-m-Y');

        return view('citizen.sebudi.show',compact('citizen','age','tanggal_lahir'));
    }

    public function destroy($id)
    {
        $citizen = Citizen::findOrfail($id);
        $family_id = $citizen->kepala_keluarga;
        $nama = $citizen->nama_lengkap;
        $citizen->delete();
        return redirect()->route('sebudi.show',$family_id)->with('success','Data ( ' . $nama .  ' ) Berhasil Di Hapus');

    }
}
