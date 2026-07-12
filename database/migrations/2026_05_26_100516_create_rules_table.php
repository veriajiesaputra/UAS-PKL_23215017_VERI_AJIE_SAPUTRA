<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rules', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis', ['penyakit', 'hama']);
            $table->unsignedBigInteger('target_id');
            $table->timestamps();

            $table->index(['jenis', 'target_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rules');
    }
};
