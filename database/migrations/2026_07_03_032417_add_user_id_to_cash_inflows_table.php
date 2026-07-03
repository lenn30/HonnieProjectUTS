<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('cash_inflows', function (Blueprint $table) {
            // Menambahkan kolom user_id setelah kolom id
            // Dibuat nullable() agar data lama yang sudah ada di database tidak error
            $table->foreignId('user_id')->nullable()->after('id')->constrained('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('cash_inflows', function (Blueprint $table) {
            // Untuk menghapus kolom jika sewaktu-waktu migration di-rollback
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};