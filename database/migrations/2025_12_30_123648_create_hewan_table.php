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
        Schema::create('hewan', function (Blueprint $table) {
            $table->char('id_hewan', 8)->primary();
            $table->string('nama_hewan', 10)->nullable();
            $table->string('jenis_hewan', 10)->nullable();
            $table->enum('jenis_kelamin', ['jantan','betina'])->nullable();
            $table->string('umur', 2)->nullable();
            $table->char('id_pemilik_hewan', 8)->nullable();
            $table->timestamps();
            
            $table->foreign('id_pemilik_hewan')->references('id_pemilik_hewan')->on('pemilik_hewan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hewan');
    }
};
