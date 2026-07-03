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
        Schema::table('cash_outflows', function (Blueprint $table) {
            // Menambahkan kolom user_id setelah kolom id secara otomatis
            // nullable() dipasang supaya data lama yang sudah ada tidak bikin crash/error
            $table->foreignId('user_id')->nullable()->after('id')->constrained('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cash_outflows', function (Blueprint $table) {
            // Menghapus hubungan (foreign key) dan kolomnya jika migration di-rollback
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};