<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveUserIdFromPengaduanTable extends Migration
{
    /**
     * Mengembalikan perubahan migrasi.
     *
     * @return void
     */
    public function up()
    {
        // Menghapus kolom user_id dari tabel pengaduan
        // Schema::table('pengaduan', function (Blueprint $table) {
        //     $table->dropColumn('user_id');
        // });
    }

    /**
     * Membatalkan perubahan migrasi.
     *
     * @return void
     */
    public function down()
    {
        // Menambahkan kolom user_id lagi (jika diperlukan untuk rollback)
        // Schema::table('pengaduan', function (Blueprint $table) {
        //     $table->integer('user_id');
        // });
    }
}
