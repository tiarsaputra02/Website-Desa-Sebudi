<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;

    protected $table = 'surat';

    protected $fillable = [
        'jenis_surat_id',
        'nama_surat',
        'nomor_surat',
        'tanggal_surat',
        'family_id',
        'file_path'
        // tambahin field lain sesuai kebutuhan
    ];

    /**
     * Surat ini milik jenis surat tertentu
     */
    public function jenisSurat()
    {
        return $this->belongsTo(JenisSurat::class, 'jenis_surat_id');
    }

    /**
     * Surat ini punya banyak pihak
     */
    public function pihak()
    {
        return $this->hasMany(SuratPihak::class, 'surat_id');
    }
    public function family()
    {
    return $this->belongsTo(FamilyHead::class, 'family_id');
    }
}
