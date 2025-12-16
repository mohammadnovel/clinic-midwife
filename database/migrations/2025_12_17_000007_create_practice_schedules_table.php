<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('practice_schedules', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('midwife_id')->constrained('midwives')->cascadeOnDelete();
            $table->string('day'); // Monday, Tuesday...
            $table->time('start_time');
            $table->time('end_time');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('practice_schedules');
    }
};
