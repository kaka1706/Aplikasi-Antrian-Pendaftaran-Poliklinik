<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->after('password');
            $table->unsignedBigInteger('clinic_id')->nullable()->after('role');

            // optional: foreign key kalau ada tabel clinics
            // $table->foreign('clinic_id')->references('id')->on('clinics')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // optional kalau pakai foreign key
            // $table->dropForeign(['clinic_id']);

            $table->dropColumn(['role', 'clinic_id']);
        });
    }
};
