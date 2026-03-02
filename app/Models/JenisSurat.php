<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class JenisSurat extends Model
{
use HasFactory;

    protected $table = 'jenis_surat';

    protected $fillable = [
        'kode_surat',
        'nama_surat',
        'slug',
        'template_path',
        'aktif',
    ];

    /**
     * Satu jenis surat bisa punya banyak surat
     */
    public function surat()
    {
        return $this->hasMany(Surat::class, 'jenis_surat_id');
    }

    protected static function booted()
{
    static::creating(function ($jenisSurat) {
        if (empty($jenisSurat->slug)) {
            $jenisSurat->slug = Str::slug($jenisSurat->nama_surat);
        }
    });
}
}
