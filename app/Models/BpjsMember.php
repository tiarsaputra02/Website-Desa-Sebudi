<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BpjsMember extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'warga_id',
        'jenis_bpjs',
        'kategori',
        'status',
        'nomor_kartu'
    ];

    public function Citizen()
    {
        return $this->belongsTo(Citizen::class,'warga_id');
    }
}
