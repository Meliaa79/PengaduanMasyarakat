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
        Schema::table('petugas', function (Blueprint $table) {
            $table->enum('status', ['aktif', 'non-aktif'])->default('aktif'); // Menambahkan kolom status
        });
    }
    
    public function down()
    {
        Schema::table('petugas', function (Blueprint $table) {
            $table->dropColumn('status'); // Menghapus kolom status jika migrasi dibatalkan
        });
    }
    
};
