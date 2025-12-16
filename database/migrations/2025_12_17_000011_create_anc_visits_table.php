<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('anc_visits', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('pregnancy_id')->constrained()->cascadeOnDelete();
            $table->foreignUuid('appointment_id')->constrained()->cascadeOnDelete();
            $table->integer('gestational_age_weeks')->nullable();
            $table->string('fundal_height')->nullable();
            $table->string('fetal_heart_rate')->nullable();
            $table->string('fetal_position')->nullable();
            $table->string('weight')->nullable();
            $table->string('blood_pressure')->nullable();
            $table->text('lab_results')->nullable();
            $table->text('complaints')->nullable();
            $table->text('actions')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anc_visits');
    }
};
