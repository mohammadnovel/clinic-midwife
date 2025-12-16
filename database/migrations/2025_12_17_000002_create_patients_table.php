<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->string('nik', 16)->unique()->nullable();
            $table->string('name');
            $table->date('date_of_birth');
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('blood_type', 3)->nullable();
            $table->string('husband_name')->nullable();
            $table->string('husband_phone')->nullable();
            $table->string('bpjs_number')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
