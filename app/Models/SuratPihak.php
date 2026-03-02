<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratPihak extends Model
{
    use HasFactory;

    protected $table = 'surat_pihak';

    protected $fillable = [
        'surat_id',
        'citizens_id',
        'nama_lengkap',
        'nik',
        'tanggal_lahir',
        'peran',
    ];

    /**
     * Pihak ini milik surat tertentu
     */
    public function surat()
    {
        return $this->belongsTo(Surat::class, 'surat_id');
    }

    /**
     * Pihak ini bisa punya data warga (citizen)
     */
    public function citizen()
    {
        return $this->belongsTo(Citizen::class, 'citizens_id');
    }
}
