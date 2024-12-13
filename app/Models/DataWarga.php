<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataWarga extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dari plural nama model
    protected $table = 'datawarga';

    // Tentukan kolom yang bisa diisi (mass assignment)
    protected $fillable = ['nama', 'nik', 'telepon', 'password'];
}
