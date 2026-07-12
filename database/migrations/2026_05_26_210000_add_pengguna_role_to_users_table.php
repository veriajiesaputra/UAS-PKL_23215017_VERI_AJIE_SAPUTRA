<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'petugas', 'pengguna') NOT NULL DEFAULT 'pengguna'");
    }

    public function down(): void
    {
        DB::table('users')->where('role', 'pengguna')->update(['role' => 'petugas']);

        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'petugas') NOT NULL DEFAULT 'petugas'");
    }
};
