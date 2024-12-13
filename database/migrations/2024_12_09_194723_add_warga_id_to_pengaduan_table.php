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
        $table->unsignedBigInteger('warga_id')->nullable()->after('id'); // Kolom untuk menghubungkan warga
        $table->foreign('warga_id')->references('id')->on('tambahwarga')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengaduan', function (Blueprint $table) {
            //
        });
    }
};
