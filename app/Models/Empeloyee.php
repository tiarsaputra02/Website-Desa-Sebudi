<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empeloyee extends Model
{
    use HasFactory, SoftDeletes;
    protected  $fillable = ['fullname','email','phone_number','role_id'];


    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
