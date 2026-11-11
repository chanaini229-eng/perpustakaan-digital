<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Hubungkan akun login dengan data anggota.
        Schema::table('anggotas', function (Blueprint $table) {
            $table->foreignId('user_id')
                ->nullable()
                ->unique()
                ->constrained('users')
                ->nullOnDelete();
        });

        // Status untuk proses pengajuan dan persetujuan.
        Schema::table('peminjamans', function (Blueprint $table) {
            $table->string('status')
                ->default('disetujui');
        });

        // Stok awal 0 agar ketersediaan tidak ditebak.
        Schema::table('bukus', function (Blueprint $table) {
            $table->unsignedInteger('stok')->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('bukus', function (Blueprint $table) {
            $table->dropColumn('stok');
        });

        Schema::table('peminjamans', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('anggotas', function (Blueprint $table) {
            $table->dropUnique(['user_id']);
            $table->dropConstrainedForeignId('user_id');
        });
    }
};
