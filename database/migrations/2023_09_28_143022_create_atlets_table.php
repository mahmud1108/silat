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
        Schema::create('atlets', function (Blueprint $table) {
            $table->id();
            $table->string('atlet_nama_lengkap');
            $table->string('atlet_tempat_lahir');
            $table->date('atlet_tanggal_lahir');
            $table->enum('atlet_jenis_kelamin', ['L', 'P']);
            $table->text('atlet_alamat');
            $table->string('no_hp');
            $table->string('atlet_foto');
            $table->string('atlet_email');
            $table->string('atlet_password');
            $table->enum('atlet_status', ['Aktif', 'Tidak Aktif']);
            $table->string('atlet_keterangan');
            $table->foreignId('kategori_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('kelas_usia_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atlets');
    }
};
