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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->string('jml_bangku');
            $table->string('maps');
            $table->string('jemput');
            $table->string('turun');
            $table->string('biaya');
            $table->string('keterangan');
            $table->string('cancled')->nullable();
            $table->string('keberangkatan_id');
            $table->string('user_id');
            $table->date('update_tanggal')->nullable();
            $table->string('is_update_tanggal')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
