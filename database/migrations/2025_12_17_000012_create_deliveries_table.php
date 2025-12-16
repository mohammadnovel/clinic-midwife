<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('pregnancy_id')->constrained()->cascadeOnDelete();
            $table->foreignUuid('appointment_id')->nullable()->constrained('appointments');
            $table->dateTime('delivery_time');
            $table->string('method');
            $table->string('birth_condition');
            $table->integer('duration_first_stage')->nullable();
            $table->integer('duration_second_stage')->nullable();
            $table->integer('duration_third_stage')->nullable();
            $table->text('complications')->nullable();
            $table->text('placenta_delivery')->nullable();
            $table->text('perineum_condition')->nullable();
            $table->integer('blood_loss_ml')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};
