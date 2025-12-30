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
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->char('id_pendaftaran', 8)->primary();
            $table->char('id_pemilik_hewan', 8)->nullable();
            $table->char('id_pegawai', 8)->nullable();
            $table->date('tanggal_daftar')->nullable();
            $table->string('status', 10)->nullable();
            $table->text('keluhan')->nullable();
            $table->timestamps();
            
            $table->foreign('id_pemilik_hewan')->references('id_pemilik_hewan')->on('pemilik_hewan');
            $table->foreign('id_pegawai')->references('id_pegawai')->on('pegawai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran');
    }
};
