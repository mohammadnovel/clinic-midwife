<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pnc_visits', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('delivery_id')->constrained()->cascadeOnDelete();
            $table->foreignUuid('appointment_id')->constrained()->cascadeOnDelete();
            $table->string('visit_code');
            $table->string('lochia_condition')->nullable();
            $table->string('uterine_involution')->nullable();
            $table->string('blood_pressure')->nullable();
            $table->boolean('breastfeeding_status')->default(true);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pnc_visits');
    }
};
