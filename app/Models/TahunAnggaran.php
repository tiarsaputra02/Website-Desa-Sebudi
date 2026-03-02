<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAnggaran extends Model
{
     use HasFactory;

    protected $table = 'tahun_anggaran';

    protected $fillable = [
        'tahun',
        'status',
    ];

    protected $casts = [
        'tahun' => 'integer',
    ];

    /**
     * Relasi ke APBDes
     */
    public function apbdes()
    {
        return $this->hasOne(Apbdes::class, 'tahun_id');
    }

    /**
     * Scope: Tahun aktif
     */
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    } 
}
