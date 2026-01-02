<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Tambah biaya_periksa ke tabel dokter_hewan
        Schema::table('dokter_hewan', function (Blueprint $table) {
            $table->integer('biaya_periksa')->default(0)->after('no_sip');
        });

        // Tambah biaya_tindakan ke tabel pemeriksaan
        Schema::table('pemeriksaan', function (Blueprint $table) {
            $table->integer('biaya_tindakan')->default(0)->after('tindakan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dokter_hewan', function (Blueprint $table) {
            $table->dropColumn('biaya_periksa');
        });

        Schema::table('pemeriksaan', function (Blueprint $table) {
            $table->dropColumn('biaya_tindakan');
        });
    }
};
