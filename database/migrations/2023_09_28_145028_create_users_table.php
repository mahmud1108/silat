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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('user_username');
            $table->string('password');
            $table->string('user_gambar');
            $table->string('user_no_hp');
            $table->string('user_email');
            $table->text('user_alamat');
            $table->string('user_nama');
            $table->enum('role', ['admin', 'pelatih']);
            $table->enum('user_status', ['aktif', 'tidak aktif']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
