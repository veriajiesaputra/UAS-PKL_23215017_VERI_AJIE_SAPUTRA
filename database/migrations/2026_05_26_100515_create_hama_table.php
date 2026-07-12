<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hama', function (Blueprint $table) {
            $table->id();
            $table->string('kode_hama', 20)->unique();
            $table->string('nama_hama');
            $table->text('deskripsi')->nullable();
            $table->text('solusi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hama');
    }
};
