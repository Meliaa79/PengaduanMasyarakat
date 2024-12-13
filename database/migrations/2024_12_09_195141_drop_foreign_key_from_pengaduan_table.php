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
    // Schema::table('pengaduan', function (Blueprint $table) {
    //     // Pastikan foreign key dihapus terlebih dahulu
    //     $table->dropForeign(['user_id']); // Menghapus foreign key constraint
    // });
}

public function down()
{
    // Schema::table('pengaduan', function (Blueprint $table) {
    //     // Jika rollback, kita tambahkan kembali foreign key constraint
    //     $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    // });
}

};
