<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('babies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('delivery_id')->constrained()->cascadeOnDelete();
            $table->foreignUuid('patient_id')->comment('Mother ID')->constrained('patients');
            $table->string('name')->nullable();
            $table->enum('gender', ['male', 'female']);
            $table->decimal('birth_weight', 4, 3);
            $table->decimal('birth_length', 4, 1);
            $table->string('birth_condition')->default('Healthy');
            $table->time('birth_time');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('babies');
    }
};
