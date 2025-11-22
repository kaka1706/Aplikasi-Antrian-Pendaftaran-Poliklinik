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
        Schema::create('poli_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('poli_id')->constrained('polies')->onDelete('cascade');
            $table->string('day_of_week'); // Mon, Tue, Wed, etc
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('quota')->default(20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poli_schedules');
    }
};
