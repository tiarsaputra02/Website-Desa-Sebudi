<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apbdes extends Model
{
   use HasFactory;

    protected $table = 'apbdes';

    /**
     * Field yang boleh diisi (mass assignment)
     */
    protected $fillable = [
        'tahun_id',
        'total_pendapatan',
        'total_belanja',
        'surplus_defisit',
        'keterangan',
    ];

    /**
     * Casting tipe data
     */
    protected $casts = [
        'total_pendapatan' => 'decimal:2',
        'total_belanja' => 'decimal:2',
        'surplus_defisit' => 'decimal:2',
    ];

    /**
     * Relasi ke Tahun Anggaran
     * APBDes milik 1 Tahun Anggaran
     */
    public function tahun()
    {
        return $this->belongsTo(TahunAnggaran::class, 'tahun_id');
    }

    /**
     * Auto hitung surplus/defisit sebelum disimpan
     */
    protected static function booted()
    {
        static::saving(function ($apbdes) {
            $apbdes->surplus_defisit =
                $apbdes->total_pendapatan - $apbdes->total_belanja;
        });
    } 
}
