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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->char('id_pembayaran', 8)->primary();
            $table->char('id_pemeriksaan', 8)->nullable();
            $table->date('tanggal_bayar')->nullable();
            $table->string('metode_bayar', 10)->nullable();
            $table->integer('total_bayar')->nullable();
            $table->timestamps();
            
            $table->foreign('id_pemeriksaan')->references('id_pemeriksaan')->on('pemeriksaan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
