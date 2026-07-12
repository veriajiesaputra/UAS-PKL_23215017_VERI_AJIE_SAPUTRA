<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rule_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rule_id')->constrained('rules')->cascadeOnDelete();
            $table->foreignId('gejala_id')->constrained('gejala')->cascadeOnDelete();
            $table->decimal('nilai_cf', 4, 2);
            $table->timestamps();

            $table->unique(['rule_id', 'gejala_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rule_details');
    }
};
