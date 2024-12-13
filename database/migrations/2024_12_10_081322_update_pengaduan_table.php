<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('pengaduan', function (Blueprint $table) {
        // Menghapus kolom judul_pengaduan
        $table->dropColumn('judul_pengaduan');
        
        // Menambahkan kolom kategori_pengaduan
        $table->string('kategori_pengaduan')->after('tanggal_pengaduan');
    });
}

public function down()
{
    Schema::table('pengaduan', function (Blueprint $table) {
        // Menambahkan kembali kolom judul_pengaduan jika rollback
        $table->string('judul_pengaduan')->after('tanggal_pengaduan');
        
        // Menghapus kolom kategori_pengaduan jika rollback
        $table->dropColumn('kategori_pengaduan');
    });
}


};
