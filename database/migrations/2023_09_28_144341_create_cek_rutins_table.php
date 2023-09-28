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
        Schema::create('cek_rutins', function (Blueprint $table) {
            $table->id();
            $table->float('cr_tb');
            $table->float('cr_bb');
            $table->float('cr_mental');
            $table->float('cr_fisik');
            $table->date('cr_waktu');
            $table->foreignId('atlet_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('kelas_usia_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('kategori_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cek_rutins');
    }
};
