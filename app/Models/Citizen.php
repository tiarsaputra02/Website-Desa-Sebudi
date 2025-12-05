<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Citizen extends Model
{
    use HasFactory ;
    protected  $fillable =
    [
        'nik',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'kewarganegaraan',
        'status_keluarga',
        'ayah',
        'ibu',
        'status_hidup',
        'tanggal_kematian',
        'wilayah_id',
        'agama_id',
        'pendidikan_id',
        'kepala_keluarga',
        'pekerjaan_id',
        'perkawinan_id',
        'bantuan_id'
    ];


    public function Villages()
    {
        return $this->belongsTo(Village::class, 'wilayah_id');
    }

    public function Religion()
    {
        return $this->belongsTo(Religion::class, 'agama_id');
    }

    public function EducationLevel()
    {
        return $this->belongsTo(EducationLevel::class, 'pendidikan_id');
    }

    public function FamilyHead()
    {
        return $this->belongsTo(FamilyHead::class, 'kepala_keluarga');
    }

    public function Profesion()
    {
        return $this->belongsTo(Profesion::class, 'pekerjaan_id');
    }

    public function MaritalStatus()
    {
        return $this->belongsTo(MaritalStatus::class, 'perkawinan_id');
    }

    public function AssistanceTypes()
    {
        return $this->belongsTo(AssistanceTypes::class, 'bantuan_id');
    }
    
    public function BpjsMember()
    {
        return $this->hasMany(BpjsMember::class,'warga_id');
    }
}
