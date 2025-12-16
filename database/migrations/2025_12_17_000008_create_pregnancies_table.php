<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pregnancies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('patient_id')->constrained()->cascadeOnDelete();
            $table->date('hpht')->nullable();
            $table->date('hpl')->nullable();
            $table->integer('gravida')->default(1);
            $table->integer('partus')->default(0);
            $table->integer('abortus')->default(0);
            $table->text('history_notes')->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pregnancies');
    }
};
