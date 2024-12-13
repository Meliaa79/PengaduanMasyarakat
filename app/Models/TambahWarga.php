<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TambahWarga extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dari nama model (opsional)
    protected $table = 'tambahwarga';

    // Tentukan field yang bisa diisi secara massal
    protected $fillable = ['nama', 'nik', 'telepon', 'password'];
    
    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class, 'user_id', 'id');
    }

}
