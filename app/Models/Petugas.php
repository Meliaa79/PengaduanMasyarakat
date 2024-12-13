<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    use HasFactory;

    protected $table = 'petugas'; // Pastikan sesuai dengan nama tabel Anda

    protected $fillable = [
        'nama',
        'telepon',
        'alamat',
        'status',
    ];
}
