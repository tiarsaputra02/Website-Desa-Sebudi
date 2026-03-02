<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratDesa extends Model
{
    use HasFactory;

    protected $table = 'surat_desa';

    protected $fillable = [
        'judul',
        'kategori',
        'tahun',
        'file'
    ];

    // Optional: scope untuk tahun aktif (tahun terbaru)
    public function scopeTahunTerbaru($query)
    {
        return $query->where('tahun', self::max('tahun'));
    }
}
