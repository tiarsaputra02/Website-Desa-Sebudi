<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;

class FamilyHead extends Model
{

    use HasFactory;
    protected  $fillable = ['no_kk','kepala_keluarga','wilayah_id','photo_kk'];

    protected function kepalaKeluarga(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => strtoupper($value)
        );
    }

    public function village()
    {
        return $this->belongsTo(Village::class, 'wilayah_id');
    }

    public function citizen()
    {
        return $this->hasMany(Citizen::class, 'kepala_keluarga');
    }
    public function surat()
    {
    return $this->hasMany(Surat::class, 'family_id');
    }
}
