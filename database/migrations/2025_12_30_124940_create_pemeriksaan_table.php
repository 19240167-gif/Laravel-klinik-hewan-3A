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
        Schema::create('pemeriksaan', function (Blueprint $table) {
            $table->char('id_pemeriksaan', 8)->primary();
            $table->char('id_pendaftaran', 8)->nullable();
            $table->char('id_dokter_hewan', 8)->nullable();
            $table->text('diagnosa')->nullable();
            $table->text('tindakan')->nullable();
            $table->date('tanggal_periksa')->nullable();
            $table->timestamps();
            
            $table->foreign('id_pendaftaran')->references('id_pendaftaran')->on('pendaftaran');
            $table->foreign('id_dokter_hewan')->references('id_dokter_hewan')->on('dokter_hewan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan');
    }
};
