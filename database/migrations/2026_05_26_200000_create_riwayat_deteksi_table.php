<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('riwayat_deteksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('nama_pengguna')->nullable();
            $table->enum('jenis_hasil', ['penyakit', 'hama']);
            $table->unsignedBigInteger('target_id');
            $table->string('nama_target');
            $table->string('kode_target')->nullable();
            $table->decimal('nilai_cf', 5, 4)->default(0);
            $table->json('gejala_terpilih');
            $table->string('ip_address', 45)->nullable();
            $table->timestamps();

            $table->index(['jenis_hasil', 'target_id']);
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('riwayat_deteksi');
    }
};
