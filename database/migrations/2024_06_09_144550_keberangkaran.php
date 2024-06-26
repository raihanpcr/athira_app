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
        Schema::create('keberangkatan', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('asal');
            $table->string('tujuan');
            $table->string('kuota');
            $table->string('pukul');
            $table->string('keterangan')->default('Tersedia');
            $table->string('mobil_id');
            $table->string('supir_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keberangkatan');
    }
};
