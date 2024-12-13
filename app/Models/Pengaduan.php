<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;
    protected $table = 'pengaduan';

    protected $fillable = [
        'nama',
        'kategori_pengaduan',
        'deskripsi',
        'tanggal_pengaduan',
        'status',
        'nama_petugas',
        'tanggal_dikerjakan',
        'umur',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    protected $casts = [
        'tanggal_pengaduan' => 'date',
        'tanggal_dikerjakan' => 'date',
    ];

    public function warga()
{
    return $this->belongsTo(TambahWarga::class, 'warga_id');
}

}
